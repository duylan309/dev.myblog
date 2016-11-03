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
			
			require(FCPATH . APPPATH . 'controllers/admin/allmodules/load_update_content.php');
		}
		
		require(FCPATH . APPPATH . 'controllers/admin/allmodules/load_general_files.php');
		
		// SET VALUE PAGE
		$data["page_title"]       = $setData["lang"]=="en" ? "Slideshow" : "Hình ảnh";
		$data["page_table_sql"]   = $setData["page"];

		$data['template'] = "admin/".$setData["page"]."/item_detail.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}

	public function saveData($setData){
		$post = $this->input->post();
		$alert = '';
		if($post){

			foreach ($post as $key => $value):
				$getKey = explode("-", $key);
				$data[$getKey[0]][$getKey[1]] = stripslashes($value);
			endforeach;	

			require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/image_control.php');
			
			if($data["db"]["id"] == NULL){ // INSERT TABLE
				
				$data["db"]["date"] = date('y-m-d');
				$data["db"]['id'] = $this->admindino->AddTable($setData['page'],$data["db"]);

				if($data["db"]['id'] == TRUE){
					require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/xml_control.php');
				}else{
					die();
				}

				redirect(base_url().ADMINBASE.'?page='.$setData["page"].'&action=lists&id=0&function=null'.$alert);

			}else{ // UPDATE TABLE
				$result = $this->admindino->UpdateTable($setData['page'],$data["db"],$data["db"]["id"]);
				
				if($result == TRUE){
					require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/xml_control.php');
				}else{
					die();
				}
				redirect(base_url().ADMINBASE.'?page='.$setData["page"].'&action=lists&id0&function=null');
			}		

		}else{
			die();
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

