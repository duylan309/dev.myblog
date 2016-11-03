<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lists extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->helper("url");
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('admin/contact');	
	}
	
	public function searchTable($setData){
		$this->session->unset_userdata('search');
		$search = $this->input->post('function');
		$config = array();
		
		///Define first value
		$setData['where'] = NULL;
		$setData['session']['status'] = -1;
		$setData['coutAll'] = $this->contact->countAll();
		
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
			
					$setData['coutAll'] = $this->contact->countSearch( $setData['where'],intval($setData['session']['status']));
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
		$data['session']['status'] = $value['session']['status']>=0 ? $value['session']['status'] : -1;
		
		
		//PHAN TRANG
		$data['coutAll'] = $value['coutAll'];
		$config = array();
		$config["base_url"] =  base_url()."admin/contact/";
		$config["per_page"] = 10;
        $config["uri_segment"] = 3;
		$config["total_rows"] = $data['coutAll'];
		 
        $this->pagination->initialize($config);	 
		$page  = getParam($this, "per_page") ? getParam($this, "per_page") : 0;
		
		if($this->session->userdata('search')=='on'){
			$data["results"] = $this->contact->noPage($value['where'],intval($data['session']['status']));//Get result from search
			$data["links"] = '';
		}else{
			$data["results"] = $this->contact->fetchItems($config["per_page"], $page ,$value['where']);//Get first result
			$data["links"] = $this->pagination->create_links();
		}
		
		$data['check_new']    = $value['check_new'];
		//DuLieu
		$data['define_folder']= $value['define_folder'];
		$data['language'] = $value['language']; 
		$data['lang'] = $value['lang'];	
		$data['template'] = "admin/contact/".$value['action'].".php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	
}

