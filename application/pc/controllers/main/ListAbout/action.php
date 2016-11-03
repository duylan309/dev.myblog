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
	   $config["per_page"]      = 40;
       $config["uri_segment"]   = 10;
	   $config["total_rows"]    = $setData['coutAll'];
	   $config["typeMain"] 	  = 'main';
	   $config['cur_page'] 	  = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   $this->pagination->initialize($config);
	  
	   $page                     = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   
	   $data['results']          = $this->maindino->ListItems($data['result_menu']['menu']->title_url,$config["per_page"], $page,NULL,$whereValue,'sort','ASC');	
	   $data["links"] 		     = $this->pagination->create_links();	
	   
	   $data['menu_gallery'] = $this->maindino->GetValueFrom('menu','id',3,'*');
	   $data['results_gallery'] = $this->maindino->ListItems($data['menu_gallery']->title_url,8, 0,NULL,array('status'=>1),'sort','ASC');
	   
	   $data['item_next'] = $this->maindino->GetNextValueFrom($data['result_menu']['menu']->title_url,$data['results'][0]->id,array('status'=>1),'title_url,id');
	   $data['item_prev'] = $this->maindino->GetPrevValueFrom($data['result_menu']['menu']->title_url,$data['results'][0]->id,array('status'=>1),'title_url,id');	
	   
	   $data['template']        = "main/ListAbout/list.php";
	   $this->load->view('main/template/layout',$data);
	}
	
	private function _loadPage($data){
	   $data['item']           = $this->maindino->GetValueFrom($data['result_menu']['menu']->title_url,'id',$data['id'],'*') ;
	   $data['readXml']        = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['result_menu']['menu']->title_url.'/',$data['id']);
	      
	    $whereValue['status']    = 1;
	   
	   $config = array();
	   $setData['coutAll'] 	  = $this->maindino->countSearch($data['result_menu']['menu']->title_url,NULL,$whereValue);
	   $config["base_url"]      = base_url().$data['result_menu']['menu']->title_url.'?page=';
	   $config["per_page"]      = 40;
       $config["uri_segment"]   = 10;
	   $config["total_rows"]    = $setData['coutAll'];
	   $config["typeMain"] 	  = 'main';
	   $config['cur_page'] 	  = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   $this->pagination->initialize($config);
	  
	   $page                     = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   
	   $data['results']          = $this->maindino->ListItems($data['result_menu']['menu']->title_url,$config["per_page"], $page,NULL,$whereValue,'sort','ASC');		  
	   
	   $data['item_next'] = $this->maindino->GetNextValueFrom($data['result_menu']['menu']->title_url,$data['id'],array('status'=>1),'title_url,id');
	   $data['item_prev'] = $this->maindino->GetPrevValueFrom($data['result_menu']['menu']->title_url,$data['id'],array('status'=>1),'title_url,id');	
	   
	   $data['meta']		   = $data['readXml']['meta']; 
	   $data['template']  = "main/ListAbout/item.php";
	   $this->load->view('main/template/layout',$data);	
	}
	
}

