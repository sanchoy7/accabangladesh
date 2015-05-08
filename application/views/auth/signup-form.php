<?php
$username = array(
	'name' 	=> 'username',
	'id' 	=> 'username',
	'value' => $form['username'],
	'style' => 'width:400px;'
);
$email = array(
	'name' 	=> 'email',
	'id' 	=> 'email',
	'value' => $form['email'],
	'style' => 'width:400px;'
);
$password = array(
	'name' 	=> 'password',
	'id' 	=> 'password',
	'value' => $form['password'],
	'style' => 'width:400px;'
);
$password_confirm = array(
	'name' 	=> 'password_confirm',
	'id' 	=> 'password_confirm',
	'value' => '',//$form['password_confirm'],
	'style' => 'width:400px;'
);
$captcha_response = array(
	'name' 	=> 'captcha_response',
	'id' 	=> 'captcha_response',
	'style' => 'width:400px;'
);
?>
<div class="post">
	<script type="text/javascript">
		$(document).ready(function(){
			setTimeout("$('.success').fadeOut(1000)", 8000);
		});
	</script>
	<a name="form"></a>
	<h2 class="title"><a href="#">User Registration Form</a></h2>
	<?php if(!empty($status_message)){echo $status_message;} ?>
	<!--<p class="meta">Sunday, April 26, 2009 7:27 AM Posted by <a href="#">Someone</a></p>-->
	<div class="entry">
		<?php echo form::open(url::current().'#form'); ?>
		<dl>
			<dt><?php echo form::label($username['id'], 'Username'); ?>:&nbsp;(<em>Required</em>)</dt>
			<dd>
			<?php
				echo form::input($username);
				if(!empty($errors->username)){echo(sprintf($common->field_error, $errors->username));}
			?>
			</dd>
			
			<dt><?php echo form::label($email['id'], 'Email Address'); ?>:&nbsp;(<em>Required</em>)</dt>
			<dd>
			<?php
				echo form::input($email);
				if(!empty($errors->email)){echo(sprintf($common->field_error, $errors->email));}
			?>
			</dd>
			
			<dt><?php echo form::label($password['id'], 'Password'); ?>:&nbsp;(<em>Required</em>)</dt>
			<dd>
			<?php
				echo form::password($password);
				if(!empty($errors->password)){echo(sprintf($common->field_error, $errors->password));}
			?>
			</dd>
			
			<dt><?php echo form::label($password_confirm['id'], 'Confirm Password'); ?>:&nbsp;(<em>Required</em>)</dt>
			<dd>
			<?php
				echo form::password($password_confirm);
				if(!empty($errors->password_confirm)){echo(sprintf($common->field_error, $errors->password_confirm));}
			?>
			</dd>

			<dt><br /></dt>
			<dd>
			<?php
			if(!$captcha->promoted())
			{
				echo '<p>'.$captcha->render().'</p>';
				echo '<b>'.form::label($captcha_response['id'], 'Enter Above Captcha Code').':&nbsp;(<em>Required</em>)</b><br>';
				echo form::input($captcha_response);
				if(!empty($errors->captcha_response)){echo(sprintf($common->field_error, $errors->captcha_response));}
			}
			?>
			</dd>
			
			<dt></dt>
			<dd>
			<?php
				echo form::submit('submit', 'Register Me Now');
			?>
			</dd>
		</dl>
		<?php echo form::close(); ?>
	</div>
</div>