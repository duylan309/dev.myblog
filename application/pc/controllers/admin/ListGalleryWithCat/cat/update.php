<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('admin/admindino'));
	}
			
	public function UpdateItem($setData){
		$id = $setData['id'];
		$data['result'] = $this->admindino->GetValueFrom($setData['page'],'id',$id,'*');	
		$data['result_cat'] = $this->admindino->loadTable($setData['page'],NULL,NULL);// Get resutl 	
		//IMAGE
		$image = './upload/'.$setData['page'].'/'.$data['result']->image;
		$data['image_link'] = $image;
		$data['define_folder']= $setData['define_folder'];
	
		///XML DATA
		$fileXML_en =$setData['define_folder']['xml'].$setData['define_folder']['english'].'/'.$setData['page'].'/'.$data['result']->id.".xml";
		$data['readXML_en'] = simplexml_load_file($fileXML_en);
		$fileXML_vn =$setData['define_folder']['xml'].$setData['define_folder']['vietnam'].'/'.$setData['page'].'/'.$data['result']->id.".xml";
		$data['readXML_vn'] = simplexml_load_file($fileXML_vn);
		
		$data['arrCat']       = $this->dinosaur_lib->getMenuAdmin($data['result_cat']);
		$data['check_new']    = $setData['check_new'];
		//LANGUAGE
		$data['language']     = $setData['language']; 
		$data['lang']         = $setData['lang'];
		$data['page']         = $setData['page'];
		$data['AdminMenu']    = $setData['AdminMenu'];
		//TEMPLATE
		$data['template'] = "admin/ListGalleryWithCat/cat/".$setData['action'].".php";		
		$this->load->view('admin/template/adminLayout',$data);
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
		$data['alt_image'] = $this->input->post('alt_image');
		$data['status']    = $this->input->post('status');
		$data['sort']      = $this->input->post('sort');
		$data['date']      = $this->input->post('date');
		$id      			= $this->input->post('id');	
		
		$do = $this->admindino->UpdateTable($setData['page'],$data,$id);
		
		////WRITE XMLDATA
		if($do == TRUE){
			$file_xml_en = $setData['define_folder']['xml'].$setData['define_folder']['english'].'/'.$setData['page'].'/'.$id.".xml";	
			$file_xml_vn = $setData['define_folder']['xml'].$setData['define_folder']['vietnam'].'/'.$setData['page'].'/'.$id.".xml";
		
			$information_en = $this->dinosaur_lib->xml_post(	stripcslashes($data['title_en']),
																stripcslashes($_REQUEST["content_en"]),
																stripcslashes($_REQUEST["description_en"]),
																stripcslashes($this->input->post('meta_title_en')),  															  																stripcslashes($_REQUEST["meta_keyword_en"]),
																stripcslashes($_REQUEST["meta_description_en"]));
					
			$information_vn = $this->dinosaur_lib->xml_post(	stripcslashes($data['title_vn']),
																stripcslashes($_REQUEST["content_vn"]),
																stripcslashes($_REQUEST["description_vn"]),
																stripcslashes($this->input->post('meta_title_vn')),
																stripcslashes($_REQUEST["meta_keyword_vn"]),
																stripcslashes($_REQUEST["meta_description_vn"]));											
			$xml_en = $this->xmlwrite->createXML('information', $information_en);
			$xml_en->save($file_xml_en);
			
			$xml_vn = $this->xmlwrite->createXML('information', $information_vn);
			$xml_vn->save($file_xml_vn);
			
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
							"image"        => $thumb_name,
							"alt_image"    => 'alt_image',
							"status"       => 0,
							"sort"	     => 0,
							"date"	     => date('y-m-d'));
							
		$do = $this->admindino->AddTable($setData['page'],$array);
		
		////WRITE XMLDATA
		if($do){
			$file_xml_en = $setData['define_folder']['xml'].$setData['define_folder']['english'].'/'.$setData['page'].'/'.$do.".xml";	
			$file_xml_vn = $setData['define_folder']['xml'].$setData['define_folder']['vietnam'].'/'.$setData['page'].'/'.$do.".xml";	
																	
			$information_en = $this->dinosaur_lib->xml_post(	    'Edit title',
																	stripslashes('edit short content'),
																	stripslashes('edit full content'),
																	stripcslashes('SEO title'),
																	stripcslashes('SEO keyword'),
																	stripcslashes('SEO description'));
																	
			$information_vn = $this->dinosaur_lib->xml_post(	    'Chỉnh sửa tiêu đề',
																	stripslashes('Chỉnh sửa nội dung ngắn'),
																	stripslashes('Chỉnh sửa nội dung đầy đủ'),
																	stripcslashes('Tiêu đề SEO'),
																	stripcslashes('Từ khóa SEO'),
																	stripcslashes('Miêu tả SEO'));																	
																															
			
			$xml_en = $this->xmlwrite->createXML('information', $information_en);
			$xml_en->save($file_xml_en);
			
			$xml_vn = $this->xmlwrite->createXML('information', $information_vn);
			$xml_vn->save($file_xml_vn);
					
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

