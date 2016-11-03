<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends CI_Controller {
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
				$pathdir_image        =  "./upload/storage/".$setData['FOLDERCONTROL'].'/'.$setData['TABLEGALLERY'].'/'.$setData['id'].'/'.$nameimage[$i];		
				$pathdir_image_thumb  =  "./upload/storage/".$setData['FOLDERCONTROL'].'/'.$setData['TABLEGALLERY'].'/'.$setData['id'].'/thumbnail/'.$nameimage[$i];		
				
				if($this->admindino->DeleteItem($setData['TABLEGALLERY'],$id[$i])){
					unlink($pathdir_image);			
					unlink($pathdir_image_thumb);
				}else{
					die();
				}
			else:
				if($this->admindino->UpdateTable($setData['TABLEGALLERY'],$array,$id[$i])){}else{die();}
			endif;
		endfor;
		
		redirect(base_url().ADMINBASE.'?page='.$setData['FOLDERCONTROL'].'&action=gallery&id='.$setData['id'].'&function=photo&position='.$setData["POSITIONIMG"]);
	}
	
	public function SaveItemPhoto($setData){
		$id = $this->input->post('id');
		$array['content'] = $this->input->post('content');
		$array['alt_image'] = $this->input->post('alt_image');
		$array['sort'] = $this->input->post('sort');
		$array['linkphoto'] = $this->input->post('linkphoto');
		$this->admindino->UpdateTable($setData['TABLEGALLERY'],$array,$id);
		redirect(base_url().ADMINBASE.'?page='.$setData['FOLDERCONTROL'].'&action=gallery&id='.getParam($this,'parent_id').'&function=photo&position='.$setData["POSITIONIMG"]);
	}
	
	
	public function EditPhoto($data){
		$id = $data['id'];
		$data['result'] 	  = $this->admindino->GetValueFrom($data['TABLEGALLERY'],'id',$id,'*');	
		$data['parent_id']    = getParam($this,'function');
		$data['template'] = "admin/template/box/gallery_detail.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	public function loadPhoto($setData){
		$id = intval($setData["id"]);
		$array = NULL;
		$array = array(
		//'user_dirs'=> true,
		'delete_type' => 'DELETE',
		'script_url' => './upload/storage/'.$setData['FOLDERCONTROL'].'/'.$setData['TABLEGALLERY'].'/'.$id.'/',
		'album_id'   => $id,
		'database'   => $setData['TABLEGALLERY'],
		'model_name' => 'admindino',
		'model_url'  => 'admin/admindino',
		'savetodatabase' =>1,
		'upload_dir' => './upload/storage/'.$setData['FOLDERCONTROL'].'/'.$setData['TABLEGALLERY'].'/'.$id.'/',
		'upload_url' => './upload/storage/'.$setData['FOLDERCONTROL'].'/'.$setData['TABLEGALLERY'].'/'.$id.'/',
		);

		$this->load->library('uploadhandler_lib',$array);
	}
}