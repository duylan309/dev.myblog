<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('admin/admindino'));
	}
	
	public function ItemAction($setData){
		// IF UPDATE
		if(isset($setData["id"]) && $setData["id"] != 0){
			$id = $setData['id'];
			$data['result'] = $this->admindino->GetValueFrom($setData['page'],'id',$id,'*');	
			
			//IMAGE
			$image = './upload/'.$setData['page'].'/'.$data['result']->image;
			$data['image_link'] = $image;
			
			$where['status']     = 1;
			$where['id !=']      = $id;
			
			$array = array();
			if($data['result']->str!=NULL && $data['result']->str!=0):
				$array = explode(',',$data['result']->str);
				$data['listArticleChoose'] = $this->admindino->loadTableWhereIn($setData['page'],NULL,$where,$array);
			endif;
			$data['listArticle']           = $this->admindino->loadTableWhereNotIn($setData['page'],NULL,$where,$array);
			
			require(FCPATH . APPPATH . 'controllers/admin/allmodules/load_update_content.php');
		}
		
		require(FCPATH . APPPATH . 'controllers/admin/allmodules/load_general_files.php');
		$data['template'] = "admin/ListArticle/item_detail.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}

	public function saveData($setData){
		$post = $this->input->post();
		$alert = '';
		if($post){

			foreach ($post as $key => $value):
				$getKey = explode("-", $key);
				if($getKey[0] == "title_url"):
					$data[$getKey[0]][$getKey[1]] = strtolower(webtitleUrl(webKillVN($value)));
				else:			
					$data[$getKey[0]][$getKey[1]] = stripslashes($value);
				endif;
			endforeach;	

			require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/image_control.php');
			
			if($data["db"]["id"] == NULL){ // INSERT TABLE
				
				$data["db"]["date"] = date('y-m-d');
				$data["db"]['id'] = $this->admindino->AddTable($setData['page'],$data["db"]);

				if($data["db"]['id'] == TRUE){
					require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/xml_control.php');
					$alert = '&alert=added';
					
				}else{
					die();
				}

				redirect(base_url().ADMINBASE.'?page='.$setData["page"].'&action=lists&id=0&function=null'.$alert);

			}else{ // UPDATE TABLE
				$result = $this->admindino->UpdateTable($setData['page'],$data["db"],$data["db"]["id"]);
				
				if($result == TRUE){

					require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/xml_control.php');
					$alert = '&alert=updated';
					
				}else{
					die();
				}
				redirect(base_url().ADMINBASE.'?page='.$setData["page"].'&action=lists&id=0&function=null'.$alert);

			}		

		}else{
			die();
		}			
	}
	
	public function UpdateOther($setData){
		$id = $setData['id'];
		$data['result'] 	  = $this->admindino->GetValueFrom($setData['page'],'id',$id,'*');	
	
		$where['status']     = 1;
		$where['id !=']      = $id;
		$array = array();
		$search = $this->input->post('function');
		$data['session']['where']     = NULL;
		
		
		if($data['result']->str!=NULL && $data['result']->str!=0):
			$array = explode(',',$data['result']->str);
			$data['listArticleChoose'] = $this->admindino->loadTableWhereIn($setData['page'],NULL,$where,$array);
		endif;
		$setData['coutAll']  = $this->admindino->countSearchNotIn($setData['page'],NULL,$where,$array );
		//Check Session search
		if($search){
			$data['session']['where']['title_vn'] =  $this->input->post('fTitle');
		}else{
			$data['session']    = $this->session->userdata($setData['page'].'other');
			if($data['session'] == FALSE):
				$data['session']['where']['title_vn']  = '';
				$this->session->set_userdata($setData['page'].'other', $data['session']);
			endif;
		}
				
		if(!empty($data['session']['where']['title_vn'])):
			$whereLike['title_vn']        =  $data['session']['where']['title_vn'];
			$this->session->set_userdata($setData['page'].'other', $data['session']);
			$setData['coutAll']  = $this->admindino->countSearchNotIn($setData['page'],$whereLike,$where,$array);
		else:
			$this->session->unset_userdata($setData['page'].'other');
		endif;// END IF CHECK EMPTY
		
		//$data['listArticle']           = $this->admindino->loadTableWhereNotIn($setData['page'],NULL,$where,$array);
		
		$whereLike['title_vn']     = $this->input->post('searchOther');
		//PHAN TRANG 
		$config 				    = array();
		$config["base_url"]        = base_url()."admin/".strtolower($setData['page'])."/other/".$id.'/Item?page=';
		$config["per_page"]        = 5;
        $config["uri_segment"]     = 5;
		$config["total_rows"]      = $setData['coutAll'];
		$config["typeMain"] 	    = 'main';
		$config['cur_page'] 	    = getParam($this,'page');
	    $this->pagination->initialize($config);	 
		$page  					  = getParam($this,'page') ? getParam($this,'page') : 0;
		$whereLike['title_vn']     =  $data['session']['where']['title_vn'];		
		$data['listArticle']       = $this->admindino->ListItemsNoIn(strtolower($setData['page']),$config["per_page"], $page ,$whereLike,$where,-1,'ASC',$array);
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
		$data['template'] = "admin/ListArticle/".$setData['action'].".php";		
		$this->load->view('admin/template/adminLayoutNoMenu',$data);
	}
	
	public function runItemOther($setData){
		$id      			= $this->input->post('id');	
		$this->input->post('getIdArticle')==false ? $data['str'] = 0 :  $data['str'] = implode(",",$this->input->post('getIdArticle'));
	
		$do = $this->admindino->UpdateTable($setData['page'],$data,$id);
		
		if($do){
		$data['result'] 	  = $this->admindino->GetValueFrom($setData['page'],'id',$id,'*');	
		$where['status']     = 1;
		$where['id !=']      = $id;
		$where['cat']        = $data['result']->cat;
		$array = array();
		if($data['result']->str!=NULL && $data['result']->str!=0):
			$array = explode(',',$data['result']->str);
			$listArticle = $this->admindino->loadTableWhereIn($setData['page'],NULL,$where,$array);
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

