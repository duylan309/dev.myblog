<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lists extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->model('admin/adminuser');	
	}
	
	public function searchTable($setData){
		$this->session->unset_userdata('search');
		$search = $this->input->post('function');
		$adminuser = array();
		
		///Define first value
		$setData['where'] = NULL;
		$setData['coutAll'] = $this->adminuser->countAll();
		
		//Check Session search
		if($search)
			$this->session->set_userdata('search', 'on');
				
		if($this->session->userdata('search') == 'on'){
 
		   //Get value from input
		   $fTitle = $this->input->post('fTitle');
		   $fId =  $this->input->post('fId');
	       $fStatus =  $this->input->post('fStatus');
		
		   if(!empty($fId) || !empty($fTitle) || $fStatus>=0){
				$lang = $setData['lang'];
				$title = 'title_'.$lang;
			
			    if($this->session->userdata('search') == 'on'){
											
					$setData['session']['title'] = !empty($fTitle) ? $setData['where'][$title] = $fTitle : '' ;
					$setData['session']['id'] = !empty($fId) ? $setData['where']['id'] = $fId : '';
					$setData['session']['status'] = !empty($fStatus) ? $setData['status'] = $fStatus : '';
			
					$setData['coutAll'] = $this->adminuser->countSearch( $setData['where'],intval($setData['session']['status']));
				}// END IF SESSION ON
				
			}else{
					$this->session->unset_userdata('search');
					
			}// END IF CHECK EMPTY
		
		}else{
			$this->session->unset_userdata('search');
		}
				
		$this->showTable($setData);
	}
	
	
	function showTable($value){
		
		$data['session'] = !empty($value['session']) ? $value['session'] : '';
		$data['session']['title'] = !empty($value['session']['title']) ? $value['session']['title'] : '';
		$data['session']['id'] = !empty($value['session']['id']) ? $value['session']['id'] : '';
		
		
		//PHAN TRANG
		$data['coutAll'] = $value['coutAll'];
		$adminuser = array();
		$adminuser["base_url"] =  base_url()."admin/adminuser/";
		$adminuser["per_page"] = 10;
        $adminuser["uri_segment"] = 3;
		$adminuser["total_rows"] = $data['coutAll'];
		 
        $this->pagination->initialize($adminuser);	 
		$page  = getParam($this, "per_page") ? getParam($this, "per_page") : 0;
		
		if($this->session->userdata('search')=='on'){
			$data["results"] = $this->adminuser->noPage($value['where'],intval($data['session']['status']));//Get result from search
			$data["links"] = '';
		}else{
			$data["results"] = $this->adminuser->fetchItems($adminuser["per_page"], $page ,$value['where']);//Get first result
			$data["links"] = $this->pagination->create_links();
		}
	
		//DuLieu
		$data['check_new']         = $value['check_new'];
		$data['define_folder']     = $value['define_folder'];
		$data['language']          = $value['language']; 
		$data['lang']              = $value['lang'];	
		$data['page']              = $value['page'];
		$data['AdminMenu']         = $value['AdminMenu'];
		$data['template'] = "admin/adminuser/".$value['action'].".php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	
}

