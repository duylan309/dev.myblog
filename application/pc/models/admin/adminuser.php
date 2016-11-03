<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Adminuser extends CI_Model
{
	public function getAll()
	{
		return $this->db->query('select * from adminuser');
	}
	
	public function getTitleId()
	{
		return $this->db->query('select id,useradmin,email from adminuser');
	}
	
	public function ChangePass($value){
		$array = array(
						"passadmin"=>$value['confirmpassadmin'],
						);
		
		$this->db->where('id', intval($value['id']));
		$this->db->update('adminuser', $array);	
		return TRUE;
	}
	
	public function editItem($value)
	{
		return $this->db->query('select * from adminuser where id = ?',$value);
	}
	
	public function countAll() {
        return $this->db->count_all("adminuser");
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
		
		$query = $this->db->get("adminuser");
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
		$query = $this->db->get("adminuser");
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
		$query = $this->db->get("adminuser");
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
		foreach($data as $item => $key):
			$array[$item] = $key;
		endforeach; 

		$this->db->where('id', intval($data['id']));
		$this->db->update('adminuser', $array);	
		return TRUE;
	}	
	
	public function AddItem($data)
	{	
		$array = array( "id"=>NULL,
						"useradmin"=>$data['useradmin'],
						"passadmin"=>md5($data['confirmpassadmin']),
						"email"=>$data['email']);
		
		$this->db->insert('adminuser', $array);	
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function RemoveItem($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('adminuser');
	}
	
	
}

?>