<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index()
	{	
		require_once ('main/getaction.php');
		$getaction             = new Getaction();

		$data 				   = array();
		$data['lang']          = $getaction->setLanguage();		
		$data 				   = $getaction->_loadUrlDirection($data);
		$page 			       = $data['page'];
	
		$data['language']      = $getaction->getLanguage($data['lang']);
		$data['configSite']    = $getaction->loadConfig();
		$data['listMenu']      = $getaction->loadMenu();

		require_once ('admin/define.php');
		$defineFolder	       = new Define();
		$data['define_folder'] = $defineFolder->setDefine();
		$data['seoname']       = $defineFolder->SeoName();
		$data['share']['facebook_image'] = SOURCEFOLDER.'images/thue.today.png';

		require_once ('main/getpage.php');
		$data['getpage']		   = new Getpage();

		if($data['menu']!=FALSE):
			if($data['configSite'][0]->info->online==1): 
				$data['getaction'] = $getaction;
				$data['getpage']  -> _index($data);
			else:
				$data['template']        = "main/template/coming.php";
				$this->load->view('main/template/layout',$data);
			endif;
		else:
			
			if($data['configSite'][0]->info->online==0 && $data['page']!='lang') : 
				$data['template']        = "main/template/coming.php";
				$this->load->view('main/template/layout',$data);
			else:
				$data['getpage']  -> __index($data);
			endif;
			
		endif;
			
		unset($defineFolder);
		unset($getaction);
		unset($getpage);
	}
}
