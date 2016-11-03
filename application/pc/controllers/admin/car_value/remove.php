<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remove extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('admin/admindino');
		$this->load->helper('file');
	}
		
	public function RemoveItem($setData){
		$result = $this->admindino->GetValueFrom($setData["TABLESQL"],'id',$setData['id'],'image');	
		if($this->admindino->DeleteItem($setData["TABLESQL"],$setData['id'])){
				
			redirect(base_url().ADMINBASE.'?page='.$setData['FOLDERCONTROL'].'&action=lists&id=0&function=null&alert=updated');
						
		}

			redirect(base_url().ADMINBASE.'?page='.$setData['FOLDERCONTROL'].'&action=lists&id=0&function=null&alert=error');

		
	}
	
	
}

