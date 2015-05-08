<?php defined('SYSPATH') OR die('No direct access allowed.');
include_once("BaseController.php");
/**
 * Default Kohana controller. This controller should NOT be used in production.
 * It is for demonstration purposes only!
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Login_Controller extends BaseController_Controller
{
	public function __construct()
	{
		// load database library into $this->db (can be omitted if not required)
		parent::__construct();
		$this->template->html_body_id = 'home';
	}

	public function index()
	{
		$this->login();
	}

	public function login()
	{
		$this->template->title 		= $this->site_name.'User Login Form';
		$this->data['active_tab'] 	= 'login';
		url::redirect('admin/auth/login');
		//$this->_loadCommonTemplate();
	}
} // End Login Controller