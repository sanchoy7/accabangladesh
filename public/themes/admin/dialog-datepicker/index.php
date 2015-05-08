<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DEMO | jensbits.com | Form Confirm Modal Box</title>
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css">
<link rel="stylesheet" type="text/css" href="css/thickbox.css">

<style type="text/css">
body {background-color: #efefef;font-family: "Trebuchet MS",sans-serif;font-size: 16px;}
fieldset{background-color: #ededed;border: 1px solid;}
legend{background-color: #ffffff;color: #cccccc;padding:5px;}
h1,h2,p,form {padding: 5px;}
h1,h2{font-size: 18px; color: #666666;}
legend,label,#dialog-email,#TB-email{font-weight:bold;margin-left: 10px;}
.container {width: 50%;margin-left: 25%;margin-top:2%;background: #ffffff;border: 4px solid #cccccc;}
.ui-dialog {font-size: 90%;}
form#testconfirmJQ fieldset{border-color: #ce0c0c;}
form#testconfirmJS legend{border: 1px solid #000000;color: #999999;}
form#testconfirmJQ legend{background-color: #ce0c0c;}
form#testconfirmTB legend{background-color: #000000;}
</style>

<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript" src="js/thickbox-compressed.js"></script>

<script type="text/javascript">
$(function(){
	
	// jQuery UI Dialog    
			
	$('#dialog').dialog({
		autoOpen: false,
		width: 400,
		modal: true,
		resizable: false,
		buttons: {
			"Yes, I do": function() {
				document.testconfirmJQ.submit();
			},
			"No, I don't": function() {
				$(this).dialog("close");
			}
		}
	});
	
	$('form#testconfirmJQ').submit(function(){
		$("p#dialog-email").html($("input#emailJQ").val());
		$('#dialog').dialog('open');
		return false;
	});
});
</script>
</head>

<body>

<div class="container">
    <h1>Form Submit Confirmation Demo:<br />Javacript Return Confirm and Modal jQuery and Thickbox</h1>
</div>

<div class="container">
<h2>Form Submit Confirmation Javascript</h2>
<?php if (isset($_POST['emailJS'])){
 echo "<p>It worked!!! Your e-mail address is " .$_POST['emailJS'];
 echo "</p>";
 }?>

<form id="testconfirmJS" name="testconfirmJS" method="post" onsubmit="return confirm('You entered your e-mail address as:\n\n' + document.getElementById('emailJS').value + '\n\nSelect OK if correct or Cancel to edit.')">
<fieldset>
<legend>Javacript Return Confirm</legend>
<p><label for="email">E-mail:</label><br />
<input id="emailJS" type="text" name="emailJS" value="" /></p>
<p><input type="submit" value="Submit"  /></p>
</fieldset>
</form>
</div>

<div class="container">
<h2>Form Submit Confirmation jQuery UI</h2>
<?php if (isset($_POST['emailJQ'])){
 echo "<p>It worked!!! Your e-mail address is " .$_POST['emailJQ'];
 echo "</p>";
 }?>

<form id="testconfirmJQ" name="testconfirmJQ" method="post">
<fieldset>
<legend>jQuery UI Modal Submit</legend>
<p><label for="email">E-mail:</label><br />
<input id="emailJQ" type="text" name="emailJQ" value="" /></p>
<p><input type="submit" value="Submit" /></p>
</fieldset>
</form>
</div>

<div id="dialog" title="Verify Form jQuery UI Style">
	<p>
		<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 0 0;"></span>
		You entered your e-mail address as:
	</p>
	<p id="dialog-email"></p>
	<p>If this is correct, click Submit Form.</p>
	<p>To edit, click Cancel.<p>
</div>

<div class="container">
<h2>Form Submit Confirmation with Thickbox</h2>
<?php if (isset($_POST['emailTB'])){
 echo "<p>It worked!!! Your e-mail address is " .$_POST['emailTB'];
 echo "</p>";
 }?>

<form id="testconfirmTB" name="testconfirmTB" method="post">
<fieldset>
<legend>Thickbox Modal Submit</legend>
<p><label for="email">E-mail:</label><br />
<input id="emailTB" type="text" name="emailTB" value="" /></p>
<p><input type="submit" value="Submit" /></p>

</fieldset>
</form>
</div>

<div id="TBcontent" style="display: none;"><p>You entered your e-mail address as:</p><p id="TB-email"></p><p>
If this is correct, click Submit Form.</p><p>To edit, click Cancel.<p>
<input type="submit" id="TBcancel" value="Cancel" />
<input type="submit" id="TBsubmit" value="Submit Form" />
</div>

<div class="container" style="margin-bottom: 2%;">
    <p><a href="http://jensbits.com">&lt;&lt; back to post on jensbits.com</a></p>
</div>

</body>
</html>