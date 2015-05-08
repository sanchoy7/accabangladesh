<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<base href="<?php echo url::base(TRUE); ?>" />
<title>::: <?php echo html::specialchars($title); ?> :::</title>
<?php
// Meta Data Loading
echo Html::meta(array('keywords' => '', 'description' => ''));

// Stylesheet Loading
echo Html::stylesheet(url::base(FALSE).'public/css/controller.css', FALSE);

// Start Dynamic Stylesheet Loading
if(count(@$stylesheets)):
	foreach($stylesheets as $stylesheet):
		echo Html::stylesheet(url::base(FALSE).'public/css/'.$stylesheet, FALSE);
	endforeach;
endif;

// End Dynamic Stylesheet Load
echo Html::script(
		array(
			url::base(TRUE).'public/js/jquery-1.js',
			url::base(TRUE).'public/js/jquery-ui.js',
			url::base(TRUE).'public/js/jquery-fluid16.js',
			url::base(TRUE).'public/js/jsn_script.js',
			url::base(TRUE).'public/js/suckerfish.js',
		), FALSE
);

// Start Dynamic Javascript Loading
if(count(@$javascripts)):
	foreach($javascripts as $javascript):
		echo Html::script(url::base(TRUE).'public/js/'.$javascript);
	endforeach;
endif;
?>
</head>
<body <?php echo(isset($html_body_id)) ? "id=\"$html_body_id\"" : ''; ?>>
<div id="wrapper">
	<div id="logo">
		<?php echo $content->SITE_TOP_BANNER; ?>
	</div>
	<hr />
	<!-- end #logo -->
	<div id="header">
		<div id="menu">
			<?php echo $content->SITE_TOP_HORI_MENU; ?>
		</div>
		<!-- end #menu -->
		<div id="search">
			<?php echo $content->SITE_SEARCH_BOX; ?>
		</div>
		<!-- end #search -->
	</div>
	<!-- end #header -->
	<!-- end #header-wrapper -->
	<div id="page">
	<div id="page-bgtop">
		<div id="content">
			<?php if($breadcrumb): ?>
				<p id="breadcrumb">
					<?php
						foreach($breadcrumb as $link):
							echo '&nbsp;&raquo;&nbsp;'.$link;
						endforeach;
					?>
				</p>
			<?php endif; ?>
			<?php echo $content->SITE_MIDDLE_CONTENT; ?>
		</div>
		<!-- end #content -->
		<div id="sidebar">
			<ul>
				<li>
					<?php echo $content->SITE_TOP_LEFT_MENU; ?>
				</li>
				<li>
					<?php echo $content->SITE_MIDDLE_LEFT_MENU; ?>
				</li>
				<li>
					<?php echo $content->SITE_BOTTOM_LEFT_BOX; ?>
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
			<?php echo $content->SITE_FOOTER_BLOCK; ?>
		</div>
	</div>
	<!-- end #footer -->
</div>
</body>
</html>
