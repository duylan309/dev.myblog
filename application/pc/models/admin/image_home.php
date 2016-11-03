<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Image_home extends CI_Model
{
	public function getAll()
	{
		return $this->db->query('select * from image_home');
	}
	
	public function getTitleId()
	{
		return $this->db->query('select id,title_vn,title_en from image_home');
	}
	
	public function editItem($value)
	{
		return $this->db->query('select * from image_home where id = ?',$value);
	}
	
	public function countAll() {
        return $this->db->count_all("image_home");
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
		
		$query = $this->db->get("image_home");
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
		$query = $this->db->get("image_home");
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
		$query = $this->db->get("image_home");
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
						"title_vn"=>$data['title_vn'],
						"title_en"=>$data['title_en'],
						"title_url"=>$data['title_url'],
						"sort"=>$data['sort'],
						"status"=>$data["status"]);
		
		if(isset($data['image']))
			$array['image'] = $data['image'];				
						
		$this->db->where('id', intval($data['id']));
		$this->db->update('image_home', $array);	
		return TRUE;
	}	
	
	public function AddItem($data)
	{	
		$array = array( "id"=>NULL,
						"title_vn"=>$data['title_vn'],
						"title_en"=>$data['title_en'],
						"title_url"=>$data['title_url'],
						"sort"=>$data['sort'],
						"status"=>$data["status"]);
		
		if(isset($data['image']))
			$array['image'] = $data['image'];				
						
		$this->db->insert('image_home', $array);	
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function RemoveItem($id)
	{	
		$result_first = $this->editItem($id);
		$result = $result_first->result();	
		
		if(isset($result[0]->image) && !empty($result[0]->image)){
			$fileOldImage = "upload/image_home/".$result[0]->image;
			if(is_file($fileOldImage))
			unlink($fileOldImage);
		}
		
		$this->db->where('id',$id);
		$this->db->delete('image_home');
	}
	
	public function removeTagFromItems($id){
		$this->db->where('image_home_id',$id);
		$this->db->delete('tag_image_home_group');	
	}
	
}

?>