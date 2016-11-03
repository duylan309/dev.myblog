<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino'));
	}
		
	public function index($data){
		$data['id'] = intval($this->uri->rsegment(5));
		
		if($data['result_menu']['menu']->title_url=='dang-ky'):
			$this->_indexDangKy($data);
		endif;
		
		/*if(intval($data['id'])==0)
			$this->_index($data);
		else
			$this->_loadPage($data);*/
	}
	
	private function _indexDangKy($data){
		
	}
	
	
}

