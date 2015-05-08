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
class Page_Controller extends BaseController_Controller
{
	public function __construct()
	{
		// load database library into $this->db (can be omitted if not required)
		parent::__construct();
		$this->template->html_body_id = 'home';
	}

	public function index()
	{
		$this->course_package();
	}

	public function about_us($condition = NULL)
	{
		$this->template->title 		= $this->site_name.' ::: '.$condition;
		$this->data['active_tab'] 	= 'about';
		if($condition != ""){$cond = "about_type = '$condition'"; }
		else { $cond = "about_type = 'why saifurs'"; }
		
		// Loading Model..
		$this->aboutus = new aboutus_Model;
		$this->data['aboutus'] = $this->aboutus->get_aboutus($cond);
		$this->view_content 			= 'pages/aboutus_show';
		$this->_loadCommonTemplate();
	}

	protected function _loadCommonTemplate()
	{
		$dynamicMiddleContent = !empty($this->view_content) ? $this->view_content : 'sources/site_middle_content';
		$tempContent = array(
			'SITE_TOP_BANNER'		  	=> 	new View('sources/site_top_banner'),
			'SITE_TOP_HORI_MENU' 		=> 	new View('sources/site_top_hori_menu', $this->data),
			'SITE_SEARCH_BOX' 			=> 	new View('sources/site_search_box'),
			'SITE_MIDDLE_CONTENT' 		=> 	new View($dynamicMiddleContent, $this->data),
			'SITE_TOP_LEFT_MENU' 		=> 	new View('sources/site_top_left_menu'),
			'SITE_MIDDLE_LEFT_MENU' 	=> 	new View('sources/site_middle_left_menu'),
			'SITE_BOTTOM_LEFT_BOX' 		=> 	new View('sources/site_bottom_left_box'),
			'SITE_FOOTER_BLOCK' 		=> 	new View('sources/site_footer_block')
		);
		
		$this->template->content = arr::to_object($tempContent);
	}
} // End Page Controller