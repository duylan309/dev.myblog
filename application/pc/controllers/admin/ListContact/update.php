<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->helper("url");
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->model('admin/admindino');
	}
	
		
	public function UpdateItem($setData){
		$id = $setData['id'];
		$arr['status']       = 1;
		$this->admindino->UpdateTable('contact_inbox',$arr,$id);
		
		$data['result'] = $this->admindino->GetValueFrom('contact_inbox','id',$id,'*');	
		//IMAGE
		$data['define_folder']= $setData['define_folder'];
		
		$data['check_new']    = $setData['check_new'];
		//LANGUAGE
		$data['language'] = $setData['language']; 
		$data['lang'] = $setData['lang'];
		$data['AdminMenu']    = $setData['AdminMenu'];
		$data['page']         = $setData['page'];

		// SET VALUE PAGE
		$data["page_title"]       = $setData["lang"]=="en" ? $setData['getMenuAdmin']->title_en : $setData['getMenuAdmin']->title_vn;
		$data["page_table_sql"]   = $setData["page"];
		
		//TEMPLATE
		$data['template'] = "admin/ListContact/".$setData['action'].".php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	
}

