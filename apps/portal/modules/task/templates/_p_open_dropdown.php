
<? foreach ($projects as $project): 
	if (!in_array($project->id, $openProjects)):
?>
<li>
    <a id="p_tab_<?= $project->id; ?>" 
        href="#p_<?= $project->id; ?>" 
        class="p_tab_open" 
        onclick='open_project("<?= $project->name; ?>", <?= $project->id; ?>);'>
        <?= $project->name; ?>
    </a>
</li>

<? 
endif;
endforeach; ?>
