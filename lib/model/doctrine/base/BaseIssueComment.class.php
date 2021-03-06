<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseIssueComment extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('issue_comment');
    $this->hasColumn('comment_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
    $this->hasColumn('issue_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('author', 'integer', 4, array('type' => 'integer', 'notnull' => true, 'length' => '4'));
    $this->hasColumn('body', 'string', 2147483647, array('type' => 'string', 'length' => '2147483647'));
    $this->hasColumn('created', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
  }

  public function setUp()
  {
    $this->hasOne('User', array('local' => 'author',
                                'foreign' => 'id'));
  }
}