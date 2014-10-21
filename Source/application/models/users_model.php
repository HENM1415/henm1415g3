<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
{
	private static $table_name = 'users';

	function validate($email, $password)
	{
		$this->db->where('email', $email);
		$query = $this->db->get(self::$table_name);
	
		if (1 == $query->num_rows())
		{
			$user = $query->row();
			if (strtolower(md5($password)) == strtolower($user->password))
			{
				return $query;
			}
	
		}
		return FALSE;
	}
	
	function insert_user($email, $password, $first_name, $last_name, $birthdate, $city, $country, $gender, $orientation, $filename)
	{
		$this->db->set('email', $email);
		$this->db->set('password', md5($password));
		$this->db->set('first_name', $first_name);
		$this->db->set('last_name', $last_name);
		$this->db->set('birthdate', $birthdate);
		$this->db->set('city', $city);
		$this->db->set('country', $country);
		$this->db->set('gender', $gender);
		$this->db->set('orientation', $orientation);
		
		$this->db->insert(self::$table_name);
		return $this->db->insert_id();
	}
	
	
	function get_user($user_id)
	{
		$this->db->select('*');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get(self::$table_name);

		if (0 == $query->num_rows())
		{
			return FALSE;
		}
		else
		{
			return $query->row();
		}
	}
	
	function search_user_by_name($name_str){
		$name_str = urldecode($name_str);
		$name_arr = explode(" ", $name_str);
		$this->db->select('*');
		
		if($name_str === ""){
			//do nothing
		} elseif(count($name_arr) == 1){
			$this->db->where('first_name', $name_str);
			$this->db->or_where('last_name', $name_str);
		} elseif (count($name_arr) == 2) {
			$this->db->where('first_name', $name_arr[0]);
			$this->db->where('last_name', $name_str[1]);
		}
		
		return $this->db->get(self::$table_name);
	}
}