<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Md_category extends CI_Model
{
	public function getAll()
	{
		return $this->db->query('SELECT * FROM article WERE status=1 ORDER BY date DESC');
	}
	
	public function getTitleId()
	{
		return $this->db->query('SELECT id,title_vn,title_en FROM article');
	}
	
	public function findId($url){
		$this->db->select('*');
		$this->db->from('menu');
		$this->db->where('title_url',$url);
		$query = $this->db->get();
		$result_1 = $query->result();
 		$result  = $result_1[0]; 
		return $result->id;	
	}
	
	public function findMenu($url){
		$this->db->select('*');
		$this->db->from('menu');
		$this->db->where('id',$url);
		$query = $this->db->get();
		$result_1 = $query->result();
 		$result  = $result_1[0]; 
		return $result;
	}
	public function findCat($url){
		$this->db->select('article.cat,article.title_url,menu.title_url AS menu_url,menu.title_en AS menu_en');
		$this->db->from('article');
		$this->db->join('menu', 'menu.id = article.menu', 'inner');
		$this->db->where('article.title_url',$url);
		$query = $this->db->get();
		$result_1 = $query->result();
 		$result  = $result_1[0]; 
		return $result;
	}
	
	public function getCatTitle($id){
		$this->db->select('id,title_vn,title_en,title_url');
		$this->db->where('id',$id);
		$query = $this->db->get("article_cat");
		$result = $query->result();
		return $result;
	}
	
	public function countAll() {
        return $this->db->count_all("article");
    }
	
	public function countPublish(){
		$this->db->where('status',1);
		$query = $this->db->get("article");
		return $query->num_rows();
	}
	
	public function countArticle($cat){
		$this->db->from('article');
		$this->db->where('article.cat',$cat);
		$this->db->where('article.status',1);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function countSearch($search){
	    $this->db->like('title_en',$search);
		$this->db->where('status',1);
		$query = $this->db->get("article");
		return $query->num_rows();
	}
	
	public function fetchItemsSearch($limit, $start, $string ,$name) {
        $cat = $this->findMenu($name);
		$this->db->select('*');
	    $this->db->from('article');
		$this->db->where('status',1);
		$this->db->where('menu !=',$cat->id);
		$this->db->like('title_en',$string);
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
		$table = $this->db->query('SELECT MIN(sort) AS minsort FROM article WHERE status=1');
		$result = $table->result();
		$result = $result[0]->minsort;
		return $result;
	}
	
	public function maxSort(){
		$table = $this->db->query('SELECT MAX(sort) AS maxsort FROM article WHERE status=1');
		$result = $table->result();
		$result = $result[0]->maxsort;
		return $result;
	}
	
	public function fetchItems($limit, $start, $home, $cat) {
        $this->db->distinct();
		$this->db->select('*');
	    $this->db->from('article');
		$this->db->where('cat',$cat);
		$this->db->where('status',1);
		
		if($home!=0)
		$this->db->where('home',1);
		
		$this->db->order_by('date','desc');
		$this->db->limit($limit,$start);
		$table = $this->db->get();
	
		if ($table->num_rows() > 0) {
            foreach ($table->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
	
	public function ItemArticle($id){
	    $this->db->select('*');
		$this->db->from('menu');
		$this->db->where('status',1);
		$this->db->where('id',$id);
		$query = $this->db->get();
		$result = $query->result();
 		return $result;
	}
	
	public function ItemNewsNext($sort){
	    $this->db->select('article.*');
		$this->db->from('article');
		$this->db->where('article.status',1);
	
		if($sort == $this->maxSort())
		$this->db->where('article.sort',1);
		else
		$this->db->where('article.sort > ',$sort);
				
		$this->db->order_by('article.sort','asc');
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result();
		$result = $result[0];
		return $result;
	}
	
	public function ItemNewsBack($sort){
	    $this->db->select('article.*');
		$this->db->from('article');
		$this->db->where('article.status',1);
		
		if($sort == 1)
		$this->db->where('article.sort',$this->maxSort());
		else
		$this->db->where('article.sort < ',$sort);
		
		$this->db->order_by('article.sort','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result();
		$result = $result[0];
		return $result;
	}
	
	public function showArticle($id){
		$this->db->select('*');
		$this->db->from('article');
		$this->db->where('status',1);
		$this->db->where('menu',$id);
		$this->db->order_by('sort','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function showArticleHome($id){
		$this->db->select('id,title_vn,title_en,image,style,title_url,date,alt_image');
		$this->db->from('article');
		$this->db->where('status',1);
		$this->db->where('home',1);
		$this->db->where('menu',$id);
		$this->db->order_by('article.sort','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function showDayHome(){
		$this->db->select('id,title_vn,title_en,image,title_url,date_begin,date_end,alt_image,location_en,link');
		$this->db->from('day');
		$this->db->where('status',1);
		$this->db->where('home',1);
		$this->db->order_by('sort','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
}

?>