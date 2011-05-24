<script>
  $(document).ready(function(){
    $("#profileForm").validate();
  });
</script>
<div id="account_management" class="container_full">
    
    <div class="header_wrapper clearfix">
    	<div class="fl">
       		<h2>Manage Profile</h2>
        </div>
        
    </div>
    
    <div class="clearfix">
            <div class="view_data block_content">
            <h3>Personal Information</h3>	
            	<?php echo form_tag('@profile_edit', array('id'=>"profileForm", 
								'name'=>"profileForm", 'method'=>"post", 'class'=>"f-wrap-1"))?>
                <dl id="mile_form" class="persistent_form">
    				<dt><label for="name"><span class="req">*</span>First Name</label></dt>
					<dd><input id="firstName" name="firstName" value="<?= $sf_user->getProfile()->getFirstName()?>" type="text" class="textfield required" /></dd>
    				
    				<dt><label for="name"><span class="req">*</span>Last Name</label></dt>
					<dd><input id="lastName" name="lastName" value="<?= $sf_user->getProfile()->getLastName()?>" type="text" class="textfield required" /></dd>
    
    				<dt><label for="name"><span class="req">*</span>Street 1</label></dt>
					<dd><input id="street1" name="street1" value="<?= $sf_user->getProfile()->getAddress()->getStreet_1()?>" type="text" class="textfield" /></dd>
        
    
    				<dt><label for="name"><span class="req">*</span>Street 2</label></dt>
					<dd><input id="street2" name="street2" value="<?= $sf_user->getProfile()->getAddress()->getStreet_2()?>" type="text" class="textfield" /></dd>
        
    
    				<dt><label for="name"><span class="req">*</span>City</label></dt>
					<dd><input id="city" name="city" value="<?= $sf_user->getProfile()->getAddress()->getCity()?>" type="text" class="textfield" /></dd>
        
    				<dt><label for="name"><span class="req">*</span>Zip</label></dt>
					<dd><input id="zip" name="zip" value="<?= $sf_user->getProfile()->getAddress()->getZip()?>" type="text" class="textfield" /></dd>
        
    			
    
					<dt><label for="name"><span class="req">*</span>Telephone</label></dt>
					<dd><input id="telephone" name="telephone" value="<?= $sf_user->getProfile()->getAddress()->getPhone()->getNumber()?>" type="text" class="textfield" /></dd>
        
    
    				<dt><label for="name"><span class="req">*</span>Password</label></dt>
					<dd><input id="password" name="password" type="password"/></dd>
    
               		<dt><label for="name"><span class="req">*</span>Password Repeat</label></dt>
					<dd><input id="passwordRepeat" name="passwordRepeat" type="password"/></dd>
    
               		
    			</dl>
    			
    			<br/>
				<div class="form_action_triggers clearfix">
					<input type="submit" value="Save" class="f-submit" /> 
				</div>
    			
                
               </form> 
                
            </div>
        
        


</div>
	