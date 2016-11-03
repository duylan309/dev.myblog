<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	 	$this->load->model(array('main/maindino','admin/admindino','admin/captcha'));
		$this->load->library(array('email'));
	}

	public function _index($data){
		$data['id'] = intval($this->uri->rsegment(3));
		if(intval($data['id'])==0)
			$this->__index($data);
		else
			$this->_loadBlogDetail($data);	
				
	}

	public function __index($data){

		$data = $this->_loadblog($data);

		$fileXML 			    = $data['define_folder']['xml'].$data['lang']."/home_content.xml";
		$data['readXml']        = simplexml_load_file($fileXML);

		$data['slideshow']      = $this->maindino->loadTable('home_slide',NULL,array('status'=>1),1,'ASC');	
		
		$data['noFooterCars'] = 1;

		$data['template']  	 = "main/home/all.php";		
		$this->load->view('main/template/layout',$data);
		
	}
	
	private function _loadblog($data){
		$whereValue['status']    = 1;

	    $config = array();
	    $data['coutAll'] 	 = $this->maindino->countSearch(TABLEBLOG,NULL,$whereValue);
	    $config["base_url"]      = base_url().$data['menu']['title_url'].'?';
	    $config["per_page"]      = 20;
	    $config["uri_segment"]   = 5;
	    $config["total_rows"]    = $data['coutAll'];
	    $config["typeMain"] 	 = 'main';
	    $config['cur_page'] 	 = getParam($this, 'per_page') ? getParam($this, 'per_page') : 0;

	    //config for bootstrap pagination class integration
	    $config['full_tag_open'] = '<ul class="pagination modified">';
	    $config['full_tag_close'] = '</ul>';
	    $config['first_link'] = true;
	    $config['last_link'] = true;
	    $config['first_tag_open'] = '<li>';
	    $config['first_tag_close'] = '</li>';
	    $config['prev_link']     = '&laquo';
	    $config['prev_tag_open'] = '<li class="prev">';
	    $config['prev_tag_close']= '</li>';
	    $config['next_link']     = '&raquo';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close']= '</li>';
	    $config['last_tag_open'] = '<li>';
	    $config['last_tag_close']= '</li>';
	    $config['cur_tag_open']  = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open']  = '<li>';
	    $config['num_tag_close'] = '</li>';

	    $this->pagination->initialize($config);

	    $page                    = getParam($this, 'per_page') ? getParam($this, 'per_page') : 0;

	    $data['results_blogs']   = $this->maindino->ListItems(TABLEBLOG,$config["per_page"], $page,NULL,$whereValue,-1,'DESC');	
	    $data["links"] 		     = $this->pagination->create_links();
		
		return $data;
	}

	private function _loadBlogDetail($data){
		$selection  = TABLEBLOG.'.*,';
		$selection .= TABLEUSER.'.image AS user_image,';
		$selection .= TABLEUSER.'.name AS user_name,';
		$selection .= TABLEUSER.'.title AS user_title';
		GetValueJoinFrom(TABLEBLOG,TABLEUSER,TABLEBLOG.'.postby='.TABLEUSER.'.id','id',$data['id'],$selection);
		$data['readXml']        = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['result_menu']['menu']->title_url.'/',$data['id']);
		$data['meta']		    = $data['readXml']['meta']; 
		
		// Load Newest
		$data['listOther'] = $this->maindino->loadTable($data['result_menu']['menu']->title_url,NULL,array('status'=>1,'id !='=>$data['id']),'id','DESC',5);
		
		$data['template']  = "main/ListArticle/item.php";
		$this->load->view('main/template/layout',$data);	
	}
}

