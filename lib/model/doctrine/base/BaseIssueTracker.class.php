<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseIssueTracker extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('issue_tracker');
    $this->hasColumn('tracker_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
    $this->hasColumn('issue_id', 'integer', 4, array('type' => 'integer', 'notnull' => true, 'length' => '4'));
    $this->hasColumn('track_info', 'string', 2147483647, array('type' => 'string', 'length' => '2147483647'));
    $this->hasColumn('created', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
  }

}