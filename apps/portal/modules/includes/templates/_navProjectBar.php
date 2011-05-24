<?php use_helper('Javascript') ?>

<div id="mh_bg">
	
</div>

<div id="mh">
	<div id="mh_left">
    	<?php include_partial('includes/accountNavTag'); ?>
    </div>
	
    <div id="mh_middle" class="clearfix">
    	<ul>
            <li><a href="#">ToDos</a> | <a href="#" onclick="$('#add_form_wrapper').toggle('fast');">+</a></li>
            <li><a href="#">Milestones</a> | <a href="/project/1/milestone/create" id="ady">+</a></li>
            <li><a href="#">Issues</a> | <a href="#">+</a></li>
            <li><a href="#">Files</a> | <a href="#">+</a></li>
            <li><a href="#">Source Control</a></li>
        </ul>
        
        <div id="pf_loading" style="height: 4em; text-align: center;">
        <br/><br/>
        <img src="/images/ajax-loader.gif" /><br/><strong>Loading ... </strong>
        <br/><br/>
        </div>
        <br/>
        <div id="add_form_wrapper" style="display: none;clear: both; padding: 20px 0 0 0;">
        	<div id="add_form_titlebar">
                <div class="fl">
                	
                </div>
                <div class="fr">
                	<a href="#" onclick="$('#add_form_wrapper').toggle('fast');$('#add_form_content').html('');ajaxLoaded = false;"><img src="/images/close.png" alt="close" /></a>
                </div>
            
            </div>
            <div id="add_form_content" style="display: none;"></div>
        
        </div>
        
    </div>
    
    <div id="mh_right">
    	Hi, <? include_partial('includes/profileNavTag') ?>
    </div>

</div>