<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseFileInfo extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('file_info');
    $this->hasColumn('file_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('version', 'integer', 4, array('type' => 'integer', 'default' => '0', 'length' => '4'));
    $this->hasColumn('version_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('type', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
    $this->hasColumn('creator_id', 'integer', 4, array('type' => 'integer', 'notnull' => true, 'length' => '4'));
    $this->hasColumn('name', 'string', 512, array('type' => 'string', 'length' => '512'));
    $this->hasColumn('path', 'string', 1048, array('type' => 'string', 'length' => '1048'));
    $this->hasColumn('description', 'string', 2147483647, array('type' => 'string', 'length' => '2147483647'));
    $this->hasColumn('size', 'integer', 4, array('type' => 'integer', 'length' => '4'));
  }

  public function setUp()
  {
    $this->hasOne('User', array('local' => 'creator_id',
                                'foreign' => 'id'));

    $this->hasOne('File', array('local' => 'file_id',
                                'foreign' => 'file_id'));

    $this->hasOne('FileVersion', array('local' => 'version_id',
                                       'foreign' => 'version_id'));
  }
}