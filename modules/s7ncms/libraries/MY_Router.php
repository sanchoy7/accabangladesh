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
 * @version $Id: MY_Router.php 328 2009-04-19 17:05:19Z eduardbaun $
 */
class Router extends Router_Core {

	public static $language = NULL;
	public static $current_id;
	public static $current_arguments = NULL;

	public static function find_uri()
	{
		parent::find_uri();

		if (preg_match('~^[a-z]{2}(?=/|$)~i', Router::$current_uri, $matches) AND isset($matches[0]))
		{
			$lang = strtolower($matches[0]);
			if (array_key_exists($lang, Kohana::config('locale.languages')))
			{
				Router::$language = $lang;
				Router::$current_uri = substr(Router::$current_uri, 3);
			}
		}
	}
}