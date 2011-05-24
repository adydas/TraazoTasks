<? use_helper("jQuery") ?>

<form name="taskChangeUser" id="taskChangeUser">
<? include_component("user", "accountUsers") ?>
<?php echo jq_submit_to_remote('taskChangeUser', 'Change User', array(
  'update'   => 'zone',
  'url'      => '@task_alter_users_process?uid='.$uid.'&tid='.$tid,
  )) ?>