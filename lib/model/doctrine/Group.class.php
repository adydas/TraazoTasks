<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Group extends BaseGroup
{
	
	public function setUp()
	{
		parent::setUp();
		$this->hasMany('Task', array('local' => 'id',
                                'foreign' => 'group_id'));
	}
	

}