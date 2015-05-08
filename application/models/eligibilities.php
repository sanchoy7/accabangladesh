<?php defined('SYSPATH') OR die('No direct access allowed.');

class Eligibilities_Model extends Model
{
	public function __construct($id = NULL)
	{
		   // load database library into $this->db (can be omitted if not required)
		   parent::__construct($id);
	}
 
	public function get_eligibility($content_id)
	{
		$this->db->where('id', $content_id);
		return $this->db->get('eligibility');
	}
 
	public function insert_eligibility($data = NULL)
	{
		if($data != NULL)
		{
			$data['post_date'] = date('d-m-Y', time());
			return $this->db->insert('eligibility_check', $data);
		}else{return FALSE;}
	}
 
	public function update_eligibility($content_id, $data)
	{
		$this->db->where('id', $content_id);
		$this->db->update('eligibility', $data);
	}
 
	public function delete_eligibility($content_id)
	{
		$this->db->delete('eligibility', $content_id);
	}
}