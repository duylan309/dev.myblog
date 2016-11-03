<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
			$this->load->database();
		$this->load->helper("url");
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->library('xmlwrite');
		$this->load->model('admin/article');
	}
		
	public function UpdateItem($setData){
		$id = $setData['id'];
		$result_first = $this->article->editItem($id);	
		$result = $result_first->result();	
		$data['result'] = $result[0];
		$data['result_cat'] = $this->getCat('menu');// Get resutl Product_cat
		
		//IMAGE
		$image = $setData['define_folder']['image_article'].$result[0]->image;
		$data['image_link'] = $image;
		$data['define_folder']= $setData['define_folder'];
		
		///XML DATA
		$fileXML_vn =$setData['define_folder']['xml'].$setData['define_folder']['vietnam'].$setData['define_folder']['xml_article'].$result[0]->id.".xml";
		$data['readXML_vn'] = simplexml_load_file($fileXML_vn);
		
		$fileXML_en =$setData['define_folder']['xml'].$setData['define_folder']['english'].$setData['define_folder']['xml_article'].$result[0]->id.".xml";
		$data['readXML_en'] = simplexml_load_file($fileXML_en);
		
		$data['check_new']    = $setData['check_new'];
		//LANGUAGE
		$data['language'] = $setData['language']; 
		$data['lang'] = $setData['lang'];
		//TEMPLATE
		$data['template'] = "admin/article/".$setData['action'].".php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	public function runItem($setData){
		if($_FILES['file_images']['name']){
			$data['image'] = mktime().str_replace(" ","_",$_FILES['file_images']['name']);
			$imageName = mktime().str_replace(" ","_",$_FILES['file_images']['name']);	
			$this->deleteOldImage($setData['id'],$setData['define_folder']); //delete old image
			if(!empty($imageName))
			{
			$config['file_name']	= $imageName;
			$config['upload_path'] = "./".$setData['define_folder']['image_article'];
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '10000';
			$config['remove_spaces']  = TRUE;
			$config['overwrite'] = TRUE;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('file_images'))
			{
				$error = array('error' => $this->upload->display_errors());
				$data['mess'] = $error;
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				$data['mess'] = "Upload Thanh Cong";
			}
		
			$data['image'] = $imageName;
			}//END IMAGENAME
		}
		
		$data['title_vn'] = $this->input->post('title_vn');
		$data['title_en'] = $this->input->post('title_en');
		$data['title_url'] = webtitleUrl(webKillVN($this->input->post('titleUrl')));
		$data['status'] = $this->input->post('status');
		$data['sort'] = $this->input->post('sort');
		$data['cat'] = $this->input->post('cat');
		$data['alt_image'] = $this->input->post('alt_image)');
		$data['home']= $this->input->post('home');
		$data['style']= $this->input->post('style');
		$data['date']= strtotime($this->input->post('date'));
		$data['id'] = $this->input->post('id');	
	
		
		$do = $this->article->updateItem($data);
		////WRITE XMLDATA
		if($do == TRUE){
			$file_xml_vn = $setData['define_folder']['xml'].$setData['define_folder']['vietnam'].$setData['define_folder']['xml_article'].$data['id'].".xml";	
			$file_xml_en = $setData['define_folder']['xml'].$setData['define_folder']['english'].$setData['define_folder']['xml_article'].$data['id'].".xml";	
			$information_vn = $this->dinosaur_lib->xml_post(	stripcslashes($data['title_vn']),
																stripcslashes($_REQUEST["content_vn"]),
																stripcslashes($_REQUEST["description_vn"]),
																stripcslashes($this->input->post('meta_title_vn')),
																stripcslashes($_REQUEST["meta_keyword_vn"]),
																stripcslashes($_REQUEST["meta_description_vn"]));
				
			$xml_vn = $this->xmlwrite->createXML('information', $information_vn);
			$xml_vn->save($file_xml_vn);
				
			$information_en = $this->dinosaur_lib->xml_post(	stripcslashes($data['title_en']),
																stripcslashes($_REQUEST["content_en"]),
																stripcslashes($_REQUEST["description_en"]),
																stripcslashes($this->input->post('meta_title_en')),
																stripcslashes($_REQUEST["meta_keyword_en"]),
																stripcslashes($_REQUEST["meta_description_en"]));
			$xml_en = $this->xmlwrite->createXML('information', $information_en);
			$xml_en->save($file_xml_en);
				
			redirect(base_url().'admin/article/lists/0/null');
		}
	}
	
	
	///ADD NEW ITEM
	public function AddNew($setData){
		$thumb_name 				 = mktime().'noimg.png';
	    
	    $config['image_library']    = "gd2";      
        $config['source_image']     = "./images/noimg.png";      
        $config['new_image']        = "./".$setData['define_folder']['image_article'].$thumb_name;
        $config['maintain_ratio']   = TRUE;      
        $config['width'] 			= "100";      
        $config['height'] 		   = "53";

        $this->load->library('image_lib',$config);
		$this->image_lib->resize(); 
		
		$data['title_vn'] 	     = 'Tiêu đề mẫu';
		$data['title_en']         = 'Edit here';
		$data['title_url']        = 'URL-'.mktime();
		$data['status']           = '0';
		$data['sort']             = '0';
		$data['cat']              = '0';
		$data['alt_image']        = 'alt_image';
		$data['image']            = $thumb_name;
		$data['home']			 = '0';
		$data['style']			= '0';
     	$data['date']			 = mktime();
		$data['id'] 			   = NULL;	
		
		
		
		$do = $this->article->AddItem($data);
		
		////WRITE XMLDATA
		if($do){
		$file_xml_vn = $setData['define_folder']['xml'].$setData['define_folder']['vietnam'].$setData['define_folder']['xml_article'].$do.".xml";	
		$file_xml_en = $setData['define_folder']['xml'].$setData['define_folder']['english'].$setData['define_folder']['xml_article'].$do.".xml";	
		$information_vn = array(
				'info' => array(
					array(
						'@attributes' => array(
							'langId' => '1'
						),
						'title' =>  array(
							'@value' => 'Tiêu đề Tiếng Việt',
						),
												
						'content' => array(
							'@value' => stripslashes('Nội dung ngắn.'),
						),
						'description' => array(
							'@value' => stripslashes('Nội dung đầy đủ'),
						),
						
						'meta'=>array(
						
							'title'=>array(
								'@value' => stripcslashes('Tiêu đề SEO')
							),
							'keyword'=>array(
								'@value' => stripcslashes('Từ khóa SEO')
							),
							'description'=>array(
								'@value' => stripcslashes('Miêu tả SEO')
							),
						),
					),
				)
			);
			
			$xml_vn = $this->xmlwrite->createXML('information', $information_vn);
			$xml_vn->save($file_xml_vn);
			
			/////////////ENGLISH//////////////////////////////////////////
			
			$information_en = array(
				'info' => array(
					array(
						'@attributes' => array(
							'langId' => '1'
						),
						'title' =>  array(
							'@value' => 'Edit title'
						),
												
						'content' => array(
							'@value' => stripslashes('edit short content'),
						),
						'description' => array(
							'@value' => stripslashes('edit full content'),
						),
						
						'meta'=>array(
						
							'title'=>array(
								'@value' => stripcslashes('SEO title')
							),
							'keyword'=>array(
								'@value' => stripcslashes('SEO keyword')
							),
							'description'=>array(
								'@value' => stripcslashes('SEO description')
							),
						),
					),
				)
			);
			
			$xml_en = $this->xmlwrite->createXML('information', $information_en);
			$xml_en->save($file_xml_en);
			
			redirect(base_url().'admin/article/lists/0/null');
		}
	}
	
	///DELETE OLD IMAGE	
	function deleteOldImage($id,$define){
			$result_first = $this->article->editItem(intval($id));	
			$result = $result_first->result();	
			$oldimage = $result[0]->image;
			
			$fileOldImage = "./".$define['image_article'].$oldimage;
			if(is_file($fileOldImage))
			unlink($fileOldImage);
			
			return TRUE;
	}
	
	public function getCat($table){
			$this->load->model('admin/'.$table);
			$article_cat = $this->$table->getTitleId();
			return $article_cat->result();
	}
	
	public function AddItem($setData){
		
		$data['result_cat'] = $this->getCat('article_cat');// Get resutl article_cat
		$data['result_author'] = $this->getCat('author');// Get resutl article_cat
		
		$data['define_folder']= $setData['define_folder'];
		//LANGUAGE
		$data['language'] = $setData['language']; 
		$data['lang'] = $setData['lang'];
		//TEMPLATE
		$data['template'] = "admin/article/add.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
}

