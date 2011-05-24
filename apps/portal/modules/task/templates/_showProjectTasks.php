<? use_helper ('Date'); ?>


<div class="date_marker_past">Due in the Past</div>
<table class="data_table">
<? foreach ($pastDue as $task):?>
    <tr id="task_row<?= $task->getTaskId(); ?>" class="task_row">
        <td class="center">
        	<input type="checkbox" onclick='$.ajax({
   				type: "POST",
   				url: "<?= url_for('@task_status_set')?>",
   				data: "tid=<?= $task->getTaskId()?>&mode="+this.checked,
   				success: function(msg){
     			alert( msg );
  				 }
 				});'  <?= $task->getStatus()==sfConfig::get('app_task-status_completed')?"checked":"" ?>/>
        </td>
        
        
        <td class="name" style="width: 450px;">
        	<div class="task">
				<?= link_to($task->getName(), "@task_view?tid=".$task->getTaskId(), array("id"=>$task->getTaskId(), "class"=>"max")) ?>
                
                <div id="name_actions<?= $task->getTaskId(); ?>" class="name_actions">
                    <?= link_to("Edit","@task_view?tid=".$task->getTaskId()) ?> | 
                    <?= link_to("Remove","@task_view?tid=".$task->getTaskId(), array("class"=>"remove")) ?>
                </div>
                
                <div id="task_info<?= $task->getTaskId()?>" class="task_info">
                    <div class="task_options clearfix">
                        <ul>
                            <li><?= link_to('Info',"@task_view?tid=".$task->getTaskId(), array('class'=>'info')) ?></li>
                            <li><?= link_to('Comments (2)',"@task_view?tid=".$task->getTaskId(), array('class'=>'comments')) ?></li>
                            <li><?= link_to('History (' . $task->getHistory()->count() . ')' ,"@task_view?tid=".$task->getTaskId(), array('class'=>'history')) ?></li>
                            <li><?= link_to('Files (4)',"@task_view?tid=".$task->getTaskId(), array('class'=>'files')) ?></li>
                        </ul>
                    </div>
                    <div class="task_description">
                        <?= $task->getDescription() ?>
                    </div>

            	</div>
            </div>
        </td>
        <td><?= $task->getDueDate()?format_date(strtotime($task->getDueDate())):"" ?></td>
        <td>
        
        <?= link_to($task->getUser()->getProfile()->getFirstName() . ' ' . $task->getUser()->getProfile()->getLastName(), 
								"@task_alter_users_view?tid=".$task->getTaskId(),
								Array('id' => '',  'class' => 'nyroModal')
								)?>
		
		</td>

        </tr>

 <? endforeach; ?>
</table>  




<div class="date_marker">Due Today</div>
<table class="data_table">
<? foreach ($todayDue as $task):?>
    <tr id="task_row<?= $task->getTaskId(); ?>" class="task_row">
        <td class="center">
        	<input type="checkbox" onclick='$.ajax({
   				type: "POST",
   				url: "<?= url_for('@task_status_set')?>",
   				data: "tid=<?= $task->getTaskId()?>&mode="+this.checked,
   				success: function(msg){
     			alert( msg );
  				 }
 				});'  <?= $task->getStatus()==sfConfig::get('app_task-status_completed')?"checked":"" ?>/>
        </td>
        
        
        <td class="name" style="width: 450px;">
        	<div class="task">
				<?= link_to($task->getName(), "@task_view?tid=".$task->getTaskId(), array("id"=>$task->getTaskId(), "class"=>"max")) ?>
                
                <div id="name_actions<?= $task->getTaskId(); ?>" class="name_actions">
                    <?= link_to("Edit","@task_view?tid=".$task->getTaskId()) ?> | 
                    <?= link_to("Remove","@task_view?tid=".$task->getTaskId(), array("class"=>"remove")) ?>
                </div>
                
                <div id="task_info<?= $task->getTaskId()?>" class="task_info">
                    <div class="task_options clearfix">
                        <ul>
                            <li><?= link_to('Info',"@task_view?tid=".$task->getTaskId(), array('class'=>'info')) ?></li>
                            <li><?= link_to('Comments (2)',"@task_view?tid=".$task->getTaskId(), array('class'=>'comments')) ?></li>
                            <li><?= link_to('History (' . $task->getHistory()->count() . ')' ,"@task_view?tid=".$task->getTaskId(), array('class'=>'history')) ?></li>
                            <li><?= link_to('Files (4)',"@task_view?tid=".$task->getTaskId(), array('class'=>'files')) ?></li>
                        </ul>
                    </div>
                    <div class="task_description">
                        <?= $task->getDescription() ?>
                    </div>

            	</div>
            </div>
        </td>
        <td><?= $task->getDueDate()?format_date(strtotime($task->getDueDate())):"" ?></td>
        <td>
        
        <?= link_to($task->getUser()->getProfile()->getFirstName() . ' ' . $task->getUser()->getProfile()->getLastName(), 
								"@task_alter_users_view?tid=".$task->getTaskId(),
								Array('id' => '',  'class' => 'nyroModal')
								)?>
		
		</td>

        </tr>

 <? endforeach; ?>
</table>


<div class="date_marker">Due in Future</div>
<table class="data_table">
<? foreach ($futureDue as $task):?>
    <tr id="task_row<?= $task->getTaskId(); ?>" class="task_row">
        <td class="center">
        	<input type="checkbox" onclick='$.ajax({
   				type: "POST",
   				url: "<?= url_for('@task_status_set')?>",
   				data: "tid=<?= $task->getTaskId()?>&mode="+this.checked,
   				success: function(msg){
     			alert( msg );
  				 }
 				});'  <?= $task->getStatus()==sfConfig::get('app_task-status_completed')?"checked":"" ?>/>
        </td>
        
        
        <td class="name" style="width: 450px;">
        	<div class="task">
				<?= link_to($task->getName(), "@task_view?tid=".$task->getTaskId(), array("id"=>$task->getTaskId(), "class"=>"max")) ?>
                
                <div id="name_actions<?= $task->getTaskId(); ?>" class="name_actions">
                    <?= link_to("Edit","@task_view?tid=".$task->getTaskId()) ?> | 
                    <?= link_to("Remove","@task_view?tid=".$task->getTaskId(), array("class"=>"remove")) ?>
                </div>
                
                <div id="task_info<?= $task->getTaskId()?>" class="task_info">
                    <div class="task_options clearfix">
                        <ul>
                            <li><?= link_to('Info',"@task_view?tid=".$task->getTaskId(), array('class'=>'info')) ?></li>
                            <li><?= link_to('Comments (2)',"@task_view?tid=".$task->getTaskId(), array('class'=>'comments')) ?></li>
                            <li><?= link_to('History (' . $task->getHistory()->count() . ')' ,"@task_view?tid=".$task->getTaskId(), array('class'=>'history')) ?></li>
                            <li><?= link_to('Files (4)',"@task_view?tid=".$task->getTaskId(), array('class'=>'files')) ?></li>
                        </ul>
                    </div>
                    <div class="task_description">
                        <?= $task->getDescription() ?>
                    </div>

            	</div>
            </div>
        </td>
        <td><?= $task->getDueDate()?format_date(strtotime($task->getDueDate())):"" ?></td>
        <td>
        
        <?= link_to($task->getUser()->getProfile()->getFirstName() . ' ' . $task->getUser()->getProfile()->getLastName(), 
								"@task_alter_users_view?tid=".$task->getTaskId(),
								Array('id' => '',  'class' => 'nyroModal')
								)?>
		
		</td>

        </tr>

 <? endforeach; ?>
</table>  



