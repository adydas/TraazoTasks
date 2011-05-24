<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseProjectFile extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('project_file');
    $this->hasColumn('file_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('project_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('created', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
  }

  public function setUp()
  {
    $this->hasOne('File', array('local' => 'file_id',
                                'foreign' => 'file_id'));
  }
}