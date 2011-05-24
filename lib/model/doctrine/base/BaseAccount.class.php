<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseAccount extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('account');
    $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
    $this->hasColumn('user_id', 'integer', 4, array('type' => 'integer', 'notnull' => true, 'length' => '4'));
    $this->hasColumn('name', 'string', 240, array('type' => 'string', 'notnull' => true, 'length' => '240'));
    $this->hasColumn('domain_id', 'integer', 4, array('type' => 'integer', 'notnull' => true, 'length' => '4'));
    $this->hasColumn('primary_user', 'integer', 4, array('type' => 'integer', 'notnull' => true, 'length' => '4'));
    $this->hasColumn('created', 'timestamp', 25, array('type' => 'timestamp', 'notnull' => true, 'length' => '25'));
    $this->hasColumn('plan_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
    $this->hasColumn('address_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
  }

  public function setUp()
  {
    $this->hasOne('Plan', array('local' => 'plan_id',
                                'foreign' => 'plan_id'));

    $this->hasOne('User', array('local' => 'user_id',
                                'foreign' => 'id'));

    $this->hasOne('Domain', array('local' => 'domain_id',
                                  'foreign' => 'id'));

    $this->hasMany('AccountGroup', array('local' => 'id',
                                         'foreign' => 'account_id'));

    $this->hasMany('AccountUser', array('local' => 'id',
                                        'foreign' => 'account_id'));

    $this->hasMany('AccountUserRole', array('local' => 'id',
                                            'foreign' => 'account_id'));

    $this->hasMany('Comment', array('local' => 'id',
                                    'foreign' => 'account_id'));

    $this->hasMany('EventLog', array('local' => 'id',
                                     'foreign' => 'account_id'));

    $this->hasMany('Group', array('local' => 'id',
                                  'foreign' => 'account_id'));

    $this->hasMany('Message', array('local' => 'id',
                                    'foreign' => 'account_id'));

    $this->hasMany('PaymentTransaction', array('local' => 'id',
                                               'foreign' => 'account_id'));

    $this->hasMany('Task', array('local' => 'id',
                                 'foreign' => 'account_id'));

    $this->hasMany('UserPref', array('local' => 'id',
                                     'foreign' => 'account_id'));
  }
}