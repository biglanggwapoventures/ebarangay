<?php

class Users extends EB_Controller
{

	protected $tab_title = 'Users';
	protected $active_nav = NAV_USERS;
	protected $fields = ['username', 'firstname', 'lastname', 'password', 'position', 'gender', 'birthdate', 'current_address', 'role', 'modules'];

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
	}

	public function index()
	{
		$this->generate_page('users/listing', [
			'items' => $this->user->all()
		]);
	}

	public function create()
	{
		$view_bag = [];
		if($this->input->method(TRUE) === 'POST'){
			$this->_peform_validation(MODE_CREATE);
			if($this->form_validation->run()){
				$data = $this->_format_data(MODE_CREATE);
				$this->user->create($data['user'], $data['permission']);
				redirect('users');
			}
		}
		$this->import_page_script('manage-users.js');
		$view_bag['title'] = 'Create new user';
		$view_bag['mode'] = MODE_CREATE;
		$view_bag['data'] = elements($this->fields, $this->input->post(), FALSE);
		$this->generate_page('users/manage', $view_bag);
	}

	public function edit($id = FALSE)
	{
		if(!$id || !$user = $this->user->get($id)){
			show_404();
		}
		$view_bag = [];
		if($this->input->method(TRUE) === 'POST'){
			$this->_peform_validation(MODE_EDIT);
			if($this->form_validation->run()){
				$data = $this->_format_data(MODE_EDIT);
				$this->user->update($id, $data['user'], $data['permission']);
				redirect('users');
			}
			$view_bag['data'] = elements($this->fields, $this->input->post(), FALSE);
			$view_bag['data']['id'] = $id;
			$view_bag['data']['username'] = $user['username'];
		}else{
			$view_bag['data'] = $user;
		}
		$this->import_page_script('manage-users.js');
		$view_bag['title'] = 'Update user';
		$view_bag['mode'] = MODE_EDIT;
		$this->generate_page('users/manage', $view_bag);
	}

	public function _format_data($mode)
	{
		$input = elements($this->fields, $this->input->post());
		$permissions = $input['role'] === ROLE_SUPERUSER ? [] : $input['modules'];
		if($mode === MODE_EDIT){
			unset($input['username']);
			if($input['password']){
				$input['password'] = md5($input['password']);
			}else{
				unset($input['password']);
			}
		}
		unset($input['modules']);
		return [
			'user' => $input,
			'permission' => $permissions
		];
		
	}

	public function _peform_validation($mode)
	{
		if($mode === MODE_CREATE){
			$this->form_validation->set_rules('username', 'username', 'required|is_unique[user.username]');
		}else{
			$this->form_validation->set_rules('password', 'password', 'min_length[8]');
			$this->form_validation->set_rules('confirm_password', 'password confirmation', 'matches[password]');
		}
		$this->form_validation->set_rules('firstname', 'first name', 'required');
		$this->form_validation->set_rules('lastname', 'last name', 'required');
		$this->form_validation->set_rules('position', 'position', 'required');
		$this->form_validation->set_rules('gender', 'gender', 'required|in_list[f,m]', ['in_list' => 'Please select a valid %s']);
		$this->form_validation->set_rules('birthdate', 'birthdate', 'required|callback__validate_birthdate');
		$this->form_validation->set_rules('current_address', 'current address', 'required');
		$this->form_validation->set_rules('role', 'role', 'callback__validate_role');
	}

	public function _validate_birthdate($date)
	{
		$this->form_validation->set_message('_validate_birthdate', 'The %s must be in format: mm/dd/yyyy');
		return is_valid_date($date, 'm/d/Y');
	}

	public function _validate_role($role)
	{
		if(!$role || !in_array($role, roles())){
			$this->form_validation->set_message('_validate_role', 'Please select a valid %s.');
			return FALSE;
		}
		if($role !== ROLE_SUPERUSER){
			$this->form_validation->set_message('_validate_role', 'Please select at least one module.');
			$modules = $this->input->post('modules');
			if(is_array($modules)){
				$permitted_modules = array_filter($modules, function($var){
					return in_array($var, modules());
				});
				if(empty($permitted_modules)){
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}
		return TRUE;
	}

}