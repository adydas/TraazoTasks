<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProjectFile extends BaseProjectFile
{
	
	public function setUp(){
		parent::setUp();
    	$this->hasMany('File as Files', array('local' => 'file_id',
                                	'foreign' => 'file_id'));
  }

}