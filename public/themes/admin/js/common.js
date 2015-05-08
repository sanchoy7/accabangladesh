// JavaScript Document
var thisURL = window.location;

$(document).ready(function(){

	$.ifixpng(baseUrl + 'public/images/pixel.gif');
	$('.pngfix').ifixpng();
	//$("#header #change-language select").change(function () {changeLanguage(this); });
	
	// automatically disappear flash msg
	setTimeout(
		function(){
			$('#flash_msg_cont').slideUp('slow');
		},
		5000
	); 	
    
    if(typeof $('.ui-state-default').live == 'function'){
    	$('.ui-state-default').live('mouseover', function() { $(this).addClass('ui-state-hover') });
        $('.ui-state-default').live('mouseout', function() { $(this).removeClass('ui-state-hover') });
    }
    else{
    	$('.ui-state-default').hover(
    			function() { $(this).addClass('ui-state-hover'); }, 
    			function() { $(this).removeClass('ui-state-hover'); }
    	);
    }
    
    if(typeof $('#dialog').dialog == 'function' )
    {
	    $('#dialog').dialog({
			autoOpen: false,
			width: 350,
			buttons: {
				"Ok": function() { 
					$(this).dialog("close"); 
				}}
		});
	    
	    $('#confirm-dialog').dialog({
	        autoOpen: false,
	        width: 300,
	        modal: true,
	        buttons: {}
	    });
    }
    
    if(typeof bindPageEvents  == 'function')
    {
    	bindPageEvents();
    }    	
});

function changeLanguage(obj)
{
	//$("#backToUrl").val(thisURL);
	//$("#change-language").submit();
		
} 

//Create jQuery UI style message
function createUIMessasge(message, type, color)
{
    // Create variables
    var type    = type    || 'success';
    var color   = color   || '';
    var icon    = (type == 'error')? 'circle-close' : 'check';
    var state   = (type == 'error')? 'error' : 'highlight';

    // build the html string
	msg  = '<div class="ui-widget ui-msgbox ui-msg-'+ type +'">';
    msg += '<div class="ui-state-'+ state +' ui-corner-all">'; 
	msg += '<p><span class="ui-icon ui-icon-'+ icon +'"/>';
	msg += '<font color="' + color + '">' + message + '</font></p></div></div>';

    return msg;
}

function toggleSelectAllCheckboxes(e){
	if($(e).attr('checked') == false){
		$(':checkbox').attr('checked', '');
	}else{
		$(':checkbox').attr('checked', 'checked');		
	}
}

function showConfirmation(title, message)
{
	var title   = title   || 'Warning!';
    var message = message || 'Are you sure to do this?';
    var iconspan    = '<span style="margin: 0pt 7px 50px 0pt; float: left;" class="ui-icon ui-icon-alert"> </span>';
    
    $('#confirm-dialog').dialog('option', 'title', title);
    $('#confirm-dialog').html('<p>' + iconspan + message + '</p>').dialog('open');
}