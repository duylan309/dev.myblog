<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Checknew extends CI_Model
{
	public function check_inbox(){
		$this->db->where('status',0);
		$query = $this->db->get("contact");
		return $query->num_rows();
	}
	
	public function check_bill(){
		$this->db->where('status',0);
		$query = $this->db->get("bill_information");
		return $query->num_rows();
	}
	
	public function check_newsletter(){
		$this->db->where('status',0);
		$query = $this->db->get("newsletter");
		return $query->num_rows();
	}
}

?>