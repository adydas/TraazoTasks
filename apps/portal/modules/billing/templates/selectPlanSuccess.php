<script>
	$(document).ready(function(){
	$("#paymentForm").validate();
	});
</script>

 <div id="plan_wrapper" style="width: 600px;">

    <div id="plan_confirm" class="clearfix" style="width: 590px;">
    	<div class="fl">
            <h2>
            	Nice! You've chosen "<?= $plan->getType() ?>" at $<?= $plan->getPrice() . "/month" ?>
            </h2>
        </div>
        <div class="fr">
        	 <?= link_to ("Change plan", "@billing_plans_view") ?>
        </div>
    </div>
    
    <div id="domain_options" class="clearfix">
        <div class="fl balloon fd_options">
            
       	<?php echo form_tag('@pay', 'id=paymentForm method=post') ?>
      	<input type="hidden" name="planId" value=<?= $plan->getPlanId() ?> />
      	
		<? include_component('billing', 'payViewForm', array('amount'=>$plan->getPrice())) ?>			


        <div class="form_action_triggers clearfix">
        <?= link_to ("Cancel", "@billing_plans_view") ?> 
        <input type="submit" value="Create Account" class="form_submit" /><br />
        </div>
        
        </form>
        
        </div>
    </div>
</div>  
     

   