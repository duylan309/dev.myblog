<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino'));
	}
		
	public function index($data){
		$data['id'] = intval($this->uri->rsegment(5));
		$data['FOLDERCONTROL'] = FOLDERCONTROLCARPRICING;
		
		$this->_loadPage($data);	
				
	}
	
	private function _loadPage($data){

	   $data['results_car_class'] = $this->maindino->loadTable(TABLECARCATEGORY,NULL,array('status'=>1),'id','DESC');	
	   $data['results_car_style'] = $this->maindino->loadTable(TABLECARSTYLE,NULL,array('status'=>1),'id','DESC');	

	   $data['noFooterCars'] = 1;
	   
	   $sql = ('SELECT * FROM menu WHERE table_control = ? ');
	   $getMenuCurrentExtra  = $this->maindino->runSQL($sql,array(FOLDERCONTROLCARCATEGORY));
	   

	   $data['link_car_class']    = $getMenuCurrentExtra[0]->title_url;

	   // // Load Newest
	   // $data['listOther'] = $this->maindino->loadTable($data['TABLESQL'],NULL,array('status'=>1,'id !='=>$data['id']),'id','DESC',5);
	   
	   $data['template']  = "main/".$data['FOLDERCONTROL']."/item.php";
	   $this->load->view('main/template/layout',$data);	
	}
	
}

