<!--<script>
  $(document).ready(function(){
    $("#taskForm").validate();
  });
</script>-->

<?php use_helper('Object'); ?>
<?php use_helper('jQuery'); ?>

<div id="t_create_wrapper" class="t_form_create clearfix">
        
<?php echo jq_form_remote_tag($options = array(
			'url'=>'@task_create?pid=' . $project->getId() . '&pos=' . $pos . '&gid=' . null,
			'success' => 'newTaskCallback(data)',
			'complete' => 'rebindGetTask()'
			//'update' => $pos,
			//'position' => 'after'
			),
			$options_html = array('id'=>"taskForm", 'name'=>"taskForm", 'method'=>"post", 'class'=>"f-wrap-1")) ?>

<p><label for="t_create_description">Enter task</label><br/>
<input id="t_create_description" type="text" name="t_create_description" style="width: 97%;" />
</p>
<ul>
<li>
<p><label for="t_create_owner">Who's responsible?</label><br/>
    <select id="t_create_owner" name="own" style="min-width: 145px;">
     <?php echo objects_for_select($profiles, 'getUserId', 'getFirstName', 4) ?>
    </select>
</p>
</li>
<li>
<p><label for="t_create_duration">Duration?</label><br/>
  <input id="t_create_duration" type="text" style="width: 35px;">
  <select id="t_create_duration_unit" style="width: 110px;">
  	<option>Minute(s)</option>
  	<option>Hour(s)</option>
    <option>Day(s)</option>
    <option>Week(s)</option>
    <option>Month(s)</option>
  </select>
</p>
</li>
<li>
<p style="clear: both;"><label for="t_create_tags">Type or choose a tag(s)</label><br/>
    <input id="t_create_tags" type="text" style="width: 338px;" />
</p>
</li>

</ul>
<div class="clear"></div>

<div class="form_actions">
<input type="submit" value="Create"> <a onclick="return false;" class="close_form" href="#">Close</a>
</div>

<div class="clear"></div>
</form>
</div>
<div class="clear"></div>