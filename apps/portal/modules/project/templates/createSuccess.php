<script type="text/javascript">
  $(document).ready(function(){
    $("#projectForm").validate();
  });
  
  notification_flash = function(){
  $("#project_notifications_zone").fadeIn(200, function () {
		window.setTimeout(function() {
		 $("#project_notifications_zone").fadeOut(1000);
		}, 1000);
	});
  }
  
</script>

<div id="modal_header">
	<h2>Create New Project</h2>
</div>


<?php echo jq_form_remote_tag(	array(	'url'=>'@project_create?aid='.$account->getId(), 
										'loading'=>'$("#spinner").show(); $("#create_submit").attr("disabled", "disabled");', 
										'update'=>'project_notifications_zone', 
										'complete'=>'close_modal(); notification_flash();'
										.jq_remote_function(array(
														'url' =>'/project/viewProjects',
														'update' =>'project_display_zone',
														'script' =>TRUE,)
														),		
									 ), 
								array(	'id'=>"projectForm", 
										'name'=>"projectForm", 
										'method'=>"post")
							)
										?>

<?php echo input_hidden_tag('aid', $account->getId()) ?>
            
<dl id="create_project" class="persistent_form">
    <dt><label for="projectName">Name</label></dt>
    <dd><input id="projectName" name="projectName" type="text" class="projectName required" tabindex="1" /></dd>
    
    <dt><label for="createProjectDescription">Description</label></dt>
    <dd><textarea name="createProjectDescription" id="createProjectDescription" class="description" tabindex="2" cols="26" rows="5"></textarea></dd>

	<dt><label for="startDate">Start Date</label></dt>
    <dd><?php echo input_date_tag('startDate', date("Y-m-d"), 'rich=true') ?></dd>
    
    <dt><label for="endDate">End Date</label></dt>
    <dd><?php echo input_date_tag('endDate', date("Y-m-d"), 'rich=true') ?></dd>

</dl>
<br/>


<div class="form_action_triggers clearfix">
<?php //echo form_tag('@account_delete?aid='.$aid, array('id'=>"accountForm", 'name'=>"accountForm", 'method'=>"post"))?>


    <span id="spinner" style="display: none;"><img src="/images/loading_small.gif" /></span> <input type="submit" value="Create" id="create_submit" class="f-submit" tabindex="12"/>
    <a onclick="close_modal();" class="close" href="#">Cancel</a>
   

</div>

</form>            
            