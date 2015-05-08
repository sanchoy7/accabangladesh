<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class Course_Material_Controller extends Administration_Controller
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
			array('admin/course_material/show_all', __('Show All Course Materials')),
			array('admin/course_material/create', __('Add Course Materials')),
			array('admin/course_material/active', __('Show Active Contents')),
			array('admin/course_material/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('Course Materials'));
		$this->template->title = html::anchor('admin/account', __('Course Materials')).' | ';
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
				$course_material = ORM::factory('course_material', (int) $value);
		
				if(!$course_material->loaded){
					message::error(__('Invalid Content ID'), 'admin/course_material/show_all');
				}	
				
				// If Inactivate button pressed
				if(isset($_POST['inactive']))
				{
					// Inactivate Content
					$course_material->status = 'inactive';
					$course_material->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/course_material/show_all');
				}
				// If Activate button pressed
				elseif(isset($_POST['active']))
				{
					// Activate Content
					$course_material->status = 'active';
					$course_material->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/course_material/show_all');
				}
				// If Delete button pressed
				elseif(isset($_POST['delete']))
				{
					// Activate Content
					$course_material->delete();
					//message::info(__('Contents deleted successfully! !!'), 'admin/course_material/show_all');
				}
			}				
		}
	}
	
	public function show_all()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('course_material')->count_all();
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
		$this->template->content = View::factory('course_material/index', array('course_materials' => ORM::factory('course_material')->orderby('id', 'desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Show All'));
		$this->template->title .= __('Show All');
	}
	
	public function active()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('course_material')->where('status', 'active')->count_all();
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
		$this->template->content = View::factory('course_material/index', array('course_materials' => ORM::factory('course_material')->where('status', 'active')->orderby('id', 'desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Active Contents'));
		$this->template->title .= __('Active Contents');
	}
	
	public function inactive()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('course_material')->where('status', 'inactive')->count_all();
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
		$this->template->content = View::factory('course_material/index', array('course_materials' => ORM::factory('course_material')->where('status', 'inactive')->orderby('id', 'desc')->find_all($num_per_page, $offset)));
		
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
		$semisterNo 	 = common::objectToArray(ORM::factory('semister_no')->select_list('semister_no', 'semister_no'));

		$form = Formo::factory()
			->plugin('csrf')
			->add_select('stud_id', $studentList, array('label' => __('Select Student Name')))
			->add_select('semister_no', $semisterNo, array('label' => __('Select Semister Number')))
			->add('text', 'provide_date', array('label' => __('Provide Date')))
			->add('text', 'provide_by', array('label' => __('Provide By')))
			->add('text', 'remarks', array('label' => __('Remarks')))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status')))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)')))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)')))
			->add('textarea', 'particulars', array('label' => __('Particular Details')))
			->add('submit', 'submit', array('label' => __('Save')))

			// TODO check if username or email exists
			->add_rule('stud_id', 'required', __('You must select a student name! !!'))
			->add_rule('semister_no', 'required', __('You must enter semister number! !!'))
			->add_rule('provide_date', 'required', __('You must enter particulars provide date! !!'))
			->add_rule('provide_by', 'required', __('You must enter provider name! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'))
			->add_rule('particulars', 'required', __('You must enter particular Details! !!'));

		if($form->validate())
		{
			$course_materials = ORM::factory('course_material');
			$course_materials->stud_id 			= $form->stud_id->value;
			$course_materials->semister_no 		= $form->semister_no->value;
			$course_materials->provide_date 	= $form->provide_date->value;
			$course_materials->provide_by   	= $form->provide_by->value;
			$course_materials->particulars 		= $form->particulars->value;
			$course_materials->status 			= $form->status->value;
			$course_materials->meta_keywords 	= $form->meta_keywords->value;
			$course_materials->meta_description = $form->meta_description->value;
			$course_materials->created 			= date("Y-m-d H:i:s", time());
			$course_materials->save();

			message::info(__('Content saved successfully! !!'), 'admin/course_material/show_all');
		}

		$this->template->content = View::factory('course_material/create', $form->get(TRUE));
	}

	public function edit($id)
	{
		$this->head->title->append(__('Modify Content'));
		$this->template->title .= __('Modify Content');
		$statusOptions 	 = common::statusOptions();
		$studentList 	 = common::objectToArrayWithKey(ORM::factory('admission_info')->select_list('stud_id', 'stud_name'));
		$semisterNo 	 = common::objectToArray(ORM::factory('semister_no')->select_list('semister_no', 'semister_no'));

		$course_materials = ORM::factory('course_material', (int) $id);
		if(!$course_materials->loaded){
			Event::run('system.404');
		}
		
		$form = Formo::factory()
			->plugin('csrf')
			->add_select('stud_id', $studentList, array('label' => __('Select Student Name'), 'value' => $course_materials->stud_id))
			->add_select('semister_no', $semisterNo, array('label' => __('Select Semister Number'), 'value' => $course_materials->semister_no))
			->add('text', 'provide_date', array('label' => __('Provide Date'), 'value' => $course_materials->provide_date))
			->add('text', 'provide_by', array('label' => __('Provide By'), 'value' => $course_materials->provide_by))
			->add('text', 'remarks', array('label' => __('Remarks'), 'value' => $course_materials->remarks))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status'), 'value' => $course_materials->status))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)'), 'value' => $course_materials->meta_keywords))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)'), 'value' => $course_materials->meta_description))
			->add('textarea', 'particulars', array('label' => __('Particular Details'), 'value' => $course_materials->particulars))
			->add('submit', 'submit', array('label' => __('Modify')))

			// TODO check if username or email exists
			->add_rule('stud_id', 'required', __('You must select a student name! !!'))
			->add_rule('semister_no', 'required', __('You must enter semister number! !!'))
			->add_rule('provide_date', 'required', __('You must enter particulars provide date! !!'))
			->add_rule('provide_by', 'required', __('You must enter provider name! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'))
			->add_rule('particulars', 'required', __('You must enter particular Details! !!'));

		if($form->validate())
		{
			$course_materials = ORM::factory('course_material', (int) $id);
			$course_materials->stud_id 			= $form->stud_id->value;
			$course_materials->semister_no 		= $form->semister_no->value;
			$course_materials->provide_date 	= $form->provide_date->value;
			$course_materials->provide_by   	= $form->provide_by->value;
			$course_materials->particulars 		= $form->particulars->value;
			$course_materials->status 			= $form->status->value;
			$course_materials->meta_keywords 	= $form->meta_keywords->value;
			$course_materials->meta_description = $form->meta_description->value;
			$course_materials->save();

			message::info(__('Content modified successfully! !!'), 'admin/course_material/show_all/');///edit/'.$id);
		}

		$this->template->content = View::factory('course_material/edit', $form->get(TRUE));
	}

	public function delete($id)
	{
		$course_materials = ORM::factory('course_material', (int) $id);

		if(!$course_materials->loaded){
			message::error(__('Invalid Content ID'), 'admin/course_material/show_all');
		}	

		$course_materials->delete();
		message::info(__('Content deleted successfully! !!'), 'admin/course_material/show_all');
	}
}