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
		
		$this->_loadPage($data);	
	}
	
	private function _index($data){
	
	   $data['template']        = "main/".$data['FOLDERCONTROL']."/list.php";
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

