<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino'));
	}
		
	public function index($data){
		$data['id'] = intval($this->uri->rsegment(5));
		$ajax       = getParam($this, 'ajax') ? getParam($this, 'ajax') : 0;
		
		if(intval($data['id'])==0 && $ajax==0)
			$this->_index($data);
		else
			$this->_loadPage($data);
	}
	
	private function _index($data){
	   $whereValue['status']    = 1;
	   
	   $config = array();
	   $data['coutAll'] 	    = $this->maindino->countSearch($data['result_menu']['menu']->title_url,NULL,$whereValue);
	   $config["base_url"]      = base_url().$data['result_menu']['menu']->title_url.'?page=';
	   $config["per_page"]      = $data['result_menu']['menu']->items == 0 ? 16 : $data['result_menu']['menu']->items;
       $config["uri_segment"]   = 10;
	   $config["total_rows"]    = $data['coutAll'];
	   $config["typeMain"] 	    = 'main';
	   $config['cur_page'] 	    = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   $this->pagination->initialize($config);
	  
	   $page                    = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   
	   $data['results_gallery']         = $this->maindino->ListItems($data['result_menu']['menu']->title_url,$config["per_page"], $page,NULL,$whereValue,'sort','ASC');	
	   $data["links"] 		    = $this->pagination->create_links();
	   $data['menu_gallery']      = $data['result_menu']['menu'];
	   $data['template']        = "main/ListGallery/list.php";
	   $this->load->view('main/template/layout',$data);
	}
	
	private function _loadPage($data){
	   $data['item']           = $this->maindino->GetValueFrom($data['result_menu']['menu']->title_url,'id',$data['id'],'*') ;
	   $whereV['status']       = 1; 
	   $whereV['album_id']     = $data['id']; 
	   $data['listImage']  	   = $this->maindino->loadTable($data['result_menu']['menu']->title_url.'_photo',NULL,$whereV,-1,'ASC');	
	   $data['readXml']        = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['result_menu']['menu']->title_url.'/',$data['id']);
	   $data['meta']		   = $data['readXml']['meta']; 
	
	  //Load others
	   $whereOther['status']   = 1;
	   $whereOther['id !=']    = $data['id'];  		
	   $data['listOthers']= $this->maindino->loadTableWhereIn($data['result_menu']['menu']->title_url,NULL,$whereOther,explode(',',$data['item']->str));	
	   
	   // Load Newest
	   $data['listNewest'] = $this->maindino->loadTable($data['result_menu']['menu']->title_url,NULL,array('status'=>1,'id !='=>$data['id']),'id','DESC',3); 	
	  
	  
	   $data['template']  = "main/ListGallery/item.php";
	   $this->load->view('main/template/layout',$data);	
	}
	 
}

