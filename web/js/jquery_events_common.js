// JavaScript Document

$(".t_row_divider").live("mouseover mouseout", function() {
    $(this).toggleClass("hover");
});


/*
var ajaxLoaded = false;
var forgot_pass_loaded = false;

jQuery().ready(function($){
  
  
	$('a#forgot_password').live('click',function(){
		$('#login_form').hide();
		$('#forgot_password_wrapper').show();
		if(forgot_pass_loaded != true){
		$.ajax({
		  url: this,
		  cache: true,
		  success: function(html){
			$("#forgot_password_content").append(html);
			$("#forgot_password_content").show();
		  },
		  complete: function(){
			forgot_pass_loaded = true;
		  }
		});
		}
		return false;
		
	});

	$('a#forgot_pass_cancel').live('click',function(){
		$('#forgot_password_wrapper').hide();
		$('#login_form').show();
	});

	$("div.plan, div#plan_free").mouseover(function(){
	  $(this).addClass('selected');
	}).mouseout(function(){
	  $(this).removeClass('selected');
	});
	
	
	


//$(".action_delete").click( function() {
	//jConfirm('Are you sure you want to delete this account? <br/><br/>This action cannot be undone.', 'Confirmation Dialog', function(r) {
	//	//jAlert('Confirmed: ' + r, 'Confirmation Results');
	//});
//});

	$.fn.nyroModal.settings.processHandler = function(settings) {
		var from = settings.from;
		if (from && from.href && from.href.indexOf('http://www.youtube.com/watch?v=') == 0) {
		  $.nyroModalSettings({
			type: 'swf',
			height: 355,
			width: 425,
			url: from.href.replace(new RegExp("watch\\?v=", "i"), 'v/')
		  });
		}
		$.nyroModalSettings({
			endShowContent: $("input:text:first").focus()
		});
	  };
	  
	  
	  // Focus all first input text fields 
	  //$("input:text:first").live(function(){
		  $("input:text:first").focus();
	//})
	  
	  
	$('a.max').live('click',function(){									   
		if($(this).hasClass('min')) {
			$('#'+this.id+'_content').slideUp('fast');
			$('#'+this.id).removeClass('min');	
		} else {
			$('#'+this.id+'_content').slideDown('fast');
			$('#'+this.id).addClass('min');
		}
		return false;
	});
	
	$("div.task_row").live("mouseover", function(){
      $(this).addClass('task_row_hover');
		  //$("#task_"+this.id+"_actions").show();
		}).live("mouseout", function(){
		  $(this).removeClass('task_row_hover');
		  //$("#task_"+this.id+"_actions").hide();
    });
	 
	 
	/*$('#task_list_wrapper a[tooltip]').each(function(){
      $(this).qtip({
		 tip: topMiddle,
         content: $(this).attr('tooltip'), // Use the tooltip attribute of the element for the content
         style: 'dark' // Give it a blue style to make it stand out
      });
   });
	
	$('#task_list_wrapper a[tooltip]') 
    .livequery(function(event) { 
        $(this).qtip({
		 content: $(this).attr('tooltip'), // Use the tooltip attribute of the element for the content
		/* position: {
					  corner: {
						 tooltip: 'topLeft', // Use the corner...
						 target: 'bottomRight' // ...and opposite corner
					  }
				   },
		position: {
		   target: 'mouse',
		   adjust: { mouse: true }
		},
		 show: { delay: 0 },
		 hide: { delay: 0 },
		 style: { 
			  tip: 'topLeft' // Notice the corner value is identical to the previously mentioned positioning corners
		   }
      });
    });



	
	$('#content_tab_wrapper_0 ul li').click(function() { 
        $.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
 
        setTimeout($.unblockUI, 2000); 
    });
	
	
	$('a.nyroModal') 
    .livequery(function(event) { 
        $(this).nyroModal();
		return false;
      });

});


crud_indicator = function(setContainer) {
	$('#loading').clone().insertAfter('#'+setContainer); $('#loading').show();
}

loading_indicator = function(setContainer) {
	$('#loading').clone().insertAfter('#'+setContainer).show();
}

canceling_indicator = function(setContainer) {
	$('#canceling').clone().insertAfter('#'+setContainer); $('#canceling').show();
}

saving_indicator = function(setContainer) {
	$('#saving').clone().insertAfter('#'+setContainer); $('#saving').show();
}

deleting_indicator = function(setContainer) {
	$('#deleting').clone().insertAfter('#'+setContainer); $('#deleting').show();
}

uploading_indicator = function() {
	$('#upload_indicator').show();
	$('#btn_upload').attr('value', 'one moment...');	
	$('#btn_upload').attr('disabled', 'disabled');
}

success_indicator = function(setContainer) {
	$('#success').clone().insertAfter('#'+setContainer).fadeIn(200, function () {
		window.setTimeout(function() {
		 $('#success').remove();
		}, 800);
		
	}); 
}

deleted_indicator = function(setContainer) {
	$('#deleted').clone().insertAfter('#'+setContainer).fadeIn(200, function () {
		window.setTimeout(function() {
		 $('#deleted').remove();
		}, 800);
	}); 
}

content_tab_select = function(selected) {
	$('#content_tab_wrapper_0 ul li').removeClass('selected');
	$('#'+selected).addClass('selected');
}

loadtiny = function() {
	tinyMCE.init({
	mode : "exact", elements: "description", theme: "simple" 
	});
}

load_persistent_form = function(urlString) {
	$('#add_form_wrapper').show();
	if(ajaxLoaded != true){
	$.ajax({
	  url: urlString,
	  cache: true,
	  success: function(html){
		$("#add_form_content").append(html);
		$("#add_form_content").show();
	  },
	  complete: function(){
		loadtiny();
		ajaxLoaded = true;
	  }
	});
	} else {
		$('#add_form_wrapper').toggle('fast');
		$('#add_form_content').html('');
		$('#add_form_content').css('display','none');
		ajaxLoaded = false;
	}
	return false;	
}


close_modal = function() {
	$.nyroModalRemove();
	return false;
}


deleteTask = function(taskId) {
	temp = 'div#' + taskId;
	
	jQuery.ajax({	type:'POST',
					dataType:'html',
					beforeSend:function(XMLHttpRequest){
						$(temp).addClass("task_strike");
						$('div#task_' + taskId +'_spinner').show();},
					complete:function(XMLHttpRequest, textStatus){
						$('div#task_' + taskId +'_spinner').hide();
						},url:'/task/' + taskId + '/delete'}); return false;
	
}

completedToggle = function(taskId, checkStatus) {
	temp = 'div#' + taskId;
	jQuery.ajax({	type: 'POST', 
					url: '/task/status/change',
					beforeSend: function(){ $(temp).addClass("task_strike"); },
					data: 'tid=' + taskId + '&mode='+checkStatus, 
					success: function(){$(temp).slideUp("fast");} });
}

 
*/