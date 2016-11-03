<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('admin/admindino'));
	}
			
	public function UpdateItem($setData){
		$id = $setData['id'];
		$data['result'] = $this->admindino->GetValueFrom('modulehome','id',$id,'*');	
		//IMAGE
		$data['define_folder']= $setData['define_folder'];
		
		$data['menu_item']   = $this->admindino->GetValueFrom('menu','id',$data['result']->menu_id,'*');
			
		//load others article
		$where['status']     = 1;
		//$where['id !=']      = $id;
		
		$array = array();
		if($data['result']->str!=NULL && $data['result']->str!=0):
			$array = explode(',',$data['result']->str);
			$data['listArticleChoose'] = $this->admindino->loadTableWhereIn($data['menu_item']->title_url,NULL,$where,$array);
		endif;
		$data['listArticle']           = $this->admindino->loadTableWhereNotIn($data['menu_item']->title_url,NULL,$where,$array);
		
	
		$data['check_new']    = $setData['check_new'];
		//LANGUAGE
		$data['language']     = $setData['language']; 
		$data['lang']         = $setData['lang'];
		$data['page']         = $setData['page'];
		$data['AdminMenu']    = $setData['AdminMenu'];
		$data['getMenuAdmin'] = $setData['getMenuAdmin'] ;
		//TEMPLATE
		$data['template'] = "admin/ModuleHome/".$setData['action'].".php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	public function UpdateOther($setData){
		$id = $setData['id'];
		$data['result'] = $this->admindino->GetValueFrom('modulehome','id',$id,'*');	
		
		$data['menu_item']   = $this->admindino->GetValueFrom('menu','id',$data['result']->menu_id,'*');
		
		$where['status']     = 1;
		$where['id !=']      = $id;
		$array = array();
		$search = $this->input->post('function');
		$data['session']['where']     = NULL;
		
		
		if($data['result']->str!=NULL && $data['result']->str!=0):
			$array = explode(',',$data['result']->str);
			$data['listArticleChoose'] = $this->admindino->loadTableWhereIn($data['menu_item']->title_url,NULL,$where,$array);
		endif;
		$setData['coutAll']  = $this->admindino->countSearchNotIn($data['menu_item']->title_url,NULL,$where,$array );
		
		//var_dump($data['listArticleChoose']);
		//Check Session search
		if($search){
			$data['session']['where']['title_vn'] =  $this->input->post('fTitle');
		}else{
			$data['session']    = $this->session->userdata($data['menu_item']->title_url.'moduleother');
			if($data['session'] == FALSE):
				$data['session']['where']['title_vn']  = '';
				$this->session->set_userdata($data['menu_item']->title_url.'moduleother', $data['session']);
			endif;
		}
				
		if(!empty($data['session']['where']['title_vn'])):
			$whereLike['title_vn']        =  $data['session']['where']['title_vn'];
			$this->session->set_userdata($data['menu_item']->title_url.'moduleother', $data['session']);
			$setData['coutAll']  = $this->admindino->countSearchNotIn($data['menu_item']->title_url,$whereLike,$where,$array);
		else:
			$this->session->unset_userdata($data['menu_item']->title_url.'moduleother');
		endif;// END IF CHECK EMPTY
		//////////////////////////////////////////////////////////////////////////////////////
		
		
		$whereLike['title_vn']     = $this->input->post('searchOther');
		//PHAN TRANG 
		$config 				    = array();
		$config["base_url"]        = base_url()."admin/ModuleHome/other/".$id.'/Item?page=';
		$config["per_page"]        = 10;
        $config["uri_segment"]     = 5;
		$config["total_rows"]      = $setData['coutAll'];
		$config["typeMain"] 	    = 'main';
		$config['cur_page'] 	    = getParam($this,'page');
	    $this->pagination->initialize($config);	 
		$page  					  = getParam($this,'page') ? getParam($this,'page') : 0;
		$whereLike['title_vn']     =  $data['session']['where']['title_vn'];		
		$data['listArticle']       = $this->admindino->ListItemsNoIn(strtolower($data['menu_item']->title_url),$config["per_page"], $page ,$whereLike,array("status"=>1),-1,'ASC',$array);
		$data['links']             = $this->pagination->create_links();
		
		//IMAGE
		$data['define_folder']= $setData['define_folder'];

		//LANGUAGE
		$data['language']     = $setData['language']; 
		$data['lang']         = $setData['lang'];
		$data['page']         = $setData['page'];
		$data['AdminMenu']    = $setData['AdminMenu'];
		$data['getMenuAdmin'] = $setData['getMenuAdmin'] ;
		//TEMPLATE
		$data['template'] = "admin/ModuleHome/".$setData['action'].".php";		
		$this->load->view('admin/template/adminLayoutNoMenu',$data);
	}
	
	public function runItemOther($setData){
		$id      			  = $this->input->post('id');	
		$this->input->post('getIdArticle')==false ? $data['str'] = 0 :  $data['str'] = implode(",",$this->input->post('getIdArticle'));
	
		$do = $this->admindino->UpdateTable(strtolower($setData['page']),$data,$id);
		
		if($do){
		$data['result'] 	  = $this->admindino->GetValueFrom(strtolower($setData['page']),'id',$id,'*');	
	
		$data['menu_item']   = $this->admindino->GetValueFrom('menu','id',$data['result']->menu_id,'*');
		$where['status']     = 1;
	
		$array = array();
		if($data['result']->str!=NULL && $data['result']->str!=0):
			$array = explode(',',$data['result']->str);
			$listArticle = $this->admindino->loadTableWhereIn(strtolower($data['menu_item']->title_url),NULL,$where,$array);
		endif;
		$txt='';
		if($listArticle):
		foreach($listArticle as $article):
			$txt .="<tr>";
			$txt .="<td class='col1'><span>".$article->id."</span></td>";
			$txt .="<td>".$article->title_vn."</td>";
		endforeach;	
		endif;	
			
		?>
         <script type="text/javascript">
				 function RefreshParent() {
            if (window.opener != null && !window.opener.closed) {
				window.opener.location.reload();
            }
			
        }
		
        window.onbeforeunload = RefreshParent;
		window.close();
		//		window.close();	
		//		document.getElementByClass("detailTable").innerHTML = "<?=$txt?>";
				 
		 </script>
		<?php 
		}
		
	}
	
	public function runItem($setData){
	
		
		$data['title_vn']  = $this->input->post('title_vn');
		$data['title_en']  = $this->input->post('title_en');
		$data['status']    = $this->input->post('status');
		$data['layout']    = $this->input->post('layout');
		$data['sort']      = $this->input->post('sort');
		$id      		   = $this->input->post('id');	
		
		$do = $this->admindino->UpdateTable(strtolower($setData['page']),$data,$id);
		
		////WRITE XMLDATA
		if($do == TRUE){
			redirect(base_url().'admin/'.$setData['page'].'/lists/0/null');
		}
	}
	
	public function AddItem($setData){
		$data['define_folder']= $setData['define_folder'];
		$data['check_new']    = $setData['check_new'];
		//LANGUAGE
		$data['language']     = $setData['language']; 
		$data['lang']         = $setData['lang'];
		$data['AdminMenu']    = $setData['AdminMenu'];
		$data['page']         = $setData['page'];
		$data['getMenuAdmin'] = $setData['getMenuAdmin'] ;
		//TEMPLATE
		
		//TEMPLATE
		$data['template'] = "admin/ModuleHome/add.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	///ADD NEW ITEM
	public function AddNew($setData){
		$array['title_vn']  = $this->input->post('title_vn');
		$array['title_en']  = $this->input->post('title_en');
		$array['status']    = $this->input->post('status');
		$array['layout']    = $this->input->post('layout');
		
		$array['sort']      = $this->input->post('sort');
		$array['menu_id']   = $this->input->post('menu_id');
		$array['id']        = NULL;
							
		$do = $this->admindino->AddTable(strtolower($setData['page']),$array);
		
		////WRITE XMLDATA
		if($do){
			redirect(base_url().'admin/'.$setData['page'].'/lists/0/null');
		}
	}
	
		
	
	public function getCat($table){
			$this->load->model('admin/'.$table);
			$article_cat = $this->$table->getTitleId();
			return $article_cat->result();
	}
	///DELETE OLD IMAGE	
	function deleteOldImage($page,$image){
			$fileOldImage = "./upload/".$page.'/'.$image;
			if(is_file($fileOldImage))
			unlink($fileOldImage);
			
			return TRUE;
	}
	
}

