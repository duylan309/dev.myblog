<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remove extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->model('admin/article');
	}
		
	public function RemoveItem($setData){
		$this->article->RemoveItem($setData['id']);
		redirect(base_url().'admin/article/lists/0/null');
	}
	
	
}

