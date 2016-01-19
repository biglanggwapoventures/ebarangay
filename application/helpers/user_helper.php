<?php

if(!function_exists('user_full_name')){
	function user_full_name()
	{
		$CI =& get_instance();
		return $CI->session->userdata('firstname').' '.$CI->session->userdata('lastname');
	}
}

if(!function_exists('user_id_number')){
	function user_id_number()
	{
		$CI =& get_instance();
		return $CI->session->userdata('username');
	}
}

if(!function_exists('user_id')){
	function user_id()
	{
		$CI =& get_instance();
		return $CI->session->userdata('id');
	}
}

if(!function_exists('modules')){
	function modules()
	{
		return [MODULE_ITEM_DATA, MODULE_BORROW_REQUESTS, MODULE_ITEM_MAINTENANCE, MODULE_ITEM_ADJUSTMENTS];
	}
}


if(!function_exists('roles')){
	function roles()
	{
		return [ROLE_SUPERUSER, ROLE_ADMIN, ROLE_STANDARD];
	}
}


if(!function_exists('user_has_access_to')){
	function user_has_access_to($module_name)
	{
		$CI =& get_instance();
		if($CI->session->userdata('role') === ROLE_SUPERUSER){
			return TRUE;
		}
		return in_array($module_name, $CI->session->userdata('modules'));
	}
}