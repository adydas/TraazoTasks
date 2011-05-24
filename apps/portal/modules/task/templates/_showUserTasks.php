<? use_helper ('Date'); ?>
<div id="multicolitem">
  <h3 class="tabletitle">Tasks</h3>
  <ul class="vert">
    <li class="tableheader">
      <ul class="horz">
        <li class="name">Name</li>
        <li>Owner</li>
        <li>Project</li>
        <li>Milestone</li>
        <li>Start Date</li>
        <li>End Date</li>
      </ul>
    </li>	
<? foreach ($tasks as $task):?>
	<li>
      <ul class="horz">
        <li class="name"><?= link_to($task->getName(), "@task_view?tid=".$task->getTaskId()) ?></li>
        <li><?= $task->getUser()->getProfile()->getFirstName() . ' ' . $task->getUser()->getProfile()->getLastName() ?></li>
        <li><?= $task->getProject()?$task->getProject()->getName():"" ?></li>
        <li><?= $task->getMilestone()?$task->getMilestone()->getName():"" ?></li>
        <li><?= format_date(strtotime($task->getStartDate())) ?></li>
        <li><?= format_date(strtotime($task->getDueDate())) ?></li>
      </ul>
    </li>
<? endforeach; ?>
	</ul>
</div>