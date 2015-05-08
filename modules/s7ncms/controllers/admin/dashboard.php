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
			if(Auth::factory()->logged_in('Admin'))
			{
				$this->template->tasks = array(
					array('admin/dashboard', __('&raquo; Admin Dashboard')),
					array('admin/aboutus/index', __('&raquo; About ACCA Bangladesh')),
					array('admin/user', __('&raquo; ACCA Users')),
					array('admin/admission_info/index', __('&raquo; Admission Information')),
					array('admin/account/index', __('&raquo; Accounts Information')),
					array('admin/personal_info/index', __('&raquo; Personal Information')),
					array('admin/semister/index', __('&raquo; Semister Information')),
					array('admin/expense_syllabus/index', __('&raquo; Expense &amp; Syllabus')),
					array('admin/course_material/index', __('&raquo; Course Materials')),
					array('admin/media/index', __('&raquo; Media Gallery')),
					array('admin/news_event/index', __('&raquo; News &amp; Events')),
					array('admin/web_link/index', __('&raquo; Essential Web Links')),
					array('admin/faq/index', __('&raquo; FAQs')),
				);

				$this->head->title->append('Admin Dashboard');
				$this->template->title = 'Admin Dashboard';
        		$this->template->content = View::factory('dashboard/index');
			}
			elseif(!Auth::factory()->logged_in('Admin') AND Auth::factory()->logged_in('login'))
			{				
				url::redirect('admin/user/dashboard/');
			}
		}else{
			url::redirect('auth/login/');
		}
    }
}