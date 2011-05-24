<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseUsers extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('users');
    $this->hasColumn('user_id', 'integer', 4, array('type' => 'integer', 'unsigned' => '1', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
    $this->hasColumn('user', 'string', 30, array('type' => 'string', 'default' => '', 'notnull' => true, 'length' => '30'));
    $this->hasColumn('name', 'string', 60, array('type' => 'string', 'default' => '', 'notnull' => true, 'length' => '60'));
    $this->hasColumn('email', 'string', 60, array('type' => 'string', 'default' => '', 'notnull' => true, 'length' => '60'));
    $this->hasColumn('title', 'text', null, array('type' => 'text', 'default' => '', 'notnull' => true, 'length' => ''));
    $this->hasColumn('bio', 'string', 2147483647, array('type' => 'string', 'notnull' => true, 'length' => '2147483647'));
    $this->hasColumn('favorites', 'string', 2147483647, array('type' => 'string', 'notnull' => true, 'length' => '2147483647'));
    $this->hasColumn('favorites_date', 'timestamp', 25, array('type' => 'timestamp', 'default' => '0000-00-00 00:00:00', 'notnull' => true, 'length' => '25'));
    $this->hasColumn('ofcs', 'enum', 1, array('type' => 'enum', 'values' => array(0 => '0', 1 => '1'), 'default' => '0', 'notnull' => true, 'length' => '1'));
    $this->hasColumn('reg_date', 'timestamp', 25, array('type' => 'timestamp', 'default' => '0000-00-00 00:00:00', 'notnull' => true, 'length' => '25'));
    $this->hasColumn('last_active', 'timestamp', 25, array('type' => 'timestamp', 'default' => '0000-00-00 00:00:00', 'notnull' => true, 'length' => '25'));
    $this->hasColumn('auth', 'enum', 1, array('type' => 'enum', 'values' => array(0 => '1', 1 => '2', 2 => '3', 3 => '4', 4 => '5'), 'default' => '1', 'notnull' => true, 'length' => '1'));
    $this->hasColumn('active', 'enum', 1, array('type' => 'enum', 'values' => array(0 => '0', 1 => '1'), 'default' => '0', 'notnull' => true, 'length' => '1'));
  }

}