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
 * @version $Id: syntaxhighlighter_installer.php 375 2009-05-21 15:13:09Z eduardbaun $
 */
class syntaxhighlighter_installer {

	public static function install()
	{
		$version = (int) module::version('syntaxhighlighter');

		// module is not installed yet
		if ($version === 0)
		{
			module::version('syntaxhighlighter', 1);
		}
	}

	public static function uninstall()
	{
		module::delete("syntaxhighlighter");
	}

}