<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remove extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->helper("url");
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->helper('file');
		$this->load->library('session');
		$this->load->model('admin/adminuser');
	
	}
		
	public function RemoveItem($setData){
		$this->adminuser->RemoveItem($setData['id']);
		redirect(base_url().ADMINBASE.'?page=adminuser&action=lists&id=0&function=null');
	}
	
	
}

