<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseFileUser extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('file_user');
    $this->hasColumn('file_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('viewer_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('view_date', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
  }

  public function setUp()
  {
    $this->hasOne('File', array('local' => 'file_id',
                                'foreign' => 'file_id'));

    $this->hasOne('User', array('local' => 'viewer_id',
                                'foreign' => 'id'));
  }
}