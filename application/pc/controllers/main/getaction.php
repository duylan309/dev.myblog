<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Getaction extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('curl'));
		$this->load->model(array('main/md_menu','main/maindino'));
	}
	
	public function _index(){
		$page  			        = $this->uri->rsegment(3);
		$data['page']		    = !empty($page) ? $page : 'home';	
		$data['page_url']       = webtitleUrl($this->uri->segment(1));
		$data['action']         = webtitleUrl($this->uri->rsegment(6));
		
		return $data;
	}

	public function _loadUrlDirection($data){
		if($this->uri->segment(1)== NULL){
			$url_site = 'home';
 		}else{
 			$url_site = $this->uri->segment(1);
 		}

 		$url_tab = explode('_',$url_site);
 		
 		$selection  =    TABLEURL.'.*,';
 		$selection .=	 TABLEMENU.'.title_url AS menu_url,';	
 		$selection .=	 TABLEMENU.'.id AS menu_id,';	
 		$selection .=	 TABLEMENU.'.title_en AS menu_en,';	
 		$selection .=	 TABLEMENU.'.title_vn AS menu_vn,';	
 		$selection .=	 TABLEMENU.'.image AS image,';	
 		$selection .=	 TABLEMENU.'.alt_image AS alt_image,';	
 		$selection .=	 TABLEMENU.'.table_control AS menu_table_control';	

 		$getMenuDirection = $this->maindino->GetValueJoinFrom(TABLEURL,TABLEMENU,TABLEURL.'.menu_id='.TABLEMENU.'.id','url',$url_tab[0],$selection);
 		if($getMenuDirection){
 			$data['page']     	   			= $getMenuDirection->url;
 			$data['page_url'] 	   			= $getMenuDirection->url;
 			$data['child_id'] 	   			= $getMenuDirection->child_id;
 			$data['menu']['id']    			= $getMenuDirection->menu_id;
 			$data['menu']['title_url']      = $getMenuDirection->menu_url;
 			$data['menu']['ti_en'] 			= $getMenuDirection->menu_en;
 			$data['menu']['ti_vn'] 			= $getMenuDirection->menu_vn;
 			$data['menu']['table_control']  = $getMenuDirection->menu_table_control;
 			$data['menu']['type']           = $getMenuDirection->type;
 			$data['menu']['image']          = $getMenuDirection->image;
 			$data['menu']['alt_image']      = $getMenuDirection->alt_image;
 			$fileXml 						= "./xmldata/".$data['lang']."/menu/".$data['menu']['id'].".xml";
			$readXml 	     			    = simplexml_load_file($fileXml);
			$data['memu']['info']['content']     = $readXml->info->content;
			$data['memu']['info']['description'] = $readXml->info->description;

 			
 			$data['action']     = webtitleUrl($this->uri->rsegment(6));
 			$data['code']       = 200;
 		}else{
 			$data['code'] = 401;
 		}

		return $data;
	}	
	
	public function loadConfig(){
		$fileLink = "./xmldata/webinfo.xml";
		$readConfig = simplexml_load_file($fileLink);
		return $readConfig;
	}
	
	public function loadXml($lang,$define_folder,$id){
		$fileXml 				     = "./xmldata/".$lang.$define_folder.$id.".xml";
	
		$readXml 	     			 = simplexml_load_file($fileXml);
		$xml['title']       		    = $readXml->info->title;
		$xml['content']     		  = $readXml->info->content;
		$xml['description'] 		  = $readXml->info->description; 
		$meta['title']       		   = $readXml->info->meta->title;
		$meta['keyword']     		 = $readXml->info->meta->keyword;
		$meta['description'] 		 = $readXml->info->meta->description; 
		
		$xml['meta']                 = $meta;
		return $xml;
	}
	
	public function getID($page){
		$getId = $this->maindino->GetValueFrom('menu','title_url',$page,'id');
		
		if($getId != FALSE)
			$id = $getId->id;
		else
			$id=0;
			
		return $id;	
	}
	
	public function loadMetaSeo($id){
	
		$fileXml 				     = "./xmldata/".$this->session->userdata('language')."/menu/".$id.".xml";
	
		$readXml 	     			 = simplexml_load_file($fileXml);
		$meta['info']['content']     = $readXml->info->content;
		$meta['info']['description'] = $readXml->info->description;
		$meta['title']       		 = $readXml->info->meta->title;
		$meta['keyword']     		 = $readXml->info->meta->keyword;
		$meta['description'] 		 = $readXml->info->meta->description; 
			
		return $meta;
	}

	public function loadMeta($title_url){
		if(empty($title_url))
		$title_url = 'home';
		
		$id = $this->getID($title_url);
	
		$fileXml 				     = "./xmldata/".$this->session->userdata('language')."/menu/".$id.".xml";
	
		$readXml 	     			 = simplexml_load_file($fileXml);
		$meta['info']['content']     = $readXml->info->content;
		$meta['info']['description'] = $readXml->info->description;
		$meta['title']       		   = $readXml->info->meta->title;
		$meta['keyword']     		 = $readXml->info->meta->keyword;
		$meta['description'] 		 = $readXml->info->meta->description; 
			
		return $meta;
	}	

	public function loadMenu(){
		$whereValue['status']        = 1;
		$listMenu = $this->maindino->loadTableSort('menu',NULL,$whereValue,1,'sort ASC');
		return $listMenu;
	}

	public function setLanguage(){
		$language              = $this->session->userdata('language');
		
		if($language==NULL)
		{
			$language="vn";
			$this->session->set_userdata('language','vn');	
		}	
		elseif($language=="vn")
		{
			$language="vn";
			$this->session->set_userdata('language','vn');
		}
		else
		{
			$language="en";
			$this->session->set_userdata('language','en');
		}
		return $language;
	}
	

	
	public function getLanguage($language){
		 if(empty($language))
			$data = simplexml_load_file("language/en.xml");
		else if($language == "vn")
			$data = simplexml_load_file("language/vn.xml");
		else if($language == "en")
			$data = simplexml_load_file("language/en.xml");
			
		return $data; 	
	}
	
	public function getCurrentMenu($data,$lang){
		
		if($data['menu']!=FALSE):
			$fileXml 				       = "./xmldata/".$lang."/menu/".$data['menu']['id'].".xml";
			$readXml 	     			   = simplexml_load_file($fileXml);
			$data['memu']['info']['content']     = $readXml->info->content;
			$data['memu']['info']['description'] = $readXml->info->description;
		else:
		
		endif;
		
		return $data;
	}	
	
	private function getPosition($position_id){
		if($position_id==0):
			return $position = "Banner";
		elseif($position_id==1):
			return $position = "Center";
		elseif($position_id==2):
			return $position = "Left";
		elseif($position_id==3):
			return $position = "Right";
		elseif($position_id==4):
			return $position = "Bottom";
		endif;	
	}
	
	public function getReport(){
		$ip_addr = $this->input->ip_address();
		$get_user_session = $this->session->userdata('ip');
		if($get_user_session==FALSE):
			$get_user_session = $this->session->set_userdata('ip',$ip_addr);
		
		else:
		
		endif;
	}
}

