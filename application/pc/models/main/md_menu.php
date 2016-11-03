<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Md_menu extends CI_Model
{
	public function getAll()
	{
		return $this->db->query('select * from menu');
	}
	
	public function editItem($value)
	{
		return $this->db->query('select * from menu where id = ?',$value);
	}
	
	public function countAll() {
        return $this->db->count_all("menu");
    }
	
	public function checkPage($url){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->where('title_url',$url);
		$table = $this->db->get('menu'); 	
		if ($table->num_rows() > 0) {
           return $table->result();
        }
        return false;
	
	}
	
	public function getSubMenu(){
		$this->db->select('id,title_vn,title_en,title_url');
		$this->db->where('status',1);
		$this->db->order_by('sort','asc');
		$this->db->order_by('id','desc');
		$table = $this->db->get('menu');
		return $table->result();
	}
	
	public function getMenu(){
		$this->db->select('id,title_vn,title_en,title_url');
		$this->db->where('status',1);
	
		$this->db->order_by('sort','asc');
		$this->db->order_by('id','desc');
		$table = $this->db->get('menu');
		return $table->result();
	}
	
	public function loadPage(){
		$this->db->select('menu.*');
		$this->db->from('menu');
		$this->db->where('status',1);
		$this->db->order_by('menu.sort','asc');
		$query = $this->db->get();
		$result = $query->result();
		$result = $result[0];
		return $result;
	}
	
	public function loadArticle($id){
		$this->db->select('article.*');
		$this->db->from('article');
		$this->db->where('status',1);
		$this->db->where('cat',$id);
		$this->db->order_by('sort','asc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getId($page){
		$table  = $this->db->query('select id from menu where title_url = ?',$page);
		$result = $table->result();
		return $result;	
	}
	
	
}

?>