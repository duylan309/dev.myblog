<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
		
	public function menuAction($data)
	{	
		switch ($data['action']){
			
			case 'update':
				require_once ('update.php');
				$do = new Update();
				//Check function
				if($data['function']=='Item'){
					$do->UpdateItem($data);
				}else if($data['function']=='Save'){
					$do->saveData($data);
				}else if($data['function']=='add'){
					$do->AddItem($data);
				}
			break;
				
			case 'gallery':
				$_SESSION['upload'] = null;
				$data["id"] = $_GET["id"];
				$data['gallery']->GalleryItem($data);
			break;

			case 'photo':
				$data["id"] = $_GET["id"];

				require_once ('photo.php');
				$do = new Photo();
				$do->SavePhoto($data);
			break;
			
			case 'loadphoto':
				$data["id"] = $_GET["id"];

				require_once ('photo.php');
				$do = new Photo();
				$do->loadPhoto($data);
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

			case 'remove':
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

