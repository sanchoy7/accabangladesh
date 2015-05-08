<?php
$name = array(
	'name' 	=> 'full_name',
	'id' 	=> 'full_name',
	'value' => $form['full_name'],
	'style' => 'width:400px;'
);
$course_name = array(
	'name' 	=> 'course_name',
	'id' 	=> 'course_name',
	'value' => $form['course_name'],
	'style' => 'width:400px;'
);

$courseData = array(
	'ACCA' 	=> 'ACCA',
	'CAT' 	=> 'CAT',
	'HND'   => 'HND',
);

$contact_no = array(
	'name' 	=> 'contact_no',
	'id' 	=> 'contact_no',
	'value' => $form['contact_no'],
	'style' => 'width:400px;'
);

$email = array(
	'name' 	=> 'email',
	'id' 	=> 'email',
	'value' => $form['email'],
	'style' => 'width:400px;'
);

$age = array(
	'name' 	=> 'age',
	'id' 	=> 'age',
	'value' => $form['age'],
	'style' => 'width:400px;'
);

$education = array(
	'name' 	=> 'education',
	'id' 	=> 'education',
	'value' => $form['education'],
	'style' => 'width:400px;'
);

$extra_course = array(
	'name' 	=> 'extra_course',
	'id' 	=> 'extra_course',
	'value' => $form['extra_course'],
	'style' => 'width:600px; height:80px;'
);

$mailing_address = array(
	'name' 	=> 'mailing_address',
	'id' 	=> 'mailing_address',
	'value' => $form['mailing_address'],
	'style' => 'width:600px; height:200px;'
);
?>
<div class="post">
	<a name="form"></a>
	<h2 class="title"><a href="#">Check Your Eligibility</a></h2>
	<?php if(!empty($status_message)){echo $status_message;} ?>
	<!--<p class="meta">Sunday, April 26, 2009 7:27 AM Posted by <a href="#">Someone</a></p>-->
	<div class="entry">
	<?php echo form::open(url::current().'#form'); ?>
	<dl>
		<dt><?php echo form::label($name['id'], 'Full Name'); ?>:&nbsp;(<em>Required</em>)</dt>
		<dd>
		<?php
			echo form::input($name);
			if(!empty($errors['full_name'])){echo '<div>'.$errors['full_name'].'</div>';}
		?>
		</dd>
		
		<dt><?php echo form::label($course_name['id'], 'Degree Name'); ?></dt>
		<dd>
		<?php
			echo form::dropdown('course_name', $courseData, '', 'style="width:400px;"');
			if(!empty($errors['course_name'])){echo '<div>'.$errors['course_name'].'</div>';}
		?>
		</dd>
	
		<dt><?php echo form::label($contact_no['id'], 'Contact Number'); ?>:&nbsp;(<em>Required</em>)</dt>
		<dd>
		<?php
			echo form::input($contact_no);
			if(!empty($errors['contact_no'])){echo '<div>'.$errors['contact_no'].'</div>';}
		?>
		</dd>
		
		<dt><?php echo form::label($email['id'], 'Email Address'); ?>:&nbsp;(<em>Required</em>)</dt>
		<dd>
		<?php
			echo form::input($email);
			if(!empty($errors['email'])){echo '<div>'.$errors['email'].'</div>';}
		?>
		</dd>
		
		<dt><?php echo form::label($age['id'], 'Age'); ?>:&nbsp;(<em>Required in Year</em>)</dt>
		<dd>
		<?php
			echo form::input($age);
			if(!empty($errors['age'])){echo '<div>'.$errors['age'].'</div>';}
		?>
		</dd>
	
		<dt><?php echo form::label($education['id'], 'Academic Education'); ?>:&nbsp;(<em>Required</em>)</dt>
		<dd>
		<?php
			echo form::input($education);
			if(!empty($errors['education'])){echo '<div>'.$errors['education'].'</div>';}
		?>
		</dd>
		
		<dt><?php echo form::label($extra_course['id'], 'Others Training'); ?>:&nbsp;(<em>Required</em>)</dt>
		<dd>
		<?php
			echo form::textarea($extra_course);
			if(!empty($errors['extra_course'])){echo '<div>'.$errors['extra_course'].'</div>';}
		?>
		</dd>
	
		<dt><?php echo form::label($mailing_address['id'], 'Your Mailing Address'); ?>:&nbsp;(<em>Required</em>)</dt>
		<dd>
		<?php
			echo form::textarea($mailing_address);
			if(!empty($errors['mailing_address'])){echo '<div>'.$errors['mailing_address'].'</div>';}
		?>
		</dd>
		
		<dt></dt>
		<dd>
		<?php
			echo form::submit('send', 'Check Eligibility');
		?>
		</dd>
	</dl>
	<?php echo form::close(); ?>
	</div>
</div>