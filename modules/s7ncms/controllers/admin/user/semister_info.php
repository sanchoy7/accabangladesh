<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class Semister_Info_Controller extends Administration_Controller
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
			array('admin/user/semister_info', __('Show All Contents')),
			//array('admin/user/create', __('Add About Us Content')),
			//array('admin/user/active', __('Show Active Contents')),
			//array('admin/user/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('Semister Information'));
		$this->template->title = html::anchor('admin/user/semister_info', __('Semister Info')).' | ';
	}

	public function index()
	{
        $this->head->title->append('Semister Information');
		$this->template->title = 'Semister Information';
        $this->template->content = View::factory('users/semister_info/index');
    }
}