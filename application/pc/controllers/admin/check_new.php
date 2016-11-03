<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Check_new extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/checknew');
	}
	
	public function checkNew(){
		$result['inbox'] = $this->checknew->check_inbox();
		return $result;   	
	}
	
}

?>