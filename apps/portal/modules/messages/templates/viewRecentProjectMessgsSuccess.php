<div id="content_wrapper" class="container">
 <div class="block_content">

	<?= link_to ("Add New Message", "@add_message?pid=".$pid) ?>
	
	<hr/>
	<? foreach ($messages as $messg): ?>
		
		<?= link_to($messg->subject, '@add_message?pid='.$pid.'&mgid='.$messg->messg_id) ?> - <?= $messg->body ?>  <?= link_to('Delete', '@delete_message?pid='.$pid.'&mgid='.$messg->messg_id) ?><br/>
		<? foreach ($messg->getMessages() as $childMessg): ?>
		----	<?= link_to($childMessg->subject, '@add_message?pid='.$pid.'&mgid='.$childMessg->messg_sub_id) ?> - <?= $childMessg->body ?> <?= link_to('Delete', '@delete_message?pid='.$pid.'&mgid='.$childMessg->messg_id.'&mgsid='.$childMessg->messg_sub_id) ?> <br/>
		<? endforeach; ?>
		
	<? endforeach; ?>


 </div>
</div>