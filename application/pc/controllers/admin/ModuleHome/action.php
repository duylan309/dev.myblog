<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
		
	public function ModuleHomeAction($data)
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
					if($data['id']!=0){
						$do->runItem($data);
					}else{
						$do->AddNew($data);
					}	
				}else if($data['function']=='add'){
					$do->AddItem($data);
				}
			break;
			
			case 'gallery':
				$_SESSION['upload'] = null;
				$data['id'] = getParam($this,'id');
				$data['gallery']->GalleryItem($data);
			break;
			
			case 'remove':
				$data['id'] = getParam($this,'id');
				require_once ('remove.php');
				$do = new Remove();
				$do->RemoveItem($data);
			break;
			
			case 'editphoto':
				$data['id'] = getParam($this,'id');
				require_once ('photo.php');
				$do = new Photo();
				$do->EditPhoto($data);
			break;
			
			
			case 'savephoto':
				$data['id'] = getParam($this,'id');
				require_once ('photo.php');
				$do = new Photo();
				$do->SaveItemPhoto($data);
			break;
			
			case 'photo':
				$data['id'] = getParam($this,'id');
				require_once ('photo.php');
				$do = new Photo();
				$do->SavePhoto($data);
			break;
			
			case 'loadphoto':
				$data['id'] = getParam($this,'id');
				require_once ('photo.php');
				$do = new Photo();
				$do->loadPhoto($data);
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

