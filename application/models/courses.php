<?php defined('SYSPATH') OR die('No direct access allowed.');

class Courses_Model extends Model
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
		$this->db->from('course_expense_syllabus');
 		$this->db->where("status='active' && course_type='expense'");
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
		$this->db->from('course_expense_syllabus');
 		$this->db->where("status='active' && course_type='syllabus'");
 		$query = $this->db->get();
 		$data = $query->result_array();
        return $data;
	}
	
	public function get_package()
	{		
 		$this->db->select("
 			              id,
 			              course_name,
 			              details
 		                 "); 			
		$this->db->from('course_expense_syllabus');
 		$this->db->where("status='active' && course_type='package'");
 		$query = $this->db->get();
 		$data = $query->result_array();
        return $data;
	} 
}