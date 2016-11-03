<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remove extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('admin/admindino');
		$this->load->helper('file');
	}
		
	public function RemoveItem($setData){
		$this->admindino->DeleteItem('contact_inbox',$setData['id']);
		redirect(base_url().ADMINBASE.'?page='.$setData['page'].'&action=lists&id=0&function=null&alert=updated');
		
	}
	
	
}

