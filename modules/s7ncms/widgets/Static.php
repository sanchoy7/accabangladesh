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
 * @version $Id: Static.php 271 2009-03-03 23:31:55Z eduardbaun $
 */
class Static_Widget extends Widget {

	public function render()
	{
		return View::factory('widgets/static')->set(array(
			'title' => $this->config['title'],
			'content' => $this->config['content']
		))->render();
	}

}