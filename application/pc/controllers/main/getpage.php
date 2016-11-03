<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Getpage extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('main/maindino'));
		
	}
	
	public function _index($data){

		$page = $data['page'];
		switch($data['menu']['type']):
				case 1:
					$data['meta']   = $data['getaction'] ->loadMetaSeo($data['menu']['id']);
					$data['action'] = webtitleUrl($this->uri->rsegment(4));
					require_once ('SimplePage/action.php');
					$do = new Action();
					$do->index($data);
					break;
				break;
				
				case 2 :
					$data['meta']   = $data['getaction'] ->loadMetaSeo($data['menu']['id']);
					$data['action'] = webtitleUrl($this->uri->rsegment(4));
					require_once ('ListArticle/action.php');
					$do = new Action();
					$do->index($data);
					break;
				break;
				
				case 3:
					$data['meta']   = $data['getaction'] ->loadMetaSeo($data['menu']['id']);
					$data['action'] = webtitleUrl($this->uri->rsegment(4));
					require_once ('ListArticleWithCat/action.php');
					$do = new Action();
					$do->index($data);
					break;
				break;
				
				case 4:
					$data['meta']   = $data['getaction'] ->loadMetaSeo($data['menu']['id']);
					$data['action'] = webtitleUrl($this->uri->rsegment(4));
					require_once ('ListGallery/action.php');
					$do = new Action();
					$do->index($data);
					break;
				break;
				
				case 5:
					$data['meta']   = $data['getaction'] ->loadMetaSeo($data['menu']['id']);
					$data['action'] = webtitleUrl($this->uri->rsegment(4));
					require_once ('ListGalleryWithCat/action.php');
					$do = new Action();
					$do->index($data);
					break;
				break;
				
				case 6:
					$data['meta']   = $data['getaction'] ->loadMetaSeo($data['menu']['id']);
					$data['action'] = webtitleUrl($this->uri->rsegment(4));
					require_once ('ListClient/action.php');
					$do = new Action();
					$do->index($data);
					break;
				break;
				
				case 8:
					$data['meta']   = $data['getaction'] ->loadMetaSeo($data['menu']['id']);
					$data['action'] = webtitleUrl($this->uri->rsegment(4));
					require_once ('SimpleGallery/action.php');
					$do = new Action();
					$do->index($data);
					break;
				break;
	
				case 10 :
					$this->__index($data);
				break;
				
				case 0 :
					$data['meta']      = $data['getaction'] ->loadMetaSeo($data['menu']['id']);
					require_once ('home/action.php');
					$do 			    = new Action();
					$do->_index($data);
				break;
				
			endswitch;
	}
	
	public function __index($data){

			if($data['page'] == 'adlogin'):
				
				require_once ('adlogin.php');
				$do = new Adlogin();

				$data["action"] = getParam($this,'action');

				if($data['action'] == 'check')
					$do->checkUser();
				else if($data['action'] == 'out')
					$do->logoutAdmin();
				else
					$do->Login($data);

			elseif($data['page'] == 'lang'):
				$this->changeLanguage();
			else:
				$this->getPageFromUrl($data);

			endif;	
			
	}

	public function getPageFromUrl($data){

		$sql = ('SELECT * FROM menu WHERE title_url = ? ');
		$getMenuCurrentExtra  = $this->maindino->runSQL($sql,array($data['page']));
		
		if(isset($getMenuCurrentExtra) && count($getMenuCurrentExtra)):
			$data['meta']   = $data['getaction']->loadMetaSeo($data['page']);
			$data['action'] = webtitleUrl($this->uri->rsegment(4));
			require_once ($getMenuCurrentExtra[0]->table_control.'/action.php');
			$do = new Action();
			$do->index($data);
		else:
			die();
		endif;	
	}

	public function changeLanguage(){
	$language              = $this->session->userdata('language');
	if($language=="vn")
	{
		$language="en";
		$this->session->set_userdata('language','en');
	}
	else
	{
		$language="vn";
		$this->session->set_userdata('language','vn');
	}
	?>
        <script type="text/javascript">
		location.reload(); 
		</script>
        
        <?php
	}
}
