<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseTask extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('task');
    $this->hasColumn('account_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('project_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('group_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
    $this->hasColumn('created_by', 'integer', 4, array('type' => 'integer', 'notnull' => true, 'length' => '4'));
    $this->hasColumn('name', 'string', 240, array('type' => 'string', 'notnull' => true, 'length' => '240'));
    $this->hasColumn('estimate_units', 'decimal', 4, array('type' => 'decimal', 'scale' => false, 'length' => '4'));
    $this->hasColumn('estimate_type', 'integer', 4, array('type' => 'integer', 'default' => '1', 'length' => '4'));
    $this->hasColumn('status', 'integer', 4, array('type' => 'integer', 'default' => '0', 'notnull' => true, 'length' => '4'));
    $this->hasColumn('created', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
    $this->hasColumn('owner', 'integer', 4, array('type' => 'integer', 'length' => '4'));
    $this->hasColumn('description', 'string', 2147483647, array('type' => 'string', 'length' => '2147483647'));
    $this->hasColumn('due_date', 'timestamp', 25, array('type' => 'timestamp', 'length' => '25'));
    $this->hasColumn('list_sequence', 'integer', 4, array('type' => 'integer', 'length' => '4'));
  }

  public function setUp()
  {
    $this->hasOne('User', array('local' => 'created_by',
                                'foreign' => 'id'));

    $this->hasOne('Account', array('local' => 'account_id',
                                   'foreign' => 'id'));

    $this->hasOne('User as Owner', array('local' => 'owner',
                                         'foreign' => 'id'));
  }
}