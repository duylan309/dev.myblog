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
			
				require(FCPATH . APPPATH . 'controllers/admin/allmodules/delete_folder.php');	
				
		}
		
		redirect(base_url().'admin/'.$setData['page'].'/lists/0/null');
	}
	
	
}

