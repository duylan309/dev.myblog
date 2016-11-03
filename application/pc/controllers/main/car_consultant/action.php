<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino'));
	}
		
	public function index($data){
		
		$data['FOLDERCONTROL'] = FOLDERCONTROLCARCONSULTANT;
		
		$this->_loadPage($data);	
	}
	
	private function _loadPage($data){
	   

	   $data['results_car_category'] = $this->maindino->loadTableSQL(TABLECARCATEGORY, '*' , NULL,NULL, 'title_vn ASC, title_en ASC');	
	   $data['results_car']          = $this->maindino->loadTableSQL(TABLECAR, '*' , NULL,NULL, 'title_vn ASC, title_en ASC');	

	   $data['template']  = "main/".$data['FOLDERCONTROL']."/list.php";
	   $this->load->view('main/template/layout',$data);	
	}
	
}

