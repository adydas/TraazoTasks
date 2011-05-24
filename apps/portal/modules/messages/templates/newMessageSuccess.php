<div id="content_wrapper" class="container">
	<div class="block_content">

<?php echo form_tag('@add_message?pid='.$pid.'&mgid='.@$mgid, array('id'=>"messageForm", 'name'=>"messageForm", 'method'=>"post"))?>
            
<? include_component('messages', 'createMessage') ?>

<hr />

Notify the folling people: <br/>

<? include_component('user', 'accountUsers') ?>

<?php echo jq_submit_to_remote('message', 'Create', array(
      				'update'   => 'zone',
      				'url'      => '@add_message?pid='.$pid.'&mgid='.@$mgid,
  			)) ?><br />
            </div>
            
</form>	
            
	</div>
</div>