<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('curl'));
		$this->load->model(array());	
	}
	
	public function getModule($setData){
		
	}
	
	public function index($setData){
		$setData['template']  	 = "main/home/all.php";		
		$this->load->view('main/template/layout',$setData);
	}
}

