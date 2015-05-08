<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class Personal_Info_Controller extends Administration_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if(Auth::factory()->logged_in())
		{
			if(!Auth::factory()->logged_in('admin')){
				url::redirect('admin/dashboard/');
			}
		}
		
		$this->template->tasks = array(
			array('admin/personal_info/show_all', __('Show All Personal Info')),
			array('admin/personal_info/create', __('Add New Personal Info')),
			array('admin/personal_info/active', __('Show Active Contents')),
			array('admin/personal_info/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('Student Personal Info'));
		$this->template->title = html::anchor('admin/personal_info', __('Student Personal Info')).' | ';
	}

	public function index()
	{
		$this->show_all();
	}

	public function active_inactive()
	{
		// Search checkbox in post array
		foreach($_POST as $key => $value)
		{
			// If checkbox found
			if(substr($key, 0, 9) == 'checkbox_')
			{
				// Inactivate Content based on checkbox value (id)
				$personal = ORM::factory('personal_info', (int) $value);
		
				if(!$personal->loaded){
					message::error(__('Invalid Content ID'), 'admin/personal_info/show_all');
				}	
				
				// If Inactivate button pressed
				if(isset($_POST['inactive']))
				{
					// Inactivate Content
					$personal->status = 'inactive';
					$personal->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/personal_info/show_all');
				}
				// If Activate button pressed
				elseif(isset($_POST['active']))
				{
					// Activate Content
					$personal->status = 'active';
					$personal->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/personal_info/show_all');
				}
				// If Delete button pressed
				elseif(isset($_POST['delete']))
				{
					// Activate Content
					$personal->delete();
					//message::info(__('Contents deleted successfully! !!'), 'admin/personal_info/show_all');
				}
			}				
		}
	}
	
	public function show_all()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('personal_info')->count_all();
		//Pagination configuration
		$num_per_page = Kohana::config('core.show_per_page');
		//Setup pagination
		$pagination = new Pagination(array(
			'uri_segment'    => 4,
			'total_items'    => $totalItems,
			'style'          => "digg",
			'items_per_page' => $num_per_page,
			'auto_hide'      => TRUE
		));
		
		$offset = $pagination->sql_offset;
		$this->template->content = View::factory('personal_info/index', array('personals' => ORM::factory('personal_info')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		//print_r($pagination->render());
		$this->head->title->append(__('Show All'));
		$this->template->title .= __('Show All');
	}
	
	public function active()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('personal_info')->where('status', 'active')->count_all();
		//Pagination configuration
		$num_per_page = Kohana::config('core.show_per_page');
		//Setup pagination
		$pagination = new Pagination(array(
			'uri_segment'    => 4,
			'total_items'    => $totalItems,
			'style'          => "digg",
			'items_per_page' => $num_per_page,
			'auto_hide'      => TRUE
		));
		
		$offset = $pagination->sql_offset;
		$this->template->content = View::factory('personal_info/index', array('personals' => ORM::factory('personal_info')->where('status', 'active')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Active Contents'));
		$this->template->title .= __('Active Contents');
	}
	
	public function inactive()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('personal_info')->where('status', 'inactive')->count_all();
		//Pagination configuration
		$num_per_page = Kohana::config('core.show_per_page');
		//Setup pagination
		$pagination = new Pagination(array(
			'uri_segment'    => 4,
			'total_items'    => $totalItems,
			'style'          => "digg",
			'items_per_page' => $num_per_page,
			'auto_hide'      => TRUE
		));
		
		$offset = $pagination->sql_offset;
		$this->template->content = View::factory('personal_info/index', array('personals' => ORM::factory('personal_info')->where('status', 'inactive')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Inactive Contents'));
		$this->template->title .= __('Inactive Contents');
	}
	
	public function create()
	{
		$this->head->title->append(__('Add New Content'));
		$this->template->title .= __('Add New Content');
		$statusOptions 	 = common::statusOptions();
		$studentList 	 = common::objectToArrayWithKey(ORM::factory('admission_info')->select_list('stud_id', 'stud_name'));
		
		$form = Formo::factory()
			->plugin('csrf')
			->add_select('stud_id', $studentList, array('label' => __('Select Student Name')))
			->add('text', 'father_name', array('label' => __('Father Name')))
			->add('text', 'mother_name', array('label' => __('Mother Name')))
			->add('text', 'mailing_address', array('label' => __('Mailing Address')))
			->add('text', 'permanent_address', array('label' => __('Permanent Address')))
			->add('text', 'email', array('label' => __('Email Address')))
			->add('text', 'phone', array('label' => __('Phone Number')))
			->add('text', 'cell_no', array('label' => __('Cellphone Number')))
			->add('text', 'picture', array('label' => __('Upload Student\'s Photo')))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status')))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)')))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)')))
			->add('submit', 'submit', array('label' => __('Save')))

			// TODO check if username or email exists
			->add_rule('stud_id', 'required', __('You must select a student name! !!'))
			->add_rule('father_name', 'required', __('You must enter father name! !!'))
			->add_rule('mother_name', 'required', __('You must enter mother name! !!'))
			->add_rule('mailing_address', 'required', __('You must enter mailing address! !!'))
			->add_rule('permanent_address', 'required', __('You must enter permanent address! !!'))
			->add_rule('email', 'required', __('You must enter email address! !!'))
			->add_rule('phone', 'required', __('You must enter phone number! !!'))
			->add_rule('cell_no', 'required', __('You must enter cell number! !!'))
			//->add_rule('picture', 'required', __('You must upload student photo! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'));

		if($form->validate())
		{
			$personal = ORM::factory('personal_info');
			$personal->stud_id 			 = $form->stud_id->value;
			$personal->father_name 		 = $form->father_name->value;
			$personal->mother_name	 	 = $form->mother_name->value;
			$personal->mailing_address 	 = $form->mailing_address->value;
			$personal->permanent_address = $form->permanent_address->value;
			$personal->email 			 = $form->email->value;
			$personal->phone 			 = $form->phone->value;
			$personal->cell_no 			 = $form->cell_no->value;
			$personal->status 			 = $form->status->value;
			$personal->meta_keywords 	 = $form->meta_keywords->value;
			$personal->meta_description  = $form->meta_description->value;
			$personal->created 			 = date("Y-m-d H:i:s", time());
			
			if(!empty($_FILES['picture']['name'])){
				$photo = array ('file' => 'picture', 'types' => 'gif,jpg,png,jpeg,jpeg', 'size' => '200K', 'path' => 'public/photos/students/', 'validate' => TRUE, 'required' => FALSE);
				$personal->picture 			 = common::upload_file($photo);
				$personal->size 			 = $_FILES['picture']['size'];
				$personal->type 			 = $_FILES['picture']['type'];
			}
			
			$personal->save();
			message::info(__('Content saved successfully! !!'), 'admin/personal_info/show_all');
		}

		$this->template->content = View::factory('personal_info/create', $form->get(TRUE));
	}

	public function edit($id)
	{
		$this->head->title->append(__('Modify Content'));
		$this->template->title .= __('Modify Content');
		$statusOptions 	 = common::statusOptions();
		$paymentStatus 	 = common::paymentStatus();
		$studentList 	 = common::objectToArrayWithKey(ORM::factory('admission_info')->select_list('stud_id', 'stud_name'));

		$personal = ORM::factory('personal_info', (int) $id);
		if(!$personal->loaded){
			Event::run('system.404');
		}
		
		$form = Formo::factory()
			->plugin('csrf')
			->add_select('stud_id', $studentList, array('label' => __('Select Student Name'), 'value' => $personal->stud_id))
			->add('text', 'father_name', array('label' => __('Father Name'), 'value' => $personal->father_name))
			->add('text', 'mother_name', array('label' => __('Mother Name'), 'value' => $personal->mother_name))
			->add('text', 'mailing_address', array('label' => __('Mailing Address'), 'value' => $personal->mailing_address))
			->add('text', 'permanent_address', array('label' => __('Permanent Address'), 'value' => $personal->permanent_address))
			->add('text', 'email', array('label' => __('Email Address'), 'value' => $personal->email))
			->add('text', 'phone', array('label' => __('Phone Number'), 'value' => $personal->phone))
			->add('text', 'cell_no', array('label' => __('Cellphone Number'), 'value' => $personal->cell_no))
			->add('text', 'picture', array('label' => __('Upload Student\'s Photo'), 'value' => $personal->picture))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status'), 'value' => $personal->status))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)'), 'value' => $personal->meta_keywords))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)'), 'value' => $personal->meta_description))
			->add('submit', 'submit', array('label' => __('Modify')))

			// TODO check if username or email exists
			->add_rule('stud_id', 'required', __('You must select a student name! !!'))
			->add_rule('father_name', 'required', __('You must enter father name! !!'))
			->add_rule('mother_name', 'required', __('You must enter mother name! !!'))
			->add_rule('mailing_address', 'required', __('You must enter mailing address! !!'))
			->add_rule('permanent_address', 'required', __('You must enter permanent address! !!'))
			->add_rule('email', 'required', __('You must enter email address! !!'))
			->add_rule('phone', 'required', __('You must enter phone number! !!'))
			->add_rule('cell_no', 'required', __('You must enter cell number! !!'))
			//->add_rule('picture', 'required', __('You must upload student photo! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'));

		if($form->validate())
		{
			$personal = ORM::factory('personal_info', (int) $id);
			$personal->stud_id 			 = $form->stud_id->value;
			$personal->father_name 		 = $form->father_name->value;
			$personal->mother_name	 	 = $form->mother_name->value;
			$personal->mailing_address 	 = $form->mailing_address->value;
			$personal->permanent_address = $form->permanent_address->value;
			$personal->email 			 = $form->email->value;
			$personal->phone 			 = $form->phone->value;
			$personal->cell_no 			 = $form->cell_no->value;
			$personal->status 			 = $form->status->value;
			$personal->meta_keywords 	 = $form->meta_keywords->value;
			$personal->meta_description  = $form->meta_description->value;
			
			if(!empty($_FILES['picture']['name'])){
				$photo = array ('file' => 'picture', 'types' => 'gif,jpg,png,jpeg,jpeg', 'size' => '200K', 'path' => 'public/photos/students/', 'validate' => TRUE, 'required' => FALSE);
				$personal->picture 			 = common::upload_file($photo);
				$personal->size 			 = $_FILES['picture']['size'];
				$personal->type 			 = $_FILES['picture']['type'];
			}
			
			$personal->save();
			message::info(__('Content modified successfully! !!'), 'admin/personal_info/show_all');
		}

		$this->template->content = View::factory('personal_info/edit', $form->get(TRUE));
	}

	public function delete($id)
	{
		$personal = ORM::factory('personal_info', (int) $id);

		if(!$personal->loaded){
			message::error(__('Invalid Content ID'), 'admin/personal_info/show_all');
		}	

		$personal->delete();
		message::info(__('Content deleted successfully! !!'), 'admin/personal_info/show_all');
	}
}