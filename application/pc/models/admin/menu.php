<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Menu extends CI_Model
{
	public function getAll()
	{
		return $this->db->query('select * from menu');
	}
	
	public function getTitleId()
	{
		return $this->db->query('select id,title_vn,title_en from menu');
	}
	
	public function editItem($value)
	{
		$this->db->select('*');
		$this->db->where('id',$value);
		$table = $this->db->get('menu');
		$result =$table->result();
		$result = $result[0];
		return $result;
	}
	
	public function countAll() {
		$query = $this->db->get("menu");
		return $query->num_rows();
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
		
		$query = $this->db->get("menu");
		return $query->num_rows();
	}
		
	public function listItem($limit, $start, $where ,$status ,$sort){
	
		if($where!=NULL){  foreach($where as $getWhere => $value){$this->db->like($getWhere,$value);}}
				
		if($status > 0)
			$this->db->where('status',$status);
		else if ($status == 0)
			$this->db->where('status',0);
		
		if($sort >= 0 ){
		 if(intval($sort)==0)
		 	$this->db->order_by("sort", "ASC"); 
		 else 
		 	$this->db->order_by("sort", "DESC");
		}else{	
		    $this->db->order_by('id',"desc");
		}
				
		$this->db->order_by('id',"desc");
		$this->db->limit($limit, $start);
		$query = $this->db->get("menu");
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
						"alt_image"=>$data['alt_image'],
						"date"=>$data['date'],
						"section"=>0,						
						"sort"=>$data['sort'],
						"type"=>$data['type'],
						"status"=>$data["status"]);
	
		if(isset($data['image']))
			$array['image'] = $data['image'];				
						
		$this->db->where('id', intval($data['id']));
		$this->db->update('menu', $array);	
		return TRUE;
	}	
	
	public function AddItem($data)
	{	
		$array = array( "id"=>NULL,
						"title_vn"=>$data['title_vn'],
						"title_en"=>$data['title_en'],
						"title_url"=>$data['title_url'],
						"alt_image"=>$data['alt_image'],
						"section"=>0,
						"date"=>mktime(),
						"sort"=>$this->countAll()+1,
						"type"=>$data['type'],
						"status"=>$data["status"]);
		
		if(isset($data['image']))
			$array['image'] = $data['image'];				
						
		$this->db->insert('menu', $array);	
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function RemoveItem($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('menu');
	}
	
	
}

?>