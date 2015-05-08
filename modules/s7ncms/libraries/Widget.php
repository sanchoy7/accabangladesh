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
 * @version $Id: Widget.php 271 2009-03-03 23:31:55Z eduardbaun $
 */
class Widget_Core {

	protected $config = array();

	public function __construct($config = array())
	{
		$this->initialize($config);
	}

	public static function factory($widget, $config = array())
	{
		$class_name = ucfirst(strtolower($widget)).'_Widget';

		if (class_exists($class_name))
			return new $class_name($config);

		if ($file = Kohana::find_file('widgets', $widget))
		{
			require $file;

			if (class_exists($class_name))
				return new $class_name($config);
		}

		throw new Kohana_Exception('core.resource_not_found', 'Widget', $widget);
	}

	public function __toString()
	{
		return $this->render();
	}

	public function initialize($config = array())
	{
		$this->config = $config;
	}

}