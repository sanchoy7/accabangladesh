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
 * @version $Id: Submenu.php 271 2009-03-03 23:31:55Z eduardbaun $
 */
class Submenu_Widget extends Widget {

	public function render()
	{
		$menu = Menu::instance('submenu')->render();

		if (empty($menu))
			return '';

		return View::factory('widgets/submenu')->set(array(
			'menu' => $menu
		))->render();
	}

}