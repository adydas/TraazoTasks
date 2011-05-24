<div id="modal_header">
	<h2>Confirm Delete</h2>
</div>

<p>
You are about to delete this account, and all projects within it.<br/>
<br/>
This action <strong>cannot</strong> be undone.
</p>
<br/>
<p>
Are you sure you want to delete this account?
</p>

<div class="form_actions">
<?php //echo form_tag('@account_delete?aid='.$aid, array('id'=>"accountForm", 'name'=>"accountForm", 'method'=>"post"))?>


 <?php echo jq_form_remote_tag(array(
   'url'      => '@account_delete?aid='.$aid,
   'complete' => '$("#status").show();'
  )) ?>



	<?php echo input_hidden_tag('aid', $aid) ?>
	<input type="submit" name="confirm" value="Confirm Delete" onclick="close_modal();"/>
    <a onclick="close_modal();" class="close" href="#">Cancel</a>
</form>

</div>
		
    