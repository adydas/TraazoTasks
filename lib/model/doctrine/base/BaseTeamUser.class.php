<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseTeamUser extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('team_user');
    $this->hasColumn('team_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
    $this->hasColumn('user_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    $this->hasColumn('created', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
    $this->hasColumn('user_role_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
  }

  public function setUp()
  {
    $this->hasOne('Team', array('local' => 'team_id',
                                'foreign' => 'team_id'));

    $this->hasOne('UserRole', array('local' => 'user_role_id',
                                    'foreign' => 'role_id'));

    $this->hasOne('User', array('local' => 'user_id',
                                'foreign' => 'id'));
  }
}