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
class Signup_Controller extends BaseController_Controller
{
	public function __construct()
	{
		// load database library into $this->db (can be omitted if not required)
		parent::__construct();
		// Loading Model..
		$this->signup = new Signup_Model;
		$this->template->html_body_id = 'home';
	}

	public function index()
	{
		$this->signup();
	}
	
	// Callback functions begin.....
	public function username_check(Validation $array, $field)
	{
	   // check the database for existing username
	   //$user_exists = (bool) ORM::factory('signup')->where('username', $array[$field])->count_all();
	 
	   if($this->signup->check_user_existance($array[$field]))
	   {
		   // add error to validation object
		   $array->add_error($field, 'user_exists');
	   }
	}
	
	public function email_check(Validation $array, $field)
	{
	   // check the database for existing email
	   //$email_exists = (bool) ORM::factory('signup')->where('email', $array[$field])->count_all();
	 
	   if($this->signup->check_email_existance($array[$field]))
	   {
		   // add error to validation object
		   $array->add_error($field, 'email_exists');
	   }
	}
	// Callback functions End.....
	
	public function signup()
	{
	   // setup and initialize your form field names
		$this->data['captcha'] = new Captcha;
		
		// Be careful not to ban real people though! Set the threshold high enough.
		if($this->data['captcha']->invalid_count() > 49)
		{
			exit('Bye! Stupid bot.');
		}		
				  
		$this->data['form'] = array
		(
			'username'			=> '',
			'email'    			=> '',
			'password'  		=> '',
			//'password_confirm'  => '',
		);
	 
		//  copy the form as errors, so the errors will be stored with keys corresponding to the form field names
		$errors = $this->data['form'];
		
		// Check whether post variable is blank or not..
		if($_POST)
		{
			$post = new Validation($_POST);
			
			// Filtering posted values
			$post->pre_filter('trim');
			
			// Setting validation rules for posted values
			$post->add_rules('username', 'required', 'alpha', 'length[4,12]', 'input::xss_clean');
			$post->add_callbacks('username', array($this, 'username_check'));
			$post->add_rules('email', 'required', 'valid::email', 'input::xss_clean');
			if(Kohana::config('core.email_per_signup'))
			{
				$post->add_callbacks('email', array($this, 'email_check'));
			}
			$post->add_rules('password', 'required', 'length[6,12]', 'alpha_numeric', 'input::xss_clean');
			$post->add_rules('password_confirm', 'required', 'length[6,12]', 'alpha_numeric', 'matches[password]', 'input::xss_clean');
			$post->add_rules('captcha_response', 'required', 'captcha::valid', 'input::xss_clean');
				
			if($post->validate())
			{
				$formData = arr::overwrite($this->data['form'], $post->as_array());

				if($this->signup->create_user($formData))
				{
					if($this->signup->set_user_role($formData['username']))
					{
						$this->data['status_message'] = sprintf($this->data['common']->user_success_msg, 'You have been registered successfully');
					}
				}
				else
				{
					$this->data['status_message'] = sprintf($this->data['common']->user_fail_msg, 'Sorry, registration process failed');
				}
			}
			else
			{
				// repopulate the form fields
				$this->data['form'] 		  = arr::overwrite($this->data['form'], $post->as_array());
				$this->data['status_message'] = $this->data['common']->error_message;
				$this->data['errors']         = arr::to_object($post->errors('reg_form'));
			}
		}
		$this->template->title 		= $this->site_name.' ::: User Registration Form';
		$this->data['active_tab'] 	= 'signup';
		$this->view_content 		= 'auth/signup-form';
		
		$this->_loadCommonTemplate();
	}
} // End Signup Controller