<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseNotificationType extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('notification_type');
    $this->hasColumn('type_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('notification', 'string', 248, array('type' => 'string', 'notnull' => true, 'length' => '248'));
    $this->hasColumn('description', 'string', 2147483647, array('type' => 'string', 'length' => '2147483647'));
  }

}