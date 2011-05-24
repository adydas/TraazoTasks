<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseUserAddress extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('user_address');
    $this->hasColumn('address_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('user_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('created', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
    $this->hasColumn('type', 'string', 25, array('type' => 'string', 'length' => '25'));
  }

  public function setUp()
  {
    $this->hasOne('User', array('local' => 'user_id',
                                'foreign' => 'id'));
  }
}