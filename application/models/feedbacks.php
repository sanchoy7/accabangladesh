<?php defined('SYSPATH') OR die('No direct access allowed.');

class Feedbacks_Model extends Model
{
	public function __construct($id = NULL)
	{
		   // load database library into $this->db (can be omitted if not required)
		   parent::__construct($id);
	}
 
	public function get_feedback($content_id)
	{
		$this->db->where('id', $content_id);
		return $this->db->get('feedback');
	}
 
	public function insert_feedback($data = NULL)
	{
		if($data != NULL)
		{
			$data['post_date'] = date('d-m-Y', time());
			return $this->db->insert('feedback', $data);
		}else{return FALSE;}
	}
 
	public function update_feedback($content_id, $data)
	{
		$this->db->where('id', $content_id);
		$this->db->update('feedback', $data);
	}
 
	public function delete_feedback($content_id)
	{
		$this->db->delete('feedback', $content_id);
	}
}