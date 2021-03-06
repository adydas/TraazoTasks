<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseProjectUser extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('project_user');
    $this->hasColumn('project_id', 'integer', 4, array('type' => 'integer', 'notnull' => true, 'autoincrement' => true, 'length' => '4'));
    $this->hasColumn('user_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('team_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('created', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
  }

  public function setUp()
  {
    $this->hasOne('Team', array('local' => 'team_id',
                                'foreign' => 'team_id'));

    $this->hasOne('User', array('local' => 'user_id',
                                'foreign' => 'id'));
  }
}