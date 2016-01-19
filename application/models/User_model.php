<?php

class User_model extends CI_Model
{

    protected $table = 'user';

    public function all()
    {
    	$this->db->order_by('lastname', 'ASC');
    	return $this->db->get($this->table)->result_array();
    }

    public function get($id = FALSE, $credentials = FALSE)
    {
        if($id){
            $this->db->where('id', $id);
        }else{
            $this->db->where($credentials);
        }
        $user = $this->db->select('id,username,firstname,lastname,gender,birthdate,current_address,position,role,is_locked')->from($this->table)->get()->row_array();
        if($user){
            $user['birthdate'] = date('m/d/Y', strtotime($user['birthdate']));
            $user['modules'] = array_column($this->db->get_where('user_permission', ['user_id' => $user['id']])->result_array(), 'module');
        }
        return $user;
    }

    public function create($data, $module_access = FALSE)
    {
    	
    	$permissions = [];
    	$data['birthdate'] = date('Y-m-d', strtotime($data['birthdate']));
        $data['password'] = md5($data['username']);

    	$this->db->trans_start();

    	$this->db->insert($this->table, $data);
    	$id = $this->db->insert_id();

        $this->db->delete('user_permission', ['user_id' => $id]);
    	if($module_access){
    		foreach($module_access AS $module){
    			$permissions[] = ['user_id' => $id, 'module' => $module];
    		}
    		$this->db->insert_batch('user_permission', $permissions);
    	}

    	$this->db->trans_complete();

    	return $this->db->trans_status();
    	
    }

    public function update($id, $data, $module_access = FALSE)
    {

        $permissions = [];
        $data['birthdate'] = date('Y-m-d', strtotime($data['birthdate']));
        unset($data['username']);

        $this->db->trans_start();

        $this->db->update($this->table, $data, ['id' => $id]);

        $this->db->delete('user_permission', ['user_id' => $id]);
        if($module_access){
            foreach($module_access AS $module){
                $permissions[] = ['user_id' => $id, 'module' => $module];
            }
            $this->db->insert_batch('user_permission', $permissions);
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
        
    }
}
