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
			$data['result']        = $this->admindino->GetValueFrom($setData['page'],'id',$id,'*');	
			
			//IMAGE
			$image = './upload/'.$setData['page'].'/'.$data['result']->image;
			$data['image_link'] = $image;
			
			$where['status']     = 1;
			$where['id !=']      = $id;
			
			require(FCPATH . APPPATH . 'controllers/admin/allmodules/load_update_content.php');
		}

		require(FCPATH . APPPATH . 'controllers/admin/allmodules/load_general_files.php');
		$data['template'] = "admin/ListArticleWithCat/cat/item_detail.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}

	public function saveData($setData){
		$post = $this->input->post();
		$url  = $post['db-title_url'];
		$data_url['status'] = 2; // 1 = article; 2 = cat
		$alert = '';
		if($post){

			foreach ($post as $key => $value):
				$getKey = explode("-", $key);
				if($getKey[1] == "title_url"):
					$data[$getKey[0]][$getKey[1]] = strtolower(webtitleUrl(webKillVN($value)));
				else:			
					$data[$getKey[0]][$getKey[1]] = stripslashes($value);
				endif;
			endforeach;	


			require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/image_control.php');
			
			if($data["db"]["id"] == NULL){ 
				
				$data["db"]["date"] = date('y-m-d');
				$data["db"]['id'] = $this->admindino->AddTable($setData['page'],$data["db"]);

				if($data["db"]['id'] == TRUE){
					require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/add_url_table.php');
					require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/xml_control.php');
					$alert = '&alert=added';
					
				}else{
					die();
				}

				redirect(base_url().ADMINBASE.'?page='.$setData["page"].'&action=lists&id=0&function=null'.$alert);

			}else{ 
				$result = $this->admindino->UpdateTable($setData['page'],$data["db"],$data["db"]["id"]);
				
				if($result == TRUE){
					require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/update_url_table.php');
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
		
	
	public function getCat($table){
			$this->load->model('admin/'.$table);
			$article_cat = $this->$table->getTitleId();
			return $article_cat->result();
	}
	
	private function deleteOldImage($database,$id,$path){
		$result = $this->admindino->GetValueFrom($database,'id',$id,'image');
		$fileOldImage = $path.$result->image;
		if(is_file($fileOldImage)){
		
			unlink($fileOldImage);
		
		}

		return TRUE;
	}
}

