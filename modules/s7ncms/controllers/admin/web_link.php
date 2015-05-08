<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class Web_Link_Controller extends Administration_Controller
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
			array('admin/web_link/show_all', __('Show All Contents')),
			array('admin/web_link/create', __('Add New Web Link')),
			array('admin/web_link/active', __('Show Active Contents')),
			array('admin/web_link/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('Web Links'));
		$this->template->title = html::anchor('admin/web_link', __('Web Links')).' | ';
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
				$web_link = ORM::factory('weblink', (int) $value);
		
				if(!$web_link->loaded){
					message::error(__('Invalid Content ID'), 'admin/web_link/show_all');
				}	
				
				// If Inactivate button pressed
				if(isset($_POST['inactive']))
				{
					// Inactivate Content
					$web_link->status = 'inactive';
					$web_link->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/web_link/show_all');
				}
				// If Activate button pressed
				elseif(isset($_POST['active']))
				{
					// Activate Content
					$web_link->status = 'active';
					$web_link->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/web_link/show_all');
				}
				// If Delete button pressed
				elseif(isset($_POST['delete']))
				{
					// Activate Content
					$web_link->delete();
					//message::info(__('Contents deleted successfully! !!'), 'admin/web_link/show_all');
				}
			}				
		}
	}
	
	public function show_all()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('weblink')->count_all();
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
		$this->template->content = View::factory('web_link/index', array('weblinks' => ORM::factory('weblink')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Show All'));
		$this->template->title .= __('Show All');
	}
	
	public function active()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('weblink')->where('status', 'active')->count_all();
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
		$this->template->content = View::factory('web_link/index', array('weblinks' => ORM::factory('weblink')->where('status', 'active')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Active Contents'));
		$this->template->title .= __('Active Contents');
	}
	
	public function inactive()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('weblink')->where('status', 'inactive')->count_all();
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
		$this->template->content = View::factory('web_link/index', array('weblinks' => ORM::factory('weblink')->where('status', 'inactive')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination->render();
		$this->head->title->append(__('Inactive Contents'));
		$this->template->title .= __('Inactive Contents');
	}
	
	public function create()
	{
		$this->head->title->append(__('Add New Content'));
		$this->template->title .= __('Add New Content');
		$statusOptions 	  = common::statusOptions();
		$linkOptions 	  = common::webLinkOptions();
		$form = Formo::factory()
			->plugin('csrf')
			->add('text', 'link_title', array('label' => __('Web Site Name')))
			->add('text', 'link_url', array('label' => __('Web Site URL')))
			->add_select('link_cat', $linkOptions, array('label' => __('Select Web Link Category')))
			->add('text', 'picture', array('label' => __('Upload Image For Ads')))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status')))
			->add('submit', 'submit', array('label' => __('Save')))

			// TODO check if username or email exists
			->add_rule('link_title', 'required', __('You must enter a link title! !!'))
			->add_rule('link_url', 'required', __('You must enter link url! !!'))
			->add_rule('link_cat', 'required', __('You must select link category! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'));
			
		if($form->validate())
		{
			$weblinks = ORM::factory('weblink');
			$weblinks->link_title = $form->link_title->value;
			$weblinks->link_url   = $form->link_url->value;
			$weblinks->link_cat   = $form->link_cat->value;
			$weblinks->status     = $form->status->value;
			$weblinks->created    = date("Y-m-d H:i:s", time());
			
			if(!empty($_FILES['picture']['name'])){
				$photo = array ('file' => 'picture', 'types' => 'gif,jpg,png,jpeg,jpeg', 'size' => '200K', 'path' => 'public/photos/web_ads/', 'validate' => TRUE, 'required' => FALSE);
				$weblinks->picture 			 = common::upload_file($photo);
				$weblinks->size 			 = $_FILES['picture']['size'];
				$weblinks->type 			 = $_FILES['picture']['type'];
			}
			
			$weblinks->save();
			message::info(__('Content saved successfully! !!'), 'admin/web_link/show_all');
		}

		$this->template->content = View::factory('web_link/create', $form->get(TRUE));
	}

	public function edit($id)
	{
		$this->head->title->append(__('Modify Content'));
		$this->template->title .= __('Modify Content');
		$statusOptions 	  = common::statusOptions();
		$linkOptions 	  = common::webLinkOptions();

		$weblinks = ORM::factory('weblink', (int) $id);
		if(!$weblinks->loaded){
			Event::run('system.404');
		}
		
		$form = Formo::factory()
			->plugin('csrf')
			->add('text', 'link_title', array('label' => __('Web Site Name'), 'value' => $weblinks->link_title))
			->add('text', 'link_url', array('label'   => __('Web Site URL'), 'value'  => $weblinks->link_url))
			->add_select('link_cat', $linkOptions, array('label' => __('Select Web Link Category'), 'value' => $weblinks->link_cat))
			->add('text', 'picture', array('label' => __('Upload Image For Ads'), 'value'  => $weblinks->picture))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status'), 'value' => $weblinks->status))
			->add('submit', 'submit', array('label' => __('Modify')))

			// TODO check if username or email exists
			->add_rule('link_title', 'required', __('You must enter a link title! !!'))
			->add_rule('link_url', 'required', __('You must enter link url! !!'))
			->add_rule('link_cat', 'required', __('You must select link category! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'));
			
		if($form->validate())
		{
			$weblinks = ORM::factory('weblink', (int) $id);
			$weblinks->link_title = $form->link_title->value;
			$weblinks->link_url   = $form->link_url->value;
			$weblinks->link_cat   = $form->link_cat->value;
			$weblinks->status     = $form->status->value;
			
			if(!empty($_FILES['picture']['name'])){
				$photo = array ('file' => 'picture', 'types' => 'gif,jpg,png,jpeg,jpeg', 'size' => '200K', 'path' => 'public/photos/web_ads/', 'validate' => TRUE, 'required' => FALSE);
				$weblinks->picture 			 = common::upload_file($photo);
				$weblinks->size 			 = $_FILES['picture']['size'];
				$weblinks->type 			 = $_FILES['picture']['type'];
			}
			
			$weblinks->save();
			message::info(__('Content modified successfully! !!'), 'admin/web_link/show_all');
		}

		$this->template->content = View::factory('web_link/edit', $form->get(TRUE));
	}

	public function delete($id)
	{
		$weblinks = ORM::factory('weblink', (int) $id);

		if(!$weblinks->loaded){
			message::error(__('Invalid Content ID'), 'admin/web_link/show_all');
		}	

		$weblinks->delete();
		message::info(__('Content deleted successfully! !!'), 'admin/web_link/show_all');
	}
}