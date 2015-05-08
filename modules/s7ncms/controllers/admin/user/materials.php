<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class Materials_Controller extends Administration_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if(Auth::factory()->logged_in())
		{
			if(!Auth::factory()->logged_in('login')){
				url::redirect('home');
			}
		}
		
		$this->template->tasks = array(
			array('admin/user/materials', __('Show All Contents')),
			//array('admin/user/create', __('Add About Us Content')),
			//array('admin/user/active', __('Show Active Contents')),
			//array('admin/user/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('Course Materials'));
		$this->template->title = html::anchor('admin/user/materials', __('Profile')).' | ';
	}

	public function index()
	{
        $this->head->title->append('Course Materials Information');
		$this->template->title = 'Course Materials Information';
        $this->template->content = View::factory('users/materials/index');
    }
}