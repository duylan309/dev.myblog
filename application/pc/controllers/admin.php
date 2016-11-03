<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	var $admin_id		 = false;
	var $current_admin	= false;

	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->model('admin/configadmin');
	}
	
	private function CheckAdmin(){
		$admin = $this->session->userdata('admin');
		if($admin==FALSE && getParam($this,'page')!='adlogin'):
			return -1;
		else:
			return 1;
		endif;
	}

	public function index()
	{
		
		$admin = $this->CheckAdmin();
		
		if($admin==-1):
			redirect(base_url().'admin?page=adlogin');
		endif;

	
		// $data['page']    = strpos(getParam($this,'page'),'_cat')==TRUE ? str_replace('_cat','',getParam($this,'page')) : getParam($this,'page');
		$data['page']    = strpos(getParam($this,'page'),'_cat')==TRUE ? str_replace('_cat','',getParam($this,'page')) : getParam($this,'page');
		
		$data['action']  = getParam($this,'action');//List or Item....
		$data['function']= getParam($this,'function');//Gia tri cuoi cung cua URL 
  		$data['id']      = getParam($this,'id');

  		$page   = $data['page'];
  		$action = $data['action'];


		require_once ('admin/define.php');
		$define = new Define();
		
		$data['define_folder'] = $define->setDefine();
		$data['check_new']     = $define->checkNew();
		$data['AdminMenu']     = $define->LoadMenus();
		$data['adminConfig']   = $define->loadConfig();

		$data['getMenuAdmin']  = !$define->getType($page) ? 10 : $define->getType($page);
		$getType               = !$define->getType($page) ? 10 : $data['getMenuAdmin']->type  ;
		
		////LANGUAGE
		$this->session->unset_userdata('language');
		$language = $this->session->userdata('language');
		$data['lang'] = $this->setLanguage($language);		
		$data['type_menu'] = $getType; 

		if(empty($language))
			$data['language'] = simplexml_load_file('language/admin_vn.xml');
		else if($language == 'vn')
			$data['language'] = simplexml_load_file('language/admin_vn.xml');
		else if($language == 'en')
			$data['language'] = simplexml_load_file('language/admin_en.xml');
		
		
		
		/////////////
		if($getType!=0 || $getType!=1):
			switch($getType){
				case 2 :
					require_once ('admin/gallery.php');
					$data['gallery'] =  new Gallery($page);
					require_once ('admin/ListArticle/action.php');
					$do = new Action();
					$do->ListArticleAction($data);
				break;
				
				case 11 :
					require_once ('admin/gallery.php');
					$data['gallery'] =  new Gallery($page);
					require_once ('admin/ListCoworking/action.php');
					$do = new Action();
					$do->ListCoworkingAction($data);
				break;	
				
				case 3:
					require_once ('admin/gallery.php');
					$data['gallery'] =  new Gallery($page);
					require_once ('admin/ListArticleWithCat/action.php');
					$do = new Action();
					$do->GetAction($data);
				break;
				
				case 4:
					require_once ('admin/gallery.php');
					$data['gallery'] =  new Gallery($page);
					require_once ('admin/ListGallery/action.php');
					$do = new Action();
					$do->ListGalleryAction($data);
				break;
				
				case 5:
					require_once ('admin/gallery.php');
					$data['gallery'] =  new Gallery($page);
					require_once ('admin/ListGalleryWithCat/action.php');
					$do = new Action();
					$do->GetAction($data);
				break;
				
				case 6:
					require_once ('admin/gallery.php');
					$data['gallery'] =  new Gallery($page);
					require_once ('admin/ListClient/action.php');
					$do = new Action();
					$do->ListClientAction($data);
				break;
				
				case 7:
					require_once ('admin/ListContact/action.php');
					$do = new Action();
					$do->ListContactAction($data);
				break;
				
				case 8:
					require_once ('admin/gallery.php');
					$data['gallery'] =  new Gallery($page);
					require_once ('admin/ListServiceWithCat/action.php');
					$do = new Action();
					$do->GetAction($data);
				break;
				
				case 9:
					require_once ('admin/gallery.php');
					$data['gallery'] =  new Gallery($page);
					require_once ('admin/ListAbout/action.php');
					$do = new Action();
					$do->GetAction($data);
				break;

				default:
					switch($page){
						case 'adlogin':
							require_once ('admin/adlogin.php');
							$do = new Adlogin();
							if($data['action'] == 'check')
								$do->checkUser();
							else if($data['action'] == 'out')
								$do->logoutAdmin();
							else
								$do->Login($data);
							break;
							
						case 'upload':
							require_once ('admin/upload/action.php');
							$do = new Action();
							$do->uploadAction($data);
							break;	

						case FOLDERCONTROLCARCATEGORY:
							$data['getMenuAdmin']  = $define->getTypeId(TABLECARIDCATEGORY);
							require_once ('admin/galleries.php');
							$data['gallery'] =  new Galleries(TABLECARCATEGORY);
							require_once ('admin/'.FOLDERCONTROLCARCATEGORY.'/action.php');
							$do = new Action();
							$do->getAction($data);
						break;

						case FOLDERCONTROLCARSTYLE:
							$data['getMenuAdmin']  = $define->getTypeId(TABLECARIDSTYLE);
							require_once ('admin/'.FOLDERCONTROLCARSTYLE.'/action.php');
							$do = new Action();
							$do->getAction($data);
						break;

						case FOLDERCONTROLCAR:
							$data['getMenuAdmin']  = $define->getTypeId(TABLECARID);
							require_once ('admin/'.FOLDERCONTROLCAR.'/action.php');
							$do = new Action();
							$do->getAction($data);
						break;

						case FOLDERCONTROLCARVALUE:
							$data['getMenuAdmin']  = $define->getTypeId(TABLECARIDVALUE);
							require_once ('admin/'.FOLDERCONTROLCARVALUE.'/action.php');
							$do = new Action();
							$do->getAction($data);
						break;	

						case FOLDERCONTROLCONTACT:
							$data['getMenuAdmin']  = $define->getTypeId(TABLECARIDVALUE);
							require_once ('admin/'.FOLDERCONTROLCONTACT.'/action.php');
							$do = new Action();
							$do->ListContactAction($data);
						break;
						
						case 'home_slide':
							require_once ('admin/home_slide/action.php');
							$do = new Action();
							$do->home_slideAction($data);
							break;

						case URLIMAGEUPLOAD:
							require_once ('admin/'.URLIMAGEUPLOAD.'/action.php');
							$do = new Action();
							$do->Action($data);
							break;	
							
						case 'list_modules':
							require_once ('admin/list_modules/action.php');
							$do = new Action();
							$do->list_modulesAction($data);
							break;		
							
						case 'contact_content':
							require_once ('admin/contact_content/action.php');
							$do = new Action();
							$do->contact_contentAction($data);
							break;
							
						case 'home_content':
							require_once ('admin/home_content/action.php');
							$do = new Action();
							$do->getAction($data);
							break;		
					
						case 'ModuleHome':
							require_once ('admin/ModuleHome/action.php');
							$do = new Action();
							$do->ModuleHomeAction($data);
						break;
					
						case 'menu':
							require_once ('admin/gallery.php');
							$data['gallery'] =  new Gallery($page);
							require_once ('admin/menu/action.php');
							$do = new Action();
							$do->menuAction($data);
							break;	
							
						case 'config_content':
							require_once ('admin/config_content/action.php');
							$do = new Action();
							$do->config_contentAction($data);
							break;	
								
						case 'adminuser':
							require_once ('admin/adminuser/action.php');
							$do = new Action();
							$do->adminuserAction($data);
							break;			
									
						case 'ajax':		
						
							require_once ('admin/function/ajaxfunction.php');
							$do = new Ajaxfunction();
							
							if($action == 'publish')
								$do->changepublish();
							else if ($action == 'home')	
								$do->changehome();		
							else if ($action == 'title')	
								$do->changetitle();	
							else if ($action == 'sort')	
								$do->changesort($data);
							else if ($action == 'language')	
								$do->changeLanguage();	
							else if ($action == 'removeImage')	
								$do->removeImage($data);
							else if ($action == 'deletephoto')	
								$do->deletephoto($data);		
							else if ($action == 'addImage')	
								$do->addImage($data);				
							else if ($action == 'delItem')
								$do->delItem($data);
							else if ($action == 'cat')
								$do->changeCat();
							else if ($action == 'checkurl')
								$do->checkUrl();
							else if ($action == 'mess')
								$do->checkNewMess();
							else if ($action == 'search')	
								$do->searchFunction($data);	// Search ? Table ? 			
							else if ($action == 'article')	
								$do->articleAction($data);	// Search ? Table ? 	

						break;
							
						default:	
							require_once ('admin/homeadmin/action.php');
							$do = new Action();
							$do->getAction($data);			
							break;			
					}
				break;
			}
		endif;
	}
	
	function setLanguage($language){
		if($language==NULL)
		{
			$language='vn';
			$this->session->set_userdata('language','vn');	
		}	
		elseif($language=='vn')
		{
			$language='vn';
			$this->session->set_userdata('language','vn');
		}
		else
		{
			$language='en';
			$this->session->set_userdata('language','en');
		}
		return $language;
	}
		
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */