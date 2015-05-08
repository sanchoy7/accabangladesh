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
 * @version $Id: Tagcloud.php 271 2009-03-03 23:31:55Z eduardbaun $
 */
class Tagcloud_Widget extends Widget {

	public function initialize($config = array())
	{
		$this->config = (array) $config + Kohana::config('tagcloud');
	}

	public function render()
	{
		return View::factory('widgets/tagcloud')->set(array(
			'tags' => new Tagcloud($this->config['tags'], $this->config['minsize'], $this->config['maxsize'], $this->config['shuffle'])
		))->render();
	}

}