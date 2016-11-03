<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
		
	public function index($data){
		$this->loadPage($data);
	}
	
	private function loadPage($data){
		$menu_id		      = $data['result_menu']['menu']->id;
		$data['readXml']      = $this->dinosaur_lib->loadXml($data['lang'],$data['define_folder']['xml_menu'] ,$menu_id);
			
		$data['template']  = "main/SimplePage/simplelayout.php";
	    $this->load->view('main/template/layout',$data);	
	}
	
}

