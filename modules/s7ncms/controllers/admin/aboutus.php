<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class Aboutus_Controller extends Administration_Controller
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
			array('admin/aboutus/show_all', __('Show All Contents')),
			array('admin/aboutus/create', __('Add About Us Content')),
			array('admin/aboutus/active', __('Show Active Contents')),
			array('admin/aboutus/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('About Us'));
		$this->template->title = html::anchor('admin/aboutus', __('About Us')).' | ';
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
				$aboutus = ORM::factory('about', (int) $value);
		
				if(!$aboutus->loaded){
					message::error(__('Invalid Content ID'), 'admin/aboutus/show_all');
				}	
				
				// If Inactivate button pressed
				if(isset($_POST['inactive']))
				{
					// Inactivate Content
					$aboutus->status = 'inactive';
					$aboutus->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/aboutus/show_all');
				}
				// If Activate button pressed
				elseif(isset($_POST['active']))
				{
					// Activate Content
					$aboutus->status = 'active';
					$aboutus->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/aboutus/show_all');
				}
				// If Delete button pressed
				elseif(isset($_POST['delete']))
				{
					// Activate Content
					$aboutus->delete();
					//message::info(__('Contents deleted successfully! !!'), 'admin/aboutus/show_all');
				}
			}				
		}
	}
	
	public function show_all()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('about')->count_all();
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
		$this->template->content = View::factory('aboutus/index', array('aboutus' => ORM::factory('about')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Show All'));
		$this->template->title .= __('Show All');
	}
	
	public function active()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('about')->where('status', 'active')->count_all();
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
		$this->template->content = View::factory('aboutus/index', array('aboutus' => ORM::factory('about')->where('status', 'active')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Active Contents'));
		$this->template->title .= __('Active Contents');
	}
	
	public function inactive()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('about')->where('status', 'inactive')->count_all();
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
		$this->template->content = View::factory('aboutus/index', array('aboutus' => ORM::factory('about')->where('status', 'inactive')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Inactive Contents'));
		$this->template->title .= __('Inactive Contents');
	}
	
	public function create()
	{
		$this->head->title->append(__('Add New Content'));
		$this->template->title .= __('Add New Content');
		$statusOptions 	  = common::statusOptions();
		$aboutTypeOptions = common::objectToArray(ORM::factory('about_type')->select_list('about_type', 'about_type'));

		$form = Formo::factory()
			->plugin('csrf')
			->add('text', 'about_title', array('label' => __('About Us Title')))
			->add_select('about_type', $aboutTypeOptions, array('label' => __('About Us Type')))
			//->add_select('about_type', theme::available(), array('label' => __('About Us Type'), 'value' => ''))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status')))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)')))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)')))
			->add('textarea', 'about_details', array('label' => __('About Us Details')))
			//->add_select('status', theme::available(), array('label' => __('Select Content Status'), 'value' => ''))
			->add('submit', 'submit', array('label' => __('Save')))

			// TODO check if username or email exists
			->add_rule('about_title', 'required', __('You must enter a title! !!'))
			->add_rule('about_type', 'required', __('You must select a type! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'))
			->add_rule('about_details', 'required', __('You must enter a details! !!'));

		if($form->validate())
		{
			$aboutus = ORM::factory('about');
			$aboutus->about_title 		= $form->about_title->value;
			$aboutus->about_type 		= $form->about_type->value;
			$aboutus->status 			= $form->status->value;
			$aboutus->meta_keywords 	= $form->meta_keywords->value;
			$aboutus->meta_description 	= $form->meta_description->value;
			$aboutus->about_details 	= $form->about_details->value;
			$aboutus->created 			= date("Y-m-d H:i:s", time());
			$aboutus->save();

			message::info(__('Content saved successfully! !!'), 'admin/aboutus/show_all');
		}
		$this->template->content = View::factory('aboutus/create', $form->get(TRUE));
	}

	public function edit($id)
	{
		$this->head->title->append(__('Modify Content'));
		$this->template->title .= __('Modify Content');
		$statusOptions 	  = common::statusOptions();
		$aboutTypeOptions = common::objectToArray(ORM::factory('about_type')->select_list('about_type', 'about_type'));

		$aboutus = ORM::factory('about', (int) $id);
		if(!$aboutus->loaded){
			Event::run('system.404');
		}
		
		$form = Formo::factory()
			->plugin('csrf')
			->add('text', 'about_title', array('label' => __('About Us Title'), 'value' => $aboutus->about_title))
			->add_select('about_type', $aboutTypeOptions, array('label' => __('About Us Type'), 'value' => $aboutus->about_type))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status'), 'value' => $aboutus->status))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)'), 'value' => $aboutus->meta_keywords))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)'), 'value' => $aboutus->meta_description))
			->add('textarea', 'about_details', array('label' => __('About Us Details'), 'value' => $aboutus->about_details))
			->add('submit', 'submit', array('label' => __('Modify')))

			// TODO check if username or email exists
			->add_rule('about_title', 'required', __('You must enter a title! !!'))
			->add_rule('about_type', 'required', __('You must select a type! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'))
			->add_rule('about_details', 'required', __('You must enter a details! !!'));

		if($form->validate())
		{
			$aboutus = ORM::factory('about', (int) $id);
			$aboutus->about_title 		= $form->about_title->value;
			$aboutus->about_type 		= $form->about_type->value;
			$aboutus->status 			= $form->status->value;
			$aboutus->meta_keywords 	= $form->meta_keywords->value;
			$aboutus->meta_description 	= $form->meta_description->value;
			$aboutus->about_details 	= $form->about_details->value;
			$aboutus->save();

			message::info(__('Content modified successfully! !!'), 'admin/aboutus/show_all');
		}
		$this->template->content = View::factory('aboutus/edit', $form->get(TRUE));
	}

	public function delete($id)
	{
		$aboutus = ORM::factory('about', (int) $id);

		if(!$aboutus->loaded){
			message::error(__('Invalid Content ID'), 'admin/aboutus/show_all');
		}	

		$aboutus->delete();
		message::info(__('Content deleted successfully! !!'), 'admin/aboutus/show_all');
	}
}