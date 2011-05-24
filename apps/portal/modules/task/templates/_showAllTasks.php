
<?php use_helper('Date') ?>


<div class="milestone_marker">
    No milestone assigned
</div>

<div id="displayTasks">
</div>

<? foreach ($tasksSansMilestones as $task): ?>

	
    <div id="<?= $task->getTaskId(); ?>" class="task_row clearfix">
    	
        <div id="task_status_<?= $task->getTaskId(); ?>" class="task_control fl center">
        	<input type="checkbox" onclick='$.ajax({
   				type: "POST",
   				url: "<?= url_for('@task_status_set')?>",
   				data: "tid=<?= $task->getTaskId()?>&mode="+this.checked,
   				success: function(msg){
     
  				 }
 				});'  <?= $task->getStatus()==sfConfig::get('app_task-status_completed')?"checked":"" ?>/>
        </div>
        <div id="task_<?= $task->getTaskId(); ?>_details" class="task_details fl">
        	
			<?= link_to($task->getName(), "@task_view?tid=".$task->getTaskId(), array("id"=>"task_".$task->getTaskId()."_info", "class"=>"max")) ?>
                
            <div id="task_<?= $task->getTaskId()?>_info_content" class="task_info">
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
        
        <div id="task_<?= $task->getTaskId(); ?>_due_date" class="task_due_date fl center">
        	<?= $task->getDueDate()?format_date(strtotime($task->getDueDate())):"" ?>
        </div>
        
        <div id="task_<?= $task->getTaskId(); ?>_owner" class="task_owner fl center">
        			<?= link_to($task->getUser()->getProfile()->getFirstName() . ' ' . $task->getUser()->getProfile()->getLastName(), 
						"@task_alter_users_view?tid=".$task->getTaskId(),
						Array('id' => '',  'class' => 'nyroModal')
						)?>
		</div>
        <div id="task_<?= $task->getTaskId(); ?>_spinner" class="fl clearfix" style="display: none;">
        	<img id="spinner" src="/images/spinner_small.gif" />
        </div>
        <div id="task_<?= $task->getTaskId(); ?>_undo" class="fl" style="display: none;position: absolute; right: 70px; top: 5px; z-index: 100;">
        	<a href="#">Undo</a>
        </div>
        
        <div id="task_<?= $task->getTaskId(); ?>_actions" class="task_actions fr right clearfix">
			<div class="fr">
				
				<?= jq_link_to_remote(image_tag('/images/icon_trash.png', array('alt' => 'Delete Task')),
						array(
						'url' => "@task_delete?tid=".$task->getTaskId(),
						'loading' => '$("div#task_'.$task->getTaskId().'_actions").remove();$("div#task_'.$task->getTaskId().'_spinner").show();',
						'complete' => '$("div#task_'.$task->getTaskId().'_spinner").hide(); $("div#'.$task->getTaskId().'").addClass("task_strike");$("div#task_'.$task->getTaskId().'_undo").show().removeClass("task_strike");'
						)); ?>
            
            </div>
            <div class="task_action_edit fr"><?= link_to("Edit","@task_view?tid=".$task->getTaskId()) ?></div>
            
        </div>

    </div>

<? endforeach; ?>


<? foreach ($milestones as $milestone): ?>

	<div class="milestone_marker">
    	<?= $milestone->getName(); ?>
    </div>

<? if($milestone->getTask()->count() == 0): ?>

	<div class="empty_data">No tasks assigned to this milestone.</div>
    
<? else: ?>

<? foreach ($milestone->getTask() as $task):?>

	<div id="<?= $task->getTaskId(); ?>" class="task_row clearfix">
    	
        <div id="task_status_<?= $task->getTaskId(); ?>" class="task_control fl center">
        	<input type="checkbox" onclick='$.ajax({
   				type: "POST",
   				url: "<?= url_for('@task_status_set')?>",
   				data: "tid=<?= $task->getTaskId()?>&mode="+this.checked,
   				success: function(msg){
     			alert( msg );
  				 }
 				});'  <?= $task->getStatus()==sfConfig::get('app_task-status_completed')?"checked":"" ?>/>
        </div>
        <div id="task_<?= $task->getTaskId(); ?>_details" class="task_details fl">
        	
			<?= link_to($task->getName(), "@task_view?tid=".$task->getTaskId(), array("id"=>"task_".$task->getTaskId()."_info", "class"=>"max")) ?>
                
            <div id="task_<?= $task->getTaskId()?>_info_content" class="task_info">
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
        
        <div id="task_<?= $task->getTaskId(); ?>_due_date" class="task_due_date fl center">
        	<?= $task->getDueDate()?format_date(strtotime($task->getDueDate())):"" ?>
        </div>
        
        <div id="task_<?= $task->getTaskId(); ?>_owner" class="task_owner fl center">
        			<?= link_to($task->getUser()->getProfile()->getFirstName() . ' ' . $task->getUser()->getProfile()->getLastName(), 
						"@task_alter_users_view?tid=".$task->getTaskId(),
						Array('id' => '',  'class' => 'nyroModal')
						)?>
		</div>
        
        <div id="task_<?= $task->getTaskId(); ?>_spinner" class="fl clearfix" style="display: none;">
        	<img id="spinner" src="/images/spinner_small.gif" />
        </div>
        <div id="task_<?= $task->getTaskId(); ?>_undo" class="fl" style="display: none;position: absolute; right: 70px; top: 5px; z-index: 100;">
        	<a href="#">Undo</a>
        </div>
        
        <div id="task_<?= $task->getTaskId(); ?>_actions" class="task_actions fr right clearfix">
			<div class="fr">
				
				<?= jq_link_to_remote(image_tag('/images/icon_trash.png', array('alt' => 'Delete Task')),
						array(
						'url' => "@task_delete?tid=".$task->getTaskId(),
						'loading' => '$("div#task_'.$task->getTaskId().'_actions").remove();$("div#task_'.$task->getTaskId().'_spinner").show();',
						'complete' => '$("div#task_'.$task->getTaskId().'_spinner").hide(); $("div#'.$task->getTaskId().'").addClass("task_strike");$("div#task_'.$task->getTaskId().'_undo").show().removeClass("task_strike");'
						)); ?>
            
            </div>
            <div class="task_action_edit fr"><?= link_to("Edit","@task_view?tid=".$task->getTaskId()) ?></div>
            
        </div>

    </div>

 <? endforeach; ?>

 <? endif; ?>    

<? endforeach; ?>