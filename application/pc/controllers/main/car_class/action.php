<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino'));
	}
		
	public function index($data){
		$data['id'] = intval($this->uri->rsegment(5));
		$data['FOLDERXML']     = XMLCARCATEGORY;
		$data['FOLDERIMAGE']   = IMAGECARCATEGORY;
		$data['TABLESQL']      = TABLECARCATEGORY;
		$data['FOLDERCONTROL'] = FOLDERCONTROLCARCATEGORY;
		$data['TABLEGALLERYPHOTO'] = TABLECARCATEGORY.'_photo';
	    $data['TABLEGALLERYBANNER'] = TABLECARCATEGORY.'_banner';
	
		$this->_loadPage($data);	
	}
	
	private function _index($data){
	   $whereValue['status']    = 1;
	   
	   $config = array();
	   $setData['coutAll'] 	    = $this->maindino->countSearch($data['TABLESQL'],NULL,$whereValue);
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
	   
	   $data['results']         = $this->maindino->ListItems($data['TABLESQL'],$config["per_page"], $page,NULL,$whereValue,-1,'DESC');	
	   
	   $data["links"] 		   = $this->pagination->create_links();

	  // $data['readXml_menu']   = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['FOLDERCONTROL'].'/',$data['result_menu']['menu']->id);
		
	   $data['template']        = "main/".$data['FOLDERCONTROL']."/list.php";
	   $this->load->view('main/template/layout',$data);
	}
	
	private function _loadPage($data){
	   $data['results']        = $this->maindino->loadTable($data['TABLESQL'],NULL,NULL,'id','DESC');	
	   $data['id']             = intval($data['id']) == 0 ? $data['results'][0]->id : $data['id'];
 
	   $data['item']           = $this->maindino->GetValueFrom($data['TABLESQL'],'id',$data['id'],'*') ;
	   $data['readXml']        = $this->dinosaur_lib->loadXmlGeneral($data['lang'],'/'.$data['FOLDERXML'].'/',$data['id']);

	   $data['meta']		   = $data['readXml']['meta']; 
	   $data['images_banner']  = $this->maindino->loadTable($data['TABLEGALLERYBANNER'],NULL,array('album_id'=>$data['id'], 'status'=>1),1,'ASC');	
	   $data['images_photos']  = $this->maindino->loadTable($data['TABLEGALLERYPHOTO'],NULL,array('album_id'=>$data['id'], 'status'=>1),1,'ASC');	
 
	   // SO SANH XE
	   $data['results_car_value'] = $this->maindino->loadTable(TABLECARVALUE,NULL,NULL,NULL,'ASC');	
	   
	   $whereValue['status']      = 1;
	   $whereValue['cat']         = $data['id'];
	   $data['results_cars']      = $this->maindino->loadTable(TABLECAR,NULL,$whereValue,NULL,'ASC');	

	   $data['id_car_one']        = isset($data['results_cars']) && $data['results_cars'] ? ( getParam($this,'car_one') && count(getParam($this,'car_one')) ? getParam($this,'car_one') :  $data['results_cars'][0]->id ) : '';
	   $data['id_car_two']        = isset($data['results_cars']) && $data['results_cars'] ? ( getParam($this,'car_two') && count(getParam($this,'car_two')) ? getParam($this,'car_two') :  $data['results_cars'][0]->id ) : '';


	   $data['readXml_car_one']   = isset($data['results_cars']) && $data['results_cars'] ? ( $this->dinosaur_lib->loadXmlGeneral($data['lang'],'/'.XMLCAR.'/',$data['id_car_one']) ) : '';
	   $data['readXml_car_two']   = isset($data['results_cars']) && $data['results_cars'] ? ( $this->dinosaur_lib->loadXmlGeneral($data['lang'],'/'.XMLCAR.'/',$data['id_car_two']) ) : '';

	   $data['readXml_car_one']   = isset($data['results_cars']) && $data['results_cars'] ? ( $data['readXml_car_one']['extra'] ) : '';
	   $data['readXml_car_two']   = isset($data['results_cars']) && $data['results_cars'] ? ( $data['readXml_car_two']['extra'] ) : '';

	   $data['template']  = "main/".$data['FOLDERCONTROL']."/item.php";
	   $this->load->view('main/template/layout',$data);	
	}
	
}

