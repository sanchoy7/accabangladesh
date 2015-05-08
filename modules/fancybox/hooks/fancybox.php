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
 * @version $Id: fancybox.php 353 2009-05-15 13:24:04Z eduardbaun $
 */

Event::add('s7n.theme.head', 'fancybox::head');
Event::add('s7n.display_content', 'fancybox::replace_content');