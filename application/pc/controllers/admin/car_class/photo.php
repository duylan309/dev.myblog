<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('admin/admindino');
	}
	
	public function SavePhoto($setData){

		$alt_image = $this->input->post('alt_image');
		$content   = $this->input->post('content');
		$linkphoto = $this->input->post('linkphoto');
		$id        = $this->input->post('id');
		$sort      = $this->input->post('sort');
		$dlete     = $this->input->post('delete');
		$nameimage = $this->input->post('nameimage');

		for($i=0; $i<count($id);$i++):
			$array['content']   = $content[$i];
			$array['alt_image'] = $alt_image[$i];
			$array['sort']      = $sort[$i];
			$array['linkphoto'] = $linkphoto[$i];
			$delete             = !isset($dlete[$i]) ? 0 : 1;
			if($delete==1):
				$this->admindino->DeleteItem($setData['TABLESQL'].'_photo',$id[$i]);
				$pathdir_image        =  "./upload/storage/".$setData['FOLDERIMAGE'].'/'.$setData['id'].'/'.$nameimage[$i];		
				$pathdir_image_thumb  =  "./upload/storage/".$setData['FOLDERIMAGE'].'/'.$setData['id'].'/thumbnail/'.$nameimage[$i];		
				unlink($pathdir_image);			
				unlink($pathdir_image_thumb);
			
			else:
				$this->admindino->UpdateTable($setData['TABLESQL'].'_photo',$array,$id[$i]);
			endif;
		endfor;
		
		redirect(base_url().ADMINBASE.'?page='.$setData['FOLDERCONTROL'].'&action=gallery&id='.$setData['id'].'&function=photo');
	}
	
	public function SaveItemPhoto($setData){
		$id = $this->input->post('id');
		$array['content'] = $this->input->post('content');
		$array['alt_image'] = $this->input->post('alt_image');
		$array['sort'] = $this->input->post('sort');
		$array['linkphoto'] = $this->input->post('linkphoto');
		$this->admindino->UpdateTable($setData['TABLESQL'].'_photo',$array,$id);
		redirect(base_url().ADMINBASE.'?page='.$setData['FOLDERCONTROL'].'&action=gallery&id='.getParam($this,'parent_id').'&function=photo');
	}
	
	
	public function EditPhoto($data){
		$id = $data['id'];
		$data['result'] 	  = $this->admindino->GetValueFrom($data['TABLESQL'].'_photo','id',$id,'*');	
		///XML DATA
		$data['parent_id']    = getParam($this,'function');
		
		//TEMPLATE
		$data['template'] = "admin/template/box/gallery_detail.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	public function loadPhoto($setData){
		$id = intval($setData["id"]);

		$array = NULL;
		$array = array(
		//'user_dirs'=> true,
		'delete_type' => 'DELETE',
		'script_url' => './upload/storage/'.$setData['FOLDERIMAGE'].'/'.$id.'/',
		'album_id'   => $id,
		'database'   => $setData['TABLESQL'].'_photo',
		'model_name' => 'admindino',
		'model_url'  => 'admin/admindino',
		'savetodatabase' =>1,
		'upload_dir' => './upload/storage/'.$setData['FOLDERIMAGE'].'/'.$id.'/',
		'upload_url' => './upload/storage/'.$setData['FOLDERIMAGE'].'/'.$id.'/',
		);

		$this->load->library('uploadhandler_lib',$array);
	}
}