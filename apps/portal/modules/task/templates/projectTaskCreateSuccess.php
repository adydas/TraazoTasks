<script>
  $(document).ready(function(){
    $("#taskForm").validate();
  });
  
  
  
  function taskCallback(obj){
    var content = "";
  	$.each (obj.milestoneTasks, function(i, task){
  		content = content + task.name + " " +task.milestone_id;
  	});
  	
  	alert (content);
  	$("#displayTasks").html(content);
  	
  }
  
</script>

<?php use_helper('Object'); ?>
<div id="ajaxForm" >
<?php echo jq_form_remote_tag(
			array(	'url'=>'@project_task_create?pid=' . $project->getId(), 
					'loading'=>'$("#submit_form").hide();$("#spinner").show(); $("#f-submit").attr("disabled", "disabled");', 
					'dataType'=>'json',
					'complete'=>'$("#spinner").hide();'
				))?>
<div id="inline_task_form" class="clearfix">
	
    <div class="fl">
    	<div><label for="name"><span class="req">*</span> Task Name</label></div>
        <div><input id="taskName" name="taskName" type="text" class="taskName required" /></div>
    </div>
    <div class="fl">
    	<div><label for="targetDate">Target Date</label></div>
    	<div><?php echo input_date_tag('targetDate', date("Y-m-d"), 'rich=true') ?></div>
    </div>
    <div class="fl">
    	<div><label for="own">Owner</label></div>
        <div>
        	<select id="own" name="own">
				 <?php echo objects_for_select($profiles, 'getUserId', 'getFirstName', 4) ?>
            </select>
        </div>
    </div>
    
    <div class="fl">
    	<br/>
    	<div class="clearfix">
        	<div id="submit_form" class="fl">
            	<input type="submit" value="Create" class="f-submit" id="f-submit"/>
            </div>
        	<div id="spinner" class="fl" style="display: none;"><img id="spinner"  src="/images/spinner_small.gif" /></div>
        </div>
    </div>
</div>


<dl id="task_advanced" class="persistent_form" style="display: none;">  
    
	<dt><label for="startDate">Start Date</label></dt>
    <dd><?php echo input_date_tag('startDate', date("Y-m-d"), 'rich=true') ?></dd>
    <dt><label for="project">Project</label></dt>
    <dd>
		<?= link_to("Change", "@project_hub?pid=".$project->getId()) ?>
    </dd>
    
    <dt><label for="estimate">Estimate</label></dt>
    <dd>
    	<input type="text" name="estimateUnits" id="estimateUnits" size="2"/> 
    	<select id="estimateType" name="estimateType">
    		<option value="3">Hours</option>
    		<option value="4">Days</option>
    		<option value="5">Week</option>
    		<option value="6">Month</option>
    	</select>
    
    </dd>
    
    <dt><label for="dependency">Dependency</label></dt>
    <dd>
        <select id="dependency" name="dependency"></select> 
    </dd>
    
    <dt></dt>
    <dd>
        
    </dd>
    
    
    <dt><label for="description">Description</label></dt>
    <dd class="clearifx"><?php echo textarea_tag('description', 'default content') ?></dd>
</dl>
<br/>
<div class="form_action_triggers fr" style="display: none;">
<input type="submit" value="Create Task" class="f-submit" id="f-submit"/> 
<a href="#">Cancel</a>
</div>
</form>
</div>