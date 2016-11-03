<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('admin/admindino'));
	}
	
	public function ItemAction($setData){

		$data['results'] = $this->admindino->loadTable($setData['TABLESQL'],NULL,NULL,NULL);	

		require(FCPATH . APPPATH . 'controllers/admin/allmodules/load_general_files.php');
		$data['template'] = "admin/".$setData["FOLDERCONTROL"]."/item_detail.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}

	public function saveData($setData){
		$post = $this->input->post();
		$alert = '';
		$error = 0;
		if($post){
			
			$title_vn_arr 		= $this->input->post('title_vn');
			$title_en_arr 		= $this->input->post('title_en');
			$status_arr       	= $this->input->post('status');
			$type_title_arr   	= $this->input->post('type_title');
			$id_arr 			= $this->input->post('id');
			$delete_row         = $this->input->post('delete_row');

			if(count($id_arr)>0):
				$result = FALSE;
				for($i=0;$i<count($id_arr);$i++){
					
					$data['db']['id'] = NULL;
					$data['db']['title_vn']   = isset($title_vn_arr[$i]) && count($title_vn_arr[$i]) ? $title_vn_arr[$i]:'a';
					$data['db']['title_en']   = isset($title_en_arr[$i]) && count($title_en_arr[$i]) ? $title_en_arr[$i]:'b';
					$data['db']['status']     = isset($status_arr[$i]) && count($status_arr[$i]) ? $status_arr[$i] : 0;
					$data['db']['type_title'] = isset($type_title_arr[$i]) && count($status_arr[$i])? $type_title_arr[$i] : 0 ;
					$data['db']['sort']       = $i;
					$data["db"]["date"]       = date('y-m-d');
					$data['db']['id']         = isset($id_arr[$i]) ? $id_arr[$i] : 0;
					
					if($data['db']['id'] == 0){
						$result = $this->admindino->AddTable($setData["TABLESQL"],$data["db"]);
						$error  = $result == TRUE ? 0 : 1;
					}else{
						if(intval($delete_row[$i])==1){
							$result = $this->admindino->DeleteItem($setData["TABLESQL"],$data['db']['id']);
							$error  = $result == TRUE ? 0 : 1;
						}else{
							$result = $this->admindino->UpdateTable($setData["TABLESQL"],$data["db"],$data["db"]["id"]);
							$error  = $result == TRUE ? 0 : 1;
						}
					}
					unset($data);
				}

				if($error ==1){
					redirect(base_url().ADMINBASE.'?page='.$setData["FOLDERCONTROL"].'&action=update&id=0&function=add&alert=error');
				}else{
					redirect(base_url().ADMINBASE.'?page='.$setData["FOLDERCONTROL"].'&action=update&id=0&function=add&alert=updated');
				}

			endif;

		}else{
			die();
		}			
	}

	function deleteOldImage($image,$folder_image){
			$fileOldImage = "./upload/".$folder_image.'/'.$image;
			if(is_file($fileOldImage))
			unlink($fileOldImage);
			
			return TRUE;
	}
	
}

