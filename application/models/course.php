<?php defined('SYSPATH') OR die('No direct access allowed.');

class Course_Model extends Model
{
	public function __construct()
	{
		   // load database library into $this->db (can be omitted if not required)
		   parent::__construct();
	}
 
	public function get_expense()
	{		
 		$this->db->select("
 			              id,
 			              course_name,
 			              details
 		                 "); 			
		$this->db->from('course_expense');
 		$this->db->where("status = 'active'");
 		$query = $this->db->get();
 		$data = $query->result_array();
        return $data;
	}
 
	public function get_syllabus()
	{		
 		$this->db->select("
 			              id,
 			              course_name,
 			              details
 		                 "); 			
		$this->db->from('course_syllabus');
 		$this->db->where("status = 'active'");
 		$query = $this->db->get();
 		$data = $query->result_array();
        return $data;
	}
  /*
	public function insert_aboutus($data = NULL)
	{
		if($data != NULL)
		{
			$data['post_date'] = date('d-m-Y', time());
			return $this->db->insert('aboutus_check', $data);
		}else{return FALSE;}
	}
 
	public function update_aboutus($content_id, $data)
	{
		$this->db->where('id', $content_id);
		$this->db->update('aboutus', $data);
	}
 
	public function delete_aboutus($content_id)
	{
		$this->db->delete('aboutus', $content_id);
	}
	*/
}