<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remove extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->model('admin/admindino');
		$this->load->dbforge();
		$this->load->helper('file');
	}
		
	public function RemoveItem($setData){
		$value = $this->admindino->GetValueFrom('menu','id',$setData['id'],'type,title_url');
	
		if($value->type == 2 || $value->type == 4 || $value->type == 9):
			$this->DeleteArticle($value->title_url);
			$this->DeleteArticleNoFolder($value->title_url.'_photo');
		elseif($value->type == 3 || $value->type == 5 || $value->type==8):
			$this->DeleteArticle($value->title_url);
			$this->DeleteArticleNoFolder($value->title_url.'_photo');
			$this->DeleteArticle($value->title_url.'_cat');
		elseif($value->type == 6 || $value->type == 11) :
			$this->DeleteArticle($value->title_url);
		elseif($value->type == 7):
			$this->DeleteArticleNoFolder($value->title_url.'_inbox');	
		endif;
		
		$this->admindino->DeleteTable('menu',$setData['id']);
		redirect(base_url().ADMINBASE.'?page=menu&action=lists&id=0&function=null');
	}
	
	private function DeleteArticle($title_url){
		
		if($this->dbforge->drop_table($title_url)){
				$pathdir_image  	   =  "./upload/".$title_url;
				$pathdir_image_store   =  "./upload/storage/".$title_url;
				$pathdir_xml_vn 	   =  "./xmldata/vn/".$title_url;
				$pathdir_xml_en 	   =  "./xmldata/en/".$title_url;
							
				if(delete_files($pathdir_image , true))
					rmdir($pathdir_image);
					 
				if(delete_files($pathdir_xml_vn , true))
					rmdir($pathdir_xml_vn);
					 
				if(delete_files($pathdir_xml_en , true))
					rmdir($pathdir_xml_en);
				
				if(delete_files($pathdir_image_store , true))
					rmdir($pathdir_image_store);
				
				return TRUE;		
		}else
				return FALSE;	
	}
	
	private function DeleteArticleNoFolder($title_url){
		if($this->dbforge->drop_table($title_url))
			return TRUE;
		else
			return FALSE;	
	}
	
}

