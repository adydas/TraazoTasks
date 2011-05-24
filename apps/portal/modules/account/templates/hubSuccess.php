<?php use_helper('jQuery'); ?>

<div id="account_options">

    <div id="login_confirm" class="clearfix">
        <div class="fl">
            <h2>
            <?
			$acct = kodaziActions::getAccount($sf_user->getAttribute('aid'));
			echo ucwords($acct->getName());
			?>
            
             Workspace <span style="font-size: .5em;"><a href="/account/manage">Manage Account</a></span></h2>
            <h5>What do you need to do, <?= ucfirst($sf_user->getProfile()->getFirstName()); ?>?</h5>
        </div>
        <div class="fr" style="text-align: right;">
        	<? include_partial('includes/profileNavTag') ?>
        </div>
    </div>
    
    
    <div id="login_options" class="clearfix">
        <div id="projects" class="fl fp_options">
            <div class="block_content">
                <div class="clearfix"><div class="fl">
                <h4>See My Projects</h4></div> 
                <div class="fr">
					<?= link_to("Add New Project", 
								"@project_create?aid=".$sf_user->getAttribute('aid'),
								Array('id' => '',  'class' => 'nyroModal')
								)?>
               	</div>
                </div>
                <div id="project_notifications_zone" class="notification_zone" style="display: none;"> </div>
                <ul id="project_display_zone">
                	<? include_component ("project", "showProjects") ?>
                </ul>
            </div>
        </div>
        
        
        <div id="project_details_wrapper" class="fr fp_options">
            <div id="project_details" class="block_content">
            
            </div>
        </div>
        
        
        <!--
        <div id="team_activity" class="fr fp_options">
            <div class="block_content">
                <div class="clearfix">
                    <div class="fl"><h4>See Team Activity</h4></div>
                    <div class="fr">
                    	<?= link_to("Invite User", "@add_user_domain?aid=".$sf_user->getAttribute('aid'),
						Array('class' => 'invite')
						) ?>
                        
           
                    </div>
                </div>
                <div id="invitation_notifications_zone" class="notification_zone" style="display: none;"></div>
                	<ul>
                    
 					<? foreach ($accountUsers as $au): ?>
                    	 <li class="clearfix">
                    		<div class="fl">
                            <a href="/"><?= $au->getUser()->getProfile()->getFirstName() . " " . $au->getUser()->getProfile()->getLastName() ?></a>
							</div>
                        	<div class="fr"><?=jq_link_to_remote('Overdue Tasks', array(
							'method' => 'get',
    						'update' => 'user_zone_'.$au->getUserId(),
    						'url'    => '@view_user_upcoming_tasks?uid='.$au->getUserId(),
    						'script' => true,
							)) ?> <a href="#">1 New Comment</a>
                        
                            <?= $au->getRoleId() != sfConfig::get('app_account-role_owner')?link_to("Delete", "@account_user_remove?uid=".$au->getUser()->getId(), Array('class'=>'action_delete')):link_to("(0)", "@account_change_owner")?>
                            </div>
                            <div id="user_zone_<?=$au->getUserId()?>"></div>
                    	</li>
                    <? endforeach; ?>
                </ul>
            </div>
        </div>-->
    </div>

</div>