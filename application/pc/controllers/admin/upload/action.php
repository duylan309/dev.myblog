<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
		
	public function uploadAction($data)
	{
		switch ($data['action']){
			case 'run':
				require_once ('lists.php');
				$do = new Lists();
				$do->elfinder_init();
			break;
			
			default :
				require_once ('lists.php');
				$do = new Lists();
				$do->showTable($data);
			break;
		}
	}
	
	
}

