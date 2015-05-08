<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class News_Event_Controller extends Administration_Controller
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
			array('admin/news_event/show_all', __('Show All Contents')),
			array('admin/news_event/create', __('Add News/Event Content')),
			array('admin/news_event/active', __('Show Active Contents')),
			array('admin/news_event/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('News/Event'));
		$this->template->title = html::anchor('admin/news_event', __('News/Event')).' | ';
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
				$news_events = ORM::factory('news_event', (int) $value);
		
				if(!$news_events->loaded){
					message::error(__('Invalid Content ID'), 'admin/news_event/show_all');
				}	
				
				// If Inactivate button pressed
				if(isset($_POST['inactive']))
				{
					// Inactivate Content
					$news_events->status = 'inactive';
					$news_events->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/faq/show_all');
				}
				// If Activate button pressed
				elseif(isset($_POST['active']))
				{
					// Activate Content
					$news_events->status = 'active';
					$news_events->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/faq/show_all');
				}
			}				
		}
	}
	
	public function show_all()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('news_event')->count_all();
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
		$this->template->content = View::factory('news_event/index', array('news_events' => ORM::factory('news_event')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Show All'));
		$this->template->title .= __('Show All');
	}
	
	public function active()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('news_event')->where('status', 'active')->count_all();
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
		$this->template->content = View::factory('news_event/index', array('news_events' => ORM::factory('news_event')->where('status', 'active')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Active Contents'));
		$this->template->title .= __('Active Contents');
	}
	
	public function inactive()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('news_event')->where('status', 'inactive')->count_all();
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
		$this->template->content = View::factory('news_event/index', array('news_events' => ORM::factory('news_event')->where('status', 'inactive')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Inactive Contents'));
		$this->template->title .= __('Inactive Contents');
	}
	
	public function create()
	{
		$this->head->title->append(__('Add New Content'));
		$this->template->title .= __('Add New Content');
		$neTypeOptions 	  = common::neTypeOptions();
		$statusOptions 	  = common::statusOptions();
		$form = Formo::factory()
			->plugin('csrf')
			->add('text', 'ne_title', array('label' => __('News/Event Title')))
			->add_select('ne_type', $neTypeOptions, array('label' => __('News/Event Type')))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status')))
            ->add('text', 'ne_photo', array('label' => __('Upload News/Event\'s Photo')))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)')))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)')))
			->add('textarea', 'ne_details', array('label' => __('News/Events Details')))
			->add('submit', 'submit', array('label' => __('Save')))

			// TODO check if username or email exists
			->add_rule('ne_title', 'required', __('You must enter a title! !!'))
			->add_rule('ne_type', 'required', __('You must select a type! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'))
			->add_rule('ne_details', 'required', __('You must enter a details! !!'));

		if($form->validate())
		{
			$news_events = ORM::factory('news_event');
			$news_events->ne_title 	= $form->ne_title->value;
			$news_events->ne_type	= $form->ne_type->value;
			$news_events->status 	= $form->status->value;
			$news_events->meta_keywords = $form->meta_keywords->value;
			$news_events->meta_description = $form->meta_description->value;
			$news_events->ne_details = $form->ne_details->value;
			$news_events->created    = date("Y-m-d H:i:s", time());
			if(!empty($_FILES['ne_photo']['name'])){
				$photo = array ('file' => 'ne_photo', 'types' => 'gif,jpg,png,jpeg,jpeg', 'size' => '200K', 'path' => 'public/photos/news_event/', 'validate' => TRUE, 'required' => FALSE, 'crop' => FALSE);
				$news_events->ne_photo	 = common::upload_file($photo);
				$news_events->size 		 = $_FILES['ne_photo']['size'];
				$news_events->type 		 = $_FILES['ne_photo']['type'];
			}
			$news_events->save();

			message::info(__('Content saved successfully! !!'), 'admin/news_event/show_all');
		}

		$this->template->content = View::factory('news_event/create', $form->get(TRUE));
	}

	public function edit($id)
	{
		$this->head->title->append(__('Modify Content'));
		$this->template->title .= __('Modify Content');
		$neTypeOptions 	  = common::neTypeOptions();
		$statusOptions 	  = common::statusOptions();


		$news_events = ORM::factory('news_event', (int) $id);
		if(!$news_events->loaded){
			Event::run('system.404');
		}
		
		$form = Formo::factory()
			->plugin('csrf')
			->add('text', 'ne_title', array('label' => __('News/Event Title'), 'value' => $news_events->ne_title))
			->add_select('ne_type', $neTypeOptions, array('label' => __('News/Event Type'), 'value' => $news_events->ne_type))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status'), 'value' => $news_events->status))
            ->add('text', 'ne_photo', array('label' => __('Upload News/Event\'s Photo'), 'value' => $news_events->ne_photo))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)'), 'value' => $news_events->meta_keywords))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)'), 'value' => $news_events->meta_description))
			->add('textarea', 'ne_details', array('label' => __('News/Event Details'), 'value' => $news_events->ne_details))
			->add('submit', 'submit', array('label' => __('Modify')))

			// TODO check if username or email exists
			->add_rule('ne_title', 'required', __('You must enter a title! !!'))
			->add_rule('ne_type', 'required', __('You must select a type! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'))
			->add_rule('ne_details', 'required', __('You must enter a details! !!'));
			
		if($form->validate())
		{
			$news_events = ORM::factory('news_event', (int) $id);
			$news_events->ne_title 		= $form->ne_title->value;
			$news_events->ne_type 		= $form->ne_type->value;
			$news_events->status 		= $form->status->value;
			$news_events->meta_keywords = $form->meta_keywords->value;
			$news_events->meta_description = $form->meta_description->value;
			if(!empty($_FILES['ne_photo']['name'])){
				$photo = array ('file' => 'ne_photo', 'types' => 'gif,jpg,png,jpeg,jpeg', 'size' => '200K', 'path' => 'public/photos/news_event/', 'validate' => TRUE, 'required' => FALSE, 'crop' => FALSE);
				$news_events->ne_photo	 = common::upload_file($photo);
				$news_events->size 		 = $_FILES['ne_photo']['size'];
				$news_events->type 		 = $_FILES['ne_photo']['type'];
			}
			$news_events->ne_details    = $form->ne_details->value;
			$news_events->save();
			
			message::info(__('Content modified successfully! !!'), 'admin/news_event/show_all');
		}

		$this->template->content = View::factory('news_event/edit', $form->get(TRUE));
	}

	public function delete($id)
	{
		$news_events = ORM::factory('news_event', (int) $id);

		if(!$news_events->loaded){
			message::error(__('Invalid Content ID'), 'admin/news_event/show_all');
		}	

		$news_events->delete();
		message::info(__('Content deleted successfully! !!'), 'admin/news_event/show_all');
	}
}