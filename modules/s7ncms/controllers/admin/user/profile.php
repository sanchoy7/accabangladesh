<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class Profile_Controller extends Administration_Controller
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
			array('admin/user/profile', __('Show All Contents')),
			//array('admin/user/create', __('Add About Us Content')),
			//array('admin/user/active', __('Show Active Contents')),
			//array('admin/user/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('User Profile'));
		$this->template->title = html::anchor('admin/user/profile', __('Profile')).' | ';
	}

	public function index()
	{
        $this->head->title->append('User Profile Information');
		$this->template->title = 'User Profile Information';
        $this->template->content = View::factory('users/profile/index');
    }
}