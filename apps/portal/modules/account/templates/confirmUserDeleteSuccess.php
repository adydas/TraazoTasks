Confirm Delete User from this account <br />

<?php echo form_tag('@account_user_remove?uid='.$uid, array('id'=>"accountUserRemoveForm", 'name'=>"accountUserRemoveForm", 'method'=>"post"))?>
	<?php echo input_hidden_tag('uid', $uid) ?>
	<input type="submit" name="confirm" value="Confirm Remove User"/>
</form>