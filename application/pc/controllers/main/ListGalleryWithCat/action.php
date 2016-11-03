<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino'));
	}
		
	public function index($data){
		$data['id']  = intval($this->uri->rsegment(6));
		$data['cat'] = intval($this->uri->rsegment(5));
		if(intval($data['id'])!=0 && intval($data['cat'])!=0)
			$this->_loadPage($data);
		elseif(intval($data['cat'])!=0)
			$this->_loadCat($data);
		else
			$this->_index($data);
	}
	
	private function _index($data){
	  /* $data['currentUrl']      = $this->_geturl($_SERVER['REQUEST_URI'] );	 
	   $data['results_cat']  	= $this->maindino->loadTable($data['result_menu']['menu']->title_url.'_cat',NULL,array('status'=>1),1,'ASC');     	
	  
	   if($data['results_cat']):
	   $i=0;  
	   foreach($data['results_cat']  as $cat):
	   $data['results'][$i]['title'] = $data['lang'] == "en" ? $cat->title_en : $cat->title_vn;
	   $data['results'][$i]['title_url'] = $cat->title_url;
	   $data['results'][$i]['cat'] = $cat->id;
	   $data['results'][$i]['data'] = $this->maindino->ListItemFindInNoPage($data['result_menu']['menu']->title_url,NULL,array('status'=>1),'sort','ASC',NULL,$cat->id,'cat',4);
	   $i++;
	   endforeach;
	   endif;*/
	  
	   $whereValue['status']    = 1;
	   
	   $config = array();
	   $data['coutAll'] 	    = $this->maindino->countSearch($data['result_menu']['menu']->title_url,NULL,$whereValue);
	   $config["base_url"]      = base_url().$data['result_menu']['menu']->title_url.'?page=';
	   $config["per_page"]      = 8;
       $config["uri_segment"]   = 10;
	   $config["total_rows"]    = $data['coutAll'];
	   $config["typeMain"] 	    = 'main';
	   $config['cur_page'] 	    = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   $this->pagination->initialize($config);
	  
	   $page                    = getParam($this, 'page') ? getParam($this, 'page') : 0;
	   
	   $data['results']         = $this->maindino->ListItems($data['result_menu']['menu']->title_url,$config["per_page"], $page,NULL,$whereValue,'sort','ASC');	
	
	   $data["links"] 		    = $this->pagination->create_links();
		
	   $data['template']   = "main/ListGalleryWithCat/list.php";
			  
	   $this->load->view('main/template/layout',$data);
	}
	
	
	private function _loadCat($data){
	   $data['currentUrl']      = $this->_geturl($_SERVER['REQUEST_URI'] );	 
	   $data['results_cat']  	= $this->maindino->loadTable($data['result_menu']['menu']->title_url.'_cat',NULL,array('status'=>1,'id'=>$data['cat']),1,'ASC');     	
	  
	   if($data['results_cat']):
		   $i=0;  
		   foreach($data['results_cat']  as $cat):
			   $data['results'][$i]['title'] = $data['lang'] == "en" ? $cat->title_en : $cat->title_vn;
			   $data['results'][$i]['data'] = $this->maindino->ListItemFindInNoPage($data['result_menu']['menu']->title_url,NULL,array('status'=>1),'sort','ASC',NULL,$data['cat'],'cat');
			   $i++;
		   endforeach;
	   endif;
	  

	   $data['template']   = "main/ListGalleryWithCat/listcat.php";
	   $this->load->view('main/template/layout',$data);	
	}
	
	private function _loadPage($data){
	  
	   $data['item']           = $this->maindino->GetValueFrom($data['result_menu']['menu']->title_url,'id',$data['id'],'*') ;
	   $data['readXml']        = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['result_menu']['menu']->title_url.'/',$data['id']);
	   
	
	   $whereV['status']       = 1; 
	   $whereV['album_id']     = $data['id']; 
	   $data['listImage']  	   = $this->maindino->loadTable($data['result_menu']['menu']->title_url.'_photo',NULL,$whereV,1,'ASC');	
	  
	   //Apartment
	   $data['listApartment']  = $this->maindino->loadTableWhereIn('kinds',NULL,NULL,explode(',',$data['item']->kinds));
	   
	   //Views
	   $data['listViews']  = $this->maindino->loadTableWhereIn('views',NULL,NULL,explode(',',$data['item']->views));
	   
	   //Views
	   $data['listFeatures']  = $this->maindino->loadTableWhereIn('features',NULL,NULL,explode(',',$data['item']->feature));
	  
	   //Load others
	   $whereOther['status']   = 1;
	   $whereOther['id !=']    = $data['id'];  		
	   $data['listOthers']= $this->maindino->loadTableWhereIn($data['result_menu']['menu']->title_url,NULL,$whereOther,explode(',',$data['item']->str),4);
	   
	   $data['meta']		   = $data['readXml']['meta']; 
	   $data['template']       = "main/ListGalleryWithCat/item.php";
	   $this->load->view('main/template/layout',$data);	
	}
	
	
	private function _geturl($url){
	   $data = array();
	   getParam($this,'type')    == false    ? '' : $data['type']    = getParam($this,'type');
	   getParam($this,'service') == false    ? '' : $data['service'] = getParam($this,'service');
	  
	   if(getParam($this,'page')    == true){	
		   $url = str_replace('&page='.getParam($this,'page'),'',$url);
		   $url = str_replace('?page='.getParam($this,'page'),'',$url);
	   }
	   	
	   $del = getParam($this,'del');
	   if(count($data)==0 && $del == false):
	   		$url = $url.'?';
	   		return $url;
	   elseif(count($data)>0 && $del == false):
	   		$url = $url.'&';
	   		return $url;
	   elseif(count($data>0) && $del != false):
	      	$url = str_replace($del.'='.$data[$del].'&','',$url);
			$url = count($data)==1 ? str_replace('?del='.$del,'',$url) : str_replace('&del='.$del,'',$url);
			redirect('http://localhost'.$url);
			//echo $url;
	   endif;
	}
}

