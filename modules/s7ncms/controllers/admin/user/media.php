<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: user.php 477 2009-11-28 23:33:14Z eduardbaun $
 */
class Media_Controller extends Administration_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if(Auth::factory()->logged_in())
		{
			if(!Auth::factory()->logged_in('admin')){
				url::redirect('admin/user_dashboard/');
			}
		}
		
		$this->template->tasks = array(
			array('admin/media/show_all', __('Show All Media Info')),
			array('admin/media/create', __('Add New Media Info')),
			array('admin/media/active', __('Show Active Contents')),
			array('admin/media/inactive', __('Show Inactive Contents')),
		);

		$this->head->title->append(__('Media Info'));
		$this->template->title = html::anchor('admin/media', __('Media Info')).' | ';
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
				$media = ORM::factory('acca_media', (int) $value);
		
				if(!$media->loaded){
					message::error(__('Invalid Content ID'), 'admin/media/show_all');
				}	
				
				// If Inactivate button pressed
				if(isset($_POST['inactive']))
				{
					// Inactivate Content
					$media->status = 'inactive';
					$media->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/media/show_all');
				}
				// If Activate button pressed
				elseif(isset($_POST['active']))
				{
					// Activate Content
					$media->status = 'active';
					$media->save();
					//message::info(__('Content inactivated successfully! !!'), 'admin/media/show_all');
				}
				// If Delete button pressed
				elseif(isset($_POST['delete']))
				{
					// Activate Content
					$media->delete();
					//message::info(__('Contents deleted successfully! !!'), 'admin/media/show_all');
				}
			}				
		}
	}
	
	public function show_all()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('acca_media')->count_all();
		//Pagination configuration
		$num_per_page = Kohana::config('core.show_per_page');
		//Setup pagination
		$pagination = new Pagination(array(
			'uri_segment'    => 4,
			'total_items'    => $totalItems,
			'style'          => "Digg",
			'items_per_page' => $num_per_page,
			'auto_hide'      => TRUE
		));
		
		$offset = $pagination->sql_offset;
		$this->template->content = View::factory('media/index', array('medias' => ORM::factory('acca_media')->orderby('id', 'desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination;
		$this->head->title->append(__('Show All'));
		$this->template->title .= __('Show All');
	}
	
	public function active()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('acca_media')->where('status', 'active')->count_all();
		//Pagination configuration
		$num_per_page = Kohana::config('core.show_per_page');
		//Setup pagination
		$pagination = new Pagination(array(
			'uri_segment'    => 4,
			'total_items'    => $totalItems,
			'style'          => "Digg",
			'items_per_page' => $num_per_page,
			'auto_hide'      => TRUE
		));
		
		$offset = $pagination->sql_offset;
		$this->template->content = View::factory('media/index', array('medias' => ORM::factory('acca_media')->where('status', 'active')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination;
		$this->head->title->append(__('Active Contents'));
		$this->template->title .= __('Active Contents');
	}
	
	public function inactive()
	{
		if($_POST){	$this->active_inactive(); }
		$totalItems = ORM::factory('acca_media')->where('status', 'inactive')->count_all();
		//Pagination configuration
		$num_per_page = Kohana::config('core.show_per_page');
		//Setup pagination
		$pagination = new Pagination(array(
			'uri_segment'    => 4,
			'total_items'    => $totalItems,
			'style'          => "Digg",
			'items_per_page' => $num_per_page,
			'auto_hide'      => TRUE
		));
		
		$offset = $pagination->sql_offset;
		$this->template->content = View::factory('media/index', array('medias' => ORM::factory('acca_media')->where('status', 'inactive')->orderby('id','desc')->find_all($num_per_page, $offset)));
		
		$this->template->content->pagination = $pagination;
		$this->head->title->append(__('Inactive Contents'));
		$this->template->title .= __('Inactive Contents');
	}
	
	public function create()
	{
		$this->head->title->append(__('Add New Content'));
		$this->template->title .= __('Add New Content');
		$statusOptions 	 = common::statusOptions();
		$mediaCatList 	 = common::objectToArrayWithValue(ORM::factory('media_cat')->select_list('media_cat', 'media_type'));
		$mediaTypeList 	 = common::objectToArray(ORM::factory('media_type')->select_list('media_type', 'media_type'));
		
		$form = Formo::factory()
			->plugin('csrf')
			->add('media_title', array('label' => __('Media Title')))
			->add_select('media_type', $mediaTypeList, array('label' => __('Select Media Type')))
			->add_select('media_cat', $mediaCatList, array('label' => __('Select Media Type Related Category')))
			->add('text', 'media_details', array('label' => __('Media Details')))
			->add('text', 'media_file', array('label' => __('Upload Media (Photo, Audio, Video, Documents)')))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status')))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)')))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)')))
			->add('submit', 'submit', array('label' => __('Save')))

			// TODO check if usermedia_file or email exists
			->add_rule('media_title', 'required', __('You must enter media title! !!'))
			->add_rule('media_type', 'required', __('You must select media type! !!'))
			->add_rule('media_cat', 'required', __('You must select media category! !!'))
			->add_rule('media_details', 'required', __('You must enter media details! !!'))
			//->add_rule('media_file', 'required', __('You must include a media file! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'));
			
		if($form->validate())
		{
			$media = ORM::factory('acca_media');
			$media->media_title 		= $form->media_title->value;
			$media->media_type 			= $form->media_type->value;
			$media->media_cat	 	 	= $form->media_cat->value;
			$media->media_details 		= $form->media_details->value;
			$media->status 			 	= $form->status->value;
			$media->meta_keywords 	 	= $form->meta_keywords->value;
			$media->meta_description  	= $form->meta_description->value;
			$media->created 			= date("Y-m-d H:i:s", time());
			
			$common = array ('file' => 'media_file', 'validate' => TRUE, 'required' => TRUE);
			if($media->media_type === 'Picture Gallery'){$medias = array ('types' => 'gif,jpg,png,jpeg,jpeg', 'size' => '200K', 'path' => 'public/uploads/picture/', 'crop' => TRUE, 'width' => 100, 'height' => 90);}
			if($media->media_type === 'Audio Gallery'){$medias = array ('types' => 'mp3,wav,wma', 'size' => '5M', 'path' => 'public/uploads/audio/');}
			if($media->media_type === 'Video Gallery'){$medias = array ('types' => 'wmv,wmx,mpeg,mpg,mkv,mov', 'size' => '20M', 'path' => 'public/uploads/video/');}
			if($media->media_type === 'Document Gallery'){$medias = array ('types' => 'ai,dir,doc,exe,fla,gtar,gz,zip,rar,tar,pdf,swf,xl,xla,xlc,xlm,xls,xlt', 'size' => '4M', 'path' => 'public/uploads/document/');}

			$media->media_file 			= common::upload_file(array_merge($medias, $common));
			$media->size 				= $_FILES['media_file']['size'];
			$media->type 				= $_FILES['media_file']['type'];
			
			$media->save();
			message::info(__('Content saved successfully! !!'), 'admin/media/show_all');
		}
		$this->template->content = View::factory('media/create', $form->get(TRUE));
	}

	public function edit($id)
	{
		$this->head->title->append(__('Add New Content'));
		$this->template->title .= __('Add New Content');
		$statusOptions 	 = common::statusOptions();
		$mediaCatList 	 = common::objectToArrayWithValue(ORM::factory('media_cat')->select_list('media_cat', 'media_type'));
		$mediaTypeList 	 = common::objectToArray(ORM::factory('media_type')->select_list('media_type', 'media_type'));

		$media = ORM::factory('acca_media', (int) $id);
		if(!$media->loaded){
			Event::run('system.404');
		}
		
		$form = Formo::factory()
			->plugin('csrf')
			->add('media_title', array('label' => __('Media Title'), 'value' => $media->media_title))
			->add_select('media_type', $mediaTypeList, array('label' => __('Select Media Type'), 'value' => $media->media_type))
			->add_select('media_cat', $mediaCatList, array('label' => __('Select Media Type Related Category'), 'value' => $media->media_cat))
			->add('text', 'media_details', array('label' => __('Media Details'), 'value' => $media->media_details))
			->add('text', 'media_file', array('label' => __('Upload Media (Photo, Audio, Video, Documents)'), 'value' => $media->media_file))
			->add_select('status', $statusOptions, array('label' => __('Select Content Status'), 'value' => $media->status))
			->add('text', 'meta_keywords', array('label' => __('Content Meta Keywords (Optional but recommanded for SEO)'), 'value' => $media->meta_keywords))
			->add('text', 'meta_description', array('label' => __('Content Meta Description (Optional but recommanded for SEO)'), 'value' => $media->meta_description))
			->add('submit', 'submit', array('label' => __('Modify')))

			// TODO check if usermedia_file or email exists
			->add_rule('media_title', 'required', __('You must enter media title! !!'))
			->add_rule('media_type', 'required', __('You must select media type! !!'))
			->add_rule('media_cat', 'required', __('You must select media category! !!'))
			->add_rule('media_details', 'required', __('You must enter media details! !!'))
			//->add_rule('media_file', 'required', __('You must include a media file! !!'))
			->add_rule('status', 'required', __('You must select an status! !!'))
			->add_rule('meta_keywords', 'required', __('Enter content related meta keywords! !!'))
			->add_rule('meta_description', 'required', __('Enter content related meta description! !!'));

		if($form->validate())
		{
			$media = ORM::factory('acca_media', (int) $id);
			$media->media_title 		= $form->media_title->value;
			$media->media_type 			= $form->media_type->value;
			$media->media_cat	 	 	= $form->media_cat->value;
			$media->media_details 		= $form->media_details->value;
			$media->status 			 	= $form->status->value;
			$media->meta_keywords 	 	= $form->meta_keywords->value;
			$media->meta_description  	= $form->meta_description->value;
			
			$common = array ('file' => 'media_file', 'validate' => TRUE, 'required' => TRUE);
			if($media->media_type === 'Picture Gallery'){$medias = array ('types' => 'gif,jpg,png,jpeg,jpeg', 'size' => '100K', 'path' => 'public/uploads/picture/', 'crop' => TRUE, 'width' => 100, 'height' => 90);}
			if($media->media_type === 'Audio Gallery'){$medias = array ('types' => 'mp3,wav,wma', 'size' => '4M', 'path' => 'public/uploads/audio/');}
			if($media->media_type === 'Video Gallery'){$medias = array ('types' => 'wmv,wmx,mpeg,mpg,mkv,mov', 'size' => '10M', 'path' => 'public/uploads/video/');}
			if($media->media_type === 'Document Gallery'){$medias = array ('types' => 'ai,dir,doc,exe,fla,gtar,gz,zip,rar,tar,pdf,swf,xl,xla,xlc,xlm,xls,xlt', 'size' => '2M', 'path' => 'public/uploads/document/');}

			$media->media_file 			= common::upload_file(array_merge($medias, $common));
			$media->size 				= $_FILES['media_file']['size'];
			$media->type 				= $_FILES['media_file']['type'];
			
			$media->save();
			message::info(__('Content modified successfully! !!'), 'admin/media/show_all');
		}

		$this->template->content = View::factory('media/edit', $form->get(TRUE));
	}

	public function delete($id)
	{
		$media = ORM::factory('acca_media', (int) $id);

		if(!$media->loaded){
			message::error(__('Invalid Content ID'), 'admin/media/show_all');
		}	

		$media->delete();
		message::info(__('Content deleted successfully! !!'), 'admin/media/show_all');
	}
}