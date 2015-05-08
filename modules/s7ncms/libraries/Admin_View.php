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
 * @version $Id: Admin_View.php 289 2009-03-14 21:16:41Z eduardbaun $
 */
class Admin_View_Core extends View
{
	public function __construct($name)
	{
		parent::__construct($name);
		
		$this->set_global('theme', $this);
	}
	
	public function url($path) {
		return 'public/themes/'.theme::$name.'/'.$path;
	}
}