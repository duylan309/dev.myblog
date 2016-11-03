<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino'));
	}
		
	public function index($data){
		
		$data['id']  = intval($this->uri->rsegment(4));
		$data['cat'] = intval($this->uri->rsegment(5));
		$layout = $this->_index($data);
		
	}
	
	private function _index($data){
		$selection  = TABLEBLOG.'.*,';
		$selection .= TABLEUSER.'.image AS user_image,';
		$selection .= TABLEUSER.'.name AS user_name,';
		$selection .= TABLEUSER.'.title AS user_title,';
		$selection .= TABLEUSER.'.alt_image AS user_alt_image';

	    $data['item']      = $this->maindino->GetValueJoinFrom(TABLEBLOG,TABLEUSER,TABLEBLOG.'.postby='.TABLEUSER.'.id','id',$data['id'],$selection);
	    
	    # Load Tags

	    $where_tags['status'] = 1;
	    if($data['item']->related){
	    	$array_tags_like = explode(',',$data['item']->related);
	    	$data['results_tags'] = $this->maindino->SearchFunctionPageOneField(TABLEBLOG, '*', 0, 0,'title_'.$data['lang'], $array_tags_like,$where_tags, 'id');
	    }
	    
	    $array_selected = array();
	    $where_selected['status'] = 1;
	    if($data['item']!=NULL){
	    	$array_selected = explode(',',$data['item']->str);
			$data['results_selected'] = $this->maindino->loadTableWhereIn(TABLEBLOG,NULL,$where_selected,$array_selected);
	    }

	    $data['readXml']   = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['menu']['title_url'].'/',$data['id']);
	    $data['meta']	   = $data['readXml']['meta']; 
	    $data['template']  = "main/ListArticleWithCat/item.php";
	    $this->load->view('main/template/layout',$data);
	}

	private function _loadPage($data){
	   $whereV['status']       = 1; 
	   $data['results_cat']    = $this->maindino->loadTable($data['menu']['title_url'].'_cat',NULL,$whereV,1,'ASC');	
	   $data['item_cat']       = $this->maindino->GetValueFrom($data['menu']['title_url'].'_cat','id',$data['cat'],'*') ;
	   $data['arrMenu']        = $this->dinosaur_lib->createMenu($data['results_cat'],0,0,0,$data['lang'],$data['menu']['title_url']);
	   $data['item']           = $this->maindino->GetValueFrom($data['menu']['title_url'],'id',$data['id'],'*') ;
	   $data['readXml']        = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['menu']['title_url'].'/',$data['id']);
	   $data['meta']		   = $data['readXml']['meta']; 
	   $data['template']  = "main/ListArticleWithCat/item.php";
	   $this->load->view('main/template/layout',$data);	
	}
	
}

