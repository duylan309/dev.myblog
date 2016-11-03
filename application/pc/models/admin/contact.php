<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Contact extends CI_Model
{
	public function getAll()
	{
		return $this->db->query('select * from contact');
	}
	
	public function editItem($value)
	{
		return $this->db->query('select * from contact where id = ?',$value);
	}
	
	public function setStatus($id){
		$this->db->select('status');
		$this->db->from('contact');
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result_1 = $query->result();
 		$result  = $result_1[0]; 
		
		if($result->status==0){
			$array = array("status"=>1);
			$this->db->where('id', $id);
			$this->db->update('contact', $array);
		}
		return TRUE;
		
	}
	
	public function countAll() {
        return $this->db->count_all("contact");
    }
	
	public function countSearch($where, $status){
		
		if($where != NULL){
			foreach($where as $getWhere => $value){
				if($value!= '')
				$this->db->like($getWhere,$value);
			}
		}
		
		if($status >= 0)
		$this->db->where('status',$status);
		
		$query = $this->db->get("contact");
		return $query->num_rows();
	}
	
	public function fetchItems($limit, $start, $where) {
        if($where!=NULL){
			foreach($where as $getWhere => $value){
				$this->db->like($getWhere,$value);
			}
		}
				
		$this->db->order_by('id',"desc");
		$this->db->limit($limit, $start);
		$query = $this->db->get("contact");
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
	
	public function noPage($where,$status){
		 if($where!=NULL){
			foreach($where as $getWhere => $value){
				$this->db->like($getWhere,$value);
			}
		}
				
		if($status > 0)
			$this->db->where('status',$status);
		else if ($status == 0)
			$this->db->where('status',0);
		
		
		$this->db->order_by('id',"desc");
		$query = $this->db->get("contact");
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}	
		
	public function updateItem($data)
	{	
		$array = array(
						"fullname"=>$data['fullname'],
						"address"=>$data['address'],
						"phone"=>$data['phone'],
						"email"=>$data['email'],
						"title"=>$data['title'],
						"content"=>stripcslashes($data['content']),
						"date"=>strtotime($data['date']),
						"status"=>$data["status"]);
		
		$this->db->where('id', intval($data['id']));
		$this->db->update('contact', $array);	
		return TRUE;
	}	
	
	public function AddItem($data)
	{	
		$array = array( "id"=>NULL,
						"fullname"=>$data['fullname'],
						"address"=>$data['address'],
						"phone"=>$data['phone'],
						"email"=>$data['email'],
						"title"=>$data['title'],
						"content"=>stripcslashes($data['content']),
						"date"=>strtotime($data['date']),
						"status"=>$data["status"]);
		
		$this->db->insert('contact', $array);	
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function RemoveItem($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('contact');
	}
	
	
}

?>