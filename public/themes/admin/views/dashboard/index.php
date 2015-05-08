<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div id="desh">
	<p><?php echo __('Dear username,<br />Welcome to the site_name Administration Interface.', array('username' => ucfirst(Auth::instance()->get_user()->username), 'site_name' => Kohana::config('core.site_name'))); ?></p>
	<p style="color: #006666;"><?php echo __('Here You can manage your website.'); ?></p>
</div>