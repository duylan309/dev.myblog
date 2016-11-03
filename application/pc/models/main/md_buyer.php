<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Md_buyer extends CI_Model {

	public function AddNewBuyer($data)
	{	
		$array = array( "id"=>NULL,
						"firstname"=>$data['firstname'],
						"lastname"=>$data['lastname'],
						"phone"=>$data['phone'],
						"date"=>mktime(),
						"address"=>$data["address"],
						"email"=>$data["email"],
					  );
							
		$this->db->insert('buyer', $array);	
		$id = $this->db->insert_id();
		return $id;
	}
}


/* End of file md_buyer.php */
/* Location: ./application/models/main/md_buyer.php */