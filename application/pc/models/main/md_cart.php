<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Md_cart extends CI_Model {
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->library(array( 'session' , 'cart'));
		
	}
	// Function to retrieve an array with all product information
	function retrieve_products(){
		$query = $this->db->get('product');
		return $query->result_array();
	}
	
	function validate_update_cart(){
		
		// Get the total number of items in cart
		$total = count($this->cart->contents());
 
		// Retrieve the posted information
		$item = $this->input->post('rowid');
	    $qty = $this->input->post('qty');

		// Cycle true all items and update them
		for($i=0;$i < $total;$i++)
		{
			// Create an array with the products rowid's and quantities. 
			$data = array(
               'rowid' => $item[$i],
               'qty'   => $qty[$i]
            );
            
            // Update the cart with the new information
			$this->cart->update($data);
		}

	}
	
	// Add an item to the cart
	function validate_add_cart_item(){
		
		$id 		= $this->input->post('product_id'); // Assign posted product_id to $id
		$cty 	   = $this->input->post('quantity'); // Assign posted quantity to $cty
		//$color	 = explode('/',$this->input->post('color'));
	//	$size	  = explode('/',$this->input->post('size'));	
		
	//var_dump($id);	
		$this->db->where('id', $id); // Select where id matches the posted id
		$query 	 = $this->db->get('product');
		
		
		 // Select the products where a match is found and limit the query by 1
		
				
		// Check if a row has been found
		if($query->num_rows > 0){
		
			foreach ($query->result() as $row)
			{
				 $price = $row->price;
				 $data  = array(
               		'id'      	   => $row->id,
               		'qty'          => $cty,
               		'price'        => $price,
					'image'        => $row->image,
               		'name'         => $row->title_en,
				//	'options'      => array('Sizeid'  => $size[0],
											//'SizeT'   => $size[1],
										//	'ColorI'  => $color[1], 
									     //   'Colorid' => $color[0]),
            	);
					
				$this->cart->insert($data); 
				return TRUE;
			}
		
		// Nothing found! Return FALSE!	
		}else{
			return FALSE;
		}
	}
	
	// Needed?
	//function cart_content(){
	//	return $this->cart->total();
	//}
	
	public function addBill($array){
		$array = array(     "id"=>NULL,
							"date_create"  => $array['date_create'],
							"status"       => 0,
							"method"	   => $array['method'],
							"sku"          => $array['vpc_MerchTxnRef'],
							"member_id"	=> $array['member_id'],
							"name"		 => $array['name_delivery'],
							"total"		=> $array['vpc_Amount'],
							"address"	  => $array["AVS_Street01"],
							"district"	 => $array["AVS_StateProv"],
							"city"	     => $array["AVS_City"],
							"country"      => $array["AVS_Country"],
							"phone"		=> $array["phone_delivery"]);
							
		$this->db->insert('billinformation', $array);	
		$id = $this->db->insert_id();
		return $id;
	}
	
	/*public function addBill($array){
		$sku = 0;
		$random_number = random_string('numeric',8);
		do {
			$sku = $this->md_cart->checkRandomSKU($random_number,'billinformation');
			if($sku==1)
				break;
			else		
				$random_number= random_string('numeric',8);
		} while ($sku==1);
		
		if($sku==1):
		$array = array(     "id"=>NULL,
							"date_create"  => $array['date_create'],
							"status"       => 0,
							"sku"          => $random_number,
							"member_id"	=> $array['member_id'],
							"name"		 => $array['name_delivery'],
							"total"		=> $array['total'],
							"address"	  => $array["address_delivery"],
							"phone"		=> $array["phone_delivery"]);
							
		$this->db->insert('billinformation', $array);	
		endif;
		$id = $this->db->insert_id();
		return $id;
	}*/
	
	public function addOrder($array){
			$array = array( "id"=>NULL,
							"product_id" =>$array['product_id'],
							"bill_id"    =>$array['bill_id'],
							"quantity"   =>$array['quantity'],
							"total"	  =>$array['total']);
							
		$this->db->insert('order_product', $array);	
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function addMemberBill($array){
	 	$array = array( "id"=>NULL,
						"member_id"    => $array['member_id'],
						"bill_id"      => $array['bill_id'],
						"date_create"  => $array['date_create']);
							
		$this->db->insert('members_bill', $array);	
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function checkRandomSKU($value,$table){
		$this->db->select();
		$this->db->from($table);
		$this->db->where('sku',$value);
		$query = $this->db->get();
		if ($query->num_rows() > 0) 
            $result = 0;
        else
        	$result = 1;
		
		return $result;	
	}
}


/* End of file cart_model.php */
/* Location: ./application/models/cart_model.php */