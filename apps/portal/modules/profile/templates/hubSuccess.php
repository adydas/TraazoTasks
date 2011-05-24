

<!-- IF USER HAS MULTIPLE DOMAINS -->
<div id="domain_options_wrapper" style="width: 600px;">

    <div id="domain_confirm" class="clearfix" style="width: 590px;">
    	<div class="fl">
            <h2>
            	Hello, <?= link_to($sf_user->getProfile()->getFirstName(), '@profile_edit') ?>
            </h2>
            <h5>You're a member of multiple accounts!</h5>
        </div>
        <div class="fr">
        	<a href="/logout" class="login_logout">Logout</a>
        </div>
    </div>
    
    <div id="status" style="border: 1px solid #006600; background: #009933;padding: 10px; display: none;">
    	Successfully deleted
    </div>
    
    <div id="domain_options" class="clearfix">
        <div id="domain_options" class="fl balloon fd_options">
            <div class="block_content">
            	<div id="test" class="clearfix">
                	<div class="fl"><h3>Where to?</h3></div>
                </div>
                <ul class="domain_list">
                	<? foreach ($accounts as $account): ?>
                    	<li class="clearfix">
                        	<div class="fl">
                            	<?= link_to("
									<strong>". ucfirst($account['name']) . "</strong> " .
                                    "(" . $account['name'] . "." . Domain::getNameForId($account['domain_id']). ")", "@account_hub?aid=".$account['id']) ?>
                            </div>
                            <div class="fr">
                            	<?= link_to("Delete Account","@account_delete?aid=".$account['id'], Array('class'=>'action_delete nyroModal')) ?>	
                            </div>
                            <div class="fr">
								<!--// link_to("+ Add Project", "@project_create?aid=".$account['account_id'])
								// link_to("+ Add User", "@account_create")  ?>-->
                       		</div>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
            <div class="alt_option">I need to <?= link_to("create a new account", "@account_create") ?>.</div>
        </div>
    </div>

</div>
