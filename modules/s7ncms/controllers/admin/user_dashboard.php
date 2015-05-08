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
 * @version $Id: dashboard.php 271 2009-03-03 23:31:55Z eduardbaun $
 */
class User_Dashboard_Controller extends Administration_Controller 
{
	public function index()
	{
        $this->head->title->append('User Dashboard');
		$this->template->title = 'User Dashboard';
        $this->template->content = View::factory('user_dashboard/index');
    }
}