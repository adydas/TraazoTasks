<script>
  $(document).ready(function(){
    $("#userForm").validate();
  });
</script>
			<fieldset>
 			<h3>Users</h3>
 			
 			<h4>Existing Users</h4>
 			
 			<? foreach ($projectUsers as $projectUser): ?>
 			
 				<? 	
 				
 					$profile = $projectUser->getUser()->getProfile();
 					echo $profile->getFirstName() . ' '.$profile->getLastName() . ' '. link_to ('Remove User', '@remove_user_project?pid='.$pid.'&uid='.$projectUser->getUserId()) . '<br/>';
 					
 				
 				?>
 			
 			
 			<? endforeach; ?>
 			
 			<h4>Account Users</h4>
 			
 			<? foreach ($accountUsers as $accountUser): ?>
 			
 				<? 	
 				
 					$profile = $accountUser->getUser()->getProfile();
 					echo $profile->getFirstName() . ' '.$profile->getLastName() . ' '. link_to ('Add User', '@link_user_project?pid='.$pid.'&uid='.$profile->getUserId()) . '<br/>';
 					
 				
 				?>
 			
 			
 			<? endforeach; ?>
 			
 			<h4>Create New User</h4>
 			
 			<?php echo form_tag('@add_user_project?pid='.$pid, array('id'=>"userForm", 'name'=>"userForm", 'method'=>"post"))?>
            

			<input type="hidden" id="pid" name="pid" value="<?= $pid ?>"/>
            <div class="req"><b>*</b> Indicates required field</div>
            
           
            <?php if ($sf_request->hasErrors()): ?>
                <p>The data you entered seems to be incorrect.
                Please correct the following errors and resubmit:</p>
                <ul>
                    <?php foreach($sf_request->getErrors() as $name => $error): ?>
                        <li><?php echo $name ?>: <?php echo $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <label for="firstname"><b><span class="req">*</span>First name:</b>
                <input id="firstname" name="firstname" type="text" class="f-name required" tabindex="1" /><br />
            </label>
            
            <label for="lastname"><b><span class="req">*</span>Last name:</b>
                <input id="lastname" name="lastname" type="text" class="f-name required" tabindex="2" /><br />
            </label>
            
            <label for="email"><b><span class="req">*</span>Email Address:</b>
                <input id="email" name="email" type="text" class="email required validate-email" tabindex="3" /><br />
            </label>
            
             <div class="f-submit-wrap">
            <input type="submit" value="Add user" class="f-submit" tabindex="12" /><br />
            </div>
            </fieldset>
            </form>	