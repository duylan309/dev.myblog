<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
		
	public function getAction($data)
	{
		$data['FOLDERXML']     = XMLCARCATEGORY;
		$data['FOLDERIMAGE']   = IMAGECARCATEGORY;
		$data['TABLESQL']      = TABLECARCATEGORY;
		$data['FOLDERCONTROL'] = FOLDERCONTROLCARCATEGORY;
		
		$data["POSITIONIMG"]   = isset($_GET['position']) && count($_GET['position']) ? $_GET['position'] : '';
		if($data['POSITIONIMG']=="gallery"):
			$data['TABLEGALLERY'] = TABLECARCATEGORY.'_photo';
		elseif($data['POSITIONIMG'] == "banner"):
			$data['TABLEGALLERY'] = TABLECARCATEGORY.'_banner';
		endif;	


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
				$data['id'] = getParam($this,'id');
				$data['function'] = getParam($this,'function');
				require_once ('update.php');
				$do = new Update();
				if($data['function']=='Item'){
					$do->UpdateOther($data);
				}else if($data['function']=='Save'){
					if($data['id']!=0){
						$do->runItemOther($data);
					}	
				}
			break;
				
			// PHOTO ACTION
				
			case 'gallery':
				$_SESSION['upload'] = null;
				$data["id"] = $_GET["id"];
				$data['gallery']->GalleryItem($data);
			break;

			case 'photo':
				$data["id"] = $_GET["id"];
				require_once ('photos.php');
				$do = new Photos();
				$do->SavePhoto($data);
			break;
			
			case 'loadphoto':
				$data["id"] = $_GET["id"];
				require_once ('photos.php');
				$do = new Photos();
				$do->loadPhoto($data);
			break;
			
			case 'editphoto':
				$data['id'] = getParam($this,'id');
				require_once ('photos.php');
				$do = new Photos();
				$do->EditPhoto($data);
			break;
			
			case 'savephoto':
				$data['id'] = getParam($this,'id');
				require_once ('photos.php');
				$do = new Photos();
				$do->SaveItemPhoto($data);
			break;
										
			default :
				require_once ('lists.php');
				$do = new Lists();
				$do->searchTable($data);
			break;
		}
	}
	
	
}

