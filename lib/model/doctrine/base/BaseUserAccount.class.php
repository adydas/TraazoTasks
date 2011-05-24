<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseUserAccount extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('user_account');
    $this->hasColumn('user_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('created', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
    $this->hasColumn('first_name', 'string', 255, array('type' => 'string', 'length' => '255'));
    $this->hasColumn('last_name', 'string', 255, array('type' => 'string', 'length' => '255'));
    $this->hasColumn('email', 'string', 255, array('type' => 'string', 'length' => '255'));
  }

}