<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class Faq_Controller extends Administration_Controller
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
			array('admin/faq/show_all', __('Show All Contents')),
			array('admin/faq/create', __('Add FAQ Content')),
			array('admin/faq/active', __('Show Active Contents')),
			array('admin/faq/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('FAQs'));
		$this->template->title = html::anchor('admin/faq', __('FAQs')).' | ';
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
				$faq = ORM::factory('faq', (int) $value);
		
				if(!$faq->loaded){
					message::error(__('Invalid Content ID'), 'admin/faq/show_all');
				}	
				
				// If Inactivate button pressed
				if(isset($_POST['inactive']))
				{
					// Inactivate Content
					$faq->status = 'inactive';
					$faq->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/faq/show_all');
				}
				// If Activate button pressed
				elseif(isset($_POST['active']))
				{
					// Activate Content
					$faq->status = 'active';
					$faq->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/faq/show_all');
				}
				// If Delete button pressed
				elseif(isset($_POST['delete']))
				{
					// Activate Content
					$faq->delete();
					//message::info(__('Contents deleted successfully! !!'), 'admin/faq/show_all');
				}
			}				
		}
	}
	
	public function show_all()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('faq')->count_all();
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
		$this->template->content = View::factory('faq/index', array('faqs' => ORM::factory('faq')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Show All'));
		$this->template->title .= __('Show All');
	}
	
	public function active()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('faq')->where('status', 'active')->count_all();
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
		$this->template->content = View::factory('faq/index', array('faqs' => ORM::factory('faq')->where('status', 'active')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Active Contents'));
		$this->template->title .= __('Active Contents');
	}
	
	public function inactive()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('faq')->where('status', 'inactive')->count_all();
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
		$this->template->content = View::factory('faq/index', array('faqs' => ORM::factory('faq')->where('status', 'inactive')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Inactive Contents'));
		$this->template->title .= __('Inactive Contents');
	}
	
	public function create()
	{
		$this->head->title->append(__('Add New Content'));
		$this->template->title .= __('Add New Content');
		$statusOptions 	  = common::statusOptions();
		$faqCategoryOptions = common::objectToArray(ORM::factory('faq_category')->select_list('faq_category', 'faq_category'));
		$courseNameOptions = common::objectToArray(ORM::factory('course')->select_list('course_name', 'course_name'));
		$form = Formo::factory()
			->plugin('csrf')
			->add('text', 'faq_title', array('label' => __('FAQ Title')))
			->add_select('course_name', $courseNameOptions, array('label' => __('Course Name')))
			->add_select('faq_category', $faqCategoryOptions, array('label' => __('FAQ Category')))
			//->add_select('about_type', theme::available(), array('label' => __('About Us Type'), 'value' => ''))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status')))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)')))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)')))
			->add('textarea', 'faq_details', array('label' => __('FAQ Details')))
			//->add_select('status', theme::available(), array('label' => __('Select Content Status'), 'value' => ''))
			->add('submit', 'submit', array('label' => __('Save')))

			// TODO check if username or email exists
			->add_rule('faq_title', 'required', __('You must enter a title! !!'))
			->add_rule('course_name', 'required', __('You must select a type! !!'))
			->add_rule('faq_category', 'required', __('You must select a type! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'))
			->add_rule('faq_details', 'required', __('You must enter a details! !!'));

		if($form->validate())
		{
			$faq = ORM::factory('faq');
			$faq->faq_title 		= $form->faq_title->value;
			$faq->course_name 		= $form->course_name->value;
			$faq->faq_category 		= $form->faq_category->value;
			$faq->status 			= $form->status->value;
			$faq->meta_keywords 	= $form->meta_keywords->value;
			$faq->meta_description 	= $form->meta_description->value;
			$faq->faq_details   	= $form->faq_details->value;
			$faq->created 			= date("Y-m-d H:i:s", time());
			$faq->save();

			message::info(__('Content saved successfully! !!'), 'admin/faq/show_all');
		}

		$this->template->content = View::factory('faq/create', $form->get(TRUE));
	}

	public function edit($id)
	{
		$this->head->title->append(__('Modify Content'));
		$this->template->title .= __('Modify Content');
		$statusOptions 	  = common::statusOptions();
		$faqCategoryOptions = common::objectToArray(ORM::factory('faq_category')->select_list('faq_category', 'faq_category'));
		$courseNameOptions = common::objectToArray(ORM::factory('course')->select_list('course_name', 'course_name'));


		$faq = ORM::factory('faq', (int) $id);
		if(!$faq->loaded){
			Event::run('system.404');
		}
		
		$form = Formo::factory()
			->plugin('csrf')
			->add('text', 'faq_title', array('label' => __('FAQ Title'), 'value' => $faq->faq_title))
			->add_select('course_name', $courseNameOptions, array('label' => __('Course Name'), 'value' => $faq->course_name))
			->add_select('faq_category', $faqCategoryOptions, array('label' => __('FAQ Category'), 'value' => $faq->faq_category))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status'), 'value' => $faq->status))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)'), 'value' => $faq->meta_keywords))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)'), 'value' => $faq->meta_description))
			->add('textarea', 'faq_details', array('label' => __('FAQ Details'), 'value' => $faq->faq_details))
			->add('submit', 'submit', array('label' => __('Modify')))

			// TODO check if username or email exists
			->add_rule('faq_title', 'required', __('You must enter a title! !!'))
			->add_rule('course_name', 'required', __('You must select a type! !!'))
			->add_rule('faq_category', 'required', __('You must select a type! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'))
			->add_rule('faq_details', 'required', __('You must enter a details! !!'));
			
		if($form->validate())
		{
			$faq = ORM::factory('faq', (int) $id);
			$faq->faq_title 		= $form->faq_title->value;
			$faq->course_name 		= $form->course_name->value;
			$faq->faq_category 		= $form->faq_category->value;
			$faq->status 			= $form->status->value;
			$faq->meta_keywords 	= $form->meta_keywords->value;
			$faq->meta_description 	= $form->meta_description->value;
			$faq->faq_details   	= $form->faq_details->value;
			$faq->save();
			
			message::info(__('Content modified successfully! !!'), 'admin/faq/show_all');
		}

		$this->template->content = View::factory('faq/edit', $form->get(TRUE));
	}

	public function delete($id)
	{
		$faq = ORM::factory('faq', (int) $id);

		if(!$faq->loaded){
			message::error(__('Invalid Content ID'), 'admin/faq/show_all');
		}	

		$faq->delete();
		message::info(__('Content deleted successfully! !!'), 'admin/faq/show_all');
	}
}