<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Milestone extends BaseMilestone
{

	public function setUp()
	{
		 
		parent::setUp();

		$this->hasMany('Task', array('local' => 'milestone_id',
                                 'foreign' => 'milestone_id',
  								 'cascade' => array('delete')));
		
		$this->hasMany('EventLog as History', array('local' => 'milestone_id',
                                'foreign' => 'milestone_id'));
	}


	public function save( Doctrine_Connection $con = null)
	{

		if (!$con){
			$con = Doctrine_Manager::connection();
		}

		try {
			
			$con->beginTransaction();
			
			$ret = parent::save($con);
			
			//create an event log
			$evl = new EventLog();
			$evl->setAccountId($this->getProject()->getProjectAccount()->getAccountId());
			$evl->setMilestoneId($this->getMilestoneId());
			$evl->setUserId($this->getCreatedBy());
			$evl->setAction($id?'UPDATE':'CREATE');
			$evl->setActionDetail(serialize($this));
			$evl->setCreated(date("Y-m-d H:i:s"));
			$evl->save($con);
				
				
			$this->updateLuceneIndex();
			$con->commit();
			return $ret;

		}catch (Doctrine_Exception $e) {
			$con->rollback();
			error_log ($e->getMessage());
			return false;
		}

	}


	public function updateLuceneIndex()
	{

		$accountId = $this->getProject()->getProjectAccount()->getId();

		$index = MilestoneTable::getLuceneIndex($accountId);

		// remove an existing entry
		if ($hit = $index->find('pk:'.$this->getMilestoneId()))
		{
			$index->delete($hit->id);
		}

		// don't index expired events
		//      if ($this->getEventDate() < today)
		//      {
		//          return;
		//      }

		$doc = new Zend_Search_Lucene_Document();

		// store primary key URL to identify it in the search results
		$doc->addField(Zend_Search_Lucene_Field::UnIndexed('pk', $this->getMilestoneId()));

		// index fields
		$doc->addField(Zend_Search_Lucene_Field::UnStored('name', $this->getName(), 'utf-8'));
		$doc->addField(Zend_Search_Lucene_Field::UnStored('description', $this->getDescription(), 'utf-8'));

		// add job to the index
		$index->addDocument($doc);
		$index->commit();
	}


	// lib/model/JobeetJob.php
	public function delete(Doctrine_Connection $con = null)
	{
		
		if (!$con){
			$con = Doctrine_Manager::connection();
		}

		try {
			
			$index = MilestoneTable::getLuceneIndex();
			if ($hit = $index->find('pk:'.$this->getMilestoneId()))
			{
				$index->delete($hit->id);
			}
			

			//create an event log
			$evl = new EventLog();
			$evl->setUserId($this->getCreatedBy());
			$evl->setAction('DELETE');
			$evl->setActionDetail(serialize(array(get_class($this), $this->getName())));
			$evl->setCreated(date("Y-m-d H:i:s"));
			$evl->save($con);

			return parent::delete($con);

		}catch (Doctrine_Exception $e) {
			$con->rollback();
			error_log ($e->getMessage());
			return false;
		}
	}



}