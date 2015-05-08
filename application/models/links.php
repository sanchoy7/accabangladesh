<?php defined('SYSPATH') OR die('No direct access allowed.');

class Links_Model extends Model
{
	public function __construct()
	{
		   // load database library into $this->db (can be omitted if not required)
		   parent::__construct();
	}
 
	public function get_link()
	{		
 		$this->db->select("
 			              id,
 			              link_title,
 			              link_url
 		                 "); 			
		$this->db->from('weblinks');
 		$this->db->where("status='active'");
 		$query = $this->db->get();
 		$data = $query->result_array();
        return $data;
	}
}