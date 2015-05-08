<?php defined('SYSPATH') OR die('No direct access allowed.');

class Signup_Model extends Model
{
	public function __construct($id = NULL)
	{
		   // load database library into $this->db (can be omitted if not required)
		   parent::__construct($id);
	}
 
	public function get_user($user_id)
	{
		$this->db->where('id', $user_id);
		return $this->db->get('users');
	}
 
	public function create_user($data = NULL)
	{
		if($data != NULL)
		{
			$data['registered_on'] = date("Y-m-d H:i:s", time());
			$data['password'] = Auth::instance()->hash_password($data['password']);
			return $this->db->insert('users', $data);
		}else{return FALSE;}
	}
 
	public function update_user($user_id, $data)
	{
		$this->db->where('id', $user_id);
		$this->db->update('users', $data);
	}
 
	public function delete_user($user_id)
	{
		$this->db->delete('users', $user_id);
	}
 
	public function check_user_existance($username)
	{
		return $this->db->where('username', $username)->count_records('users');
	}
	
	public function check_email_existance($email)
	{
		return $this->db->where('email', $email)->count_records('users');
	}
 
	public function set_user_role($username)
	{
		$users = $this->db->where('username', $username)->get('users');
		$roles = $this->db->where('name', 'login')->get('roles');
		foreach($users as $user){}
		foreach($roles as $role){}
		return $this->db->insert('roles_users', array('user_id' => $user->id, 'role_id' => $role->id));
	}
}