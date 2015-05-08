<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class Account_Controller extends Administration_Controller
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
			array('admin/account/show_all', __('Show All Account Information')),
			array('admin/account/create', __('Add New Account Information')),
			array('admin/account/active', __('Show Active Contents')),
			array('admin/account/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('Student Account Information'));
		$this->template->title = html::anchor('admin/account', __('Student Account Information')).' | ';
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
				$account = ORM::factory('account', (int) $value);
		
				if(!$account->loaded){
					message::error(__('Invalid Content ID'), 'admin/account/show_all');
				}	
				
				// If Inactivate button pressed
				if(isset($_POST['inactive']))
				{
					// Inactivate Content
					$account->status = 'inactive';
					$account->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/account/show_all');
				}
				// If Activate button pressed
				elseif(isset($_POST['active']))
				{
					// Activate Content
					$account->status = 'active';
					$account->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/account/show_all');
				}
				// If Delete button pressed
				elseif(isset($_POST['delete']))
				{
					// Activate Content
					$account->delete();
					//message::info(__('Contents deleted successfully! !!'), 'admin/account/show_all');
				}
			}				
		}
	}
	
	public function show_all()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('account')->count_all();
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
		$this->template->content = View::factory('account/index', array('accounts' => ORM::factory('account')->orderby('id', 'desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Show All'));
		$this->template->title .= __('Show All');
	}
	
	public function active()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('account')->where('status', 'active')->count_all();
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
		$this->template->content = View::factory('account/index', array('accounts' => ORM::factory('account')->where('status', 'active')->orderby('id', 'desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Active Contents'));
		$this->template->title .= __('Active Contents');
	}
	
	public function inactive()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('account')->where('status', 'inactive')->count_all();
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
		$this->template->content = View::factory('account/index', array('accounts' => ORM::factory('account')->where('status', 'inactive')->orderby('id', 'desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Inactive Contents'));
		$this->template->title .= __('Inactive Contents');
	}
	
	public function create()
	{
		$this->head->title->append(__('Add New Content'));
		$this->template->title .= __('Add New Content');
		$statusOptions 	 = common::statusOptions();
		$paymentStatus 	 = common::paymentStatus();
		$studentList 	 = common::objectToArrayWithKey(ORM::factory('admission_info')->select_list('stud_id', 'stud_name'));

		$form = Formo::factory()
			->plugin('csrf')
			->add_select('stud_id', $studentList, array('label' => __('Select Student Name')))
			->add('text', 'payment_date', array('label' => __('Payment Date')))
			->add('text', 'money_receipt_no', array('label' => __('Money Receipt Number')))
			->add('text', 'amount_payable', array('label' => __('Amount Payable')))
			->add('text', 'amount_paid', array('label' => __('Amount Paid')))
			->add('text', 'amount_due', array('label' => __('Amount Due')))
			->add_select('payment_status', $paymentStatus, array('label' => __('Select Payment Status')))
			->add('text', 'received_by', array('label' => __('Payment Received By')))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status')))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)')))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)')))
			->add('submit', 'submit', array('label' => __('Save')))

			// TODO check if username or email exists
			->add_rule('stud_id', 'required', __('You must select a student name! !!'))
			->add_rule('payment_date', 'required', __('You must enter payment date! !!'))
			->add_rule('money_receipt_no', 'required', __('You must enter money receipt number! !!'))
			->add_rule('amount_payable', 'required', __('You must enter amount payable! !!'))
			->add_rule('amount_paid', 'required', __('You must enter amount paid! !!'))
			->add_rule('amount_due', 'required', __('You must enter amount due! !!'))
			->add_rule('payment_status', 'required', __('You must select payment status! !!'))
			->add_rule('received_by', 'required', __('You must enter payment received by! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'));

		if($form->validate())
		{
			$account = ORM::factory('account');
			$account->stud_id 			= $form->stud_id->value;
			$account->payment_date 		= $form->payment_date->value;
			$account->money_receipt_no 	= $form->money_receipt_no->value;
			$account->amount_payable 	= $form->amount_payable->value;
			$account->amount_paid 		= $form->amount_paid->value;
			$account->amount_due 		= $form->amount_due->value;
			$account->payment_status 	= $form->payment_status->value;
			$account->received_by 		= $form->received_by->value;
			$account->status 			= $form->status->value;
			$account->meta_keywords 	= $form->meta_keywords->value;
			$account->meta_description 	= $form->meta_description->value;
			$account->created 			= date("Y-m-d H:i:s", time());
			$account->save();

			message::info(__('Content saved successfully! !!'), 'admin/account/show_all');
		}

		$this->template->content = View::factory('account/create', $form->get(TRUE));
	}

	public function edit($id)
	{
		$this->head->title->append(__('Modify Content'));
		$this->template->title .= __('Modify Content');
		$statusOptions 	 = common::statusOptions();
		$paymentStatus 	 = common::paymentStatus();
		$studentList 	 = common::objectToArrayWithKey(ORM::factory('admission_info')->select_list('stud_id', 'stud_name'));

		$account = ORM::factory('account', (int) $id);
		if(!$account->loaded){
			Event::run('system.404');
		}
		
		$form = Formo::factory()
			->plugin('csrf')
			->add_select('stud_id', $studentList, array('label' => __('Select Student Name'), 'value' => $account->stud_id))
			->add('text', 'payment_date', array('label' => __('Payment Date'), 'value' => $account->payment_date))
			->add('text', 'money_receipt_no', array('label' => __('Money Receipt Number'), 'value' => $account->money_receipt_no))
			->add('text', 'amount_payable', array('label' => __('Amount Payable'), 'value' => $account->amount_payable))
			->add('text', 'amount_paid', array('label' => __('Amount Paid'), 'value' => $account->amount_paid))
			->add('text', 'amount_due', array('label' => __('Amount Due'), 'value' => $account->amount_due))
			->add_select('payment_status', $paymentStatus, array('label' => __('Select Payment Status'), 'value' => $account->payment_status))
			->add('text', 'received_by', array('label' => __('Payment Received By'), 'value' => $account->received_by))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status'), 'value' => $account->status))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)'), 'value' => $account->meta_keywords))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)'), 'value' => $account->meta_description))
			->add('submit', 'submit', array('label' => __('Modify')))

			// TODO check if username or email exists
			->add_rule('stud_id', 'required', __('You must select a student name! !!'))
			->add_rule('payment_date', 'required', __('You must enter payment date! !!'))
			->add_rule('money_receipt_no', 'required', __('You must enter money receipt number! !!'))
			->add_rule('amount_payable', 'required', __('You must enter amount payable! !!'))
			->add_rule('amount_paid', 'required', __('You must enter amount paid! !!'))
			->add_rule('amount_due', 'required', __('You must enter amount due! !!'))
			->add_rule('payment_status', 'required', __('You must select payment status! !!'))
			->add_rule('received_by', 'required', __('You must enter payment received by! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'));

		if($form->validate())
		{
			$account = ORM::factory('account', (int) $id);
			$account->stud_id 			= $form->stud_id->value;
			$account->payment_date 		= $form->payment_date->value;
			$account->money_receipt_no 	= $form->money_receipt_no->value;
			$account->amount_payable 	= $form->amount_payable->value;
			$account->amount_paid 		= $form->amount_paid->value;
			$account->amount_due 		= $form->amount_due->value;
			$account->payment_status 	= $form->payment_status->value;
			$account->received_by 		= $form->received_by->value;
			$account->status 			= $form->status->value;
			$account->meta_keywords 	= $form->meta_keywords->value;
			$account->meta_description 	= $form->meta_description->value;
			$account->save();

			message::info(__('Content modified successfully! !!'), 'admin/account/show_all/');///edit/'.$id);
		}

		$this->template->content = View::factory('account/edit', $form->get(TRUE));
	}

	public function delete($id)
	{
		$account = ORM::factory('account', (int) $id);

		if(!$account->loaded){
			message::error(__('Invalid Content ID'), 'admin/account/show_all');
		}	

		$account->delete();
		message::info(__('Content deleted successfully! !!'), 'admin/account/show_all');
	}
}