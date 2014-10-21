<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}

	function index()
	{
		//
		// if already logged in, redirect.
		//
		$is_logged_in = $this->session->userdata('is_logged_in');
		if (!isset($is_logged_in) || TRUE != $is_logged_in)
		{
			$this->load->view('v_login');
		}
		else
		{
			redirect('profile');
		}
	}

	// --------------------------------------------------------------------

	function validate_credentials()
	{
		$query = $this->users_model->validate($this->input->post('email'), $this->input->post('password'));
		if (TRUE == $query)
		{
			$row = $query->row();
			$data = array(
					'user_id' => $row->user_id,
					'is_logged_in' => TRUE
			);
			$this->session->set_userdata($data);

			redirect('profile');
		}
		else
		{
			$data = array();
			if ($this->input->post('email'))
				$data = array('wrong_password' => TRUE);
			$this->load->view('v_login', $data);
		}
	}

	// --------------------------------------------------------------------

	function logout()
	{
		$this->session->sess_destroy();
		$data = array();
		$this->load->view('v_login', $data);
	}

	// --------------------------------------------------------------------

	function registration()
	{
		if ($this->input->post('submit_registration'))
		{
			/**
			 * Set validation rules
			 */
			$this->load->library('form_validation');
			$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
			$this->form_validation->set_rules('birthdate', 'Date of Birth', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');

			$this->form_validation->set_rules('email', 'Email address', 'trim|valid_email|required|is_unique[users.email]');
			$this->form_validation->set_message('is_unique', 'An account with the email provided is already registered.');

			if (FALSE == $this->form_validation->run())
			{
				$this->load->view('v_register');
			}
			else
			{
				$filename = '';
				if (!empty($_FILES['userfile']['name']))
				{
					$config['upload_path'] = FCPATH . '/user_pictures/';
					$config['allowed_types'] = 'jpg|jpeg';
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload', $config);

					if ( ! $this->upload->do_upload())
					{
						log_message('error', $this->upload->display_errors());
						$filename = '';
						return FALSE;
					}
					else
					{
						$upload_data = $this->upload->data();
						/* read the source image */
						$source_image = imagecreatefromjpeg(FCPATH . '/user_pictures/'.$upload_data['file_name']);
						$width = imagesx($source_image);
						$height = imagesy($source_image);
						$desired_width = 300;
						/* find the "desired height" of this thumbnail, relative to the desired width  */
						$desired_height = floor($height * ($desired_width / $width));
						// @todo cropping needs to be done correctly, this is a wrong solution...
						$desired_height = $desired_height > $desired_width ? 120 : $desired_height;
						/* create a new, "virtual" image */
						$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
						/* copy source image at a resized size */
						imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
						/* create the physical thumbnail image to its destination */
						imagejpeg($virtual_image, FCPATH . '/user_pictures/thumb_'.$upload_data['file_name']);
						$filename = $upload_data['file_name'];
					}
				}

				$coords = $this->input->post('coordinates');
				$coords = substr($coords, 1);
				$coords = substr($coords, 0, strlen($coords) - 1);
				$latlon = split(',', $coords);
				$lat = $latlon[0];
				$lon = $latlon[1];
				
				// validate password = password_ref
				$user_id = $this->users_model->insert_user(
						$this->input->post('email'),
						$this->input->post('password'),
						$this->input->post('first_name'),
						$this->input->post('last_name'),
						$this->input->post('birthdate'),
						$this->input->post('city'),
						$this->input->post('country'),
						$this->input->post('gender'),
						$this->input->post('orientation'),
						$lat,
						$lon,
						$filename
				);
				redirect('login');
			}


		}
		else
		{
			$this->load->view('v_register');
		}
	}

	function show_profile($user_id = NULL)
	{
		if (!$this->session->userdata('is_logged_in'))
		{
			show_error('Please log in first: '.anchor('/'), 403);
		}
		if (NULL === $user_id)
		{
			// show user's own profile
			$user_id = $this->session->userdata('user_id');
		}

		$user = $this->users_model->get_user($user_id);
		if (NULL != $user)
		{
			$data = array(
					'user_id' => $user->user_id,
					'email' => $user->email,
					'first_name' => $user->first_name,
					'last_name' => $user->last_name,
					'birthdate' => $user->birthdate,
					'city' => $user->city,
					'country' => $user->country,
					'gender' => $user->gender,
					'orientation' => $user->orientation
			);
			$data['data'] = $data;

			
		}
		else
		{
			$data['error'] = 'No user found with id '. $user_id;
		}
		
		if ($this->session->userdata('user_id') == $user_id)
		{
			$nearest_user = $this->users_model->find_nearest_users($user->lat, $user->lon);
			$data['nearest_user'] = $nearest_user;			
		}
		
		$this->load->view('test_profile', $data);
	}
}