<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remove extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('admin/admindino');
		$this->load->helper('file');
	
	}
		
	public function RemoveItem($setData){
		$result = $this->admindino->GetValueFrom($setData['page'],'id',$setData['id'],'image');	
		if($this->admindino->DeleteItem($setData['page'],$setData['id'])){
				
				$pathdir_image  	    =  "./upload/".$setData['page'].'/'.$result->image;
				$pathdir_image_store  =  "./upload/storage/".$setData['page'].'/'.$setData['id'];
				$pathdir_xml_vn 	   =  "./xmldata/vn/".$setData['page'].'/'.$setData['id'].'.xml';
				$pathdir_xml_en 	   =  "./xmldata/en/".$setData['page'].'/'.$setData['id'].'.xml';
				
				unlink($pathdir_image);			
				unlink($pathdir_xml_vn);
				unlink($pathdir_xml_en);
				
				if(delete_files($pathdir_image_store , true))
					rmdir($pathdir_image_store);
		}
		redirect(base_url().'admin/'.$setData['page'].'/lists/0/null');
	}
	
	
}

