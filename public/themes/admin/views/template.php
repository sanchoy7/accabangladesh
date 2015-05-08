<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php echo $head; ?>
	<?php Event::run('s7n.admin.theme.head'); ?>
	<?php
	    // Loading Stylesheeet..
		echo Html::stylesheet(url::base(TRUE).'public/themes/admin/css/jquery-ui-1.7.2.custom.css', FALSE);
		// End Dynamic Stylesheet Load
		echo Html::script(
				array(
					url::base(TRUE).'public/themes/admin/js/common.js',
					url::base(TRUE).'public/themes/admin/js/stuff.js',
					url::base(TRUE).'public/themes/admin/js/jquery-1.3.2.min.js',
					url::base(TRUE).'public/themes/admin/js/jquery-ui-1.7.2.custom.min.js',
				), FALSE
		);
	?>

<style type="text/css">
	.dialog {font-size: 100%; font-weight:bold;}
</style>
</head>

<body>
	<div id="header">
		<?php if(Auth::factory()->logged_in('admin')){ ?>
			<?php echo Kohana::config('core.site_name').' / Admin Panel'; ?>
		<?php }elseif(!Auth::factory()->logged_in('Admin') AND Auth::factory()->logged_in('login')){ ?>
			<?php echo Kohana::config('core.site_name').' / User Panel'; ?>
		<?php } ?>
		<div class="info">
			<?php echo __('Logged In As %username', array('%username' => ucfirst(Auth::instance()->get_user()->username))); ?> |
			<?php echo html::anchor(url::base().'home', __('Home')); ?> |
			<?php if(Auth::factory()->logged_in('admin')){ ?>
				<?php echo html::anchor(url::base().'admin/modules', __('Modules')); ?> |
				<?php echo html::anchor(url::base().'admin/settings', __('Settings')); ?> |
			<?php } ?>
			<?php echo html::anchor(url::base().'admin/auth/logout', __('Logout')); ?>
		</div>
	</div>

	<div id="navigation">
		<ul>
			<?php if(Auth::factory()->logged_in('admin')){ ?>
				<li><?php echo html::anchor('admin/dashboard', 'Dashboard'); ?></li>
				<li><?php echo html::anchor('admin/aboutus/index', 'About Us'); ?></li>
				<li><?php echo html::anchor('admin/user', 'Users'); ?></li>
				<li><?php echo html::anchor('admin/admission_info/index', 'Admission Info'); ?></li>
				<li><?php echo html::anchor('admin/account/index', 'Accounts'); ?></li>
				<li><?php echo html::anchor('admin/personal_info/index', 'Personal Info'); ?></li>
				<li><?php echo html::anchor('admin/semister/index', 'Semisters'); ?></li>
				<li><?php echo html::anchor('admin/expense_syllabus/index', 'Expense/Syllabus'); ?></li>
				<li><?php echo html::anchor('admin/course_material/index', 'Course Materials'); ?></li>
				<li><?php echo html::anchor('admin/media/index', 'Media'); ?></li>
				<li><?php echo html::anchor('admin/news_event/index', 'News/Event'); ?></li>
				<li><?php echo html::anchor('admin/web_link/index', 'Links'); ?></li>
				<li><?php echo html::anchor('admin/faq/index', 'FAQ'); ?></li>
			<?php }elseif(!Auth::factory()->logged_in('Admin') AND Auth::factory()->logged_in('login')){ ?>
				<li><?php echo html::anchor('admin/user/dashboard/', 'Dashboard'); ?></li>
				<li><?php echo html::anchor('admin/user/account_settings/', 'Settings'); ?></li>
				<li><?php echo html::anchor('admin/user/profile', 'Profile'); ?></li>
				<li><?php echo html::anchor('admin/user/admission/', 'Admission Info'); ?></li>
				<li><?php echo html::anchor('admin/user/accounts/', 'Accounts Info'); ?></li>
				<li><?php echo html::anchor('admin/user/personal/', 'Personal Info'); ?></li>
				<li><?php echo html::anchor('admin/user/semister_info/', 'Semister Info'); ?></li>
				<li><?php echo html::anchor('admin/user/courses/', 'Courses'); ?></li>
				<li><?php echo html::anchor('admin/user/syllabus/', 'Syllabus'); ?></li>
				<li><?php echo html::anchor('admin/user/materials/', 'Course Materials'); ?></li>
				<li><?php echo html::anchor('admin/user/archives/', 'Archives'); ?></li>
				<li><?php echo html::anchor('admin/user/inbox/', 'Inbox'); ?></li>
				<li><?php echo html::anchor('admin/user/media_gallery/', 'Media Gallery'); ?></li>
			<?php } ?>
		</ul>
	</div>

	<div id="main">
		<div id="title">
			<h2><?php echo $title; ?></h2>
			<?php if ($searchbar): ?>
			<?php echo form::open(NULL, array('id' => 'searchbar', 'method' => 'get')); ?>
			    <input name="q" value="<?php echo $searchvalue; ?>" type="search" placeholder="<?php echo __('Filter By'); ?>" autosave="s7n.search" />
				<?php echo form::submit('search', __('Go')); ?>
			<?php echo form::close(); ?>
			<?php endif; ?>
		</div>

		<div id="left">
			<div id="sidebar">
				<?php echo Sidebar::instance(); ?>

				<?php if(isset($tasks) AND !empty($tasks)): ?>
					<h3><?php echo __('Tasks'); ?></h3>
					<p>
						<?php foreach($tasks as $task): ?>
							<?php echo html::anchor($task[0], $task[1]); ?><br />
						<?php endforeach; ?>
					</p>
				<?php endif; ?>
			</div>
		</div>

		<div id="content">
			<?php if($message = message::info()): ?>
				<div id="info_message">
					<p><?php echo $message; ?></p>
				</div>
			<?php endif; ?>
			<?php if($message = message::error()): ?>
				<div id="error_message">
					<p><?php echo $message; ?></p>
				</div>
			<?php endif; ?>
			
			<?php echo $content; ?>
			<?php if(!Auth::factory()->logged_in('Admin') AND Auth::factory()->logged_in('login')){ ?>
				<div id="dialog2" style="display: none;"></div>
					<div id="uploader" style="display: none; margin: 10px 0 0 20px;">
						<?php echo form::open_multipart("admin/upload/save", array('id'=>'imageuploadform', "target" => "uploadiframe")); ?>
						<?php echo form::upload('picture'); ?>
						<?php echo form::close(); ?>
						<iframe id="uploadiframe" name="uploadiframe" src="#" style="display: none;"></iframe>
						<div id="uploadmessage"></div>
					</div>
				<div id="logoProgress"></div>
			<?php } ?>
		</div>
	</div>
</body>
</html>
