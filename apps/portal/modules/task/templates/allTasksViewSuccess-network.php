<div class="container clearfix">
	<br/>
    <div class="fl">
    	<h2>Adyze</h2>
    </div>

</div>

<div id="tabs" class="container">
	<?php include_component("task", "projectTabs", array('openProjects'=>$openProjects)); ?>


    <div id="p_0" class="container">
    
        <div id="content_wrapper">
            
        
            <div id="task_list_wrapper" class="block_content">
        
                <div id="displayTaskListMile">
                    
                </div>
                
                <div id="displayTaskListSans">
                    <div class="el_load_indicator clearfix">
                        <div class="fl" style="margin: 0 20px 0 0;">
                            <img src="/images/loading_big.gif" alt="loading data" />
                        </div>
                        <div class="fl" style="padding: 7px 0 0 0; font-size: 1.8em; color: #333;">
                            Loading Task List...
                        </div>
                    </div>
                </div>
                
               
                
                <script type="text/javascript"> 
                $.getJSON("<? echo url_for("@view_all_tasks_json?pid=".$project->id)  ?>");
                </script>
        
        
            </div>
            
        </div>
    
    </div>
    <div id="p_1">
    
    </div>
    
    <div id="p_2">
    
    </div>
    
    <div id="p_3">
    
    </div>

</div><!-- tabs -->

<!--<div id="create_task_wrapper" class="container clearfix">
	<div id="create_task_content" class="block_content">
    	<?//php include_component("task", "projectTaskCreate"); ?>
    </div>
</div>-->





