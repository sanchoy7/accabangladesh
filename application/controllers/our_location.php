<?php defined('SYSPATH') OR die('No direct access allowed.');
include_once("BaseController.php");
/**
 * Gmaps module demo controller. This controller should NOT be used in production.
 * It is for demonstration purposes only!
 *
 * $Id: gmaps_demo.php 3769 2008-12-15 00:48:56Z zombor $
 *
 * @package    Gmaps
 * @author     Woody Gilk
 * @copyright  (c) 2007-2008 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Our_Location_Controller extends BaseController_Controller
{

	// Do not allow to run in production
	const ALLOW_PRODUCTION = FALSE;
	
	public function __construct()
	{
		// load database library into $this->db (can be omitted if not required)
		parent::__construct();
		$this->template->html_body_id = 'location';
	}

	public function index()
	{
		// Create a new Gmap
		$map = new Gmap('map', array
		(
			'ScrollWheelZoom' => TRUE,
		));

		// Set the map center point
		$map->center(23.750514, 90.388061, 18, 'G_HYBRID_MAP')->controls('large')->types('G_PHYSICAL_MAP', 'add');

		// Add a custom marker icon
		$map->add_icon('tinyIcon', array
		(
			'image' 		   => 'http://labs.google.com/ridefinder/images/mm_20_red.png',
			'shadow' 		   => 'http://labs.google.com/ridefinder/images/mm_20_shadow.png',
			'iconSize'         => array('20', '30'),
			'shadowSize' 	   => array('22', '20'),
			'iconAnchor' 	   => array('6', '20'),
			'infoWindowAnchor' => array('5', '1')
	    ));

		// Add a new marker
		$map->add_marker(23.750514, 90.388061, '<strong><br /><h2>S@ifur`s University College</h2><br />69/B, Monowara Plaza, Green Road,<br />Panthopath, Dhaka-1205, Bangladesh.</strong><p>Welcome To S@ifurs University College.</p>', array('icon' => 'tinyIcon', 'draggable' => true, 'bouncy' => true));
		$this->data['api_url'] = Gmap::api_url();
		$this->data['map'] 	   = $map->render();
		
		$this->template->title 		= $this->site_name.' ::: Where we are located';
		$this->data['active_tab'] 	= 'location';
		$this->view_content 		= 'pages/our-location';
		$this->_loadCommonTemplate();
	}
} // End Google Map Controller