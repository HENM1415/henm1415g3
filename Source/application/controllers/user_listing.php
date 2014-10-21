<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_listing extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}

	function list_users(){
		$name_str = $this->input->get("name_str");

		$is_logged_in = $this->session->userdata('is_logged_in');

		if (!isset($is_logged_in) || TRUE != $is_logged_in)
		{
			echo "You need to log in to see the list of users.";
		}
		else
		{
			$query = $this->users_model->search_user_by_name($name_str);
			$data = array('query' => $query);
			$this->load->view('v_search_results', $data);
		}
	}
}