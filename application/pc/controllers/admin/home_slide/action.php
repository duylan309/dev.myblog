<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
		
	public function home_slideAction($data)
	{
		// SET VALUE PAGE
		$data["page_title"]       = $data["lang"]=="en" ? "Slideshow" : "Hình nh";
		$data["page_table_sql"]   = $data["page"];
		

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
					redirect(base_url().'admin/'.$data['page'].'/lists/0/null');
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

