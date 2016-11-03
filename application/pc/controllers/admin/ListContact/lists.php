<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lists extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('admin/admindino'));	
	}
	
	public function searchTable($setData){
	//	echo $setData['page'];
		$search = $this->input->post('function');
		///Define first value
		$setData['session']['where']     = NULL;
		$setData['coutAll']  = $this->admindino->CountAll('contact_inbox');
		
		//Check Session search
		if($search){
			$setData['session']['where']['id']	   =  $this->input->post('fId');
			$setData['session']['where']['fullname'] =  $this->input->post('fTitle');
			$setData['session']['status']   	   =  $this->input->post('fStatus');
			$setData['session']['sort']     =  $this->input->post('fSort');
			$setData['session']['sortTable']       =  $this->input->post('fsortTable');
			
		}else{
			$setData['session']    = $this->session->userdata($setData['page'].'_inbox');
			if($setData['session'] == FALSE):
				$setData['session']['where']['id']  = '';
				$setData['session']['where']['fullname']   = '';
				$setData['session']['status']	    = -1;
				$setData['session']['sort']     =  0;
				$setData['session']['sortTable']    =  'id';
				$this->session->set_userdata($setData['page'].'_inbox', $setData['session']);
			endif;
		}
				
		if( !empty($setData['session']['where']['id']) || 
			!empty($setData['session']['where']['fullname']) ||  
			$setData['session']['status']>=0 ||
			!empty($setData['session']['sortTable'])):
			$whereValue['status']      = intval($setData['session']['status']);
			$whereLike['id']           = $setData['session']['where']['id'];
			$whereLike['fullname']     = $setData['session']['where']['fullname'];
			$this->session->set_userdata($setData['page'], $setData['session']);
			$setData['coutAll']  = $this->admindino->countSearch('contact_inbox',$whereLike,$whereValue);
		else:
			$this->session->unset_userdata($setData['page'].'_inbox');
		endif;// END IF CHECK EMPTY
					
		$this->showTable($setData);
		
		//-----------------------------------------------------------------------------------//
	}
	
	
	function showTable($value){
		
		//PHAN TRANG
		$data['session']		   = $value['session'];
		$data['coutAll']           = $value['coutAll'];
		
		$config 				    = array();
		$config["base_url"]        = base_url().ADMINBASE."?page=".$value['page']."&action=lists&id=0&function=null";
		$config["per_page"]        = 20;
        $config["uri_segment"]     = 3;
		$config["total_rows"]      = $value['coutAll'];
		$config["typeMain"] 	    = 'admin';
		$config['cur_page'] 	    = getParam($this,'per_page');
	   

	    $this->pagination->initialize($config);	 
		$page  					  = getParam($this,'per_page') ? getParam($this,'per_page') : 0;
		
		$whereValue['status']      = intval($data['session']['status']);
		$sortValue       		   = intval($data['session']['sort'])==0 ? 'DESC' : 'ASC';
		$sort 					   = $data['session']['sortTable'];
		$whereLike['id']           = $data['session']['where']['id'];
		$whereLike['fullname']     = $data['session']['where']['fullname'];
		$data["results"]           = $this->admindino->ListItems('contact_inbox',$config["per_page"], $page ,$whereLike,$whereValue,$sort,$sortValue);//Get result from search
	
		$data["links"]             = $this->pagination->create_links();
			
		$data['check_new']         = $value['check_new'];
		$data['define_folder']     = $value['define_folder'];
		$data['language']          = $value['language']; 
		$data['lang']              = $value['lang'];	
		$data['getMenuAdmin']      = $value['getMenuAdmin'] ;
		$data['page']              = $value['page'];
		$data['AdminMenu']         = $value['AdminMenu'];


		// SET VALUE PAGE
		$data["page_title"]       = $value["lang"]=="en" ? $value['getMenuAdmin']->title_en : $value['getMenuAdmin']->title_vn;
		$data["page_table_sql"]   = $value["page"];
		
		
		$data['template'] 		  = "admin/ListContact/".$value['action'].".php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	
	
}

