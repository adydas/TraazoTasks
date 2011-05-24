<div class="clearfix">
    <div class="fl">
    <label for="cardno">Card Number</label><br/>
    <input id="cardno" name="cardno" type="text" class="cardno required" />
    </div>
</div>  

<div class="clearfix">
    
    <? include_component("common", "fragmentCCExpiration") ?>
    
    <div class="fl">
        <label for="billZIP">Billing Address ZIP Code</label><br/>
        <input id="billZIP" name="billZIP" type="text" class="billZIP required" style="width: 100%;" />
    </div> 
    <!--<div class="fl">
        <label for="card_number">Security Code</label><br/>
        <input type="text" name="ccv" id="ccv" class="textfield_date"/>
    </div>-->           
</div>