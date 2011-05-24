<script>
  $(document).ready(function(){
    $("#userForm").validate();
  });
</script>

<?php echo form_tag('@request_password', array('id'=>"userForm", 'name'=>"userForm", 'method'=>"post"))?>



<label for="email">Username or Email Address</label> 
<input id="email" name="email" type="text" class="email required" tabindex="1" /><br />
<div class="form_actions_wrapper" style="border-bottom: none;">
	<a id="forgot_pass_cancel" href="#">Cancel</a> <input type="submit" value="Email My Password"  tabindex="12" /><br />
</div>

</form>

<script type="text/javascript">
	 $("input:text:first").focus();
</script>