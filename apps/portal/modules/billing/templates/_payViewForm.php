
<input type="hidden" name="amount" id="amount" value="<?= $amount ?>"/> 
<div id="user_details" class="block_content page_form">
<h3>Your Details</h3>
   <? include_component("account", "formUserDetails") ?>
</div>

<div id="url" class="block_content page_form">
    <h3>What URL?</h3>
    <br/>
    <? include_component("account", "formURL") ?>
</div>

<div id="billing" class="block_content page_form">
    <h3>Billing Information <em style="font-size: .8em;">(secure)</em>	</h3>       
    <? include_component("account", "formCreditCard") ?>
    I agree to the <a href="#">Terms of Service</a>, <a href="#">Privacy</a>, &amp; <a href="#">Refund</a> policies. 
<div> 
      