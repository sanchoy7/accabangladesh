<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<?php echo $redirect; ?>
<title><?php echo $title; ?></title>
</head>
<body>
<h1><?php echo $title; ?></h1>

<?php if($text != $title): ?>
	<span>
		<?php echo $text; ?>
	</span>
<?php endif; ?>

<p><?php echo $links ?></p>
</body>
</html>