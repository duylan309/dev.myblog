<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lists extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->model('admin/admindino');	
	}
	
	public function searchTable($setData){
		$search = $this->input->post('function');
		///Define first value
		$setData['session']['where']     = NULL;
		$setData['coutAll']  = $this->admindino->CountAll('menu');
		
		//Check Session search
		if($search){
			$setData['session']['where']['title_'.$setData['lang']]  =  $this->input->post('fTitle');
			$setData['session']['where']['id']	                     =  $this->input->post('fId');
			$setData['session']['status']   =  $this->input->post('fStatus');
			$setData['session']['top']   =  $this->input->post('fTop');
			$setData['session']['sort']     =  $this->input->post('fSort');
			$setData['session']['sortTable']       =  $this->input->post('fsortTable');
		}else{
			$setData['session']    = $this->session->userdata('session_menu');
			if($setData['session'] == FALSE):
				$setData['session']['where']['title_'.$setData['lang']]  = '';
				$setData['session']['where']['id']     = '';
				$setData['session']['status'] = -1;
				$setData['session']['top'] = -1;
				$setData['session']['sort']   = -1;
				$setData['session']['sortTable']       =  'id';
				$this->session->set_userdata('session_menu', $setData['session']);
			endif;
		}
				
		if( !empty($setData['session']['where']['id']) || 
			!empty($setData['session']['where']['title_'.$setData['lang']])  ||
			$setData['session']['status']>=0  || 
			$setData['session']['sort']>=0 || 
			$setData['session']['top']>=0 ||
			!empty($setData['session']['sortTable'])):
			//$this->session->set_userdata('session_menu', $setData['session']);
		//	$setData['coutAll']  = $this->menu->countSearch( $setData['session']['where'],intval($setData['session']['status']));
			$whereValue['top']         = intval($setData['session']['top']);
			$whereValue['status']      = intval($setData['session']['status']);
			$whereValue['sort']        = intval($setData['session']['sort']);
			$whereLike['id']           = $setData['session']['where']['id'];
			$whereLike['title_'.$setData['lang']]        =  $setData['session']['where']['title_'.$setData['lang']];
			$this->session->set_userdata('session_menu', $setData['session']);
			$setData['coutAll']  = $this->admindino->countSearch('menu',$whereLike,$whereValue);
		else:
			$this->session->unset_userdata('session_menu');
		endif;// END IF CHECK EMPTY
					
		$this->showTable($setData);
		
		//-----------------------------------------------------------------------------------//
	}
		
	function showTable($value){
		//PHAN TRANG
		$data['session']		   = $value['session'];
		$data['coutAll']           = $value['coutAll'];
				
		$config 				    = array();
		$config["base_url"]        = base_url().ADMINBASE."?page=menu&action=lists&id=0&function=null";
		$config["per_page"]        = 10;
        $config["uri_segment"]     = 3;
		$config["total_rows"]      = $value['coutAll'];
		$config["typeMain"] 	   = 'admin';
		$config['cur_page'] 	   = getParam($this,'per_page');

		//config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

	    $this->pagination->initialize($config);	 

		$page  					   = getParam($this,'per_page') ? getParam($this,'per_page') : 0;
		
		$whereValue['top']         = intval($data['session']['top']);
		$whereValue['status']      = intval($data['session']['status']);
		$sortValue       		   = intval($data['session']['sort'])==0 ? 'ASC' : 'DESC';
		$sort 					   = $data['session']['sortTable'];
		
 		$whereLike['id']           =  $data['session']['where']['id'];
		$whereLike['title_'.$value['lang']]        =  $data['session']['where']['title_'.$value['lang']];
		$data["results"]           = $this->admindino->ListItems('menu',$config["per_page"], $page ,$whereLike,$whereValue,$sort,$sortValue);//Get result from search
		$data["links"]             = $this->pagination->create_links();
		
		$data['check_new']         = $value['check_new'];
		$data['define_folder']     = $value['define_folder'];
		$data['language']          = $value['language']; 
		$data['lang']              = $value['lang'];	
		$data['page']              = $value['page'];	
		$data['AdminMenu']         = $value['AdminMenu'];


		// SET VALUE PAGE
		$data["page_title"]       = $data["lang"]=="en" ? 'Menu management' :'Quản trị menu';
		$data["page_table_sql"]   = "menu";

		$data['template'] 		  = "admin/menu/".$value['action'].".php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
}

