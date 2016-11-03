<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino'));
	}
		
	public function index($data){
		$data['id'] = intval($this->uri->rsegment(5));
		$data['FOLDERXML']     = XMLCAR;
		$data['FOLDERIMAGE']   = IMAGECAR;
		$data['TABLESQL']      = TABLECAR;
		$data['FOLDERCONTROL'] = FOLDERCONTROLCOMPARISON;
	

			if(intval($data['id'])==0)
				$this->_index($data);
			else
				$this->_loadPage($data);	
				
	}
	
	private function _index($data){
	  	
	    $data['results_car_value'] = $this->maindino->loadTable(TABLECARVALUE,NULL,NULL,NULL,'ASC');	
	   
	    $whereValue['status']      = 1;
	    $data['results_cars']      = $this->maindino->loadTableSQL(TABLECAR,'*',$whereValue,NULL,'title_vn ASC, title_en ASC');	

	    
	    $data['id_car_one']        = getParam($this,'car_one') && count(getParam($this,'car_one')) ? getParam($this,'car_one') :  $data['results_cars'][0]->id;
	    $data['id_car_two']        = getParam($this,'car_two') && count(getParam($this,'car_two')) ? getParam($this,'car_two') :  $data['results_cars'][0]->id;


	    $data['readXml_car_one']   = $this->dinosaur_lib->loadXmlGeneral($data['lang'],'/'.$data['FOLDERXML'].'/',$data['id_car_one']);
	    $data['readXml_car_two']   = $this->dinosaur_lib->loadXmlGeneral($data['lang'],'/'.$data['FOLDERXML'].'/',$data['id_car_two']);

	    $data['readXml_car_one']   = $data['readXml_car_one']['extra'];
	    $data['readXml_car_two']   = $data['readXml_car_two']['extra'];




	   $data['template']          = "main/".$data['FOLDERCONTROL']."/list.php";
	   $this->load->view('main/template/layout',$data);
	}
	
	private function _loadPage($data){
	   $data['item']           = $this->maindino->GetValueFrom($data['TABLESQL'],'id',$data['id'],'*') ;
	   $data['readXml']        = $this->dinosaur_lib->loadXmlGeneral($data['lang'],'/'.$data['FOLDERXML'].'/',$data['id']);
	   $data['meta']		   = $data['readXml']['meta']; 
	  

	   $data['images_banner']  = $this->maindino->loadTable($data['TABLEGALLERYBANNER'],NULL,array('status'=>1),1,'ASC');	
	   $data['images_photos']  = $this->maindino->loadTable($data['TABLEGALLERYPHOTO'],NULL,array('status'=>1),1,'ASC');	

	   // Load Newest
	   $data['listOther'] = $this->maindino->loadTable($data['TABLESQL'],NULL,array('status'=>1,'id !='=>$data['id']),'id','DESC',5);
	   
	   $data['template']  = "main/".$data['FOLDERCONTROL']."/item.php";
	   $this->load->view('main/template/layout',$data);	
	}
	
}

