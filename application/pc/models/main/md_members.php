<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Md_members extends CI_Model
{
	public function getNew($id){
		$this->db->select('id,username,firstname,lastname,email,phone,');
		$this->db->from('members');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
		    }
            return $data;
        }
        return FALSE;
			
	}
	
	public function CheckOldPass($member_id,$pass){
		$this->db->select('id');
		$this->db->from('members');
		$this->db->where('id',$member_id);
		$this->db->where('password',md5($pass));
		$query = $this->db->get();
		if ($query->num_rows() > 0) 
            return TRUE;
        else
        	return FALSE;
		
	}
	
	public function SaveChangePass($memeber_id,$oldpass,$newpass){
		$array['password'] = $newpass;
		$this->db->where('id',$memeber_id);
		//$this->db->where('password',md5($oldpass));
		if($this->db->update('members', $array))
				return TRUE;
			else
				return FALSE;			
	}
	
	public function SaveMembers($data){
		$array = array( "firstname"   => $data['firstname'],
						"lastname"	=> $data['lastname'],
						"phone"	   => $data['phone'],
						"address"	 => $data['address'],
						"district"	=> $data['district'],
						"country"	 => $data['country'],
						"dateofbirth" => $data['dateofbirth']);
		
		if($data['keyedit'] == 0):		
			$array['username'] = $data['username'];
			$array['password'] = $data['password'];
			$array['email']    = $data['email'];
		endif;
		
		if($data['id']==0):
			$array['id'] = NULL;
			if($this->db->insert('members', $array)){
				$id = $this->db->insert_id();
				return $id;
			}else
				return FALSE;
		else:
			$this->db->where('id', intval($data['id']));
			if($this->db->update('members', $array))
				return TRUE;
			else
				return FALSE;
		endif;
	}
	
	public function loadMem($id){
		$this->db->select('username,firstname,lastname,email,phone,address,country,district,dateofbirth,city');
	    $this->db->where('id',$id);
		$query = $this->db->get('members');
		$result_1 = $query->result();
 		$result  = $result_1[0]; 
		return $result;	
	}
	
	public function login($array){
		$this->db->select('id,username,firstname,lastname,phone,address,email,');
		$this->db->from('members');
		$this->db->where('active',1);
		$this->db->where('username',$array['username']);
		$this->db->where('password',$array['password']);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data = $row;
		    }
			$this->session->set_userdata('member', $data);
            return $data;
        }
        return FALSE;
	}
	
	public function loadBill($id){
		$this->db->select('members_bill.*,billinformation.total AS total_price,billinformation.phone AS phone,billinformation.name AS name,billinformation.date_create AS date_create,billinformation.address AS address');
		$this->db->from('members_bill');
		$this->db->join('billinformation', 'billinformation.id = members_bill.bill_id', 'inner');
		$this->db->where('members_bill.member_id',$id);
		$this->db->order_by('billinformation.date_create','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
		    }
            return $data;
        }
        return FALSE;
	}
	
	public function loadProductBill($id){
		$this->db->select('order_product.*, product.image AS product_image, product.title_en AS product_en, product.title_vn AS product_vn, product.price AS product_price, billinformation.total AS total_bill');
		$this->db->from('order_product');
		$this->db->join('product', 'product.id = order_product.product_id', 'inner');
		$this->db->join('billinformation', 'billinformation.id = order_product.bill_id', 'inner');
		$this->db->where('order_product.bill_id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
		    }
            return $data;
        }
        return FALSE;
	}
	
}

?>