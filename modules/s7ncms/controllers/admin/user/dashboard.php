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
class Dashboard_Controller extends Administration_Controller {

	public function index()
	{
		if(Auth::factory()->logged_in())
		{
			if(!Auth::factory()->logged_in('Admin') AND Auth::factory()->logged_in('login'))
			{				
				$this->template->tasks = array(
					array('admin/user/dashboard/', __('&raquo; User Dashboard')),
					array('admin/user/account_settings/', __('&raquo; Account Settings')),
					array('admin/user/profile', __('&raquo; Your Profile')),
					array('admin/user/admission/', __('&raquo; Admission Information')),
					array('admin/user/accounts/', __('&raquo; Accounts Information')),
					array('admin/user/personal/', __('&raquo; Personal Information')),
					array('admin/user/semister_info/', __('&raquo; Semister Information')),
					array('admin/user/courses/', __('&raquo; Courses Information')),
					array('admin/user/syllabus/', __('&raquo; Semister Syllabus')),
					array('admin/user/materials/', __('&raquo; Course Materials')),
					array('admin/user/archives/', __('&raquo; Archives')),
					array('admin/user/inbox/', __('&raquo; Message Inbox')),
					array('admin/user/media_gallery/', __('&raquo; Media Gallery')),
				);

				$this->head->title->append('User Dashboard');
				$this->template->title = 'User Dashboard';
        		$this->template->content = View::factory('users/dashboard/index');
			}
		}else{
			url::redirect('auth/login/');
		}
    }
}