<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class FileVersion extends BaseFileVersion
{

	public function setUp()
  	{
	    parent::setUp();
		$this->hasOne('FileInfo', array('local' => 'version_id',
                                     'foreign' => 'version_id'));
  	}	
	
}