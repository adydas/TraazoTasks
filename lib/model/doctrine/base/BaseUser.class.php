<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseUser extends SfGuardUser
{
  public function setUp()
  {
    parent::setUp();
    $this->hasMany('Account', array('local' => 'id',
                                    'foreign' => 'user_id'));

    $this->hasMany('AccountUser', array('local' => 'id',
                                        'foreign' => 'user_id'));

    $this->hasMany('AccountUserRole', array('local' => 'id',
                                            'foreign' => 'user_id'));

    $this->hasMany('Comment', array('local' => 'id',
                                    'foreign' => 'submitted_by'));

    $this->hasMany('Email', array('local' => 'id',
                                  'foreign' => 'user_id'));

    $this->hasMany('EventLog', array('local' => 'id',
                                     'foreign' => 'user_id'));

    $this->hasMany('FileInfo', array('local' => 'id',
                                     'foreign' => 'creator_id'));

    $this->hasMany('FileUser', array('local' => 'id',
                                     'foreign' => 'viewer_id'));

    $this->hasMany('Group', array('local' => 'id',
                                  'foreign' => 'created_by'));

    $this->hasMany('Issue', array('local' => 'id',
                                  'foreign' => 'assigned_to'));

    $this->hasMany('IssueComment', array('local' => 'id',
                                         'foreign' => 'author'));

    $this->hasMany('Message', array('local' => 'id',
                                    'foreign' => 'submitted_by'));

    $this->hasMany('MessageSubs', array('local' => 'id',
                                        'foreign' => 'subscriber_id'));

    $this->hasMany('NotifMessage', array('local' => 'id',
                                         'foreign' => 'created_by'));

    $this->hasMany('NotifUser', array('local' => 'id',
                                      'foreign' => 'recipient'));

    $this->hasMany('PaymentTransaction', array('local' => 'id',
                                               'foreign' => 'user_id'));

    $this->hasMany('Profile', array('local' => 'id',
                                    'foreign' => 'user_id'));

    $this->hasMany('Project', array('local' => 'id',
                                    'foreign' => 'created_by'));

    $this->hasMany('ProjectUser', array('local' => 'id',
                                        'foreign' => 'user_id'));

    $this->hasMany('ProjectUserRole', array('local' => 'id',
                                            'foreign' => 'user_id'));

    $this->hasMany('Task', array('local' => 'id',
                                 'foreign' => 'created_by'));

    $this->hasMany('TeamUser', array('local' => 'id',
                                     'foreign' => 'user_id'));

    $this->hasMany('UserAddress', array('local' => 'id',
                                        'foreign' => 'user_id'));

    $this->hasMany('UserEmail', array('local' => 'id',
                                      'foreign' => 'user_id'));

    $this->hasMany('UserGroup', array('local' => 'id',
                                      'foreign' => 'user_id'));

    $this->hasMany('UserPhone', array('local' => 'id',
                                      'foreign' => 'user_id'));

    $this->hasMany('UserPref', array('local' => 'id',
                                     'foreign' => 'user_id'));
  }
}