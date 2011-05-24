<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
 
class TaskTable extends Doctrine_Table
{	
	static public function getTasksSansMilestones($pid){
		
		$q = Doctrine_Query::create()
				->from('Task t')
				->leftJoin('t.Profile p')
				->leftJoin('t.Creator c')
//				->leftJoin('t.FileTask ft')
//				->leftJoin('ft.File f')
//				->leftJoin('f.FileInfo fi')
//				->leftJoin('t.IssueTask it')
//				->leftJoin('it.Issue i')
				->where('t.group_id is null')
				->addWhere('t.project_id = ?', $pid)
				->addWhere ('t.account_id = ?', $aid)
				->orderBy('t.due_date asc');
		return $q->execute();
		
	}
	
	
	
	
	static public function getAllTasks($aid, $pid){
		
		$q = Doctrine_Query::create()
				->from ('Group g')
				->leftJoin('g.Task t')
				->leftJoin('t.Profile p')
				->leftJoin('t.Creator c')
//				->leftJoin('t.FileTask ft')
//				->leftJoin('ft.File f')
//				->leftJoin('f.FileInfo fi')
//				->leftJoin('t.IssueTask it')
//				->leftJoin('it.Issue i')
				->where ('g.account_id = ?', $aid)
				->andWhere('g.project_id = ?', $pid)
				->andWhere('t.project_id = ?', $pid)
				->orderBy('t.group_id asc')
				->orderBy('t.due_date asc');
		return $q->execute();
		
	}
	
	static public function getAllGroupTasks($aid, $pid){
		
		$q = Doctrine_Query::create()
				->from ('Group g')
				->leftJoin('g.Task t')
				->leftJoin('t.Profile p')
				->leftJoin('t.Creator c')
//				->leftJoin('t.FileTask ft')
//				->leftJoin('ft.File f')
//				->leftJoin('f.FileInfo fi')
//				->leftJoin('t.IssueTask it')
//				->leftJoin('it.Issue i')
				->where ('g.account_id = ?', $aid)
				->andWhere('g.project_id = ?', $pid)
				->orderBy('t.group_id asc')
				->orderBy('t.due_date asc');
		return $q->execute();
		
	}
	
	
	static public function getTasksByProjectUser($uid, $projectId){
		$q = Doctrine_Query::create()
				->select('t.*')
				->from('Task t')
				->where('t.owner = ? and t.project_id = ?', array($uid, $projectId))
				->orderBy('t.due_date, t.milestone_id');
		return $q->execute();
	}
	
	static public function getTasksByOwner($uid, $accountId){
		
		$q = Doctrine_Query::create()
				->select('t.*')
				->from('Task t')
				->innerJoin('t.Project p')
				->innerJoin('p.ProjectAccount pa')
				->where('t.owner = ? and pa.account_id = ?', array($uid, $accountId))
				->orderBy('t.due_date, t.milestone_id');
		return $q->execute();
		
	}
	
	
	static public function getTasksByProject($pid){
		
		$q = Doctrine_Query::create()
				->select('t.*')
				->from('Task t')
				->where('t.status = 1 and t.project_id = ?', $pid)
				->orderBy('t.milestone_id');
		return $q->execute();
		
	}
	
	
	static public function getTasksByAccount($accountId){
		
		$q = Doctrine_Query::create()
				->select('t.*')
				->from('Task t')
				->innerJoin('t.Project p')
				->innerJoin('p.ProjectAccount pa')
				->where('t.status = 1 and pa.account_id = ?', $accountId)
				->orderBy('t.project_id, t.milestone_id');
		return $q->execute();
		
	}
	
	
	static public function getLuceneIndex($accountId)
	{
		ProjectConfiguration::registerZend();
        if (file_exists($index = self::getLuceneIndexFile($accountId))){
			return Zend_Search_Lucene::open($index);
		}else{
			return Zend_Search_Lucene::create($index);
		}
	}

	static public function getLuceneIndexFile($accountId)
	{
		return sfConfig::get('sf_data_dir').'/Task.'.$accountId.'.'.sfConfig::get('sf_environment').'.index';
	}

	static public function getForLuceneQuery($accountId, $query)
	{

		$hits = self::getLuceneIndex($accountId)->find($query);
        $pks = array();
        foreach ($hits as $hit){
			$pks[] = $hit->pk;
		}
        return $pks;
	}

}