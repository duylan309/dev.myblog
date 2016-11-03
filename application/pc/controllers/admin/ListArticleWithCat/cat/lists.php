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
		$setData['coutAll']  = $this->admindino->CountAll($setData['page']);
		
		//Check Session search
		if($search){
			$setData['session']['where']['title_'.$setData['lang']] 	=  $this->input->post('fTitle');
			$setData['session']['where']['id']	   =  $this->input->post('fId');
			$setData['session']['status']          =  $this->input->post('fStatus');
			$setData['session']['sort']            =  $this->input->post('fSort');
			$setData['session']['sortTable']       =  $this->input->post('fsortTable');
		}else{
			$setData['session']    = $this->session->userdata($setData['page']);
			if($setData['session'] == FALSE):
				$setData['session']['where']['title_'.$setData['lang']]  = '';
				$setData['session']['where']['id']     = '';
				$setData['session']['status'] = -1;
				$setData['session']['sort']   = 0;
				$setData['session']['sortTable'] ='id';
				$this->session->set_userdata($setData['page'], $setData['session']);
			endif;
		}

		if( !empty($setData['session']['where']['id']) || 
			!empty($setData['session']['where']['title_'.$setData['lang']])  || 
			$setData['session']['status']>=0 ||
			!empty($setData['session']['sortTable'])):
			$whereValue['status']      = intval($setData['session']['status']);
			$whereLike['id']           = $setData['session']['where']['id'];
			$whereLike['title_'.$setData['lang']]        =  $setData['session']['where']['title_'.$setData['lang']];
			$this->session->set_userdata($setData['page'], $setData['session']);
			$setData['coutAll']  = $this->admindino->countSearch( $setData['page'],$whereLike,$whereValue);
		else:
			$this->session->unset_userdata($setData['page']);
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
		
		$whereValue['status']      = intval($data['session']['status']);
		$sortValue       		   = intval($data['session']['sort'])==0 ? 'DESC' : 'ASC';
		$sort 					   = $data['session']['sortTable'];
		
		//print_r($sort);

 		$whereLike['id']           =  $data['session']['where']['id'];
		$whereLike['title_'.$value['lang']]        =  $data['session']['where']['title_'.$value['lang']];
		$data["results"]           = $this->admindino->ListItems($value['page'],$config["per_page"], $page ,$data['session']['where'],$whereValue,$sort,$sortValue);//Get result from search
		$data["links"]             = $this->pagination->create_links();
		
		$data['getMenuAdmin']      = $value['getMenuAdmin'] ;
		$data['check_new']         = $value['check_new'];
		$data['define_folder']     = $value['define_folder'];
		$data['language']          = $value['language']; 
		$data['lang']              = $value['lang'];	
		$data['page']              = $value['page'];
		$data['AdminMenu']         = $value['AdminMenu'];

		// SET VALUE PAGE
		$data["page_title"]       = $value["lang"]=="en" ? $value['getMenuAdmin']->title_en : $value['getMenuAdmin']->title_vn;
		$data["page_table_sql"]   = $value["page"];
		
		$data['template'] 		  = "admin/ListArticleWithCat/cat/".$value['action'].".php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
		
}

