<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Md_bill extends CI_Model {

	public function AddNewBill($data)
	{	
		$array = array( "id"=>NULL,
						"date"=>$data['date'],
						"status"=>0,
						"buyer_id"=>$data['buyer_id'],
						"total"=>$data['total_price'],
						"address_delivery"=>$data["address_delivery"],
						"more_information"=>$data["more_information"],
					  );
							
		$this->db->insert('bill_information', $array);	
		$id = $this->db->insert_id();
		return $id;
	}
}


/* End of file md_buyer.php */
/* Location: ./application/models/main/md_buyer.php */