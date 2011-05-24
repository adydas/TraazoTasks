<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseFileIssue extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('file_issue');
    $this->hasColumn('file_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('issue_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
  }

  public function setUp()
  {
    $this->hasOne('File', array('local' => 'file_id',
                                'foreign' => 'file_id'));
  }
}