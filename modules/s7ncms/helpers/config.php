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
 * @version $Id: config.php 271 2009-03-03 23:31:55Z eduardbaun $
 */
class config_Core {

	public static function set($key, $value)
	{
		$keys = explode('.', $key);

		if (count($keys) === 2)
		{
			$db = Database::instance();

			$count = $db
				->where(array('context' => $keys[0], 'key' => $keys[1]))
				->count_records('config');

			if ($count > 0)
			{
				$db->update(
					'config',
					array('value' => $value),
					array('context' => $keys[0], 'key' => $keys[1])
				);
			}
			else
			{
				$db->insert(
					'config',
					array('context' => $keys[0], 'key' => $keys[1], 'value' => $value)
				);
			}
		}
	}

	public static function get($key)
	{
		return Kohana::config($key);
	}

	public static function load()
	{
		$query = Database::instance()
			->select('context, key, value')
			->get('config');

		$result = $query->result();

		foreach ($result as $item)
			if(Kohana::find_file('config', $item->context))
			{
				Kohana::config_set($item->context.'.'.$item->key, $item->value);
			}
	}
}