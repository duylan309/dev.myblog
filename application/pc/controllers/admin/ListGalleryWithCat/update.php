<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('admin/admindino'));
	}
			
	public function UpdateItem($setData){
		$id = $setData['id'];
		$data['result'] 	     = $this->admindino->GetValueFrom($setData['page'],'id',$id,'*');	
		$data['result_cat']      = $this->admindino->loadTable($setData['page'].'_cat',NULL,NULL);// Get resutl Product_cat
		$data['result_features'] = $this->admindino->loadTable('features',NULL,NULL);// Get resutl Product_cat
		$data['result_kinds']    = $this->admindino->loadTable('kinds',NULL,NULL);// Get resutl Product_cat
		$data['result_views']    = $this->admindino->loadTable('views',NULL,NULL);// Get resutl Product_cat
		
		$data['cat']             = explode(',',$data['result']->cat);
		$data['feature']         = explode(',',$data['result']->feature);
		$data['kinds']           = explode(',',$data['result']->kinds);
		$data['views']           = explode(',',$data['result']->views);
		//IMAGE
		$image = './upload/'.$setData['page'].'/'.$data['result']->image;
		$data['image_link']   = $image;
		$data['define_folder']= $setData['define_folder'];
	
		///XML DATA
		$fileXML_en =$setData['define_folder']['xml'].$setData['define_folder']['english'].'/'.$setData['page'].'/'.$data['result']->id.".xml";
		$data['readXML_en'] = simplexml_load_file($fileXML_en);
		$fileXML_vn =$setData['define_folder']['xml'].$setData['define_folder']['vietnam'].'/'.$setData['page'].'/'.$data['result']->id.".xml";
		$data['readXML_vn'] = simplexml_load_file($fileXML_vn);
		
		//load others article
		$where['status']     = 1;
		$where['id !=']      = $id;
		$where['cat']        = $data['result']->cat;
		$array = array();
		if($data['result']->str!=NULL && $data['result']->str!=0):
			$array = explode(',',$data['result']->str);
			$data['listArticleChoose'] = $this->admindino->loadTableWhereIn($setData['page'],NULL,$where,$array);
		endif;
		$data['listArticle']           = $this->admindino->loadTableWhereNotIn($setData['page'],NULL,$where,$array);
		
		$data['arrCat']       = $this->dinosaur_lib->getMenuAdmin($data['result_cat']);
		
		$data['check_new']    = $setData['check_new'];
		//LANGUAGE
		$data['language']     = $setData['language']; 
		$data['lang']         = $setData['lang'];
		$data['page']         = $setData['page'];
		$data['AdminMenu']    = $setData['AdminMenu'];
		//TEMPLATE
		$data['template'] = "admin/ListGalleryWithCat/".$setData['action'].".php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	public function UpdateOther($setData){
		$id = $setData['id'];
		$data['result'] 	  = $this->admindino->GetValueFrom($setData['page'],'id',$id,'*');	
	
		$where['status']     = 1;
		$where['id !=']      = $id;
		$where['cat']        = intval($data['result']->cat);
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
		
		$whereLike['title_vn']     = $this->input->post('searchOther');
		//PHAN TRANG 
		$config 				    = array();
		$config["base_url"]        = base_url()."admin/".strtolower($setData['page'])."/other/".$id.'/Item?page=';
		$config["per_page"]        = 5;
        $config["uri_segment"]     = 5;
		$config["total_rows"]      = $setData['coutAll'];
		$config["typeMain"] 	   = 'main';
		$config['cur_page'] 	   = getParam($this,'page');
	    $this->pagination->initialize($config);	 
		$page  					   = getParam($this,'page') ? getParam($this,'page') : 0;
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
		$data['template'] = "admin/ListGalleryWithCat/".$setData['action'].".php";		
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
				 
		 </script>
		<?php 
		}
		
	}
	
	public function runItem($setData){
		if($_FILES['file_images']['name']){
			$data['image'] = mktime().str_replace(" ","_",$_FILES['file_images']['name']);
			$imageName = mktime().str_replace(" ","_",$_FILES['file_images']['name']);	
			$this->deleteOldImage($setData['page'],$this->input->post('image_id')); //delete old image
			if(!empty($imageName))
			{
			$config['file_name']	= $imageName;
			$config['upload_path'] = "./upload/".$setData['page'];
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '10000';
			$config['remove_spaces']  = TRUE;
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('file_images'))
			{
				$error = array('error' => $this->upload->display_errors());
				$data1['mess'] = $error;
			}
			else
			{
				$data1 = array('upload_data' => $this->upload->data());
				$data1['mess'] = "Upload Thanh Cong";
			}
		
			$data['image'] = $imageName;
			}//END IMAGENAME
		}
		
		if($this->input->post('image_id')==1){
			$this->deleteOldImage($setData['page'],$this->input->post('image_id')); //delete old image
			$data['image'] = '';
		}
		
		$data['title_vn']  = $this->input->post('title_vn');
		$data['title_en']  = $this->input->post('title_en');
		$data['title_url'] = webtitleUrl(webKillVN($this->input->post('titleUrl')));
		$data['linkmore']  = $this->input->post('linkmore');
		$data['alt_image'] = $this->input->post('alt_image');
		$data['status']    = $this->input->post('status');
		$data['hot']       = $this->input->post('hot');
		$data['sort']      = $this->input->post('sort');
		$data['home']      = $this->input->post('home');
		$data['address_vn']= $this->input->post('address_vn');
		$data['address_en']= $this->input->post('address_en');
		$data['mainview']  = $this->input->post('mainview');
		$data['acreage']   = $this->input->post('acreage');
		$data['tree']      = $this->input->post('tree');
		$data['block']     = $this->input->post('block');
		$data['apartment'] = $this->input->post('apartment');
		$data['available'] = $this->input->post('available');
		$data['process']   = $this->input->post('process');
		$data['sold']      = $this->input->post('sold');

		$data['cat']       = implode(",",$this->input->post('cat'));
		$data['feature']   = implode(",",$this->input->post('feature'));
		$data['kinds']     = implode(",",$this->input->post('kind'));
		$data['views']     = implode(",",$this->input->post('view'));
		$data['date']      = $this->input->post('date');
		$id      		   = $this->input->post('id');	
		
		$do = $this->admindino->UpdateTable($setData['page'],$data,$id);
		
		////WRITE XMLDATA
		if($do == TRUE){
			require(FCPATH . APPPATH . 'controllers/admin/allmodules/update_xml_content_project.php');
			
			redirect(base_url().'admin/'.$setData['page'].'/lists/0/null');
		}
	}
	
	
	///ADD NEW ITEM
	public function AddNew($setData){
		$thumb_name 				 = mktime().'noimg.png';
	    
	    $config['image_library']    = "gd2";      
        $config['source_image']     = "./images/noimg.png";      
        $config['new_image']        = "./upload/".$setData['page'].'/'.$thumb_name;
        $config['maintain_ratio']   = TRUE;      
        $config['width'] 			= "100";      
        $config['height'] 		   = "53";

        $this->load->library('image_lib',$config);
		$this->image_lib->resize(); 
		
		$array = array(     "id"=>NULL,
							"title_en"     => 'Edit here',
							"title_vn"     => 'Tiêu đề',
							"title_url"    => 'URL-'.mktime(),
							"linkmore"     =>  '#',
							"image"        => $thumb_name,
							"alt_image"    => 'alt_image',
							"status"       => 0,
							"home"         => 0,
							"hot"          => 0,
							"cat"          => 0,
							"kinds"        => 0,
							"views"        => 0,
							"feature"      => 0,
							"sort"	       => 0,
							"date"	       => date('y-m-d'));
							
		$do = $this->admindino->AddTable($setData['page'],$array);
		
		////WRITE XMLDATA
		if($do){
				require(FCPATH . APPPATH . 'controllers/admin/allmodules/add_xml_content.php');
					
			redirect(base_url().'admin/'.$setData['page'].'/update/'.$do.'/Item');
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

