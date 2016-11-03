<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino'));
	}
		
	public function index($data){
		$data['page'] = 'menu';

		$data['id'] = intval($this->uri->rsegment(5));
		$ajax       = getParam($this, 'ajax') ? getParam($this, 'ajax') : 0;
		
		if(intval($data['id'])==0 && $ajax==0)
			$this->_index($data);
		else
			$this->_loadPage($data);
	}
	
	private function _index($data){
	   $whereValue['status']    = 1;
	   $whereValue['album_id']  = $data['result_menu']['menu']->id;

	   $config = array();
	   $data['coutAll'] 	    = $this->maindino->countSearch('menu_photo',NULL,$whereValue);
	   $config["base_url"]      = base_url().$data['result_menu']['menu']->title_url.'?page=';
	   $config["per_page"]      = 3;
       $config["uri_segment"]   = 10;
	   $config["total_rows"]    = $data['coutAll'];
	   $config["typeMain"] 	    = 'main';
	   $config['cur_page'] 	    = getParam($this, 'page') ? getParam($this, 'page') : 0;

	    $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

	   $this->pagination->initialize($config);
	  
	   $page                    = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   
	   $data['results_gallery'] = $this->maindino->ListItems('menu_photo',$config["per_page"], $page,NULL,$whereValue,'sort','ASC');	
	   $data["links"] 		    = $this->pagination->create_links();

	   $data['menu_gallery']    = $data['result_menu']['menu'];
	   $data['template']        = "main/SimpleGallery/list.php";
	   $this->load->view('main/template/layout',$data);
	}
	
	private function _loadPage($data){
	   $data['item']           = $this->maindino->GetValueFrom('menu','id',$data['id'],'*') ;
	   $whereV['status']       = 1; 
	   $whereV['album_id']     = $data['id']; 
	   $data['listImage']  	   = $this->maindino->loadTable('menu'.'_photo',NULL,$whereV,-1,'ASC');	
	   $data['readXml']        = $this->dinosaur_lib->loadXml($data['lang'],'/'.'menu'.'/',$data['id']);
	   $data['meta']		   = $data['readXml']['meta']; 
	  
	   $data['template']  = "main/SimpleGallery/item.php";

	   $this->load->view('main/template/layout',$data);	
	}
	 
}

