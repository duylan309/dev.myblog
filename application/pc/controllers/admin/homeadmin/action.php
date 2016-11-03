<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('admin/admindino');	
	}
		
	public function getAction($data)
	{
			
	
		/*$data['lienhe_url']     =  $this->admindino->GetValueFrom('menu','id',2,'*');
		$data['countLienhe']    =  $this->admindino->CountAll('contact_inbox');
		$data['lienhe_list']    =  $this->admindino->loadTable('contact_inbox',NULL,NULL,5);
		
	
		
		$data['countStudent']   =  $this->admindino->CountAll('students');
		$data['countLienhe']    =  $this->admindino->CountAll($data['lienhe_url']->title_url.'_inbox');
		$data['countModule']    =  $this->admindino->CountAll('modulecreate');
		$data['Contactinbox']   =  $this->admindino->loadTable('lien-he_inbox',NULL,array('status'=>0),NULL); */
		
		
		/*$this->gapi_lib->email($ga_email);
		$this->gapi_lib->password($ga_password);*/
		
	    $data['template']  = "admin/homeadmin/index.php";
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	
}

