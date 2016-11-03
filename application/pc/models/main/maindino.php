<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maindino extends CI_Model
{   
	//----------CHECK USER--------------------//
	public function checkUser($username,$password){
		$this->db->select('id,username');
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$this->db->limit(1);
		$result = $this->db->get('students');
		if ($result->num_rows() == 1)
		{	
		    $res = $result->result();
			$admin = array();
			$admin['user']			  = array();
			$admin['user']['username']  = $res[0]->username;
			$admin['user']['student_id']  = $res[0]->id;
			$admin['user']['expire']    = time() + 7200;
			$this->session->set_userdata($admin);
			$this->getNewLogin($res[0]->id);
			$id = $res[0]->id;
			return $id;
		}
		else
			return false;
	}
	
	private function getNewLogin($id){
		$array['last_login'] = date('Y-m-d',mktime());
		
		$this->db->where('id', intval($id));
		$this->db->update('students', $array);	
	}
	
	public function checkpass($id,$username,$password){
		$this->db->select('*');
		$this->db->where('id'      , $id);
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->limit(1);
		$result = $this->db->get('students');
		if ($result->num_rows() == 1)
		{	
		   	return true;
		}
		else
			return false;
	}
	
	//////////////////////////////////////////
	//////////////////////////////////////////
	// Get Value From Something///////////////
	public function GetValueFrom($database,$row,$value,$select){
		$this->db->select($select);
		$this->db->where($row,$value);
		$table  = $this->db->get($database);
		$result = $table->result();
		if ($table->num_rows() > 0) {
            $result = $result[0];
		    return $result;
        }
        return false;
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
	}
	
	public function GetNextValueFrom($database,$id,$whereValue=NULL,$selection){
		$this->db->select_min('id');
		$this->db->select($selection);
		
		if($whereValue != NULL){
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
		
		$this->db->where('id >',$id);
		$this->db->order_by("id", "DESC"); 
		$table  = $this->db->get($database);
		$result = $table->result();
		if ($table->num_rows() > 0) {
            $result = $result[0];
		    return $result;
        }else{
			return -1;	
		}
        
	}
	
	public function GetPrevValueFrom($database,$id,$whereValue=NULL,$selection){
		$this->db->select_max('id');
		$this->db->select($selection);
		
		if($whereValue != NULL){
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
		
		$this->db->where('id <',$id);
		$this->db->order_by("id", "DESC"); 
		$table  = $this->db->get($database);
		$result = $table->result();
		if ($table->num_rows() > 0) {
            $result = $result[0];
		    return $result;
        }else{
			return -1;	
		}
        
	}
	
	public function SearchFunction($selectA,$selectB,$likeA,$likeB,$whereA,$whereB,$tableA,$tableB,$table_join,$where_join,$limit){
	   $this->db->select($selectA);
	   $this->db->select($selectB);
	   $this->db->like($likeA);
	   $this->db->like($likeB);
	   $this->db->where($whereA);	
	   $this->db->where($whereB);
	   $this->db->join($database_cat, $where_join, 'inner');	
	   $this->db->order_by($tableA.'.id','DESC'); 
	   $this->db->limit($limit);
	   $query = $this->db->get($database);
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
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
		if($this->db->update($database, $array)):
			return TRUE;
		else:
			return false;
		endif;	
	}
	
	public function DeleteTable($database,$id){
		$this->db->where('id',$id);
		$this->db->delete($database);
		return TRUE;
	}
	//COUNT FUNCTION ////////////////////////////////////
	public function CountPhoto($database,$name,$id){
		$this->db->where($name,$id);
		$query = $this->db->get($database);
		return $query->num_rows();
	}
	
	public function CountAll($database){
		$query = $this->db->get($database);
		return $query->num_rows();	
	}
	
	public function countSearch($database,$whereLike, $wherevalue,$array = array()){
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
		
		if($wherevalue != NULL){
			foreach ($wherevalue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
		
		
		
		if(count($array)>0):
			$this->db->where_in('cat',$array);
		endif;
				
		$query = $this->db->get($database);
		return $query->num_rows();
	}
	
	public function countSearchFindIn($database,$whereLike, $wherevalue,$array = array(),$cat_id,$cat_name){
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
		
		if($wherevalue != NULL){
			foreach ($wherevalue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
		
		if($cat_id!=0):
		$where = "FIND_IN_SET('".$cat_id."', ".$cat_name.")";  
		$this->db->where($where); 
		endif;
		if(count($array)>0):
			$this->db->where_in('cat',$array);
		endif;
				
		$query = $this->db->get($database);
		return $query->num_rows();
	}
	
	
	//DELETE FUNCTION ///////////////////////////////////
	public function deleteImage($database,$name,$album_id){
		$this->db->where('album_id',$album_id);
		$this->db->where('name',$name);
		
		$this->db->delete($database);
	}
	
	public function DeleteItem($database,$id){
		$this->db->where('id',$id);
		if($this->db->delete($database))
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
	
	public function loadTable($database, $whereLike = NULL,$whereValue = NULL, $sort, $valueSort,$limit=NULL){
		if($whereLike!=NULL){  foreach($whereLike as $getWhere => $value){$this->db->like($getWhere,$value);}}
				
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
		
		if($limit!=NULL)
			$this->db->limit($limit);
		
		
		$query = $this->db->get($database);
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function loadTableSQL($database, $selection , $whereLike = NULL,$whereValue = NULL, $valueSort,$limit=NULL){
		$this->db->select($selection);
		if($whereLike!=NULL){  foreach($whereLike as $getWhere => $value){$this->db->like($getWhere,$value);}}
				
		if($whereValue != NULL){
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
		
		$this->db->order_by($valueSort); 
		
		if($limit!=NULL)
			$this->db->limit($limit);
		
		$query = $this->db->get($database);

		// var_dump($this->db->last_query());
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }else{
       		die();
        }
	}

	public function runSQL($sql,$array = NULL){
		if ($array == NULL)
		$query = $this->db->query($sql); 
		else
		$query = $this->db->query($sql, $array); 


		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        }else{
       		die();
        }

	}
	
	public function loadTableSort($database, $whereLike = NULL,$whereValue = NULL, $sort, $valueSort,$limit=NULL){
		if($whereLike!=NULL){  foreach($whereLike as $getWhere => $value){$this->db->like($getWhere,$value);}}
				
		if($whereValue != NULL){
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
		
		if($sort==-1){
			$this->db->order_by('id', 'DESC'); 
		}
		else{
			count($valueSort) ? $this->db->order_by($valueSort) : $this->db->order_by('id', 'DESC') ; 
		}
		
		if($limit!=NULL)
			$this->db->limit($limit);
		
		
		$query = $this->db->get($database);
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}


	public function loadTableModule($database, $whereLike = NULL,$whereValue = NULL, $sort, $valueSort,$menu_id){
		if($whereLike!=NULL){  foreach($whereLike as $getWhere => $value){$this->db->like($getWhere,$value);}}
		if($whereValue != NULL){
			
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
					$this->db->where($gWhere,$val);	
			}	
		}
		
		
		$where = "FIND_IN_SET('".$menu_id."', menu_id)";  
		$this->db->where( $where ); 


		if($sort==-1)
			$this->db->order_by('id', 'DESC'); 
		else
			$this->db->order_by('sort', $valueSort); 
		
		
		$query = $this->db->get($database);
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function loadTableWhereIn($database, $whereLike = NULL,$whereValue = NULL,$array = array(),$limit = NULL){
		if($whereLike!=NULL){  foreach($whereLike as $getWhere => $value){$this->db->like($getWhere,$value);}}
				
		if($whereValue != NULL){
			foreach ($whereValue as $gWhere => $val){
				if($val >=0)
				$this->db->where($gWhere,$val);	
			}	
		}
		
		$this->db->where_in('id',$array);
			
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
	
	public function SearchFunctionPage($database, $select, $limit = 0 , $start= 0, $whereLike = NULL,$whereValue = NULL, $sortTable){
		$this->db->select($select);
		
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
		
		
		$this->db->order_by($sortTable, 'DESC'); 
		
		if($limit != 0 && $start != 0)
		$this->db->limit($limit, $start);
		
		$query = $this->db->get($database);
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	public function SearchFunctionPageOneField($database, $select, $limit = 0 , $start= 0, $field_like, $whereLike = NULL,$whereValue = NULL, $sortTable){
		$this->db->select($select);
		
		if($whereLike!=NULL){ 
		 	$i=0; 
			foreach($whereLike as $getWhere => $value){
				if($i=0)
					$this->db->like($field_like,$value);
				else
					$this->db->or_like($field_like,$value);
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
		
		$this->db->order_by($sortTable, 'DESC'); 
		
		if($limit != 0 && $start != 0)
		$this->db->limit($limit, $start);
		
		$query = $this->db->get($database);
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function ListItemFindIn($database,$limit, $start, $whereLike = NULL,$whereValue = NULL, $sort, $valueSort,$array = array(),$cat_id,$cat_name){
		$this->db->select('*');
		
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
		
		if($cat_id!=0):
		$where = "FIND_IN_SET('".$cat_id."', ".$cat_name.")";  
		$this->db->where($where); 
		endif;
		
		if(count($array)>0):
			$this->db->where_in('cat',$array);
		endif;
		
		if($sort==-1)
			$this->db->order_by('id', 'DESC'); 
		else
			$this->db->order_by('sort', $valueSort); 
		
		$this->db->limit($limit, $start);
		$query = $this->db->get($database);
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function ListItemFindInNopage($database, $whereLike = NULL,$whereValue = NULL, $sort, $valueSort,$array = array(),$cat_id,$cat_name,$limit){
		$this->db->select('*');
		
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
		
		if($cat_id!=0):
		$where = "FIND_IN_SET('".$cat_id."', ".$cat_name.")";  
		$this->db->where($where); 
		endif;
		
		if(count($array)>0):
			$this->db->where_in('cat',$array);
		endif;
		
		if($sort==-1)
			$this->db->order_by('id', 'DESC'); 
		else
			$this->db->order_by('sort', $valueSort); 
		
		$this->db->limit($limit);
		$query = $this->db->get($database);
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function ListItems($database,$limit, $start, $whereLike = NULL,$whereValue = NULL, $sort, $valueSort,$array = array()){
		$this->db->select('*');
		
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
		
		if(count($array)>0):
			$this->db->where_in('cat',$array);
		endif;
		
		if($sort==-1)
			$this->db->order_by('id', 'DESC'); 
		else
			$this->db->order_by($sort, $valueSort); 
		
		

		$this->db->limit($limit, $start);
		$query = $this->db->get($database);
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	
	
	
}