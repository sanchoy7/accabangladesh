<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class Semister_Controller extends Administration_Controller
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
			array('admin/semister/show_all', __('Show All Semister Info')),
			array('admin/semister/create', __('Add New Semister Info')),
			array('admin/semister/active', __('Show Active Contents')),
			array('admin/semister/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('Student Semister Info'));
		$this->template->title = html::anchor('admin/semister', __('Student Semister Info')).' | ';
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
				$semister = ORM::factory('semister', (int) $value);
		
				if(!$semister->loaded){
					message::error(__('Invalid Content ID'), 'admin/semister/show_all');
				}	
				
				// If Inactivate button pressed
				if(isset($_POST['inactive']))
				{
					// Inactivate Content
					$semister->status = 'inactive';
					$semister->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/semister/show_all');
				}
				// If Activate button pressed
				elseif(isset($_POST['active']))
				{
					// Activate Content
					$semister->status = 'active';
					$semister->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/semister/show_all');
				}
				// If Delete button pressed
				elseif(isset($_POST['delete']))
				{
					// Activate Content
					$semister->delete();
					//message::info(__('Contents deleted successfully! !!'), 'admin/semister/show_all');
				}
			}				
		}
	}
	
	public function show_all()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('semister')->count_all();
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
		$this->template->content = View::factory('semister/index', array('semisters' => ORM::factory('semister')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Show All'));
		$this->template->title .= __('Show All');
	}
	
	public function active()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('semister')->where('status', 'active')->count_all();
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
		$this->template->content = View::factory('semister/index', array('semisters' => ORM::factory('semister')->where('status', 'active')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Active Contents'));
		$this->template->title .= __('Active Contents');
	}
	
	public function inactive()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('semister')->where('status', 'inactive')->count_all();
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
		$this->template->content = View::factory('semister/index', array('semisters' => ORM::factory('semister')->where('status', 'inactive')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Inactive Contents'));
		$this->template->title .= __('Inactive Contents');
	}

	public function create()
	{
		$this->head->title->append(__('Add New Content'));
		$this->template->title .= __('Add New Content');
		$statusOptions 	 = common::statusOptions();
		$studNameList 	 = common::objectToArrayWithKey(ORM::factory('admission_info')->select_list('stud_id', 'stud_name'));
		$courseNameList  = common::objectToArray(ORM::factory('course')->select_list('course_name', 'course_name'));
		$semisterNoList	 = common::objectToArray(ORM::factory('semister_no')->select_list('semister_no', 'semister_no'));
		
		$form = Formo::factory()
			->plugin('csrf')
			->add_select('stud_id', $studNameList, array('label' => __('Select Student Name')))
			->add_select('course_name', $courseNameList, array('label' => __('Select Course Name')))
			->add_select('semister_no', $semisterNoList, array('label' => __('Select Semister No')))
			->add('text', 'semister_course_details', array('label' => __('Semister Course Details')))
			->add('text', 'admission_fees', array('label' => __('Admission Fees')))
			->add('text', 'fees_per_module', array('label' => __('Tuition Fees Per Module')))
			->add('text', 'modules_in_semister', array('label' => __('Number Of Module In Semister')))
			->add('text', 'vat', array('label' => __('Value Added Tax (VAT)')))
			->add('text', 'discount', array('label' => __('Offered Discount (If Any)')))
			->add('text', 'semister_total_fees', array('label' => __('Semister Total Fees')))
			->add('text', 'amount_payable', array('label' => __('Amount Payable')))
			->add('text', 'amount_paid', array('label' => __('Amount Paid')))
			->add('text', 'amount_due', array('label' => __('Amount Due')))
			->add('text', 'payment_date', array('label' => __('Payment Date')))
			->add('text', 'money_receipt_no', array('label' => __('Money Receipt Number')))
			->add('text', 'amount_received_by', array('label' => __('Amount Received By')))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status')))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)')))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)')))
			->add('submit', 'submit', array('label' => __('Save')))

			// TODO check if username or admission_fees exists
			->add_rule('stud_id', 'required', __('You must select student name! !!'))
			->add_rule('course_name', 'required', __('You must select course name! !!'))
			->add_rule('semister_no', 'required', __('You must select semister no! !!'))
			->add_rule('semister_course_details', 'required', __('You must enter semister course details! !!'))
			->add_rule('admission_fees', 'required', __('You must enter admission fees! !!'))
			->add_rule('fees_per_module', 'required', __('You must enter fees per module! !!'))
			->add_rule('modules_in_semister', 'required', __('Enter number of modules in semister! !!'))
			->add_rule('vat', 'required', __('You must enter VAT (%)! !!'))
			->add_rule('discount', 'required', __('You must enter discount (if any)! !!'))
			->add_rule('semister_total_fees', 'required', __('You must enter semister total fees! !!'))
			->add_rule('amount_payable', 'required', __('You must enter payable amount! !!'))
			->add_rule('amount_paid', 'required', __('You must enter paid amount! !!'))
			->add_rule('amount_due', 'required', __('You must enter due amount! !!'))
			->add_rule('payment_date', 'required', __('You must enter payment date! !!'))
			->add_rule('money_receipt_no', 'required', __('You must enter money receipt number! !!'))
			->add_rule('amount_received_by', 'required', __('You must enter amount receiver name! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'));

		if($form->validate())
		{
			$semister = ORM::factory('semister');
			$semister->stud_id 		  			= $form->stud_id->value;
			$semister->course_name 	      		= $form->course_name->value;
			$semister->semister_no	 	  		= $form->semister_no->value;
			$semister->semister_course_details 	= $form->semister_course_details->value;
			$semister->admission_fees 			= $form->admission_fees->value;
			$semister->fees_per_module 			= $form->fees_per_module->value;
			$semister->modules_in_semister 		= $form->modules_in_semister->value;
			$semister->vat 	  					= $form->vat->value;
			$semister->discount  				= $form->discount->value;
			$semister->semister_total_fees 		= $form->semister_total_fees->value;
			$semister->amount_payable 	    	= $form->amount_payable->value;
			$semister->amount_paid	 	  		= $form->amount_paid->value;
			$semister->amount_due  				= $form->amount_due->value;
			$semister->payment_date 	  		= $form->payment_date->value;
			$semister->money_receipt_no  		= $form->money_receipt_no->value;
			$semister->amount_received_by 		= $form->amount_received_by->value;
			$semister->status 			  		= $form->status->value;
			$semister->meta_keywords 	  		= $form->meta_keywords->value;
			$semister->meta_description  		= $form->meta_description->value;
			$semister->created 		  = date("Y-m-d H:i:s", time());

			$semister->save();
			message::info(__('Content saved successfully! !!'), 'admin/semister/show_all');
		}

		$this->template->content = View::factory('semister/create', $form->get(TRUE));
	}

	public function edit($id)
	{
		$this->head->title->append(__('Modify Content'));
		$this->template->title .= __('Modify Content');
		$statusOptions 	 = common::statusOptions();
		$studNameList 	 = common::objectToArrayWithKey(ORM::factory('admission_info')->select_list('stud_id', 'stud_name'));
		$courseNameList  = common::objectToArray(ORM::factory('course')->select_list('course_name', 'course_name'));
		$semisterNoList	 = common::objectToArray(ORM::factory('semister_no')->select_list('semister_no', 'semister_no'));

		$semister = ORM::factory('semister', (int) $id);
		if(!$semister->loaded){
			Event::run('system.404');
		}
		
		$form = Formo::factory()
			->plugin('csrf')
			->add_select('stud_id', $studNameList, array('label' => __('Select Student Name'), 'value' => $semister->stud_id))
			->add_select('course_name', $courseNameList, array('label' => __('Select Course Name'), 'value' => $semister->course_name))
			->add_select('semister_no', $semisterNoList, array('label' => __('Select Semister No'), 'value' => $semister->semister_no))
			->add('text', 'semister_course_details', array('label' => __('Semister Course Details'), 'value' => $semister->semister_course_details))
			->add('text', 'admission_fees', array('label' => __('Admission Fees'), 'value' => $semister->admission_fees))
			->add('text', 'fees_per_module', array('label' => __('Tuition Fees Per Module'), 'value' => $semister->fees_per_module))
			->add('text', 'modules_in_semister', array('label' => __('Number Of Module In Semister'), 'value' => $semister->modules_in_semister))
			->add('text', 'vat', array('label' => __('Value Added Tax (VAT)'), 'value' => $semister->vat))
			->add('text', 'discount', array('label' => __('Offered Discount (If Any)'), 'value' => $semister->discount))
			->add('text', 'semister_total_fees', array('label' => __('Semister Total Fees'), 'value' => $semister->semister_total_fees))
			->add('text', 'amount_payable', array('label' => __('Amount Payable'), 'value' => $semister->amount_payable))
			->add('text', 'amount_paid', array('label' => __('Amount Paid'), 'value' => $semister->amount_paid))
			->add('text', 'amount_due', array('label' => __('Amount Due'), 'value' => $semister->amount_due))
			->add('text', 'payment_date', array('label' => __('Payment Date'), 'value' => $semister->payment_date))
			->add('text', 'money_receipt_no', array('label' => __('Money Receipt Number'), 'value' => $semister->money_receipt_no))
			->add('text', 'amount_received_by', array('label' => __('Amount Received By'), 'value' => $semister->amount_received_by))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status'), 'value' => $semister->status))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)'), 'value' => $semister->meta_keywords))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)'), 'value' => $semister->meta_description))
			->add('submit', 'submit', array('label' => __('Modify')))

			// TODO check if username or amount_received_by exists
			->add_rule('stud_id', 'required', __('You must select student name! !!'))
			->add_rule('course_name', 'required', __('You must select course name! !!'))
			->add_rule('semister_no', 'required', __('You must select semister no! !!'))
			->add_rule('semister_course_details', 'required', __('You must enter semister course details! !!'))
			->add_rule('admission_fees', 'required', __('You must enter admission fees! !!'))
			->add_rule('fees_per_module', 'required', __('You must enter fees per module! !!'))
			->add_rule('modules_in_semister', 'required', __('Enter number of modules in semister! !!'))
			->add_rule('vat', 'required', __('You must enter VAT (%)! !!'))
			->add_rule('discount', 'required', __('You must enter discount (if any)! !!'))
			->add_rule('semister_total_fees', 'required', __('You must enter semister total fees! !!'))
			->add_rule('amount_payable', 'required', __('You must enter payable amount! !!'))
			->add_rule('amount_paid', 'required', __('You must enter paid amount! !!'))
			->add_rule('amount_due', 'required', __('You must enter due amount! !!'))
			->add_rule('payment_date', 'required', __('You must enter payment date! !!'))
			->add_rule('money_receipt_no', 'required', __('You must enter money receipt number! !!'))
			->add_rule('amount_received_by', 'required', __('You must enter amount receiver name! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'));

		if($form->validate())
		{
			$semister = ORM::factory('semister', (int) $id);
			$semister->stud_id 		  			= $form->stud_id->value;
			$semister->course_name 	      		= $form->course_name->value;
			$semister->semister_no	 	  		= $form->semister_no->value;
			$semister->semister_course_details 	= $form->semister_course_details->value;
			$semister->admission_fees 			= $form->admission_fees->value;
			$semister->fees_per_module 			= $form->fees_per_module->value;
			$semister->modules_in_semister 		= $form->modules_in_semister->value;
			$semister->vat 	  					= $form->vat->value;
			$semister->discount  				= $form->discount->value;
			$semister->semister_total_fees 		= $form->semister_total_fees->value;
			$semister->amount_payable 	    	= $form->amount_payable->value;
			$semister->amount_paid	 	  		= $form->amount_paid->value;
			$semister->amount_due  				= $form->amount_due->value;
			$semister->payment_date 	  		= $form->payment_date->value;
			$semister->money_receipt_no  		= $form->money_receipt_no->value;
			$semister->amount_received_by 		= $form->amount_received_by->value;
			$semister->status 			  		= $form->status->value;
			$semister->meta_keywords 	  		= $form->meta_keywords->value;
			$semister->meta_description  		= $form->meta_description->value;

			$semister->save();
			message::info(__('Content modified successfully! !!'), 'admin/semister/show_all');
		}

		$this->template->content = View::factory('semister/edit', $form->get(TRUE));
	}

	public function activate($id = '', $what = TRUE)
	{
		$semister = ORM::factory('semister', (int) $id);

		if(!$semister->loaded){
			message::error(__('Invalid Content ID'), 'admin/semister/show_all');
		}	
		$semister->status = ($what) ? 'active' : 'inactive';
		$semister->save();
		message::info(__('Content '.(($what) ? 'activated' : 'inactivated').' successfully! !!'), 'admin/semister/show_all');
	}

	public function inactivate($id)
	{
		$this->activate($id, $what = FALSE);
	}
	
	public function delete($id)
	{
		$semister = ORM::factory('semister', (int) $id);

		if(!$semister->loaded){
			message::error(__('Invalid Content ID'), 'admin/semister/show_all');
		}	

		$semister->delete();
		message::info(__('Content deleted successfully! !!'), 'admin/semister/show_all');
	}
}