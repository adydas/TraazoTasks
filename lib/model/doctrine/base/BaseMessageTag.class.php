<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseMessageTag extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('message_tag');
    $this->hasColumn('messg_tag_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
    $this->hasColumn('messg_id', 'integer', 4, array('type' => 'integer', 'notnull' => true, 'length' => '4'));
    $this->hasColumn('tags', 'string', 2048, array('type' => 'string', 'notnull' => true, 'length' => '2048'));
  }

  public function setUp()
  {
    $this->hasOne('Message', array('local' => 'messg_id',
                                   'foreign' => 'messg_id'));
  }
}