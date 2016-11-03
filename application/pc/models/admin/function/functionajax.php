<?php
class Functionajax extends CI_Model
{	
	public function getPub($data){
		$id = $data['id'];
		$name = $data['name'];
	
		$this->db->select('status');
		$this->db->where('id',$id);
		$table  = $this->db->get($name);
		$result = $table->result();
		if ($table->num_rows() > 0) {
            $result = $result[0];
		    return $result;
        }
        return false;
		//return $this->db->query('select status from '.$name.' where id = ?',$id);
	}
	
	public function getHom($data){
		$id = $data['id'];
		$name = $data['name'];
	
		$this->db->select('home');
		$this->db->where('id',$id);
		$table  = $this->db->get($name);
		$result = $table->result();
		if ($table->num_rows() > 0) {
            $result = $result[0];
		    return $result;
        }
        return false;
	}
	
	public function checkurl($data){
		$this->db->where('title_url',$data['title_url']);
	    $query = $this->db->get($data['data']);
		return $query->num_rows();	
	}

	public function check_table_url($data){
		$this->db->where('url',$data['url']);
	    $query = $this->db->get($data['data']);
		return $query->num_rows();	
	}
	
	public function setpublish($data)
	{
		$value['id'] = $data['id'];
		$value['name'] = $data['data'];
		$statusQuery = $this->getPub($value);
		if(intval($statusQuery->status) == 0)
			$status=1;
		else
			$status=0;	
		
		$array = array('status' => $status);
		
		$this->db->where('id', $value['id']);
		$this->db->update($value['name'], $array); 
		
		return $status;
	}
	
	public function sethome($data)
	{
		$value['id'] = $data['id'];
		$value['name'] = $data['data'];
		$statusQuery = $this->getHom($value);
	
		if(intval($statusQuery->home) == 0)
			$status=1;
		else
			$status=0;	
		
		$array = array('home' => $status);
		
		$this->db->where('id', $value['id']);
		$this->db->update($value['name'], $array); 
		
		return $status;
	}
	
	
	public function setmodulename($data)
	{
		$id = $data['id'];
		$name = $data['data'];
		$title = $data['title'];
		$array =array('name' => $title);
		
		$this->db->where('id', $id);
		if($this->db->update($data['data'], $array)) 
			return true;
		else
			return false;	
	}
	
	public function settitle($data)
	{
		$id = $data['id'];
		$name = $data['data'];
		$title = $data['title'];
		$lang = $data['lang'];
		if($lang == 'en')
			$array =array('title_en' => $title);
		else
			$array =array('title_vn' => $title);
		
		$this->db->where('id', $id);
		if($this->db->update(strtolower($name), $array)) 
			return true;
		else
			return false;	
	}
	
	public function setsort($data)
	{
		$id    = $data['id'];
		$cat   = $data['cat'];
		$name  = $data['data'];
		$sort  = $data['sort'];
	
		$array = array('sort' => $sort);
		
		$this->db->where('id', $id);
		if($this->db->update(strtolower($name), $array)){ 
			$this->autoSort(strtolower($name),$cat,$sort,$id);
			return true;
		}else
			return false;	
	}
	
	public function setsortmenu($data)
	{
		$id    = $data['id'];
		$name  = $data['data'];
		$sort  = $data['sort'];
		$top   = $data['top'];
		$array = array('sort' => $sort);
		
		$this->db->where('id', $id);
		if($this->db->update(strtolower($name), $array)){ 
			$this->autoSortMenu(strtolower($name),$sort,$id,$top);
			return true;
		}else
			return false;	
	}
	
	public function autoSortMenu($name,$newsort,$id,$top){
		$this->db->where('top',$top);
		$this->db->where('status',1);
		$this->db->where('id !=',$id);
						
		$this->db->order_by('sort','asc');
	
		$query = $this->db->get($name);
		$count = 1;
		$all = $query->num_rows();
	
		if ($all > 0) {
            foreach ($query->result() as $row){
				
				if($count==$newsort):
					$count= $newsort+1;
				endif;
					$data = array('sort'=>$count);
               		$this->db->update(strtolower($name), $data, "id = $row->id");
            	$count++;
				
			}
        }
        return;
	}
	
	public function setprice($data)
	{
		$id = $data['id'];
		$name = $data['data'];
		$price = $data['price'];
		$array =array('price' => $price);
		
		$this->db->where('id', $id);
		if($this->db->update(strtolower($name), $array)) 
			return true;
		else
			return false;	
	}
	
	public function addmodule($data)
	{
		$array['menu_id']  = $data['menu_id'];
		$array['module_type']= $data['module_type'];
		$array['name']     = 'edit here';  
		$array['id']       = NULL;
		$array['sort']     = 0;
		$array['status']   = 0;
		
		$this->db->insert('modulecontroller', $array);	
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function setcat($data)
	{
		$id = $data['id'];
		$name = $data['data'];
		$cat = $data['cat'];
		$array =array('cat' => $cat);
		
		$this->db->where('id', $id);
		if($this->db->update(strtolower($name), $array)) 
			return true;
		else
			return false;	
	}
	
	public function setmenucat($data)
	{
		$id = $data['id'];
		$name = $data['data'];
		$cat = $data['menu_id'];
		$array =array('menu_id' => $cat);
		
		$this->db->where('id', $id);
		if($this->db->update(strtolower($name), $array)) 
			return true;
		else
			return false;	
	}
	
	public function setmenu($data)
	{
		$id = $data['id'];
		$name = $data['data'];
		$cat = $data['menu'];
		$array =array('menu' => $cat);
		
		$this->db->where('id', $id);
		
		if($this->db->update(strtolower($name), $array)) 
			return true;
		else
			return false;	
	}
	
	public function setmenuupdate($data)
	{   $menuid  = $data['menuid'];
		$this->db->select('id,title_en');
		$this->db->where('cat',$menuid);
		$this->db->where('section', 1);
		$query = $this->db->get('menu');
		$result = $query->result();
		return $result;
	}
	
	public function setcol($data)
	{
		$id = $data['id'];
		$name = $data['data'];
		$cat = $data['cat'];
		$array =array('collection_id' => $cat);
		
		$this->db->where('id', $id);
		if($this->db->update(strtolower($name), $array)) 
			return true;
		else
			return false;	
	}
	
	public function setproduct($data)
	{
		$id = $data['id'];
		$name = $data['data'];
		$cat = $data['cat'];
		
		if($cat== -1)
		$array =array('product_id' => 0,'check_product'=>0);
		else
		$array =array('product_id' => $cat,'check_product'=>1);
		
		$this->db->where('id', $id);
		if($this->db->update(strtolower($name), $array)) 
			return true;
		else
			return false;	
	}
	
	public function setnews($data)
	{
		$id = $data['id'];
		$name = $data['data'];
		$cat = $data['cat'];
		if($cat== -1)
		$array =array('new_id' => 0,'check_new'=>0);
		else
		$array =array('new_id' => $cat,'check_new'=>1);
		
		$this->db->where('id', $id);
		if($this->db->update(strtolower($name), $array)) 
			return true;
		else
			return false;	
	}
	
	public function findSection($id,$name){
		$this->db->where('id',$id);
		$table   = $this->db->get($name);
		$result  = $table->result();
		$result  = $result[0];
		return $result->section;
	}	
	
	public function autoSort($name,$cat,$newsort,$id){
		if($this->db->field_exists('section',$name)!=FALSE):
			$section = $this->findSection($id,$name);
			$this->db->where('section',$section);
		endif;
		
		if(intval($cat)>0)
		$this->db->where('cat',$cat);
		
		
		$this->db->where('status',1);
		$this->db->where('id !=',$id);
		
				
		$this->db->order_by('sort','asc');
	
		$query = $this->db->get($name);
		$count = 1;
		$all = $query->num_rows();
	
		if ($all > 0) {
            foreach ($query->result() as $row){
				
				if($count==$newsort):
					$count= $newsort+1;
				endif;
					$data = array('sort'=>$count);
               		$this->db->update(strtolower($name), $data, "id = $row->id");
            	$count++;
				
			}
        }
        return;
	}

	public function addImageGallery($listarray, $database,$album_id,$member_id){
		//var_dump($listarray);
		for($i=0;$i<count($listarray);$i++):
			$array = array( "id"=>NULL,
							"member_id"=>$member_id,
							"title_url"=>$listarray[$i],
							"name"     =>$listarray[$i],
							"alt_image"    =>'alt_image',
							"content"    =>'add your content',
							"status"   =>1,
							"sort"	 =>0,
							"date"	 =>date('y-m-d'),
							"album_id" =>$album_id);
			
			$this->db->insert($database, $array);	
		
		endfor;
								
		return TRUE;
	}
	
}

?>