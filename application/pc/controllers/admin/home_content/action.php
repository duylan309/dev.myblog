<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
		
	public function getAction($data)
	{
		switch ($data['action']){
			
			case 'update':
				
				$data['function'] = getParam($this,'function');
				require_once ('update.php');
				$do = new Update();
				//Check function
				if($data['function']=='Item'){
					$do->UpdateItem($data);
				}else if($data['function']=='Save'){
					$do->runItem($data);				
				}
			break;
			
			case 'remove':
				$data['id'] = getParam($this,'id');
				require_once ('remove.php');
				$do = new Remove();
				$do->RemoveItem($data);
			break;
			
										
			default :
				require_once ('lists.php');
				$do = new Lists();
				$do->searchTable($data);
			break;
		}
	}
	
	
}

