<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * S7Ncms - www.s7n.de
 *
 * Copyright (c) 2007-2009, Eduard Baun <eduard at baun.de>
 * All rights reserved.
 *
 * See license.txt for full text and disclaimer
 *
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: tinymce_installer.php 471 2009-07-30 14:34:47Z eduardbaun $
 */
class tinymce_installer {

	public static function install()
	{
		$version = (int) module::version('tinymce');

		// module is not installed yet
		if ($version === 0)
		{
			module::version('tinymce', 1);
		}
	}

	public static function uninstall()
	{
		module::delete("tinymce");
	}

}