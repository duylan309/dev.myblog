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
	   $setData['coutAll'] 	    = $this->maindino->countSearch($data['result_menu']['menu']->title_url,NULL,$whereValue);
	   $config["base_url"]      = base_url().$data['result_menu']['menu']->title_url.'?';
	   $config["per_page"]      = 2;
       $config["uri_segment"]   = 10;
	   $config["total_rows"]    = $setData['coutAll'];
	   $config["typeMain"] 	    = 'main';
	   $config['cur_page'] 	    = getParam($this, 'per_page') ? getParam($this, 'per_page') : 0;
	   
	   //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination modified">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = true;
        $config['last_link'] = true;
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
	  
	   $page                    = getParam($this, 'per_page') ? getParam($this, 'per_page') : 0;
	   
	   $data['results']         = $this->maindino->ListItems($data['result_menu']['menu']->title_url,$config["per_page"], $page,NULL,$whereValue,-1,'DESC');	
	   
	  // var_dump($data['results']);
	   $data["links"] 		   = $this->pagination->create_links();

	   $data['readXml_menu']      = $this->dinosaur_lib->loadXml($data['lang'],$data['define_folder']['xml_menu'] ,$data['result_menu']['menu']->id);
		
	   $data['template']        = "main/ListArticle/list.php";
	   $this->load->view('main/template/layout',$data);
	}
	
	private function _loadPage($data){
	   $data['item']           = $this->maindino->GetValueFrom($data['result_menu']['menu']->title_url,'id',$data['id'],'*') ;
	   $data['readXml']        = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['result_menu']['menu']->title_url.'/',$data['id']);
	   $data['meta']		   = $data['readXml']['meta']; 
	  
	   // Load Newest
	   $data['listOther'] = $this->maindino->loadTable($data['result_menu']['menu']->title_url,NULL,array('status'=>1,'id !='=>$data['id']),'id','DESC',5);
	   
	   $data['template']  = "main/ListArticle/item.php";
	   $this->load->view('main/template/layout',$data);	
	}
	
}

