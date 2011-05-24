<div class="container clearfix">
    <div class="fl"><h2>Milestones</h2></div>
    <div class="fr"><?= link_to ('+ Create Milestone', '@milestone_create?pid='.$projectAccount->getProject()->getId()) ?></div>
</div>

<div id="content_wrapper" class="container">
<div class="block_content">
	
    <ul>
	<? foreach ($projectAccount->getProject()->getMilestone() as $mille): ?>
	
		<li><?= link_to($mille->getName(), "@milestone_view?mid=".$mille->getMilestoneId()) ?></li>
	
	<? endforeach; ?>
	</ul>
            
</div>
</div>