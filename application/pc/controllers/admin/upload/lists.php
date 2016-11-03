<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lists extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
		
	function showTable($value){
		//DuLieu
		$data['check_new']         = $value['check_new'];
		$data['define_folder']     = $value['define_folder'];
		$data['language']          = $value['language']; 
		$data['lang']              = $value['lang'];	
		$data['page']              = $value['page'];	
		$data['AdminMenu']         = $value['AdminMenu'];
		$data['template'] 		  = "admin/upload/".$value['action'].".php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	function elfinder_init()
	{
	  $this->load->helper('path');
	  $opts = array(
		// 'debug' => true, 
		'roots' => array(
		  array( 
			'driver' => 'LocalFileSystem', 
			'path'   => set_realpath('upload'), 
			'URL'    => base_url('upload') . '/'
			// more elFinder options here
		  ) 
		)
	  );
	  $this->load->library('elfinder_lib', $opts);
	}
	
}

