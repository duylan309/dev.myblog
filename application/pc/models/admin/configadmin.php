<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Configadmin extends CI_Model
{
	//this is the expiration for a non-remember session

	public function CheckAdmin($username,$password){
					
		$pass = md5(mysql_real_escape_string($password));
		$user = mysql_real_escape_string($username);
				
		$this->db->select('*');
		$this->db->where('useradmin', $user);
		$this->db->where('passadmin', $pass);
		$this->db->limit(1);
		$result = $this->db->get('adminuser');
		$result = $result->row_array();
		
		if (sizeof($result) > 0)
		{
			$expiration = mktime(); // Two hour limit
		    $this->db->where('expire <', $expiration);
		    $this->db->delete('login');
			$array= array(  "id"	   => NULL,
							"admin"	   => $result['useradmin'],
							"email"    => $result['email'],
							"ip" 	   => $this->input->ip_address(),
							"time" 	   => mktime());
			
			$this->db->insert('login', $array);	
			$id = $this->db->insert_id();
			
			//////////////////////////////////////////////////
			$admin = array();
			$admin			    = array();
			$admin['id']		= $result['id'];
			$admin['useradmin'] = $result['useradmin'];
			$admin['email'] 	= $result['email'];
			$admin['loginid']   = $id;
			$this->session->set_userdata('admin',$admin);
			$this->session->unset_userdata('error_count');			
			return true;
		}
		else{
			$error_count = $this->session->userdata('error_count');
			if($this->session->userdata('error_count')){
				$this->session->set_userdata('error_count', $error_count+1);
			}else{
				$this->session->set_userdata('error_count', 1);
			}
			
			return false;
		}
		
	}
	
	public function checkTime($id){
		$this->db->select('expire');
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query  = $this->db->get('login');
		$result = $query->result();
 		$result = $result[0]->expire;
		return $result;
	}
	
	public function allAdmin(){
		return $this->db->query('select * from adminuser');
	}
	
}