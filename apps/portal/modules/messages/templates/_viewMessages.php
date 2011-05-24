<? foreach ($messages as $message): ?>
<ul>
	<li>
	<?= $message->getBody() ?> <br/>
	<?= $message->getCreated() ?>
	</li>
</ul>	
	

<? endforeach; ?>