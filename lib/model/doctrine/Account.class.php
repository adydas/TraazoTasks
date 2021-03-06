<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Account extends BaseAccount
{

	public function setUp()
  	{
  	
  		parent::setUp();
  					 
  		$this->hasMany('AccountUserRole', array('local' => 'id',
                                 'foreign' => 'account_id',
  								 'cascade' => array('delete')
  									)
  					 );
  					 
  		$this->hasMany('AccountUser', array('local' => 'id',
                                 'foreign' => 'account_id',
  								 'cascade' => array('delete')
  									)
  					 );
  		
  		$this->hasMany('PaymentTransaction', array('local' => 'id',
                                 'foreign' => 'account_id',
  								 'cascade' => array('delete')
  									)
  					 );


    	$this->hasOne('AccountFile as AccountFileInfo', array('local' => 'id',
                                        'foreign' => 'account_id'));
  	}
  	
  	public function getUsers(){
  		return Doctrine::getTable('AccountUserRole')->findByAccountId($this->id);
  	}
  	
  	
  	public function getRecentPaymentTransaction(){
  		$q = new Doctrine_Query();
		$q->select('pt.*');
		$q->from('PaymentTransaction pt');
		$q->where('pt.account_id = ?', $this->id);
		$q->orderBy('pt.created desc');

		return $q->fetchOne();
  	}
  	
  	public function getNewProjectId(){
  		$q = new Doctrine_Query();
		$q->select('p.*');
		$q->from('Project p');
		$q->where('p.account_id = ?', $this->id);
		$q->orderBy('p.id desc');
		$q->limit(1);

		$project =  $q->fetchOne();
		return $project->id + 1;
  	}
  	
  	
}