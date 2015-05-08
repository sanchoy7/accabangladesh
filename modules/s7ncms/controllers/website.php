<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * S7Ncms - www.s7n.de
 *
 * Copyright (c) 2007-2009, Eduard Baun <eduard at baun.de>
 * All rights reserved.
 *
 * See license.txt for full text and disclaimer
 *
 * @author Eduard Baun <eduard at baun.de>
 * @copyright Eduard Baun, 2007-2009
 * @version $Id: website.php 357 2009-05-16 17:45:25Z eduardbaun $
 */
class Website_Controller extends Template_Controller {

	public $cache_enabled = FALSE;

	public function __construct()
	{
		parent::__construct();

		$this->session = Session::instance();
		$this->head = Head::instance();
		$this->head->css->append_file('public/themes/'.config::get('s7n.theme').'/css/layout');
		$this->head->title->set(config::get('s7n.site_title'));

		$this->template->set_global('theme_url', 'public/themes/'.config::get('s7n.theme').'/');
		$this->template->head = $this->head;
	}
}
