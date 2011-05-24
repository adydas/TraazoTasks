<!-- USER IS LOGGED IN, PRESENT OPTIONS FOR THIS DOMAIN -->

<div id="account_management">

    <div id="login_confirm" class="clearfix">
        <div class="fl">
            <h2>Kodazi Workspace</h2>
            <h5>What do you need to do, Spooky Boo</h5>
        </div>
        <div class="fr" style="text-align: right;">
        	<a href="/logout" class="login_logout">Logout</a>
        </div>
    </div>
    
    <?php echo form_tag('@account_change_owner', array('id'=>"accountChangeOwnerForm", 'name'=>"accountChangeOwnerForm", 'method'=>"post", 'class'=>"main-form"))?>
            
            <div class="req"><b>*</b> Indicates required field</div>
            
            <fieldset>
            
            <h3>Change account owner</h3>
            
            <?php if ($sf_request->hasErrors()): ?>
                <p>The data you entered seems to be incorrect.
                Please correct the following errors and resubmit:</p>
                <ul>
                    <?php foreach($sf_request->getErrors() as $name => $error): ?>
                        <li><?php echo $name ?>: <?php echo $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
    
     
      
            <div class="block_content">
                
                
                <? foreach ($accountUsers as $aUser): ?>
                
                	<?= $aUser->getUser()->getProfile()->getFirstName() ?> <?= $aUser->getUser()->getProfile()->getLastName() ?> <?= $aUser->getRoleId() == sfConfig::get('app_account-role_owner')?"(Account Owner)":"<input type=\"radio\" name=\"owner\" value=\"". $aUser->getUser()->getId() ."\">"  ?><br/>
                
                
                <? endforeach; ?>
                
               
            </div>
            
        	<div class="form-submit">
            	<input type="submit" value="Change account owner" class="form_submit" tabindex="4" /><br />
        	</div>
		</fieldset>

</div>