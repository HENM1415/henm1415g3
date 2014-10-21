<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_listing extends CI_Controller {
	
	private static $table_name = 'users';
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}
	
	function list_users(){
	
		$is_logged_in = $this->session->userdata('is_logged_in');
	
		if (!isset($is_logged_in) || TRUE != $is_logged_in)
		{
			echo "You need to log in to see the list of users.";
		}
		else
		{
			//$this->load->view('v_userlisting');
			
			$this->db->select('*');
			$query = $this->db->get(self::$table_name);
			
			foreach($query->result() as $row){
				print_r($row);
			}
		}
	}
}