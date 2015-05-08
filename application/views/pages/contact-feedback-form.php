<div class="post">
	<!--<p class="meta">Sunday, April 26, 2009 7:27 AM Posted by <a href="#">Someone</a></p>-->
	<div class="entry">
		<h2 class="title"><a href="#">For further information</a></h2>
		<p>Please visit our website: <a href="http://www.saifurs.org/">www.saifurs.org</a>&nbsp;&nbsp;<strong>Or</strong><br /> 
		<strong>Corporate Office:</strong> 69/B, Monowara Plaza (5th Floor.),<br />
		Green Road, Panthapath, Dhaka-1205, Bangladesh,<br />
		<strong>Phone:</strong> 8628624, 9677277, 8629471, 01713432003,<br />
		<strong>Email:</strong> <a href="mailto:saifursadmin@gmail.com">saifursadmin@gmail.com</a></p>
		
		<h2 class="title"><a href="#">Our London Office:</a></h2>
		<p>Murad Hossain,<br />
		Director, <a href="http://www.saifurs.org/">S@ifur&rsquo;s</a>
		6 Fordham Street,<br />
		London, E1 1HS, UK,<br />
		00447574061010,<br />
		<a href="mailto:h_m_murad@yahoo.com">h_m_murad@yahoo.com</a></p>
	</div>
</div>

<?php
$name = array(
	'name' 	=> 'full_name',
	'id' 	=> 'full_name',
	'value' => $form['full_name'],
	'style' => 'width:400px;'
);
$phone = array(
	'name' 	=> 'phone',
	'id' 	=> 'phone',
	'value' => $form['phone'],
	'style' => 'width:400px;'
);
$email = array(
	'name' 	=> 'email',
	'id' 	=> 'email',
	'value' => $form['email'],
	'style' => 'width:400px;'
);
$subject = array(
	'name' 	=> 'subject',
	'id' 	=> 'subject',
	'value' => $form['subject'],
	'style' => 'width:400px;'
);
$message = array(
	'name' 	=> 'message',
	'id' 	=> 'message',
	'value' => $form['message'],
	'style' => 'width:600px; height:200px;'
);
?>
<div class="post">
	<script type="text/javascript">
		$(document).ready(function(){
			setTimeout("$('.success').fadeOut(1000)", 8000);
		});
	</script>
	<a name="form"></a>
	<h2 class="title"><a href="#">Visitors Feedback Form</a></h2>
	<?php if(!empty($status_message)){echo $status_message;} ?>
	<?php
	/*if(!empty($faults))
	{
		echo "<ul class='fail' style='text-indent:10px; text-align:left;'>";
		foreach($faults as $key => $val)
		{
			echo '<li>'.ucwords(str_replace('_', ' ', $key).' - field failed to meet the rule - '.$val).'</li>';
		}
		echo "</ul>";
	}*/
	?>
	<!--<p class="meta">Sunday, April 26, 2009 7:27 AM Posted by <a href="#">Someone</a></p>-->
	<div class="entry">
		<?php echo form::open(url::current().'#form'); ?>
		<dl>
			<dt><?php echo form::label($name['id'], 'Full Name'); ?>:&nbsp;(<em>Required</em>)</dt>
			<dd>
			<?php
				echo form::input($name);
				if(!empty($errors->full_name)){echo(sprintf($common->field_error, $errors->full_name));}
			?>
			</dd>
			
			<dt><?php echo form::label($phone['id'], 'Contact Number'); ?>:&nbsp;(<em>Required</em>)</dt>
			<dd>
			<?php
				echo form::input($phone);
				if(!empty($errors->phone)){echo(sprintf($common->field_error, $errors->phone));}
			?>
			</dd>
			
			<dt><?php echo form::label($email['id'], 'Email Address'); ?>:&nbsp;(<em>Required</em>)</dt>
			<dd>
			<?php
				echo form::input($email);
				if(!empty($errors->email)){echo(sprintf($common->field_error, $errors->email));}
			?>
			</dd>
			
			<dt><?php echo form::label($subject['id'], 'Subject'); ?>:&nbsp;(<em>Required</em>)</dt>
			<dd>
			<?php
				echo form::input($subject);
				if(!empty($errors->subject)){echo(sprintf($common->field_error, $errors->subject));}
			?>
			</dd>
			
			<dt><?php echo form::label($message['id'], 'Write Your Message'); ?>:&nbsp;(<em>Required</em>)</dt>
			<dd>
			<?php
				echo form::textarea($message);
				if(!empty($errors->message)){echo(sprintf($common->field_error, $errors->message));}
			?>
			</dd>
			
			<dt></dt>
			<dd>
			<?php
				echo form::submit('send', 'Send Your Message');
			?>
			</dd>
		</dl>
		<?php echo form::close(); ?>
	</div>
</div>