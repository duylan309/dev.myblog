<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('admin/menu','admin/admindino'));
		$this->load->dbforge();
		$this->load->helper('file');
	}
			
	public function UpdateItem($setData){
		$id = $setData['id'];
		$data['result'] = $this->menu->editItem($id);	
		$where['menu_id']  = $id;
		
		//IMAGE
		$image = './upload/'.$setData['page'].'/'.$data['result']->image;
		$data['image_link'] = $image;
		$data['define_folder']= $setData['define_folder'];
		///XML DATA
		$fileXML_vn =$setData['define_folder']['xml_vn'].$setData['define_folder']['xml_menu'].$data['result']->id.".xml";
		$data['readXML_vn'] = simplexml_load_file($fileXML_vn);
		
		$fileXML_en =$setData['define_folder']['xml_en'].$setData['define_folder']['xml_menu'].$data['result']->id.".xml";
		$data['readXML_en'] = simplexml_load_file($fileXML_en);
		
		
		$data['check_new']    = $setData['check_new'];
		//LANGUAGE
		$data['language']     = $setData['language']; 
		$data['lang']         = $setData['lang'];
		$data['AdminMenu']    = $setData['AdminMenu'];
		$data['page']         = $setData['page'];
		//TEMPLATE
		$data['template'] = "admin/menu/item_detail.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}

	public function AddItem($setData){
		$data['define_folder']= $setData['define_folder'];
		$data['check_new']    = $setData['check_new'];
		//LANGUAGE
		$data['language']     = $setData['language']; 
		$data['lang']         = $setData['lang'];
		$data['page']         = $setData['page'];
		$data['AdminMenu']    = $setData['AdminMenu'];
		//TEMPLATE
		$data['template'] = "admin/menu/item_detail.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	// public function AddNew($setData){
	public function saveData($setData){
		
		$post = $this->input->post();

		if($post){
			foreach ($post as $key => $value):
				$getKey = explode("-", $key);
				if($getKey[0] == 'db' || $getKey[0] == 'more' || $getKey[0] == 'seo'):
					if($getKey[1] == "title_url"):
						$data[$getKey[0]][$getKey[1]] = strtolower(webtitleUrl(webKillVN($value)));
					else:			
						$data[$getKey[0]][$getKey[1]] = stripslashes($value);
					endif;
				endif;
			endforeach;	

			if(isset($data['db']['type'])){
				if($data["db"]['type']==9){
					$data['db']['title_url'] = $this->input->post('db-title_url');
				}
			}else if(isset($data['more']['type_hidden'])){
				if($data["more"]['type_hidden']==9){
					$data['db']['title_url'] = $this->input->post('db-title_url');
				}
			}		

			// INSERT TABLE
			if($data["db"]["id"] == NULL){
				$newid = $this->admindino->AddTable('menu',$data["db"]);
				if($newid):
					if($data["db"]['type']==2):
						$this->CreateListArticle($data["db"]['title_url']);
						$this->CreateListArticlePhoto($data["db"]['title_url']);	
					elseif($data["db"]['type']==3):
						$this->CreateListArticle($data["db"]['title_url']);
						$this->CreateListArticleTab($data["db"]['title_url'].'_tab');
						$this->CreateListArticlePhoto($data["db"]['title_url']);	
						$this->CreateListArticlesCategory($data["db"]['title_url']);	
					elseif($data["db"]['type']==4):
						$this->CreateListArticleGallery($data["db"]['title_url']);
						$this->CreateListArticlePhoto($data["db"]['title_url']);
					elseif($data["db"]['type']==5):
						$this->CreateListArticleGallery($data["db"]['title_url']);	
						$this->CreateListArticlePhoto($data["db"]['title_url']);	
						$this->CreateListArticlesCategory($data["db"]['title_url']);
					elseif($data["db"]['type'] == 6):	
						$this->CreateListArticle($data["db"]['title_url']);
					elseif($data["db"]['type'] == 11):	
						$this->CreateListArticle($data["db"]['title_url']);	
					endif;
					
					$file_xml_vn = $setData['define_folder']['xml_vn'].$setData['define_folder']['xml_menu'].$newid.".xml";	
					$file_xml_en = $setData['define_folder']['xml_en'].$setData['define_folder']['xml_menu'].$newid.".xml";	
					
					$information_vn = $this->dinosaur_lib->xml_post(	    'Tiêu đề Tiếng Việt',
																			stripslashes('Nội dung ngắn.'),
																			stripslashes('Nội dung đầy đủ.'),
																			stripcslashes('Tiêu đề SEO'),
																			stripcslashes('Từ khóa SEO'),
																			stripcslashes('Miêu tả SEO'));
																			
					$information_en = $this->dinosaur_lib->xml_post(	    'Edit title',
																			stripslashes('edit short content'),
																			stripslashes('edit full content'),
																			stripcslashes('SEO title'),
																			stripcslashes('SEO keyword'),
																			stripcslashes('SEO description'));														
					
					
					$xml_vn = $this->xmlwrite->createXML('information', $information_vn);
					$xml_vn->save($file_xml_vn);
					
					$xml_en = $this->xmlwrite->createXML('information', $information_en);
					$xml_en->save($file_xml_en);
				endif;
				$alert = "&alert=updated";
			}else{ // UPDATE TABLE
			
			if(isset($_FILES['file_images']['name'])){
				$data["db"]['image'] = mktime().str_replace(" ","_",$_FILES['file_images']['name']);
				$imageName = mktime().str_replace(" ","_",$_FILES['file_images']['name']);	
				
				if($data["db"]["id"])
				$this->deleteOldImage($this->input->post($data["db"]["id"])); //delete old image
				
				if(!empty($imageName))
				{
				$config['file_name']	= $imageName;
				$config['upload_path'] = "./upload/menu";
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '20000';
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
			
				$data["db"]['image'] = $imageName;
				}
			}
			
			if($data["db"]["id"]){
				if($this->input->post('db-del_image')==1){
					$this->deleteOldImage($this->input->post($data["db"]["id"])); //delete old image
					$data["db"]['image'] = '';
				}
			}

			$do = $this->admindino->UpdateTable('menu',$data["db"],$data["db"]['id']);
			
			$old_type = $this->input->post('more-type_hidden');
			$old_url  = $this->input->post('more-url_hidden');

				////WRITE XMLDATA
				if($do == TRUE){
					// UPDATE OR CREATE FOLDER
					if($data["db"]['title_url'] != $old_url && $old_type!=10):

						if($old_type!=7 && $old_type !=1 && $old_type !=9)
							$this->RenameXMLAndImageFolder($old_url,$data["db"]['title_url']); 
						
						if($old_type==2  || $old_type==4 || $old_type==5)
							$this->RenameTable($old_url.'_photo',$data["db"]['title_url'].'_photo'); 
						
						if($old_type==3) {
							$this->RenameTable($old_url.'_photo',$data["db"]['title_url'].'_photo');
							$this->RenameXMLAndImageFolder($old_url."_tab",$data["db"]['title_url']."_tab"); 
						}
						
						if($old_type==3 || $old_type==5)
							$this->RenameXMLAndImageFolder($old_url."_cat",$data["db"]['title_url']."_cat"); 
				   
				    endif;	
							
					$file_xml_vn = $setData['define_folder']['xml_vn'].$setData['define_folder']['xml_menu'].$data["db"]['id'].".xml";	
					$file_xml_en = $setData['define_folder']['xml_en'].$setData['define_folder']['xml_menu'].$data["db"]['id'].".xml";	
					
					$information_vn = $this->dinosaur_lib->xml_post(	stripcslashes($data["db"]['title_vn']),
																		isset($data["more"]["content_vn"]) && count($data["more"]["content_vn"]) ? stripcslashes( $data["more"]["content_vn"]) : "",
																		isset($data["more"]["description_vn"]) && count($data["more"]["description_vn"]) ? stripcslashes($data["more"]["description_vn"]) : "",
																		stripcslashes($data["seo"]['meta_title_vn']),
																		stripcslashes($data["seo"]["meta_keyword_vn"]),
																		stripcslashes($data["seo"]["meta_description_vn"]));
						
					$xml_vn = $this->xmlwrite->createXML('information', $information_vn);
					$xml_vn->save($file_xml_vn);
						
					$information_en = $this->dinosaur_lib->xml_post(	stripcslashes($data["db"]['title_en']),
																		isset($data["more"]["content_en"]) &&  count($data["more"]["content_en"]) ? stripcslashes($data["more"]["content_en"]) : "",
																		isset($data["more"]["description_en"]) &&  count($data["more"]["description_en"]) ? stripcslashes($data["more"]["description_en"]) : "",
																		stripcslashes($data["seo"]['meta_title_en']),
																		stripcslashes($data["seo"]["meta_keyword_en"]),
																		stripcslashes($data["seo"]["meta_description_en"]));
					// var_dump($information_vn);												
					$xml_en = $this->xmlwrite->createXML('information', $information_en);
					$xml_en->save($file_xml_en);
				}

				$alert = "&alert=added";

			}
			
			redirect(base_url().ADMINBASE.'?page=menu&action=lists&id=0&function=null'.$alert);

		}else{
			$alert = "&alert=error";
			redirect(base_url().ADMINBASE.'?page=menu&action=lists&id=0&function=null');
		}
		

	}
	
	///DELETE OLD IMAGE	
	function deleteOldImage($id){
			$result = $this->menu->editItem($id);	
			$oldimage = $result->image;
			
			$fileOldImage = "./upload/menu/".$oldimage;
			if(is_file($fileOldImage))
			unlink($fileOldImage);
			
			return TRUE;
	}
	
	/// FUNCTION CONTROL FOLDER
	private function CreateXMLAndImageFolder($folder_name){
		    $pathdir_image =  "./upload/".$folder_name;
			$pathdir_image_storage =  "./upload/storage/".$folder_name;
			$pathdir_xml_vn =  "./xmldata/vn/".$folder_name;
			$pathdir_xml_en =  "./xmldata/en/".$folder_name;
			if(!is_dir($pathdir_xml_vn) && !is_dir($pathdir_xml_en) && !is_dir($pathdir_image) && !is_dir($pathdir_image_storage)){ 
			  if( mkdir($pathdir_xml_vn,0755,TRUE) && mkdir($pathdir_xml_en,0755,TRUE)&& mkdir($pathdir_image,0755,TRUE)&& mkdir($pathdir_image_storage,0755,TRUE))
			  	return TRUE;
			  else
			  	return FALSE;	
			}
	}
		
	/// RENAME TABLE
	private function RenameTable($OldFolderName,$NewFolderName){
			if($this->dbforge->rename_table($OldFolderName, $NewFolderName))
				return TRUE;
			else
				return FALSE;
	}
	private function RenameXMLAndImageFolder($OldFolderName,$NewFolderName){
			if(rename('./upload/'.$OldFolderName    , './upload/'.$NewFolderName) && rename('./upload/storage/'.$OldFolderName    , './upload/storage/'.$NewFolderName) && rename('./xmldata/vn/'.$OldFolderName, './xmldata/vn/'.$NewFolderName) && rename('./xmldata/en/'.$OldFolderName, './xmldata/en/'.$NewFolderName)&& $this->dbforge->rename_table($OldFolderName, $NewFolderName))
				return TRUE;
			else
				return FALSE; 
	}
	
	private function deleteOldType($table_name){
			if($this->dbforge->drop_table($table_name))
				return TRUE;
			else
				return FALSE;
	}
	
	private function DropTableAndRemoveFolder($table_name){
			if($this->dbforge->drop_table($table_name)){
				$pathdir_image  =  "./upload/".$table_name;
				$pathdir_image_store  =  "./upload/storage/".$table_name;
				$pathdir_xml_vn =  "./xmldata/vn/".$table_name;
				$pathdir_xml_en =  "./xmldata/en/".$table_name;
							
				if(delete_files($pathdir_image  , true))
					rmdir($pathdir_image);
					 
				if(delete_files($pathdir_xml_vn , true))
					rmdir($pathdir_xml_vn);
					 
				if(delete_files($pathdir_xml_en , true))
					rmdir($pathdir_xml_en);
					
				if(delete_files($pathdir_image_store , true)){
					rmdir($pathdir_image_store);
				}
				
			}else
				return FALSE;
	}
	
	private function CreateContact($table_name){
			$fields['id']       = array( 'type' => 'INT'    , 'constraint' => 11    , 'unsigned'   => TRUE, 'auto_increment' => TRUE  );
            $fields['fullname'] = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['subject'] = array( 'type' => 'VARCHAR', 'constraint' => '225');
            $fields['firstname']= array( 'type' => 'VARCHAR', 'constraint' => '225');
            $fields['lastname'] = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['phone']    = array( 'type' => 'VARCHAR', 'constraint' => '225');	
			$fields['email']    = array( 'type' => 'VARCHAR', 'constraint' => '225');					
			$fields['status']   = array( 'type' => 'TINYINT');
			$fields['content']  = array( 'type' => 'TEXT');
			$fields['date']     = array( 'type' => 'DATE');
			$fields['sort']     = array( 'type' => 'INT'    , 'constraint' => 11);
			
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			if($this->dbforge->create_table($table_name.'_inbox', TRUE)){
				return TRUE;
			}else
				return FALSE;
	}
	
	private function CreateListArticle($table_name){
			$fields['id']       = array( 'type' => 'INT'    , 'constraint' => 11    , 'unsigned'   => TRUE, 'auto_increment' => TRUE  );
            $fields['title_vn'] = array( 'type' => 'VARCHAR', 'constraint' => '225');
            $fields['title_en'] = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['title_url']= array( 'type' => 'VARCHAR', 'constraint' => '225', 'unique'	 => TRUE);					
			$fields['status']   = array( 'type' => 'TINYINT');
			$fields['home']     = array( 'type' => 'TINYINT');
			$fields['hot']      = array( 'type' => 'TINYINT');
			$fields['alt_image']= array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['image']    = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['str']      = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['date']     = array( 'type' => 'DATE');
			$fields['str']      = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['sort']     = array( 'type' => 'INT'    , 'constraint' => 11);
			$fields['cat']      = array( 'type' => 'VARCHAR'    , 'constraint' => 255);
			$fields['color']      = array( 'type' => 'VARCHAR'    , 'constraint' => 255);
			$fields['font_color']      = array( 'type' => 'VARCHAR'    , 'constraint' => 255);
			$fields['layout']   = array( 'type' => 'INT'    , 'constraint' => 11);
			
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			if($this->dbforge->create_table($table_name, TRUE)){
				$this->CreateXMLAndImageFolder($table_name);
				return TRUE;
			}else
				return FALSE;
	}
	
	private function CreateListArticleTab($table_name){
			$fields['id']       = array( 'type' => 'INT'    , 'constraint' => 11    , 'unsigned'   => TRUE, 'auto_increment' => TRUE  );
            $fields['title_vn'] = array( 'type' => 'VARCHAR', 'constraint' => '225');
            $fields['title_en'] = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['title_url']= array( 'type' => 'VARCHAR', 'constraint' => '225', 'unique'	 => TRUE);					
			$fields['status']   = array( 'type' => 'TINYINT');
			$fields['type']     = array( 'type' => 'TINYINT');
			$fields['hot']      = array( 'type' => 'TINYINT');
			$fields['alt_image']= array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['image']    = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['date']     = array( 'type' => 'DATE');
			$fields['style']    = array( 'type' => 'INT'    , 'constraint'  => 11 );
			$fields['position'] = array( 'type' => 'INT'    , 'constraint'  => 11 );
			$fields['str']      = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['sort']     = array( 'type' => 'INT'    , 'constraint' => 11);
			$fields['cat']      = array( 'type' => 'VARCHAR'    , 'constraint' => 255);
			
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			if($this->dbforge->create_table($table_name, TRUE)){
				$this->CreateXMLAndImageFolder($table_name);
				return TRUE;
			}else
				return FALSE;
	}
	
	private function CreateListArticleGallery($table_name){
			$fields['id']       = array( 'type' => 'INT'    , 'constraint' => 11    , 'unsigned'   => TRUE, 'auto_increment' => TRUE  );
            $fields['title_vn'] = array( 'type' => 'VARCHAR', 'constraint' => '225');
            $fields['title_en'] = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['title_url']= array( 'type' => 'VARCHAR', 'constraint' => '225', 'unique'	 => TRUE);					
			$fields['status']   = array( 'type' => 'TINYINT');
			$fields['home']     = array( 'type' => 'TINYINT');
			$fields['hot']      = array( 'type' => 'TINYINT');
			$fields['alt_image']= array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['image']    = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['str']      = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['date']     = array( 'type' => 'DATE');
			$fields['sort']     = array( 'type' => 'INT'    , 'constraint' => 11);
			$fields['cat']      = array( 'type' => 'INT'    , 'constraint' => 11);
			$fields['layout']   = array( 'type' => 'INT'    , 'constraint' => 11);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			if($this->dbforge->create_table($table_name, TRUE)){
				$this->CreateXMLAndImageFolder($table_name);
				return TRUE;
			}else
				return FALSE;
	}
	
	private function CreateListArticlePhoto($table_name){
			$fields['id']       = array( 'type' => 'INT'    , 'constraint' => 11    , 'unsigned'   => TRUE, 'auto_increment' => TRUE  );
      		$fields['title_url']= array( 'type' => 'VARCHAR', 'constraint' => '225', 'unique'	 => TRUE);					
			$fields['small_content']   = array( 'type' => 'TEXT');
			$fields['content']  = array( 'type' => 'TEXT');
			$fields['alt_image']= array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['image']    = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['name']     = array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['linkphoto']= array( 'type' => 'VARCHAR', 'constraint' => '225');
			$fields['date']     = array( 'type' => 'DATE');
			$fields['sort']     = array( 'type' => 'INT'    , 'constraint' => 11);
			$fields['status']   = array( 'type' => 'TINYINT'    , 'constraint' => 11);
			$fields['album_id'] = array( 'type' => 'INT'    , 'constraint' => 11);
			
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			if($this->dbforge->create_table($table_name.'_photo', TRUE)){
					return TRUE;
			}else
				return FALSE;
	}
	
	private function CreateListArticlesCategory($table_name){
				$fields_cat['id']       = array( 'type' => 'INT'    , 'constraint' => 11    , 'unsigned'   => TRUE, 'auto_increment' => TRUE  );
          	    $fields_cat['title_vn'] = array( 'type' => 'VARCHAR', 'constraint' => '225');
            	$fields_cat['title_en'] = array( 'type' => 'VARCHAR', 'constraint' => '225');
				$fields_cat['title_jp'] = array( 'type' => 'VARCHAR', 'constraint' => '225');
				$fields_cat['title_url']= array( 'type' => 'VARCHAR', 'constraint' => '225', 'unique'	 => TRUE);					
				$fields_cat['status']   = array( 'type' => 'TINYINT');
				$fields_cat['image']    = array( 'type' => 'VARCHAR', 'constraint' => '225');
				$fields_cat['alt_image']= array( 'type' => 'VARCHAR', 'constraint' => '225');
				$fields_cat['date']     = array( 'type' => 'DATE');
				$fields_cat['cat']      = array( 'type' => 'INT'    , 'constraint' => 11);
				$fields_cat['sort']     = array( 'type' => 'INT'    , 'constraint' => 11);
				$this->dbforge->add_field($fields_cat);
			    $this->dbforge->add_key('id', TRUE);
				if($this->dbforge->create_table($table_name.'_cat', TRUE)){
					$this->CreateXMLAndImageFolder($table_name.'_cat');
					return TRUE;
				}else{
					return FALSE;	
				}
			
	}
}
