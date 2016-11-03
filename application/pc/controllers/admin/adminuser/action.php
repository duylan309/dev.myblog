<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
		
	public function adminuserAction($data)
	{
		switch ($data['action']){
			
			case 'update':
				//Get value
				$data['id'] = getParam($this,'id');
				$data['function'] = getParam($this,'function');

				require_once ('update.php');
				$do = new Update();
				
				//Check function
				if($data['function']=='Item'){
					$do->UpdateItem($data);
				}else if($data['function']=='Save'){
					if($data['id']!= 0){
						$do->runItem($data);
					}else{
						$do->AddNew($data);
					}	
				}else if($data['function']=='Add'){
					$do->AddItem($data);
				}else if($data['function']=='ChangePass')
					$do->ChangePass($data);
				else if($data['function']=='newPassword')
					$do->newPassword($data);	
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

