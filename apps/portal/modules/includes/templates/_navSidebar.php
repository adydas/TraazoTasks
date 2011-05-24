<?php use_helper('Javascript') ?>
<!--
<div id="mh_bg">
	
</div>


<div id="sidebar_nav" class="clearfix">
    <ul>
        <li <?//= $module == 'project'?'class="selected"':'' ?>><?//= link_to('Milestones', '@project_hub?pid='.$pid, array('id'=>'milestones')) ?></li>
        <li <?//= $module == 'task'?'class="selected"':'' ?>>
        	<?//= link_to('Tasks', '@view_all_project_tasks?pid='.$pid, array('id'=>'tasks')) ?>
        </li>
        
        <li><?//= link_to('Files', '@project_files?pid='.$pid, array('id'=>'files')) ?></li>
        <li <?//= $module=='messages'?'class="selected"':'' ?>><?//= link_to('Messages', '@view_recent_project_messages?pid='.$pid, array('id'=>'messages')) ?></li>
        <li><a href="<?//= url_for('@issue_create?pid='.$pid) ?>" id="issues">Issues</a></li>
        <li><a href="#" id="source">Source</a></li>
        <li><a href="#" id="team">Team</a></li>
    </ul>
</div>
-->