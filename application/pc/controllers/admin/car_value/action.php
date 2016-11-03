<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
		
	public function getAction($data)
	{
		$data['FOLDERXML']     = XMLCARVALUE;
		$data['FOLDERIMAGE']   = IMAGECARVALUE;
		$data['TABLESQL']      = TABLECARVALUE;
		$data['FOLDERCONTROL'] = FOLDERCONTROLCARVALUE;

		switch ($data['action']){
			case 'update':
				//Get value
				$data['id'] = getParam($this,'id');
				$data['function'] = getParam($this,'function');
				
				require_once ('update.php');
				$do = new Update();
				
				//Check function
				if($data['function']=='Item' || $data["function"] == "Add" || $data["function"] == "add"){
					$do->ItemAction($data);
				}else if($data['function']=='Save'){
					$do->saveData($data);
				}else{
					redirect(base_url().'admin/'.$data['FOLDERCONTROL'].'/lists/0/null');
				}
		
			break;
			
			case 'remove':
				$data['id'] = getParam($this,'id');
				require_once ('remove.php');
				$do = new Remove();
				$do->RemoveItem($data);
			break;
			
			case 'other':
				//Get value
				$data['id'] = getParam($this,'id');
				$data['function'] = getParam($this,'function');
				
				require_once ('update.php');
				$do = new Update();
				//Check function
				if($data['function']=='Item'){
					$do->UpdateOther($data);
				}else if($data['function']=='Save'){
					if($data['id']!=0){
						$do->runItemOther($data);
					}	
				}
			break;
			
			default :
				require_once ('lists.php');
				$do = new Lists();
				$do->searchTable($data);
			break;
		}
	}
	
	
}

