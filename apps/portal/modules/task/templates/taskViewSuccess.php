<div class="container clearfix">
	<div class="fl">
    	<h2>Task: <?= $task->getName() ?></h2>
    </div>
    <div class="fr">
     	<?= link_to("Create new task", "@task_create?mid=".$task->getMilestoneId()) ?> | 
		<?= link_to("Delete", "@task_delete?tid=".$task->getTaskId(), array("class" => "remove")) ?>
    </div>
</div>

<div id="content_wrapper" class="container">
<div class="block_content">


<br/>
  <table class="data_table">
  	<tr>
    	<th>Owner</th>
        <th style="width: 400px;">Description</th>
       	<th>Start Date</th>
        <th>Due Date</th>
    </tr>
    <tr>
    	<td><?= $task->getUser()->getProfile()->getFirstName() ?> <?= $task->getUser()->getProfile()->getLastName() ?></td>
        <td><?= $task->getDescription() ?></td>
        <td><?= $task->getStartDate() ?></td>
        <td><?= $task->getDueDate() ?></td>
    </tr>
   </table>
	
</div>
</div>

