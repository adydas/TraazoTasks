<script>
  $(document).ready(function(){
    $("#milestoneForm").validate();
  });
</script>

<?php use_helper('Object'); ?>
<br/>
<br/>
<div id="ajaxForm" >
<div class="clearfix"style="width: 390px;">
    <div class="fl"><h3>Add Milestone</h3></div>
    <div class="fr"><div class="req">* Required field</div></div>
</div>
<br/>
<?php echo form_tag('@milestone_create?pid=' . $pid, array('id'=>"milestoneForm", 
'name'=>"milestoneForm", 'method'=>"post", 'class'=>"f-wrap-1"))?>
<input id="projectId" name="projectId" type="hidden" value="<?= $pid ?>"/>

<dl id="mile_form" class="persistent_form">
    <dt><label for="name"><span class="req">*</span> Milestone Name</label></dt>
    <dd><input id="milestoneName" name="milestoneName" type="text" class="textfield required" /></dd>
    
   
    
    <dt><label for="targetDate">Target Date</label></dt>
    <dd><?php echo input_date_tag('targetDate', date("Y-m-d"), 'rich=true') ?></dd>
    
    <dt><label for="dependency">Dependency</label></dt>
    <dd>
        <select id="dependency" name="dependency"></select> 
    </dd>
    
    <dt><label for="priOwner">Primary Owner</label></dt>
    <dd>
        <select id="priOwn" name="priOwn">
             <?php echo objects_for_select($profiles, 'getUserId', 'getFirstName', 4) ?>
        </select>
    </dd>
    
    <dt><label for="secOwner">Secondary Owner</label></dt>
    <dd>
        <select id="secOwn" name="secOwn">
         <?php echo objects_for_select($profiles, 'getUserId', 'getFirstName', 4) ?>
        </select>
    </dd>
    
    <dt><label for="description">Description</label></dt>
    <dd class="clearifx"><?php echo textarea_tag('description', 'default content') ?></dd>
</dl>
<br/>
<div class="form_action_triggers clearfix">
<input type="submit" value="Create Milestone" class="f-submit" /> 
<input type="reset" value="Cancel" class="f-submit"  />
</div>
</form>
</div>