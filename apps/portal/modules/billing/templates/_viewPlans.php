<div id="plan_container" class="clearfix">

<h1>Select the plan for your project needs</h1>

<? foreach ($planFeatures as $planFeature): ?>
	
    <? if( $planFeature->getPlan()->getType() != 'FREE'): ?>

	<div class='plan'>
    <div class='box'>
    
    <h3><? echo $planFeature->getPlan()->getType(); ?></h3>
    <h4><? echo '$' . number_format($planFeature->getPlan()->getPrice(),0); ?></h4>
    
    <ul>
    	<li><? echo $planFeature->getSpace()>1024?$planFeature->getSpace()/1024 . "GB Storage": $planFeature->getSpace() . "MB Storage"; ?></li>
        <li><? echo $planFeature->getNumUsers()==-1?"Unlimited users":$planFeature->getNumUsers() . " users"; ?></li>
        <li><? echo $planFeature->getNumProjects()==-1?"Unlimited projects":$planFeature->getNumProjects() . " projects"; ?></li>
        <li><? echo $planFeature->getIphoneAccess()==0?"X":"Available"; ?></li>
        <li><? echo $planFeature->getSslOn()==0?"X":"Available"; ?></li>
        <li><? echo $planFeature->getDataBackup()==0?"X":"Available"; ?></li>
    </ul>
    
    <div class='plan_action'>
	<? echo link_to("Start for FREE", "@billing_plan_select?plid=".$planFeature->getPlanId()); ?>
	</div>
	
	</div>
    </div>
    <? endif; ?>
	

<? endforeach; ?>

</div>

<? foreach ($planFeatures as $planFeature): ?>
	<? if( $planFeature->getPlan()->getType() == 'FREE'): ?>
    
    <div id="plan_free"><div class="box">    
    <div><strong><? echo $planFeature->getPlan()->getType(); ?></strong></div>
    <div><? echo $planFeature->getSpace()>1024?$planFeature->getSpace()/1024 . " GB": $planFeature->getSpace() . "MB Storage"; ?>, </div>
    <div><? echo $planFeature->getNumUsers()==-1?"Unlimited Users":$planFeature->getNumUsers() . " users"; ?>, </div>
    <div><? echo $planFeature->getNumProjects()==-1?"Unlimited Projects":$planFeature->getNumProjects() . " project"; ?>, </div>
    <div class="action"><? echo link_to("Try the free plan", "@billing_plan_select?plid=".$planFeature->getPlanId()); ?></div>
    </div></div>
    
    
	<? endif; ?>
	

<? endforeach; ?>