<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class Admission_Info_Controller extends Administration_Controller
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
			array('admin/admission_info/show_all', __('Show All Admission Info')),
			array('admin/admission_info/create', __('Add New Admission Info')),
			array('admin/admission_info/active', __('Show Active Contents')),
			array('admin/admission_info/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('Student Admission Info'));
		$this->template->title = html::anchor('admin/admission_info', __('Student Admission Info')).' | ';
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
				$admission = ORM::factory('admission_info', (int) $value);
		
				if(!$admission->loaded){
					message::error(__('Invalid Content ID'), 'admin/admission_info/show_all');
				}	
				
				// If Inactivate button pressed
				if(isset($_POST['inactive']))
				{
					// Inactivate Content
					$admission->status = 'inactive';
					$admission->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/admission_info/show_all');
				}
				// If Activate button pressed
				elseif(isset($_POST['active']))
				{
					// Activate Content
					$admission->status = 'active';
					$admission->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/admission_info/show_all');
				}
				// If Delete button pressed
				elseif(isset($_POST['delete']))
				{
					// Activate Content
					$admission->delete();
					//message::info(__('Contents deleted successfully! !!'), 'admin/admission_info/show_all');
				}
			}				
		}
	}
	
	public function show_all()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('admission_info')->count_all();
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
		$this->template->content = View::factory('admission_info/index', array('admissions' => ORM::factory('admission_info')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Show All'));
		$this->template->title .= __('Show All');
	}
	
	public function active()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('admission_info')->where('status', 'active')->count_all();
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
		$this->template->content = View::factory('admission_info/index', array('admissions' => ORM::factory('admission_info')->where('status', 'active')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Active Contents'));
		$this->template->title .= __('Active Contents');
	}
	
	public function inactive()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('admission_info')->where('status', 'inactive')->count_all();
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
		$this->template->content = View::factory('admission_info/index', array('admissions' => ORM::factory('admission_info')->where('status', 'inactive')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Inactive Contents'));
		$this->template->title .= __('Inactive Contents');
	}

	public function create()
	{
		$this->head->title->append(__('Add New Content'));
		$this->template->title .= __('Add New Content');
		$statusOptions 	 = common::statusOptions();
		$batchNoList 	 = common::objectToArray(ORM::factory('batch_no')->select_list('batch_no', 'batch_no'));
		$batchDayList 	 = common::objectToArray(ORM::factory('batch_day')->select_list('batch_day', 'batch_day'));
		$courseNameList	 = common::objectToArray(ORM::factory('course')->select_list('course_name', 'course_name'));
		
		$form = Formo::factory()
			->plugin('csrf')
			->add('text', 'stud_id', array('label' => __('Student ID')))
			->add('text', 'stud_name', array('label' => __('Student Name')))
			->add_select('course_name', $courseNameList, array('label' => __('Select Course Name')))
			->add('text', 'money_receipt_no', array('label' => __('Money Receipt Number')))
			->add('text', 'admission_date', array('label' => __('Admission Date')))
			->add_select('batch_no', $batchNoList, array('label' => __('Select Batch No')))
			->add_select('batch_day', $batchDayList, array('label' => __('Select Batch Day')))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status')))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)')))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)')))
			->add('submit', 'submit', array('label' => __('Save')))

			// TODO check if username or batch_no exists
			->add_rule('stud_id', 'required', __('You must enter student ID! !!'))
			->add_rule('stud_name', 'required', __('You must enter Student name! !!'))
			->add_rule('course_name', 'required', __('You must enter course name! !!'))
			->add_rule('money_receipt_no', 'required', __('You must enter money receipt number! !!'))
			->add_rule('admission_date', 'required', __('You must enter admission date! !!'))
			->add_rule('batch_no', 'required', __('You must select a batch_no! !!'))
			->add_rule('batch_day', 'required', __('You must select batch day! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'));

		if($form->validate())
		{
			$admission = ORM::factory('admission_info');
			$admission->stud_id 		  = $form->stud_id->value;
			$admission->stud_name 	      = $form->stud_name->value;
			$admission->course_name	 	  = $form->course_name->value;
			$admission->money_receipt_no  = $form->money_receipt_no->value;
			$admission->admission_date 	  = $form->admission_date->value;
			$admission->batch_no 		  = $form->batch_no->value;
			$admission->batch_day 		  = $form->batch_day->value;
			$admission->status 			  = $form->status->value;
			$admission->meta_keywords 	  = $form->meta_keywords->value;
			$admission->meta_description  = $form->meta_description->value;
			$admission->created 		  = date("Y-m-d H:i:s", time());
			
			$admission->save();
			message::info(__('Content saved successfully! !!'), 'admin/admission_info/show_all');
		}

		$this->template->content = View::factory('admission_info/create', $form->get(TRUE));
	}

	public function edit($id)
	{
		$this->head->title->append(__('Modify Content'));
		$this->template->title .= __('Modify Content');
		$statusOptions 	 = common::statusOptions();
		$batchNoList 	 = common::objectToArray(ORM::factory('batch_no')->select_list('batch_no', 'batch_no'));
		$batchDayList 	 = common::objectToArray(ORM::factory('batch_day')->select_list('batch_day', 'batch_day'));
		$courseNameList	 = common::objectToArray(ORM::factory('course')->select_list('course_name', 'course_name'));

		$admission = ORM::factory('admission_info', (int) $id);
		if(!$admission->loaded){
			Event::run('system.404');
		}
		
		$form = Formo::factory()
			->plugin('csrf')
			->add('text', 'stud_id', array('label' => __('Student ID'), 'value' => $admission->stud_id))
			->add('text', 'stud_name', array('label' => __('Student Name'), 'value' => $admission->stud_name))
			->add_select('course_name', $courseNameList, array('label' => __('Select Course Name'), 'value' => $admission->course_name))
			->add('text', 'money_receipt_no', array('label' => __('Money Receipt Number'), 'value' => $admission->money_receipt_no))
			->add('text', 'admission_date', array('label' => __('Admission Date'), 'value' => $admission->admission_date))
			->add_select('batch_no', $batchNoList, array('label' => __('Select Batch No'), 'value' => $admission->batch_no))
			->add_select('batch_day', $batchDayList, array('label' => __('Select Batch Day'), 'value' => $admission->batch_day))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status'), 'value' => $admission->status))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)'), 'value' => $admission->meta_keywords))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)'), 'value' => $admission->meta_description))
			->add('submit', 'submit', array('label' => __('Modify')))

			// TODO check if username or batch_no exists
			//->add_rule('stud_id', 'required', __('You must enter student ID! !!'))
			->add_rule('stud_name', 'required', __('You must enter Student name! !!'))
			->add_rule('course_name', 'required', __('You must enter course name! !!'))
			->add_rule('money_receipt_no', 'required', __('You must enter money receipt number! !!'))
			->add_rule('admission_date', 'required', __('You must enter admission date! !!'))
			->add_rule('batch_no', 'required', __('You must select a batch_no! !!'))
			->add_rule('batch_day', 'required', __('You must select batch day! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'));

		if($form->validate())
		{
			$admission = ORM::factory('admission_info', (int) $id);
			//$admission->stud_id 		  = $form->stud_id->value;
			$admission->stud_name 	      = $form->stud_name->value;
			$admission->course_name	 	  = $form->course_name->value;
			$admission->money_receipt_no  = $form->money_receipt_no->value;
			$admission->admission_date 	  = $form->admission_date->value;
			$admission->batch_no 		  = $form->batch_no->value;
			$admission->batch_day 		  = $form->batch_day->value;
			$admission->status 			  = $form->status->value;
			$admission->meta_keywords 	  = $form->meta_keywords->value;
			$admission->meta_description  = $form->meta_description->value;
			
			$admission->save();
			message::info(__('Content modified successfully! !!'), 'admin/admission_info/show_all');
		}

		$this->template->content = View::factory('admission_info/edit', $form->get(TRUE));
	}

	public function delete($id)
	{
		$admission = ORM::factory('admission_info', (int) $id);

		if(!$admission->loaded){
			message::error(__('Invalid Content ID'), 'admin/admission_info/show_all');
		}	

		$admission->delete();
		message::info(__('Content deleted successfully! !!'), 'admin/admission_info/show_all');
	}
}