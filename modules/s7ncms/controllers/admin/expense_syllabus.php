<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class Expense_Syllabus_Controller extends Administration_Controller
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
			array('admin/expense_syllabus/show_all', __('Show All Contents')),
			array('admin/expense_syllabus/create', __('Add Expense or Syllabus')),
			array('admin/expense_syllabus/active', __('Show Active Contents')),
			array('admin/expense_syllabus/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('Course Expenses or Syllabus'));
		$this->template->title = html::anchor('admin/expense_syllabus', __('Course Expenses or Syllabus')).' | ';
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
				$expense_syllabus = ORM::factory('course_expense_syllabus', (int) $value);
		
				if(!$expense_syllabus->loaded){
					message::error(__('Invalid Content ID'), 'admin/expense_syllabus/show_all');
				}	
				
				// If Inactivate button pressed
				if(isset($_POST['inactive']))
				{
					// Inactivate Content
					$expense_syllabus->status = 'inactive';
					$expense_syllabus->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/expense_syllabus/show_all');
				}
				// If Activate button pressed
				elseif(isset($_POST['active']))
				{
					// Activate Content
					$expense_syllabus->status = 'active';
					$expense_syllabus->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/expense_syllabus/show_all');
				}
				// If Delete button pressed
				elseif(isset($_POST['delete']))
				{
					// Activate Content
					$expense_syllabus->delete();
					//message::info(__('Contents deleted successfully! !!'), 'admin/expense_syllabus/show_all');
				}
			}				
		}
	}
	
	public function show_all()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('course_expense_syllabus')->count_all();
		//Pagination configuration
		$num_per_page = Kohana::config('core.show_per_page');
		//Setup pagination
		$pagination = new Pagination(array(
			'uri_segment'    => 4,
			'total_items'    => $totalItems,
			'style'          => 'digg',
			'items_per_page' => $num_per_page,
			'auto_hide'      => TRUE
		));
		
		$offset = $pagination->sql_offset;
		//echo $offset;
		$this->template->content = View::factory('expense_syllabus/index', array('expense_syllabuses' => ORM::factory('course_expense_syllabus')->orderby('id', 'desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Show All'));
		$this->template->title .= __('Show All');
	}
	
	public function active()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('course_expense_syllabus')->where('status', 'active')->count_all();
		//Pagination configuration
		$num_per_page = Kohana::config('core.show_per_page');
		//Setup pagination
		$pagination = new Pagination(array(
			'uri_segment'    => 4,
			'total_items'    => $totalItems,
			'style'          => 'digg',
			'items_per_page' => $num_per_page,
			'auto_hide'      => TRUE
		));
		
		$offset = $pagination->sql_offset;
		//echo $offset;
		$this->template->content = View::factory('expense_syllabus/index', array('expense_syllabuses' => ORM::factory('course_expense_syllabus')->where('status', 'active')->orderby('id', 'desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Active Contents'));
		$this->template->title .= __('Active Contents');
	}
	
	public function inactive()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('course_expense_syllabus')->where('status', 'inactive')->count_all();
		//Pagination configuration
		$num_per_page = Kohana::config('core.show_per_page');
		//Setup pagination
		$pagination = new Pagination(array(
			'uri_segment'    => 4,
			'total_items'    => $totalItems,
			'style'          => 'digg',
			'items_per_page' => $num_per_page,
			'auto_hide'      => TRUE
		));
		
		$offset = $pagination->sql_offset;
		//echo $offset;
		$this->template->content = View::factory('expense_syllabus/index', array('expense_syllabuses' => ORM::factory('course_expense_syllabus')->where('status', 'inactive')->orderby('id', 'desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Inactive Contents'));
		$this->template->title .= __('Inactive Contents');
	}
	
	public function create()
	{
		$this->head->title->append(__('Add New Content'));
		$this->template->title .= __('Add New Content');
		$statusOptions 	    = common::statusOptions();
		$courseTypeOptions  = common::courseTypeOptions();
		$courseNameOptions  = common::objectToArray(ORM::factory('course')->select_list('course_name', 'course_name'));
		
		$form = Formo::factory()
			->plugin('csrf')
		    ->add_select('course_name', $courseNameOptions, array('label' => __('Course Name')))
			->add_select('course_type', $courseTypeOptions, array('label' => __('Select Content Type')))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status')))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)')))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)')))
			->add('textarea', 'details', array('label' => __('Content Details')))
			->add('submit', 'submit', array('label' => __('Save')))

			// TODO check if username or email exists
			->add_rule('course_name', 'required', __('You must select a type! !!'))
			->add_rule('course_type', 'required', __('You must select a type! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'))
			->add_rule('details', 'required', __('You must enter a details! !!'));

		if($form->validate())
		{
			$expense_syllabus = ORM::factory('course_expense_syllabus');
			$expense_syllabus->course_name 	  	= $form->course_name->value;
			$expense_syllabus->course_type 	  	= $form->course_type->value;
			$expense_syllabus->status      	  	= $form->status->value;
			$expense_syllabus->meta_keywords 	= $form->meta_keywords->value;
			$expense_syllabus->meta_description = $form->meta_description->value;
			$expense_syllabus->details   	 	= $form->details->value;
			$expense_syllabus->save();

			message::info(__('Content saved successfully! !!'), 'admin/expense_syllabus/show_all');
		}

		$this->template->content = View::factory('expense_syllabus/create', $form->get(TRUE));
	}

	public function edit($id)
	{
		$this->head->title->append(__('Modify Content'));
		$this->template->title .= __('Modify Content');
		$statusOptions 	   = common::statusOptions();
		$courseTypeOptions = common::courseTypeOptions();
		$courseNameOptions = common::objectToArray(ORM::factory('course')->select_list('course_name', 'course_name'));

		$expense_syllabus = ORM::factory('course_expense_syllabus', (int) $id);
		if(!$expense_syllabus->loaded){
			Event::run('system.404');
		}
		
		$form = Formo::factory()
			->plugin('csrf')
			->add_select('course_name', $courseNameOptions, array('label' => __('Course Name'), 'value' => $expense_syllabus->course_name))
			->add_select('course_type', $courseTypeOptions, array('label' => __('Content Type'), 'value' => $expense_syllabus->course_type))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status'), 'value' => $expense_syllabus->status))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)'), 'value' => $expense_syllabus->meta_keywords))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)'), 'value' => $expense_syllabus->meta_description))
			->add('textarea', 'details', array('label' => __('Content Details'), 'value' => $expense_syllabus->details))
			->add('submit', 'submit', array('label' => __('Modify')))

			// TODO check if username or email exists
			->add_rule('course_name', 'required', __('You must select a type! !!'))
			->add_rule('course_type', 'required', __('You must select a type! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'))
			->add_rule('details', 'required', __('You must enter a details! !!'));
			
		if($form->validate())
		{
			$expense_syllabus = ORM::factory('course_expense_syllabus', (int) $id);
			$expense_syllabus->course_name 	  	= $form->course_name->value;
			$expense_syllabus->course_type 	  	= $form->course_type->value;
			$expense_syllabus->status      	  	= $form->status->value;
			$expense_syllabus->meta_keywords 	= $form->meta_keywords->value;
			$expense_syllabus->meta_description = $form->meta_description->value;
			$expense_syllabus->details   	 	= $form->details->value;
			$expense_syllabus->save();
			
			message::info(__('Content modified successfully! !!'), 'admin/expense_syllabus/show_all');
		}

		$this->template->content = View::factory('expense_syllabus/edit', $form->get(TRUE));
	}

	public function delete($id)
	{
		$expense_syllabus = ORM::factory('course_expense_syllabus', (int) $id);

		if(!$expense_syllabus->loaded){
			message::error(__('Invalid Content ID'), 'admin/expense_syllabus/show_all');
		}	

		$expense_syllabus->delete();
		message::info(__('Content deleted successfully! !!'), 'admin/expense_syllabus/show_all');
	}
}