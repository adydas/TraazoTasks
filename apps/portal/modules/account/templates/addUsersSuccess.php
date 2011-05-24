<script>
  $(document).ready(function(){
    $("#accountUserAddForm").validate();
  });
</script>

           <?php echo form_tag('@account_user_add', array('id'=>"accountUserAddForm", 'name'=>"accountUserAddForm", 'method'=>"post", 'class'=>"main-form"))?>
            
            <div class="req"><b>*</b> Indicates required field</div>
            
            <fieldset>
            
            <h3>Add User to Company/Account</h3>
            
            <?php if ($sf_request->hasErrors()): ?>
                <p>The data you entered seems to be incorrect.
                Please correct the following errors and resubmit:</p>
                <ul>
                    <?php foreach($sf_request->getErrors() as $name => $error): ?>
                        <li><?php echo $name ?>: <?php echo $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <label for="invitee"><b><span class="req">*</span>Invite user 1 Email:</b>
                <input id="invitee" name="inviteeEmails[]" type="text" class="required email" tabindex="1" /><br />
            </label>
            
            <label for="invitee"><b><span class="req">*</span>Invite user 1 First Name:</b>
                <input id="inviteeFirstName" name="inviteeFirstName[]" type="text" class="textfield required" tabindex="2" /><br />
            </label>
            
            <label for="invitee"><b><span class="req">*</span>Invite user 1 last Name:</b>
                <input id="inviteeLastName" name="inviteeLastName[]" type="text" class="textfield required" tabindex="3" /><br />
            </label>
            
            <a href="">Add another user</a>
            
            <div class="form-submit">
                <input type="submit" value="Invite User" class="form_submit" tabindex="4" /><br />
             </div>
            </fieldset>
            
            </form>
            
        