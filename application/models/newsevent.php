<?php defined('SYSPATH') OR die('No direct access allowed.');

class Newsevent_Model extends Model
{
	public function __construct()
	{
		   // load database library into $this->db (can be omitted if not required)
		   parent::__construct();
	}
	
	public function get_all_news_event()
	{		
 		$this->db->select("
 			              id,
 			              ne_title,
						  ne_type,
 		                 "); 			
		$this->db->from('news_events');
 		$this->db->where("status = 'active'");
		$this->db->orderby('id','DESC');
 		$query = $this->db->get();
 		$data = $query->result_array();
        return $data;
	}

	public function get_news_event()
	{		
 		$this->db->select("
 			              id,
 			              ne_title,
						  ne_type,
 		                 "); 			
		$this->db->from('news_events');
 		$this->db->where("status = 'active'");
		$this->db->limit('5');
		$this->db->orderby('id','DESC');
 		$query = $this->db->get();
 		$data = $query->result_array();
        return $data;
	}
 
	public function get_news_event_details($neId=NULL)
	{		
		$this->db->select("
 			              id,
 			              ne_title,
						  ne_type,
						  ne_photo,
						  ne_details,
						  created,
 		                 "); 			
		$this->db->from('news_events');
 		$this->db->where("status = 'active' && id = '$neId'");
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