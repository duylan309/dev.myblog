<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Md_order extends CI_Model {
	public function __construct()
	{
		parent::__construct();	
		$this->load->library(array( 'session' , 'cart'));
	}
	
	public function AddNewOrder($data)
	{	
		$bill_id = $data;
			 
    	foreach($this->cart->contents() as $items): 
           $array = array( "id"=>NULL,
						   "product_id"=>$items['id'],
						   "quantity"=>$items['qty'],
						   "price"=>$items['subtotal'],
						   "color"=>0,
						   "size"=>0,
						   "date_order"=>mktime(),
						   "bill_id"=>$bill_id
					      );	
		   $this->db->insert('order', $array);	
      	endforeach;
		
		return true;
	}
}


/* End of file md_buyer.php */
/* Location: ./application/models/main/md_buyer.php */