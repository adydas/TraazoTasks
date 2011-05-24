
<div id="content_wrapper" class="container">
<div class="block_content">
	<? 
		$statuses = sfConfig::get('app_issue-status');
	
		foreach ($issues as $issue): ?>
		<p>
			Summary: <?= $issue->summary ?> <br/>
			Description: <?= $issue->description ?> <br/>
			Status: <?= $statuses[$issue->status] ?> <br/>
		</p>
		<hr/>
	<? endforeach; ?>
</div>
</div>