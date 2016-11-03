<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Md_contact extends CI_Model {
	public function Savecontact($data)
	{	
		$array = array( "id"=>NULL,
						"fullname"=>$data['fullname'],
						"email"=>$data['email'],
						"title"=>$data['subject'],
						"date"=>mktime(),
						"content"=>$data['content'],
						"phone"=>$data['phone'],
						"status"=>0);
		
		$this->db->insert('contact', $array);	
		$id = $this->db->insert_id();
		return $id;
	}
}


/* End of file md_buyer.php */
/* Location: ./application/models/main/md_buyer.php */