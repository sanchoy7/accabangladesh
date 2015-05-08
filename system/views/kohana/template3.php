<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<base href="<?php echo url::base(TRUE); ?>" />
<title><?php echo html::specialchars($title); ?> : : :</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="<?php echo url::base(FALSE); ?>public/css/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper">
	<div id="logo">
		<?php echo $content1; ?>
	</div>
	<hr />
	<!-- end #logo -->
	<div id="header">
		<div id="menu">
			<?php echo $content2; ?>
		</div>
		<!-- end #menu -->
		<div id="search">
			<?php echo $content3; ?>
		</div>
		<!-- end #search -->
	</div>
	<!-- end #header -->
	<!-- end #header-wrapper -->
	<div id="page">
	<div id="page-bgtop">
		<div id="content">
			<div class="post">
				<?php echo $content4; ?>
			</div>
			<div class="post">
				<?php echo $content5; ?>
			</div>
			<div class="post">
				<?php echo $content6; ?>
			</div>
		</div>
		<!-- end #content -->
		<div id="sidebar">
			<ul>
				<li>
					<?php echo $content7; ?>
				</li>
				<li>
					<?php echo $content8; ?>
				</li>
				<li>
					<?php echo $content9; ?>
				</li>
			</ul>
		</div>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	</div>
	<!-- end #page -->
	<div id="footer-bgcontent">
		<div id="footer">
			<?php echo $content10; ?>
		</div>
	</div>
	<!-- end #footer -->
</div>
</body>
</html>
