<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseUserProfile extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('user_profile');
    $this->hasColumn('profile_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
    $this->hasColumn('user_id', 'integer', 4, array('type' => 'integer', 'notnull' => true, 'length' => '4'));
    $this->hasColumn('created', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
    $this->hasColumn('street_1', 'string', 255, array('type' => 'string', 'length' => '255'));
    $this->hasColumn('street_2', 'string', 255, array('type' => 'string', 'length' => '255'));
    $this->hasColumn('city', 'string', 255, array('type' => 'string', 'length' => '255'));
    $this->hasColumn('state', 'string', 255, array('type' => 'string', 'length' => '255'));
    $this->hasColumn('zip', 'string', 48, array('type' => 'string', 'length' => '48'));
    $this->hasColumn('country', 'string', 48, array('type' => 'string', 'length' => '48'));
  }

}