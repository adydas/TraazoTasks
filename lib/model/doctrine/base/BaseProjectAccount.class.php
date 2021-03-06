<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseProjectAccount extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('project_account');
    $this->hasColumn('account_id', 'integer', 11, array('type' => 'integer', 'primary' => true, 'length' => '11'));
    $this->hasColumn('project_id', 'integer', 11, array('type' => 'integer', 'primary' => true, 'length' => '11'));
    $this->hasColumn('created', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
  }

  public function setUp()
  {
    $this->hasOne('Account', array('local' => 'account_id',
                                   'foreign' => 'account_id'));

    $this->hasOne('Project', array('local' => 'project_id',
                                   'foreign' => 'project_id'));
  }
}