<?php use_helper('Date') ?>

<div class="container clearfix">
	<div class="fl">
    	<h2>Milestone: <?= $milestone->getName() ?></h2>
    </div>
    <div class="fr">
     	<a href="#">Edit Milestone</a> | <?= link_to("Remove Milestone", "@milestone_delete?mid=".$milestone->getMilestoneId()) ?>
    </div>
</div>

<? include_component("task", "showMilestoneTasks") ?>