<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div id="desh">
	<p><?php echo __('Dear username,<br />This page is under construction.<br />Sorry, for this inconvenient.', array('username' => ucfirst(Auth::instance()->get_user()->username))); ?></p>
	<p style="color: #006666;"><?php echo __('But, we are coming very soon! !!'); ?></p>
</div>