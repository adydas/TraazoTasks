<? foreach ($projects as $project): ?>
<li class="clearfix">
	
	<div class="fl">
	<?= link_to($project->getName(), "@view_all_project_tasks?pid=".$project->getId())  ?> 
	</div>
	<div class="fr">

		<?= link_to('Edit', 
					'@project_edit?pid='.$project->getId(), 
					array('class'=>'nyroModal')) ?> <?= link_to(image_tag('/images/icon_trash.png'), 
					"@project_delete?pid=".$project->getId()
					) ?>
	</div>
	
	<div class="dash_project_actions clear clearfix"> 
		<ul>
		<li>
			<?=jq_link_to_remote($project->getGroups()->count() .' Groups', array(
			'method' => 'get',
			'update' => 'project_details',
			'url'    => '@view_project_tasks?pid='.$project->getId(),
			'script' => true,
			)) ?>   
		</li>
		<li>     
			<?=jq_link_to_remote($project->getTasks()->count() .' Upcoming Tasks', array(
			'method' => 'get',
			'update' => 'project_details',
			'url'    => '@view_all_project_tasks?pid='.$project->getId(),
			'script' => true,
			)) ?>
		</li>
		<li>      
			<?=jq_link_to_remote('Users', array(
			'method' => 'get',
			'update' => 'project_details',
			'url'    => '@add_user_project?pid='.$project->getId(),
			'script' => true,
			)) ?>
		</li>
		<li>
			<?=jq_link_to_remote('Comment', array(
			'method' => 'get',
			'update' => 'project_details',
			'url'    => '@add_comment?mode=p&id='.$project->getId(),
			'script' => true,
			)) ?>
		</li>
		</ul>
	</div>
	
	<div id="project_zone_<?= $project->getId() ?>"></div>
</li>
<? endforeach; ?>