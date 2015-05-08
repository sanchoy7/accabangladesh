<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<?php echo html::stylesheet('public/themes/admin/css/login.css', 'screen'); ?>
	<title>ACCA Bangladesh Login</title>
	<script type="text/javascript">
        window.onload = function () {document.getElementById('username').focus();};
    </script>
</head>
<body>
<div id="login">
    <div id="logo"><a href="<?php echo url::base(TRUE); ?>"><?php echo html::image('public/images/logo.gif', array('border' => 0)); ?></a></div>
    <div id="formular">
        <div id="message">
		<p>&nbsp;</p>
        <?php if ( ! empty($error)): ?>
        	<?php echo $error; ?>
        <?php endif; ?>
        </div>
		<div id="form">
			<?php echo form::open(); ?>
				<?php echo $__form_object; ?>
				<p class="email">
					<?php echo form::label($username->name, $username->label); ?>
					<?php echo empty($username->error) ? form::input($username->name, $username->value) : form::input($username->name, $username->value, 'class="error"'); ?>
					<?php if ( ! empty($username->error)): ?><br /><span class="error"><?php echo $username->error ?></span><?php endif; ?>
				</p>
				<p class="password">
					<?php echo form::label($password->name, $password->label); ?>
					<?php echo empty($password->error) ? form::password($password->name) : form::password($password->name, '', 'class="error"'); ?>
					<?php if ( ! empty($password->error)): ?><br /><span class="error"><?php echo $password->error; ?></span><?php endif; ?>
				</p>
				<p class="submit">
					<?php echo form::submit($submit->name, $submit->label); ?>
				</p>
			<?php echo form::close(); ?>
		</div>
		<p><br />&nbsp;</p>
    </div>
</div>
</body>
</html>
