<script>
	$(document).ready(function(){
	$("#accountAddForm").validate();
	});
</script>

<div id="domain_options_wrapper" style="width: 600px;">

    <div id="domain_confirm" class="clearfix" style="width: 590px;">
    	<div class="fl">
            <h2>
            	Free Plan Signup
            </h2>
        </div>
        <div class="fr">
        	<?= link_to ("Login", "@sf_guard_signin") ?> | <?= link_to ("Change plan", "@billing_plans_view") ?>
        </div>
    </div>
    
    <div id="domain_options" class="clearfix">
        <div id="domain_options" class="fl balloon fd_options">
            <div id="user_details" class="block_content page_form">
            
            <?php echo form_tag('@account_create', array('id'=>"accountAddForm", 'name'=>"accountAddForm", 'method'=>"post", 'class'=>"main-form"))?>
            
            
            <?php if ($sf_request->hasErrors()): ?>
                <p>The data you entered seems to be incorrect.
                Please correct the following errors and resubmit:</p>
                <ul>
                    <?php foreach($sf_request->getErrors() as $name => $error): ?>
                        <li><?php echo $name ?>: <?php echo $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <h3>Your Details</h3>
               <? include_component("account", "formUserDetails") ?>
            </div>
           
            <div id="url" class="block_content page_form">
                <h3>What URL?</h3>
                <br/>
                <? include_component("account", "formURL") ?>
            
            	<br/>
    			I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy</a> policies.        
                <div class="form_action_triggers clearfix">
                    <a href="#">Cancel</a> <input type="submit" value="Add Account" class="form_submit" tabindex="7" /><br />
                </div>
            
            </form>
            </div> 
        </div>
    </div>

</div>