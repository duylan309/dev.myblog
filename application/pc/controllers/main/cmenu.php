<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cmenu extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->helper("url");
		$this->load->model(array('main/md_menu','main/maindino'));
	}
	
	public function loadConfig(){
		$fileLink = "./xmldata/config_content.xml";
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
	
	public function loadMeta($title_url){
		if(empty($title_url))
		$title_url = 'home';
		
		$id = $this->getID($title_url);
	
		$fileXml 				     = "./xmldata/en/menu/".$id.".xml";
	
		$readXml 	     			 = simplexml_load_file($fileXml);
		$meta['description']		 = $readXml->info->description;
		$meta['title']       		   = $readXml->info->meta->title;
		$meta['keyword']     		 = $readXml->info->meta->keyword;
		$meta['description'] 		 = $readXml->info->meta->description; 
			
		return $meta;
	}	

	public function loadMenu(){
		$whereValue['status']      = 1;
		$result['MainMenu'] = $this->maindino->loadTable('menu',NULL,$whereValue,1,'sort');
	   	return $result;
	}
	
	public function loadModule($id){
		$module['MdSlideShow'] = $this->maindino->loadTable('moduleslideshow',NULL,array('status'=>1,'menu_id'=>$id),-1,'ASC');
		$module['MdAd']       	= $this->maindino->loadTable('modulead',NULL,array('status'=>1,'menu_id'=>$id),-1,'ASC');
		return $module;
	} 

}

