<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admindino extends CI_Model
{   
	// Get Value From Something
	public function GetValueFrom($database,$row,$value,$select){
		$this->db->select($select);
		$this->db->where($row,$value);
		$table  = $this->db->get(strtolower($database));
		$result = $table->result();
		if ($table->num_rows() > 0) {
            $result = $result[0];
		    return $result;
        }
        return false;
	}
	
	public function checkNewMess(){
		
	}
	
	public function GetValueJoinFrom($database,$database_cat,$where_join,$row,$value,$select){
		$this->db->select($select);
		$this->db->where($database.'.'.$row,$value);
		$this->db->join($database_cat, $where_join, 'inner');
		$table  = $this->db->get(strtolower($database));
		$result = $table->result();
		if ($table->num_rows() > 0) {
            $result = $result[0];
		    return $result;
        }
        return false;
		
		//return $result;	
	}
	
	public function deletephotogallery($database,$album_id,$photo_id){
		$result = $this->GetValueFrom($database.'_photo','id',$photo_id,'name');	
		if($this->DeleteItem($database.'_photo',$photo_id)){
				$pathdir_image  	    =  "./upload/storage/".$database.'/'.$album_id.'/'.$result->name;
				unlink($pathdir_image);	
				$pathdir_image_thumb  	    =  "./upload/storage/".$database.'/'.$album_id.'/thumbnail/'.$result->name;
				unlink($pathdir_image_thumb);			
		}
	}
	// ADD FUNCTION////////////////////////////
	public function AddPhoto($database,$data)
	{	
		foreach($data as $item => $key):
			$array[$item] = $key;
		endforeach; 
		
		$this->db->insert($database, $array);	
		$id = $this->db->insert_id();
		return $id;
	}	
	

	public function AddTable($database,$data){
		foreach($data as $item => $key):
			$array[$item] = $key;
		endforeach; 
		
		$this->db->insert($database, $array);	
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function UpdateTable($database,$data,$id){
		foreach($data as $item => $key):
			$array[$item] = $key;
		endforeach; 
		
		$this->db->where('id', intval($id));
		$this->db->update($database, $array);	
		return TRUE;
	}
	
	public function DeleteTableWithCat($database,$cat_name,$cat){
		$this->db->where($cat_name,$cat);
		if($this->db->delete(strtolower($database)))
			return TRUE;
		else
			return FALSE;
	}
	
	public function DeleteTable($database,$id){
		$this->db->where('id',$id);
		$this->db->delete(strtolower($database));
		return TRUE;
	}
	//COUNT FUNCTION ////////////////////////////////////
	public function CountPhoto($database,$name,$id){
		$this->db->where($name,$id);
		$query = $this->db->get(strtolower($database));
		return $query->num_rows();
	}
	
	public function CountAll($database){
		$query = $this->db->get(strtolower($database));
		return $query->num_rows();	
	}
	
	public function countSearch($database,$wherelike, $wherevalue){
		
		if($wherelike != NULL){
			foreach($wherelike as $getWhere => $value){
				if($value!= '')
				$this->db->like($getWhere,$value);
			}
		}
		
		if($wherevalue != NULL){
			foreach ($wherevalue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
				
		$query = $this->db->get(strtolower($database));
		return $query->num_rows();
	}
	public function countSearchModule($database,$wherelike, $wherevalue,$menu_id){
		
		if($wherelike != NULL){
			foreach($wherelike as $getWhere => $value){
				if($value!= '')
				$this->db->like($getWhere,$value);
			}
		}
		
		if($wherevalue != NULL){
			foreach ($wherevalue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
			
		if($menu_id >=0):
		$where = "FIND_IN_SET('".$menu_id."', menu_id)";  
		$this->db->where( $where );
		endif;	
				
		$query = $this->db->get(strtolower($database));
		return $query->num_rows();
	}
	//DELETE FUNCTION ///////////////////////////////////
	public function deleteImage($database,$name,$album_id){
		$this->db->where('album_id',$album_id);
		$this->db->where('name',$name);
		$this->db->delete(strtolower($database));
	}
	
	public function getNameImage($database,$name,$album_id){
		$this->db->select('name');
		$this->db->where('album_id',$album_id);
		$this->db->where('id',$name);
		$table  = $this->db->get(strtolower($database));
		$result = $table->result();
		if ($table->num_rows() > 0) {
            $result = $result[0];
		    return $result;
        }
        return false;
	}
	
	public function DeleteItem($database,$id){
		$this->db->where('id',$id);
		if($this->db->delete(strtolower($database)))
			return TRUE;
		else
			return FALSE;
	}
	//LOAD FUNCTION /////////////////////////////////////
	public function listPhoto($database,$id){
		$this->db->select('*');
		$this->db->where($database.'_id',$id);
		$this->db->order_by("sort", "ASC"); 
		$table  = $this->db->get($database.'_photo');
		$result = $table->result();
		return $result;
	}
	
	public function loadTable($database, $whereLike = NULL,$whereValue = NULL,$limit=NULL){
		
		if($whereLike!=NULL){  foreach($whereLike as $getWhere => $value){$this->db->like($getWhere,$value);}}
				
		if($whereValue != NULL){
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
		
				
		//$this->db->order_by("sort", "ASC"); 
		$this->db->order_by("id", "DESC"); 
		if($limit!=NULL)
		$this->db->limit($limit);
		
		$query = $this->db->get(strtolower($database));
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	public function loadTableWhere($database, $whereLike = NULL,$whereValue = NULL,$colname,$array = array(),$limit=NULL){
		if($whereLike!=NULL){  foreach($whereLike as $getWhere => $value){$this->db->like($getWhere,$value);}}
				
		if($whereValue != NULL){
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
		
		$this->db->where_in($colname,$array);
			
		$this->db->order_by("sort", "ASC"); 
		$query = $this->db->get(strtolower($database));
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	public function loadTableWhereIn($database, $whereLike = NULL,$whereValue = NULL,$array = array()){
		if($whereLike!=NULL){  foreach($whereLike as $getWhere => $value){$this->db->like($getWhere,$value);}}
				
		if($whereValue != NULL){
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
		
		$this->db->where_in('id',$array);
			
		$this->db->order_by("sort", "ASC"); 
		$query = $this->db->get(strtolower($database));
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function loadTableWhereNotIn($database, $whereLike = NULL,$whereValue = NULL,$array = array()){
		if($whereLike!=NULL){  foreach($whereLike as $getWhere => $value){$this->db->like($getWhere,$value);}}
				
		if($whereValue != NULL){
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
		
		if(count($array) >0):
			$this->db->where_not_in('id',$array);
		endif;
		
		$this->db->order_by("sort", "ASC"); 
		$query = $this->db->get(strtolower($database));
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	
	public function loadTableOr($database, $whereLike = NULL,$whereValue = NULL){
		if($whereLike!=NULL){ 
		 	$i=0; 
			foreach($whereLike as $getWhere => $value){
				if($i=0)
					$this->db->like($getWhere,$value);
				else
					$this->db->or_like($getWhere,$value);
				$i++;
			}
			unset($i);
		}
				
		if($whereValue != NULL){
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
			
		$this->db->order_by("sort", "ASC"); 
		$query = $this->db->get(strtolower($database));
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function ListItems($database,$limit, $start, $whereLike = NULL,$whereValue = NULL, $sort, $valueSort){
		$this->db->select('*');
		if($whereLike!=NULL){  
			$i=0; 
			foreach($whereLike as $getWhere => $value){
				if($i=0 && !empty($value))
					$this->db->like($getWhere,$value);
				elseif(!empty($value))
					$this->db->or_like($getWhere,$value);
				$i++;
			}
			unset($i);
		}
				
				
		if($whereValue != NULL){
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
		
		if($sort==-1)
			$this->db->order_by('id', 'DESC'); 
		else
			$this->db->order_by('sort', $valueSort); 
		
		$this->db->limit($limit, $start);
		$query = $this->db->get(strtolower($database));
		
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
		
		
        return false;
	}
	
	public function ListItemsModule($database,$limit, $start, $whereLike = NULL,$whereValue = NULL, $sort, $valueSort,$menu_id){
		$this->db->select('*');
		if($whereLike!=NULL){  
			$i=0; 
			foreach($whereLike as $getWhere => $value){
				if($i=0 && !empty($value))
					$this->db->like($getWhere,$value);
				elseif(!empty($value))
					$this->db->or_like($getWhere,$value);
				$i++;
			}
			unset($i);
		}
				
				
		if($whereValue != NULL){
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
		if($menu_id >=0):
		$where = "FIND_IN_SET('".$menu_id."', menu_id)";  
		$this->db->where( $where );
		endif;
		if($sort==-1)
			$this->db->order_by('id', 'DESC'); 
		else
			$this->db->order_by('sort', $valueSort); 
		
		$this->db->limit($limit, $start);
		$query = $this->db->get(strtolower($database));
		
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
		
		
        return false;
	}
	
	 
	public function ListItemsJoin($database,$database_cat,$select,$where_join,$limit, $start, $whereLike = NULL,$whereValue = NULL, $sort, $valueSort){
		$this->db->select($select);
		if($whereLike!=NULL){  foreach($whereLike as $getWhere => $value){$this->db->like($database.'.'.$getWhere,$value);}}
				
		if($whereValue != NULL){
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
				$this->db->where($database.'.'.$gWhere,$val);	
			}	
		}
		$this->db->join($database_cat, $where_join, 'inner');
		
		if($sort==-1)
			$this->db->order_by($database.'.'.'id', 'DESC'); 
		else
			$this->db->order_by($database.'.'.'sort', $valueSort); 
		
		$this->db->limit($limit, $start);
		$query = $this->db->get(strtolower($database));
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
}