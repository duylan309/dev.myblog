<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Md_product extends CI_Model
{
	public function getAll()
	{
		return $this->db->query('SELECT * FROM product WERE status=1 ORDER BY date DESC');
	}
	
	public function getTitleId()
	{
		return $this->db->query('SELECT id,title_vn,title_en FROM product');
	}
	
	public function findCategory($id){
		$this->db->select('id,title_en');
		$this->db->where('cat',$id);
		$query = $this->db->get('menu');
		$result = $query->result();
		return $result;	
	}
	
	public function ortherProduct($id,$cat,$menu){
		$check_cat = $this->findCategory($menu);
		
		$this->db->select('id,title_en,title_url,title_vn,date');
		$this->db->from('product');
		$this->db->where('status',1);
		
		if($check_cat)
		$this->db->where('cat',$cat);                                                         
		
		if($menu!=0)
		$this->db->where('menu',$menu);
		
		$this->db->order_by('date','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function findMenu($url){
		$this->db->select('id');
		$this->db->from('menu');
		$this->db->where('title_url',$url);
		$query = $this->db->get();
		$result_1 = $query->result();
 		$result  = $result_1[0]; 
		return $result;
	}
	public function findCat($url){
		$this->db->select('product.cat,product.title_url,menu.title_url AS menu_url,menu.title_en AS menu_en');
		$this->db->from('product');
		$this->db->join('menu', 'menu.id = product.cat', 'inner');
		$this->db->where('product.title_url',$url);
		$query = $this->db->get();
		$result_1 = $query->result();
 		$result  = $result_1[0]; 
		return $result;
	}
	
	public function findSubCat($id){
		$this->db->select('title_url,title_en');
		$this->db->from('menu');
		$this->db->where('id',$id);
		$this->db->where('section',1);
		$query = $this->db->get();
				
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	public function getCatTitle($id){
		$this->db->select('id,title_vn,title_en,title_url');
		$this->db->where('id',$id);
		$query = $this->db->get("product_cat");
		$result = $query->result();
		return $result;
	}
	
	public function countAll() {
        return $this->db->count_all("product");
    }
	
	public function countPublish(){
		$this->db->where('status',1);
		$query = $this->db->get("product");
		return $query->num_rows();
	}
	
	public function countProduct(){
		$this->db->from('product');
	   $this->db->where('product.status',1);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function countSearch($search){
	    $this->db->like('title_en',$search);
		$this->db->where('status',1);
		$query = $this->db->get("product");
		return $query->num_rows();
	}
	
	public function fetchItemsSearch($limit, $start, $string,$name) {
        $cat = $this->findMenu($name);
		$this->db->select('*');
	    $this->db->from('product');
		$this->db->where('status',1);
		$this->db->where('menu !=',$cat->id);
		$this->db->like('title_en',$string);
		
		if($limit!=0 || $start!=0)
		$this->db->limit($limit,$start);
		
		$this->db->order_by('date','desc');
		$table = $this->db->get();
	
		if ($table->num_rows() > 0) {
            foreach ($table->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
	
	public function minSort(){
		$table = $this->db->query('SELECT MIN(sort) AS minsort FROM product WHERE status=1');
		$result = $table->result();
		$result = $result[0]->minsort;
		return $result;
	}
	
	public function maxSort(){
		$table = $this->db->query('SELECT MAX(sort) AS maxsort FROM product WHERE status=1');
		$result = $table->result();
		$result = $result[0]->maxsort;
		return $result;
	}
	
	public function fetchItems($limit, $start, $home, $url) {
        $this->db->select('product.*');
	    $this->db->from('product');
		$this->db->where('product.status',1);
		
		if($home!=0)
		$this->db->where('product.home',1);
		
	  	if($limit!=0 || $start!=0)
		$this->db->limit($limit,$start);
		
		$this->db->order_by('date','desc');
		$this->db->order_by('sort','asc');		
		$table = $this->db->get();
	
		if ($table->num_rows() > 0) {
            foreach ($table->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
	
	public function ItemProduct($id){
	    $this->db->select('*');
		$this->db->from('product');
		$this->db->where('status',1);
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result_1 = $query->result();
 		$result  = $result_1[0]; 
		return $result;
	}
	
	public function ItemNewsNext($sort){
	    $this->db->select('product.*');
		$this->db->from('product');
		$this->db->where('product.status',1);
	
		if($sort == $this->maxSort())
		$this->db->where('product.sort',1);
		else
		$this->db->where('product.sort > ',$sort);
				
		$this->db->order_by('product.sort','asc');
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result();
		$result = $result[0];
		return $result;
	}
	
	public function ItemNewsBack($sort){
	    $this->db->select('product.*');
		$this->db->from('product');
		$this->db->where('product.status',1);
		
		if($sort == 1)
		$this->db->where('product.sort',$this->maxSort());
		else
		$this->db->where('product.sort < ',$sort);
		
		$this->db->order_by('product.sort','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result();
		$result = $result[0];
		return $result;
	}
	
	public function showProduct($id){
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('status',1);
		$this->db->where('menu',$id);
		$this->db->order_by('sort','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function showProductHome($id){
		$this->db->select('id,title_vn,title_en,image,style,title_url,date,alt_image');
		$this->db->from('product');
		$this->db->where('status',1);
		$this->db->where('home',1);
		$this->db->where('menu',$id);
		$this->db->order_by('product.sort','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function ItemType($id){
		
	}
	
	public function ItemAttribute($type_id){
		$this->db->select('*');
	    $this->db->from('product_attribute');
	    $this->db->where('type_id',$type_id);
	 	$this->db->order_by('sort','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;	
	}
	
	public function ItemTypeId($id){
		$this->db->select('*');	
		$this->db->from('product_attribute_type');
		$this->db->where('product_id',$id);
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
}

?>