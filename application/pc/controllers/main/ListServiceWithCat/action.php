<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino'));
	}
		
	public function index($data){
		$data['id']  = intval($this->uri->rsegment(6));
		$data['cat'] = intval($this->uri->rsegment(5));
		
		if(intval($data['id'])!=0)
			$layout = $this->_loadPage($data);
		else
			$layout = $this->_index($data);
			
		return $layout;	
	}
	
	private function _index($data){
	   $whereV['status']          = 1; 
	   $data['results_cat']  	   = $this->maindino->loadTable($data['result_menu']['menu']->title_url.'_cat',NULL,$whereV,1,'ASC');	
	   $whereValue['status']      = 1;
	   $data['arrMenuId']         = array();
	 
	   if(intval($data['cat'])!=0){
			$data['readXml']      = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['result_menu']['menu']->title_url.'_cat/',$data['cat']);
			$data['meta']		 = $data['readXml']['meta']; 
			
			$data['arrMenuId']    = $this->dinosaur_lib->getIdMenu($data['results_cat'],$data['cat'],$data['cat']);
			array_push($data['arrMenuId'],$data['cat']);
	   }else{
	   		$data['cat']          = $data['results_cat'][0]->id;
	   		$data['readXml']      = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['result_menu']['menu']->title_url.'_cat/',$data['cat']);
			$data['meta']		 = $data['readXml']['meta']; 
			
			$data['arrMenuId']    = $this->dinosaur_lib->getIdMenu($data['results_cat'],$data['cat'],$data['cat']);
			array_push($data['arrMenuId'],$data['cat']);
	   }
	   
	   $config = array();
	   $data['coutAll'] 	     = $this->maindino->countSearch($data['result_menu']['menu']->title_url,NULL,$whereValue,$data['arrMenuId']);
	   $config["base_url"]      = intval($data['cat'])!=0 ? base_url().$data['result_menu']['menu']->title_url.'/'.$this->uri->rsegment(4).'_'.$this->uri->rsegment(5).'.html?page=' : base_url().$data['result_menu']['menu']->title_url.'?page=';
	   $config["per_page"]      = 10;
       $config["uri_segment"]   = 10;
	   $config["total_rows"]    = $data['coutAll'];
	   $config["typeMain"] 	    = 'main';
	   $config['cur_page'] 	    = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   $this->pagination->initialize($config);
	  
	   $page                    = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   
	   $data['results']         = $this->maindino->ListItems($data['result_menu']['menu']->title_url,$config["per_page"], $page,NULL,$whereValue,'sort','ASC',$data['arrMenuId']);	
	   $data["links"] 		    = $this->pagination->create_links();
	   $data['arrMenu']         = $this->dinosaur_lib->createMenu($data['results_cat'],0,0,0,$data['lang'],$data['result_menu']['menu']->title_url,'',$data['cat']);

	   $data['template']  = "main/ListServiceWithCat/list.php";
	   $this->load->view('main/template/layout',$data);	
	}
	
	private function _loadPage($data){
		$whereV['status']          = 1; 
	   $data['results_cat']  	   = $this->maindino->loadTable($data['result_menu']['menu']->title_url.'_cat',NULL,$whereV,1,'ASC');	
	   $data['arrMenu']         = $this->dinosaur_lib->createMenu($data['results_cat'],0,0,0,$data['lang'],$data['result_menu']['menu']->title_url);
	   $data['item']           = $this->maindino->GetValueFrom($data['result_menu']['menu']->title_url,'id',$data['id'],'*') ;
	   $data['readXml']        = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['result_menu']['menu']->title_url.'/',$data['id']);
	   $data['meta']		   = $data['readXml']['meta']; 
	   $data['template']  = "main/ListServiceWithCat/item.php";
	   $this->load->view('main/template/layout',$data);	
	}
	
}

