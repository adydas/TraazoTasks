<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseProjectEmail extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('project_email');
    $this->hasColumn('project_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('email_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('created', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
  }

  public function setUp()
  {
    $this->hasOne('Email', array('local' => 'email_id',
                                 'foreign' => 'email_id'));
  }
}