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
 * @version $Id: Menu.php 377 2009-05-21 20:49:28Z eduardbaun $
 */
class Menu_Core {

	static $instance = NULL;
	static $uri = array();

	public $items = array();
	public static $data = NULL;
	public $type = NULL;

	public function __construct($type = NULL)
	{
		$this->type = $type;

		self::$instance = $this;
	}

	public static function instance($type = NULL)
	{
		if (self::$instance === NULL)
			new Menu($type);

		self::$instance->type = $type;
		return self::$instance;
	}

	public function set_active($id)
	{
		if ($id === 0)
			return;

		$item = $this->get($id);
		$item->active = TRUE;

		$this->set_active($item->parent);
	}

	public function generate_uris()
	{
		foreach ($this->items() as $item)
		{
			if ($item->parent === 0)
			{
				$item->uri = '';

				continue;
			}

			$item->uri = $this->get($item->parent)->uri.'/'.$item->uri;
			$item->uri = trim($item->uri, '/');
		}
	}

	public function add(Menu_Item $item)
	{
		$this->items[$item->id] = $item;

		if ($item->parent > 0)
			$this->items[$item->parent]->append($item->id);
	}

	public function get($id)
	{
		return $this->items[$id];
	}

	public function __toString()
	{
		return (string) $this->render();
	}
	
	public function items()
	{
		if (empty($this->items))
		{
			if (empty(self::$data))
				self::$data = ORM::factory('page')->find_all();

			foreach (self::$data as $item)
			{
				$menu = new Menu_Item;
				$menu->id = (int) $item->id;
				$menu->title = $item->title;
				$menu->uri = $item->uri;
				$menu->parent = (int) $item->parent()->id;
				$menu->level = (int) $item->level;
	
				$this->add($menu);
	
				if ($menu->id === Router::$current_id)
					$this->set_active($menu->id);
			}
	
			$this->generate_uris();
		}
		
		return $this->items;
	}

	public function render()
	{
		if ($this->type == 'submenu')
			return $this->submenu();

		if (($cache = Cache::instance()->get('menu_'.Router::$language.'_'.Router::$current_id)) !== NULL)
			return $cache;

		foreach ($this->items() as $item)
			$item->rendered = FALSE;
		
		if (count($this->items()) === 0)
		{
			Cache::instance()->set('menu_'.Router::$language.'_'.Router::$current_id, '<ul class="menu"></ul>', array('menu'));
			return '<ul class="menu"></ul>';
		}

		$output = '<ul class="menu">';
		foreach ($this->items() as $item)
		{
			if ($item->level !== 1)
				continue;

			$output .= $item->render_without_children();
		}
		$output .= '</ul>';

		Cache::instance()->set('menu_'.Router::$language.'_'.Router::$current_id, $output, array('menu'));
		
		return $output;
	}

	public function submenu()
	{
		$cache = Cache::instance()->get('submenu_'.Router::$language.'_'.Router::$current_id);
		if ( ! empty($cache))
			return '<ul class="submenu">'.$cache.'</ul>';

		if ($cache === '')
			return '';

		if (count($this->items()) === 0)
		{
			Cache::instance()->set('submenu_'.Router::$language.'_'.Router::$current_id, '', array('menu'));
			return '';
		}

		foreach ($this->items() as $item)
			$item->rendered = FALSE;
			
		$id = $this->first_level(Router::$current_id);
		
		if ($this->get($id)->level === 0)
		{
			Cache::instance()->set('submenu_'.Router::$language.'_'.Router::$current_id, '', array('menu'));
			return '';
		}
			
			
		$output = $this->get($id)->render(TRUE);

		Cache::instance()->set('submenu_'.Router::$language.'_'.Router::$current_id, $output, array('menu'));
		
		if (empty($output))
			return '';
			
		return '<ul class="submenu">'.$output.'</ul>';
	}

	public function first_level($id)
	{
		$item = $this->get($id);
		if ($item->level <= 1)
			return $id;

		return $this->first_level($item->parent);
	}

}

class Menu_Item {

	public $id = 0;
	public $title;
	public $uri;
	public $parent = 0;
	public $level = 0;
	public $children = array();
	public $rendered = FALSE;
	public $active = FALSE;

	public function append($id)
	{
		$this->children[] = $id;
	}

	public function __toString()
	{
		return (string) $this->render();
	}

	public function render($only_children = FALSE)
	{
		$this->rendered = TRUE;

		if ($only_children === TRUE)
		{
			$output = '';
			foreach ($this->children as $child)
				$output .= Menu::instance()->get($child);

			return $output;
		}

		$class = $this->active === TRUE ? 'active' : '';

		if (empty($this->children))
			return '<li class="'.$class.'">'.html::anchor($this->uri, html::specialchars($this->title), array('class' => $class)).'</li>';

		$output = '<li class="'.$class.'">'.html::anchor($this->uri, html::specialchars($this->title), array('class' => $class));
		$output .= '<ul>';
		foreach ($this->children as $child)
			$output .= Menu::instance()->get($child)->render();

		$output .= '</ul></li>';

		return $output;
	}

	public function render_without_children()
	{
		$class = $this->active === TRUE ? 'active' : '';
		return '<li class="'.$class.'">'.html::anchor($this->uri, html::specialchars($this->title), array('class' => $class)).'</li>';
	}
}