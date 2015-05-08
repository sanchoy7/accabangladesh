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
 * @version $Id: s7n.php 377 2009-05-21 20:49:28Z eduardbaun $
 */
Event::add('system.ready', 'module::load_modules');
Event::add('system.ready', 'config::load');

/*** Responsible to add en before url start***/
//Event::add_before('system.routing', array('Router', 'setup'), array('language', 'setup'));
//Event::add_before('system.routing', array('Router', 'setup'), array('url', 'new_route'));
/*** Responsible to add en before url end***/

Event::add('system.post_routing', 'theme::load_themes');

function __($string, array $values = array())
{
	if (I18n::$lang !== I18n::$default_lang)
		$string = I18n::get($string);

	return empty($values) ? $string : strtr($string, $values);
}

function __n($singular, $plural, $count, array $values = array())
{
	if (I18n::$lang !== I18n::$default_lang)
	{
		$string = $count === 1 ? I18n::get($singular) : I18n::get_plural($plural, $count);
	}
	else
		$string = $count === 1 ? $singular : $plural;
	
	return strtr($string, array_merge($values, array('%count' => $count)));
}