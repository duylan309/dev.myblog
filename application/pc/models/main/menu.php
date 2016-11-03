<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Menu extends CI_Model
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
	
	public function getMenu($value){
		$table = $this->db->query('select id,title_vn,title_en,title_url,pc,mobile from menu where status = 1 and '.$value['table'].' = ? order by sort asc',intval($value['device']));
		return $table->result();
	}
	
	public function getId($page){
		$table  = $this->db->query('select id from menu where title_url = ?',$page);
		$result = $table->result();
		return $result;	
	}
}

?>