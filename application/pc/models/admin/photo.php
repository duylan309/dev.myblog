<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album extends CI_Model
{
	public function getAll()
	{
		return $this->db->query('select * from album');
	}
	
	public function getTitleId()
	{
		return $this->db->query('select id,title from album ');
	}
	
	public function editItem($value)
	{
		$this->db->select('*');
		$this->db->where('id',$value);
		$table = $this->db->get('album');
		$result =$table->result();
		$result = $result[0];
		return $result;
	}
	
	public function countAll() {
		$query = $this->db->get("album");
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
		
		$query = $this->db->get("album");
		return $query->num_rows();
	}
		
	public function listItem($limit, $start, $where ,$status ,$sort){
		$this->db->select('album.*,members.firstname AS member_name');
		
		$this->db->join('members', 'members.id = album.member_id', 'inner');
		
		if($where!=NULL){  foreach($where as $getWhere => $value){$this->db->like('album.'.$getWhere,$value);}}
		
		if($status > 0)
			$this->db->where('album.status',$status);
		else if ($status == 0)
			$this->db->where('album.status',0);
			
		if($sort >= 0 ){
		 if(intval($sort)==0)
		 	$this->db->order_by("album.sort", "ASC"); 
		 else 
		 	$this->db->order_by("album.sort", "DESC");
		}else{	
		    $this->db->order_by('album.id',"desc");
		}
				
		$this->db->order_by('album.id',"desc");
		$this->db->limit($limit, $start);
		$query = $this->db->get("album");
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
		$array = array( "title"=>$data['title'],
						"title_url"=>$data['title_url'],
						"alt_image"=>$data['alt_image'],
						"date"=>$data['date'],
						"member_id"=>$data['member_id'],
						"sort"=>$data['sort'],
						"status"=>$data["status"]);
	
		if(isset($data['image']))
			$array['image'] = $data['image'];				
						
		$this->db->where('id', intval($data['id']));
		$this->db->update('album', $array);	
		return TRUE;
	}	
	
	public function AddItem($data)
	{	
		$array = array( "id"=>NULL,
						"title"=>$data['title'],
						"title_url"=>$data['title_url'],
						"alt_image"=>$data['alt_image'],
						"member_id"=>$data['member_id'],
						"date"=>date('y-m-d',mktime()),
						"sort"=>$this->countAll()+1,
						"status"=>$data["status"]);
		
		if(isset($data['image']))
			$array['image'] = $data['image'];				
						
		$this->db->insert('album', $array);	
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function RemoveItem($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('album');
	}
	
	
}

?>