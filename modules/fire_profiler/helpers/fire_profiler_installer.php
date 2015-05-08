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
 * @version $Id: fire_profiler_installer.php 354 2009-05-16 16:37:32Z eduardbaun $
 */
class fire_profiler_installer {

	public static function install()
	{
		$version = (int) module::version('fire_profiler');

		// module is not installed yet
		if ($version === 0)
		{
			module::version('fire_profiler', 1);
		}
	}

	public static function uninstall()
	{
		module::delete("fire_profiler");
	}

}