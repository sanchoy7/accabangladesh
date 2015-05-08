<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Common Core helper class.
 */
class common_Core
{
	/**
	 * Holds an array stack.
	 *
	 * @param   none
	 * @returns loaded array
	 */
	public static function statusOptions()
	{
		$array = array (
						''         => 'Select Content Status',
						'active'   => 'Active Content',
						'inactive' => 'Inactive Content'
					   );
						
		return $array;
	}
	
	/**
	 * Holds an array stack.
	 *
	 * @param   none
	 * @returns loaded array
	 */
	public static function webLinkOptions()
	{
		$array = array (
						''        				=> 'Select Web Link Category',
						'ACCA Related Web Link' => 'ACCA Related Web Link',
						'Ads Related Web Link' 	=> 'Ads Related Web Link'
					   );
						
		return $array;
	}

	/**
	 * Holds an array stack.
	 *
	 * @param   none
	 * @returns loaded array
	 */
	public static function paymentStatus()
	{
		$array = array (
						''         	=> 'Select Payment Status',
						'Due'   	=> 'Payment Due',
						'Paid' 		=> 'Payment Paid',
						'Pending'   => 'Payment Pending'
					   );
						
		return $array;
	}

	/**
	 * Holds an array stack.
	 *
	 * @param   none
	 * @returns loaded array
	 */
	public static function neTypeOptions()
	{
		$array = array (
						''       => 'Select Content Type',
						'news'   => 'News',
						'event'  => 'Event'
					   );
						
		return $array;
	}
	
	/**
	 * Holds an array stack.
	 *
	 * @param   none
	 * @returns loaded array
	 */
	public static function courseTypeOptions()
	{
		$array = array (
						''          => 'Select Content Type',
						'expense'   => 'Expense',
						'syllabus'  => 'Syllabus',
						'package'   => 'Package'
					   );
						
		return $array;
	}
	
	/**
	 * Recursively convert an Object to an array.
	 *
	 * @param   object   object to convert
	 * @return  array
	 */
	public static function objectToArray($objects = NULL)
    {
		if(!empty($objects))
		{
			$keys[]   = '';
			$values[] = 'Select One From The List';
			
			foreach($objects as $key => $value):
				$keys[]   = $key;
				$values[] = ucwords($value);
			endforeach;
			
			return array_combine($keys, $values);
		}
    }
	
	/**
	 * Recursively convert an Object to an array.
	 *
	 * @param   object   object to convert
	 * @return  array
	 */
	public static function objectToArrayWithKey($objects = NULL)
    {
		if(!empty($objects))
		{
			$keys[]   = '';
			$values[] = 'Select One From The List';
			
			foreach($objects as $key => $value):
				$keys[]   = $key;
				$values[] = ucwords($value).' ('.$key.')';
			endforeach;
			
			return array_combine($keys, $values);
		}
    }
	
	/**
	 * Recursively convert an Object to an array.
	 *
	 * @param   object   object to convert
	 * @return  array
	 */
	public static function objectToArrayWithValue($objects = NULL)
    {
		if(!empty($objects))
		{
			$keys[]   = '';
			$values[] = 'Select One From The List';
			
			foreach($objects as $key => $value):
				$keys[]   = $key;
				$values[] = ucwords($key).' ('.$value.')';
			endforeach;
			
			return array_combine($keys, $values);
		}
    }
	
	/**
	 * Upload file helper.
	 *
	 * @param  none
	 * @return  string
	 */
	public function upload_file($attributes)
	{
		$this->auto_render = FALSE;
		$attributes = arr::to_object($attributes);
		
		$files = Validation::factory($_FILES);
		if($attributes->validate){ $files->add_rules($attributes->file, 'upload::valid'); }
		if($attributes->required){ $files->add_rules($attributes->file, 'upload::required'); }
		if($attributes->types){ $files->add_rules($attributes->file, 'upload::type['.$attributes->types.']'); }
		if($attributes->size){ $files->add_rules($attributes->file, 'upload::size['.$attributes->size.']'); }

		if ($files->validate())
		{
			// Temporary file name
			$filename  =  md5(uniqid(mt_rand())).upload::get_extension(basename($_FILES[$attributes->file]['name']));
			$directory =  ($attributes->path) ? DOCROOT.$attributes->path : DOCROOT.'public/archive/';
		
			if($attributes->crop){
				$this->image = new Image($_FILES[$attributes->file]['tmp_name']);
				$this->image->crop($attributes->width, $attributes->height, 'center', 'center')->sharpen(15)->quality(75)->save(DOCROOT.'public/uploads/thumbnails/'.$filename);
			}
		
			Upload::save($attributes->file, $filename, $directory, 0777);
			return $filename;
		}
	}
} // End Common_Core Helper Class