<?php defined('SYSPATH') OR die('No direct access allowed.');
include_once("BaseController.php");
/**
 * Default Kohana controller. This controller should NOT be used in production.
 * It is for demonstration purposes only!
 *
 * @package    Core
 * @author     Kohana Team
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Home_Controller extends BaseController_Controller
{
	public function __construct()
	{
		// load database library into $this->db (can be omitted if not required)
		parent::__construct();
		$this->template->html_body_id = 'home';
	}

	public function index()
	{
		$this->home();
	}

	public function home()
	{
		$this->template->title 		= $this->site_name.' ::: Welcome to Home';
		$this->data['active_tab'] 	= 'home';
		$this->_loadCommonTemplate();
	}

	public function about_us($condition = NULL)
	{
		$this->template->title 		= $this->site_name.' ::: '.(!empty($condition) ? ucwords($condition) : 'About Us');
		$this->data['active_tab'] 	= 'about';
		if($condition != ""){$cond = "about_type = '$condition'"; }
		else { $cond = "about_type = 'why saifurs'"; }
		
		// Loading Model..
		$this->aboutus = new Aboutus_Model;
		$this->data['aboutuses'] = $this->aboutus->get_aboutus($cond);
		$this->view_content 	 = 'pages/aboutus-show';
		$this->_loadCommonTemplate();
		
	}
	
	public function media_type($cat = FALSE)
	{
		$this->data['active_tab'] 	= 'media';
		$this->medias = new Medias_Model;
		
		if(!$cat){
			$this->template->title 	 = $this->site_name.' ::: Media Types';
			$this->data['pictures']  = $this->medias->get_all('media_cat', "media_type = 'Picture Gallery'");
			$this->data['audios']    = $this->medias->get_all('media_cat', "media_type = 'Audio Gallery'");
			$this->data['videos']    = $this->medias->get_all('media_cat', "media_type = 'Video Gallery'");
			$this->data['documents'] = $this->medias->get_all('media_cat', "media_type = 'Document Gallery'");
			$this->view_content 	 = 'pages/media-gallery-type';
		}else{
			$this->template->title 	  = $this->site_name.' ::: '.$cat.' List';
			$this->data['head']		  = $cat.' List';
			$this->data['mediatype']  = substr($cat, -7);
			if($this->data['mediatype'] === 'Gallery'){
				$this->template->stylesheets = array('style.css');
				$this->template->javascripts = array('jquery-1.3.2.min.js', 'jquery.easing.1.3.js', 'jquery.galleryview-1.1.js', 'jquery.timers-1.1.2.js');
			}
			$this->data['medialists'] = $this->medias->get_all('acca_media', "media_cat = '$cat'");
			$this->view_content 	  = 'pages/media-gallery-list';
		}
		
		$this->_loadCommonTemplate();
	}
		
	public function course_package()
	{
		$this->template->title 		= $this->site_name.' ::: ACCA, CAT Course Package Price';
		$this->data['active_tab'] 	= 'package';
		// Loading Model..
		$this->course = new Courses_Model;
		$this->data['courses']  = $this->course->get_expense();
		$this->view_content 	= 'pages/course-info-show';
		$this->_loadCommonTemplate();
	}
		
	public function news_event_list()
	{
		$this->template->title 		= $this->site_name.' ::: S@ifur\'s University College News &amp; Events List';
		$this->data['active_tab'] 	= 'news_event';
		// Loading Model..
		$this->newsevent = new Newsevent_Model;
		$this->data['nelists']   = $this->newsevent->get_all_news_event();
		$this->view_content 	= 'pages/news-event-list-show';
		$this->_loadCommonTemplate();
		
	}
		
	public function news_event($neId = NULL)
	{
		$this->template->title 		= $this->site_name.' ::: S@ifur\'s University College News &amp; Events Details';
		$this->data['active_tab'] 	= 'news_event';
		// Loading Model..
		$this->newsevent = new Newsevent_Model;
		$this->data['newsevents']  = $this->newsevent->get_news_event_details($neId);
		$this->view_content 	   = 'pages/news-event-show';
		$this->_loadCommonTemplate();
		
	}
	
	public function course_syllabus()
	{
		$this->template->title 		= $this->site_name.' ::: ACCA, CAT Course Syllabus';
		$this->data['active_tab'] 	= 'syllabus';
		// Loading Model..
		$this->course = new Courses_Model;
		$this->data['courses'] = $this->course->get_syllabus();
		$this->view_content    = 'pages/course-info-show';
		$this->_loadCommonTemplate();
		
	}

	public function links()
	{
		$this->template->title 		= $this->site_name.' ::: Essential Links';
		$this->data['active_tab'] 	= 'link';
		$this->links = new Links_Model;
		$this->data['links'] = $this->links->get_link();
		$this->view_content 			= 'pages/web-link-show';
		$this->_loadCommonTemplate();
	}


	public function blog()
	{
		$this->template->title 		= $this->site_name.' ::: ACCA Blog';
		$this->data['active_tab'] 	= 'blog';
		$this->_loadCommonTemplate();
	}

	public function contact_us()
	{
	   // setup and initialize your form field names
		$this->data['form'] = array
		(
			'full_name'	=> '',
			'phone'    	=> '',
			'email'    	=> '',
			'subject'  	=> '',
			'message'  	=> '',
		);
	 
		//  copy the form as errors, so the errors will be stored with keys corresponding to the form field names
		$errors = $this->data['form'];
		
		// Check whether post variable is blank or not..
		if($_POST)
		{
			$post = new Validation($_POST);
			
			// Filtering posted values
			$post->pre_filter('trim');
			$post->post_filter('ucwords', 'full_name');
			$post->post_filter('ucfirst', 'subject');
			
			//input::xss_clean('*');
			//$this->input->xss_clean($post['full_name']);
			
			// Setting validation rules for posted values
			$post->add_rules('full_name', 'required', 'input::xss_clean');
			$post->add_rules('phone', 'required', 'numeric', 'length[7,11]', 'input::xss_clean');
			$post->add_rules('email', 'required', 'email', 'input::xss_clean');
			$post->add_rules('subject', 'required', 'input::xss_clean');
			$post->add_rules('message', 'required', 'input::xss_clean');
							  
			if($post->validate())
			{
				// Loading Model..
				$this->feedbacks = new Feedbacks_Model;
				
				$formData = arr::overwrite($this->data['form'], $post->as_array());
			
				if($this->feedbacks->insert_feedback($formData))
				{
					$this->data['status_message'] = sprintf($this->data['common']->user_success_msg, 'Data has been saved successfully');
				}
				else
				{
					$this->data['status_message'] = sprintf($this->data['common']->user_fail_msg, 'Sorry, data has been failed to save');
				}
			}
			else
			{
				// repopulate the form fields
				$this->data['form'] 		  = arr::overwrite($this->data['form'], $post->as_array());
				$this->data['status_message'] = $this->data['common']->error_message;
				$this->data['errors']         = arr::to_object($post->errors('feedback_form'));
				$this->data['faults']         = $post->errors();
			}
		}
		$this->template->title 		= $this->site_name.' ::: Contact Us';
		$this->data['active_tab'] 	= 'contact';
		$this->view_content 		= 'pages/contact-feedback-form';
		
		$this->_loadCommonTemplate();
	}

	public function faq($condition = NULL)
	{
		$this->template->title 		= $this->site_name.' ::: Frequency Asked Question(FAQ) of '.$condition;
		$this->data['active_tab'] 	= 'faq';
		if($condition != ""){
			$cond1 = "course_name = '$condition' && faq_category = 'Course Related FAQ'";
			$cond2 = "course_name = '$condition' && faq_category = 'Exam Related FAQ'";
			$cond3 = "course_name = '$condition' && faq_category = 'Cost Related FAQ'";
		}
		else{
			$cond1 = "course_name = 'ACCA' && faq_category = 'Course Related FAQ'";
			$cond2 = "course_name = 'ACCA' && faq_category = 'Exam Related FAQ'";
			$cond3 = "course_name = 'ACCA' && faq_category = 'Cost Related FAQ'";
		}
		// Loading Model..
		$this->faq = new Faqs_Model;
		$this->data['faqcourse'] = $this->faq->get_faq($cond1);
		$this->data['faqexam']   = $this->faq->get_faq($cond2);
		$this->data['faqcost']   = $this->faq->get_faq($cond3);
		$this->view_content 	 = 'pages/faq-show';
		$this->_loadCommonTemplate();
	}
  
    public function eligibility()
	{
	   // setup and initialize your form field names
		$this->data['form'] = array
		(
			'full_name'	      => '',
			'course_name'     => '',
			'mailing_address' => '',
			'contact_no'      => '',
			'email'    	      => '',
			'age'  	          => '',
			'education'       => '',
			'extra_course'    => '',
		);
	 
		//  copy the form as errors, so the errors will be stored with keys corresponding to the form field names
		$errors = $this->data['form'];
		
		// Check whether post variable is blank or not..
		if($_POST)
		{
			$post = new Validation($_POST);
			
			// Filtering posted values
			$post->pre_filter('trim');
			$post->post_filter('ucwords', 'full_name');
			
			// Setting validation rules for posted values
			$post->add_rules('full_name', 'required', 'input::xss_clean');
			$post->add_rules('course_name', 'required', 'input::xss_clean');
			$post->add_rules('mailing_address', 'required', 'input::xss_clean');
			$post->add_rules('contact_no', 'required', 'numeric', 'length[7,11]', 'input::xss_clean');
			$post->add_rules('email', 'required', 'email', 'input::xss_clean');
			$post->add_rules('age', 'required', 'numeric', 'length[1,3]', 'input::xss_clean');
			$post->add_rules('education', 'required', 'input::xss_clean');
			$post->add_rules('extra_course', 'required', 'input::xss_clean');
			$ss=$post->age;
		
			if($post->validate())
			{
				// Loading Model..
				$this->eligibilities = new Eligibilities_Model;
				
				$formData = arr::overwrite($this->data['form'], $post->as_array());
				
				if($this->eligibilities->insert_eligibility($formData))
				{
				   if($ss >= 21)
				   {
					 $this->data['status_message'] = sprintf($this->data['common']->user_success_msg, 'Congratulation, your are eligible for the degree');
				   }
				   else
				   {
					 $this->data['status_message'] = sprintf($this->data['common']->user_fail_msg, 'Sorry, your are not eligible for the degree');
				   }
				}
				else
				{
					$this->data['status_message'] = $this->data['common']->fail_message;
				}
			}
			else
			{
				// repopulate the form fields
				$this->data['form'] = arr::overwrite($this->data['form'], $post->as_array());
				$this->data['status_message'] = $this->data['common']->error_message;
				$this->data['errors'] = arr::overwrite($errors, $post->errors('eligibility_form'));
				$this->data['faults'] = $post->errors();
			}
		}
		$this->template->title 		= $this->site_name.' ::: Eligibility Check';
		$this->data['active_tab'] 	= 'eligibility';
		$this->view_content 		= 'pages/eligibility-check-form';
		$this->_loadCommonTemplate();
	}
} // End Home Controller