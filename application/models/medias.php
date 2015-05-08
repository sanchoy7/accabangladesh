<?php defined('SYSPATH') OR die('No direct access allowed.');

class Medias_Model extends Model
{
	public function __construct()
	{
		   // load database library into $this->db (can be omitted if not required)
		   parent::__construct();
	}
 
	public function get_all($table = FALSE, $cond = FALSE, $use = TRUE, $order = 'ASC')
	{		
 		if($table):
			$this->db->select(" * "); 			
			$this->db->from($table);
			($use) ? $this->db->where("status = 'active'") : '';
			($cond) ? $this->db->where($cond) : '';
			$this->db->orderby('id', $order);
			return $this->db->get()->result();
		endif;
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