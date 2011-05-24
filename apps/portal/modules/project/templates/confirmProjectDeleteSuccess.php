Confirm Delete Project <br />

<?php echo form_tag('@project_delete?pid='.$pid, array('id'=>"projectForm", 'name'=>"projectForm", 'method'=>"post"))?>
	<?php echo input_hidden_tag('pid', $pid) ?>
	<input type="submit" name="confirm" value="Confirm Delete"/>
</form>