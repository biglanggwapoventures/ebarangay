<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function attempt()
	{
		$this->output->set_content_type('json');
		$this->load->model('User_model', 'user');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run()){
			$credentials = [
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
			];
			$user = $this->user->get(FALSE, $credentials);
			if($user){
				$this->session->set_userdata($user);
				$this->output->set_output(json_encode(['result' => TRUE]));
				return;
			}
			$this->output->set_output(json_encode([
				'result' => FALSE,
				'errors' => ['Invalid username or password.']
			]));
			return;
		}
		$this->output->set_output(json_encode([
			'result' => FALSE,
			'errors' => array_values($this->form_validation->error_array())
		]));
	}

}
