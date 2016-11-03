<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino'));
	}
		
	public function index($data){
	   //$search                = $this->input->post('search',true);
	   $likeValue 	          = getParam($this,'search_value');
	   $data['search_value']  = $likeValue;
	   $countAll              = 0;
	   $whereValue['status']  = 1;
	   $whereLike['title_en'] = $likeValue;
	   $whereLike['title_vn'] = $likeValue;
	   $cAll = 0;
	   foreach($data['listMenu'] as $menu => $key):
		   if($key->type == 2 || $key->type == 3 || $key->type == 4 || $key->type == 5 )	:
		   		$countAll    += $this->maindino->countSearch(strtolower($key->title_url),$whereLike,$whereValue);
				$cAll++;
		   endif;
       endforeach;	
	   	   
	   $config = array();
	  // $setData['coutAll'] 	  = $countAll;
	   $config["base_url"]    = base_url().'search?query='.$likeValue.'&page=';
	   $config["per_page"]    = 10;
       $config["uri_segment"] = 10;
	   $config["total_rows"]  = $countAll;
	   $config["typeMain"] 	  = 'main';
	   $config['cur_page'] 	  = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   $this->pagination->initialize($config);
	  
	   $page                  = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   
	   $i=0;
	   foreach($data['listMenu'] as $menu => $key):
		   if($key->type == 2 || $key->type == 3 || $key->type == 4 || $key->type == 5 )	:
		   		$data['results'][$i]['lists'] = $this->maindino->ListItems(strtolower($key->title_url),round($config["per_page"]/$cAll), round($page/$cAll),$whereLike,$whereValue,-1,'DESC');	
		   		$data['results'][$i]['title_en']  = $key->title_en;
				$data['results'][$i]['title_vn']  = $key->title_vn;
				$data['results'][$i]['title_url'] = $key->title_url;
				$data['results'][$i]['type']      = $key->type;
		   $i++;
		   endif;
       endforeach;
	   
	   $data["links"] 		  = $this->pagination->create_links();
	   $data['meta']['title'] = $data['lang']=='en' ? 'Search: '.$likeValue : 'Tìm kiếm: '.$likeValue;
	   $data['meta']['keyword'] = $data['lang']=='en' ? 'Search: '.$likeValue : 'Tìm kiếm: '.$likeValue;
	   $data['meta']['description'] = $data['lang']=='en' ? 'Search: '.$likeValue : 'Tìm kiếm: '.$likeValue;
	   
	   $data['template']        = "main/search/list.php";
	   $this->load->view('main/template/layout',$data);
	
	}
	
}

