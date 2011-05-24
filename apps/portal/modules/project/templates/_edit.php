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
        <h2>Edit Project <?= $project->getName() ?></h2>
    </div>


    
    <?php echo jq_form_remote_tag(	array(	'url'=>'@project_edit?pid='.$project->getProjectId(), 
											'loading'=>'$("#spinner").show(); $("#create_submit").attr("disabled", "disabled");', 
											'update'=>'project_notifications_zone', 
											'complete'=>'close_modal(); notification_flash();'), 
									array(	'id'=>"projectForm", 
											'name'=>"projectForm", 
											'method'=>"post"))
											?>

    
    
    <dl id="edit_project" class="persistent_form">
    
        <dt><label for="projectName">Name</label></dt>
        <dd><input value="<?= $project->getName() ?>" id="projectName" name="projectName" type="text" class="projectName required" tabindex="1" /></dd>
        
        <dt><label for="projectDescription">Description</label></dt>
        <dd><textarea name="description" id="projectDescription" class="description" tabindex="2"><?= $project->getDescription() ?></textarea></dd>
        
        
        <dt><label for="projectStatus">Status</label></dt>
        <dd>
            <select name="status" id="projectStatus">
                <option value="0" <?= $project->getStatus() == 0?'selected':''?> >Disabled</option>
                <option value="1" <?= $project->getStatus() == 1?'selected':''?> >Active</option>
            </select>
        </dd>
    
    </dl>
    <br/>

    <div class="form_action_triggers clearfix">
        <span id="spinner" style="display: none;"><img src="/images/loading_small.gif" /></span> 
        <input type="submit" value="Save" class="f-submit" />
        <a class="nyroModalClose" href="#">Cancel</a>
    </div>

</form> 
            
          