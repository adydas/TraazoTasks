<?php use_helper('jQuery'); ?>

<script type="text/javascript">

var active_task_create = "";

$(document).ready(function() {
	$(".t_row_divider").live("click", function() {
	
		var active_task_divider = $(this).attr('id');
		var project_id = $(this).attr('project_id');
		var task_id = $(this).attr('task_id');
		
		show_task_form(project_id, task_id);
		
	});
});


function show_task_form(project_id, task_id) {
//alert(project_id);
//alert(task_id);

	//var p_panel = '#p_'+ project_id;
	var t_divider = '#p_'+ project_id + '_t_divider_'+ task_id;
	var t_form_container = '#p_'+ project_id + '_t_form_container_'+ task_id;
	
	active_task_create = t_divider;
	
	
	//$(t_divider).hide();
	//$('.t_row_divider').die('click');
	$('#t_create_wrapper').remove();
	
	$(t_form_container).load('/task/'+ project_id +'/create/p_' + project_id + '_t_' + task_id);
}


function taskCallback(obj){	
	var content = "";
  	$.each (obj.groups, function(i, group){
  		content = content + '<div id="' + group.id + '" class="g_header">' + group.name + '</div>'
		if(group.Task.length != 0) {
				for(j=0;j<group.Task.length;j++)
				{  
					group.Task[j].owner == null ? group.Task[j].owner = "Assign Owner" : group.Task[j].owner = group.Task[j].owner;
					group.Task[j].estimate_units == null ? group.Task[j].estimate_units = "" : group.Task[j].estimate_units = group.Task[j].estimate_units;
					group.Task[j].estimate_type == null ? group.Task[j].estimate_type = "Set Estimate" : group.Task[j].estimate_type = group.Task[j].estimate_type;
					
					content += '<div id="p_' + group.project_id + '_t_' + group.Task[j].id + '" class="t clearfix">'
					content += '<div id="p_' + group.project_id + '_t_complete_' + group.Task[j].id + '" class="t_complete fl"><input type="checkbox" /></div>'
					content += '<div id="p_' + group.project_id + '_t_id_' + group.Task[j].id + '" class="t_id fl">' + group.Task[j].id + '</div>'
					content += '<div id="p_' + group.project_id + '_t_description_' + group.Task[j].id + '" class="t_description fl">' + group.Task[j].name + '&nbsp;</div>'
					content += '<div id="p_' + group.project_id + '_t_attachment_' + group.Task[j].id + '" class="t_attachment fl"><a href="#"></a></div>'
					content += '<div id="p_' + group.project_id + '_t_comments_' + group.Task[j].id + '" class="t_comment fl">5</div>'
					content += '<div id="p_' + group.project_id + '_t_owner_' + group.Task[j].id + '"  class="t_owner fl">' + group.Task[j].owner + '<br/>' + group.Task[j].estimate_units + ' ' + group.Task[j].estimate_type + '</div>'
					content += '<div class="clear"></div>'
					content += '<div id="p_' + group.project_id + '_t_divider_' + group.Task[j].id + '" class="t_row_divider clearfix" project_id="' + group.project_id +'" task_id="'+ group.Task[j].id +'"></div>'
					content += '<div class="clear"></div></div>'
					content += '<div id="p_' + group.project_id + '_t_form_container_' + group.Task[j].id + '" class="clearfix"></div>'
				}
			} else {
					content += '<div>No tasks for this group.</div>';
			}
  	});
  	
  	$('#'+obj.zone).html(content);
	
  }
  
  function rebindGetTask() {
  	$(".t_row_divider").removeClass('form');
  	$(".t_row_divider").live("click", function() {
	
		var active_task_divider = $(this).attr('id');
		var project_id = $(this).attr('project_id');
		var task_id = $(this).attr('task_id');
		
		show_task_form(project_id, task_id);
		
	});
  }
  

function newTaskCallback(obj){
	obj = JSON.parse(obj);
	var content = "";
	content += '<div id="p_' + obj.task.project_id + '_t_' + obj.task.id + '" class="t clearfix">'
					content += '<div id="p_' + obj.task.project_id + '_t_complete_' + obj.task.id + '" class="t_complete fl"><input type="checkbox" /></div>'
					content += '<div id="p_' + obj.task.project_id + '_t_id_' + obj.task.id + '" class="t_id fl">' + obj.task.id + '</div>'
					content += '<div id="p_' + obj.task.project_id + '_t_description_' + obj.task.id + '" class="t_description fl">' + obj.task.name + '</div>'
					content += '<div id="p_' + obj.task.project_id + '_t_attachment_' + obj.task.id + '" class="t_attachment fl"><a href="#"></a></div>'
					content += '<div id="p_' + obj.task.project_id + '_t_comments_' + obj.task.id + '" class="t_comment fl">5</div>'
					content += '<div id="p_' + obj.task.project_id + '_t_owner_' + obj.task.id + '"  class="t_owner fl">' + obj.task.owner + '</div>'
					content += '<div class="clear"></div>'
					content += '<div id="p_' + obj.task.project_id + '_t_divider_' + obj.task.id + '" class="t_row_divider clearfix" project_id="' + obj.task.project_id +'" task_id="'+ obj.task.id +'"></div>'
					
					content += '<div class="clear"></div></div>'
					content += '<div id="p_' + obj.task.project_id + '_t_form_container_' + obj.task.id + '" class="clearfix"></div>'
	/*content = content + '<div id="p_' + obj.task.project_id + '_t_' + group.Task[j].id + '" class="t clearfix">'
	content += '<div id="p_' + group.project_id + '_t_complete_' + group.Task[j].id + '" class="t_complete fl"><input type="checkbox" /></div>'
	content += '<div id="p_' + group.project_id + '_t_id_' + group.Task[j].id + '" class="t_id fl">' + group.Task[j].id + '</div>'
	content += '<div id="p_' + group.project_id + '_t_name_' + group.Task[j].id + '" class="t_task_description fl">' + group.Task[j].name + '</div>'
	content += '<div id="p_' + group.project_id + '_t_attachment_' + group.Task[j].id + '" class="t_task_attachment fl"></div>'
	content += '<div id="p_' + group.project_id + '_t_comments_' + group.Task[j].id + '" class="t_task_comment fl">5 Comments</div>'
	content += '<div id="p_' + group.project_id + '_t_owner_' + group.Task[j].id + '"  class="t_task_comment fl">' + group.Task[j].owner + '</div>'
	content += '<div class="clear"></div>'
	content += '<div id="p_' + group.project_id + '_t_divider_' + group.Task[j].id + '" class="t_row_divider clearfix" project_id="' + group.project_id +'" task_id="'+ group.Task[j].id +'"></div>'
	content += '<div class="clear"></div></div>'*/
				
  
  	
  	//$('#'+obj.pos).html(content);
	//alert(obj.pos);
	
	$(content).insertAfter($('#'+obj.pos));
  }

  
</script>


<div class="container clearfix">
	<!--<br/>
    <div class="fl">
    	<h2>Adyze</h2>
    </div>-->

</div>

<div id="tabs" class="container">
	<?php include_component("task", "projectTabs", array('openProjects'=>$openProjects)); ?>
    
    <div id="g_create">
    	Add Group <input type="text" /> <input type="submit" value="Add" />
    </div>
    
    <? 
		foreach ($projects as $project):
		if (in_array($project->id, $openProjects)):
	?>
		<div id="p_<?= $project->id ?>">
        	<div class="el_load_indicator clearfix">
                <div class="fl" style="margin: 0 20px 0 0;">
                    <img src="/images/loading_big.gif" alt="loading data" />
                </div>
                <div class="fl" style="padding: 7px 0 0 0; font-size: 1.8em; color: #333;">
                   Loading Tasks...
                </div>
            </div>
        </div>
        
         <script type="text/javascript"> 
			$(document).ready(function(){
				$.getJSON("<?echo url_for("@view_all_tasks_json?pid=$project->id")?>", 'zone=p_<?= $project->id ?>',taskCallback);
			});
		</script>
    <? 
    	endif;
    	endforeach; 
	?>


</div><!-- tabs -->

<!--<div id="create_task_wrapper" class="container clearfix">
	<div id="create_task_content" class="block_content">
    	<?//php include_component("task", "projectTaskCreate"); ?>
    </div>
</div>-->





