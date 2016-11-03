<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino'));
	}
		
	public function index($data){
		$data['id'] = intval($this->uri->rsegment(5));
			if(intval($data['id'])==0)
				$this->_index($data);
			else
				$this->_loadPage($data);
		
		
				
	}
	
	private function _index($data){
	   $whereValue['status']    = 1;
	   
	   $config = array();
	   $setData['coutAll'] 	  = $this->maindino->countSearch($data['result_menu']['menu']->title_url,NULL,$whereValue);
	   $config["base_url"]      = base_url().$data['result_menu']['menu']->title_url.'?page=';
	   $config["per_page"]      = $data['configSite'][0]->info->page_number;
       $config["uri_segment"]   = 10;
	   $config["total_rows"]    = $setData['coutAll'];
	   $config["typeMain"] 	  = 'main';
	   $config['cur_page'] 	  = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   $this->pagination->initialize($config);
	  
	   $page                    = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   
	   $data['results']         = $this->maindino->ListItems($data['result_menu']['menu']->title_url,$config["per_page"], $page,NULL,$whereValue,'sort','ASC');	
	   $data["links"] 		   = $this->pagination->create_links();
	   
	   $data['template']        = "main/ListTeam/list.php";
	   $this->load->view('main/template/layout',$data);
	}
	
	private function _loadPage($data){
	   $data['item']           = $this->maindino->GetValueFrom($data['result_menu']['menu']->title_url,'id',$data['id'],'*') ;
	   $data['readXml']        = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['result_menu']['menu']->title_url.'/',$data['id']);
	   $data['meta']		   = $data['readXml']['meta']; 
	   $data['template']  = "main/ListTeam/item.php";
	   $this->load->view('main/template/layout',$data);	
	}
	
	private function __index($data){
	   $whereValue['status']    = 1;
	   
	   $data['results']  	     = $this->maindino->loadTable($data['result_menu']['menu']->title_url,NULL,$whereValue,1,'ASC');	
	   $whereV['status']       = 1; 
	   $whereV['album_id']     = $data['results'][0]->id; 
	   $data['listImage']  	  = $this->maindino->loadTable($data['result_menu']['menu']->title_url.'_photo',NULL,$whereV,1,'ASC');
	   
	   $data['template']        = "main/ListArticle/list-style-2.php";
	   $this->load->view('main/template/layout',$data);
	}
	private function __loadPage($data){
	   $whereValue['status']    = 1;
	   $data['results']  	    = $this->maindino->loadTable($data['result_menu']['menu']->title_url,NULL,$whereValue,1,'ASC');	
	   $data['item_detail']           = $this->maindino->GetValueFrom($data['result_menu']['menu']->title_url,'id',$data['id'],'*') ;
	   $whereV['status']       = 1; 
	   $whereV['album_id']     = $data['id']; 
	   $data['listImage']  	  = $this->maindino->loadTable($data['result_menu']['menu']->title_url.'_photo',NULL,$whereV,1,'ASC');
	   
	   $data['readXml']        = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['result_menu']['menu']->title_url.'/',$data['id']);
	   $data['meta']		   = $data['readXml']['meta']; 
	   $data['template']  = "main/ListArticle/item-style-2.php";
	   $this->load->view('main/template/layout',$data);	
	}
}

