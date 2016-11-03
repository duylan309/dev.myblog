<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->model('admin/admindino');
	}
	
	public function SavePhoto($setData){
		// var_dump($setData['id']);
		$alt_image = $this->input->post('alt_image');
		$content   = $this->input->post('content');
		$linkphoto = $this->input->post('linkphoto');
		$id        = $this->input->post('id');
		$sort      = $this->input->post('sort');
		$dlete     = $this->input->post('delete');
		$nameimage = $this->input->post('nameimage');
		isset($id[0]) ? $i=0 : $i=1;
		for($i=0; $i<count($id);$i++):
			$array['content']   = $content[$i];
			$array['alt_image'] = $alt_image[$i];
			$array['sort']      = $sort[$i];
			$array['linkphoto'] = $linkphoto[$i];
			$delete             = !isset($dlete[$i]) ? 0 : 1;
			if($delete==1):
				$this->admindino->DeleteItem($setData['page'].'_photo',$id[$i]);
				$pathdir_image        =  "./upload/storage/".$setData['page'].'/'.$setData['id'].'/'.$nameimage[$i];		
				$pathdir_image_thumb  =  "./upload/storage/".$setData['page'].'/'.$setData['id'].'/thumbnail/'.$nameimage[$i];		
				unlink($pathdir_image);			
				unlink($pathdir_image_thumb);
			
			else:
				$this->admindino->UpdateTable($setData['page'].'_photo',$array,$id[$i]);
			endif;
		endfor;

		redirect(base_url().ADMINBASE.'?page='.$setData['page'].'&action=gallery&id='.$setData['id'].'&function=photo');
	}
	
	public function SaveItemPhoto($setData){
		$id = $this->input->post('id');
		$array['content'] = $this->input->post('content');
		$array['alt_image'] = $this->input->post('alt_image');
		$array['sort'] = $this->input->post('sort');
		$array['linkphoto'] = $this->input->post('linkphoto');
		$this->admindino->UpdateTable($setData['page'].'_photo',$array,$id);
		redirect(base_url().ADMINBASE.'?page='.$setData['page'].'&action=gallery&id='.$setData['id'].'&function=photo');
	}
	
	
	public function EditPhoto($setData){
		$id = $setData['id'];
		$data['result'] 	  = $this->admindino->GetValueFrom($setData['page'].'_photo','id',$id,'*');	
		//IMAGE
		$data['define_folder']= $setData['define_folder'];
	
		///XML DATA
		$data['check_new']    = $setData['check_new'];
		$data['parent_id']    = getParam($this,'function');
		//LANGUAGE
		$data['language']     = $setData['language']; 
		$data['lang']         = $setData['lang'];
		$data['page']         = $setData['page'];
		$data['AdminMenu']    = $setData['AdminMenu'];
		//TEMPLATE
		$data['template'] = "admin/template/box/galleryitem.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	public function loadPhoto($setData){
		$array = array(
		//'user_dirs'=> true,
		'delete_type' => 'DELETE',
		'script_url' => './upload/storage/'.$setData['page'].'/'.$setData['id'].'/',
		'album_id'   => $setData['id'],
		'database'   => $setData['page'].'_photo',
		'model_name' => 'admindino',
		'model_url'  => 'admin/admindino',
		'savetodatabase' =>1,
		'upload_dir' => './upload/storage/'.$setData['page'].'/'.$setData['id'].'/',
		'upload_url' => './upload/storage/'.$setData['page'].'/'.$setData['id'].'/',
		);
		
		var_dump($array);

		$this->load->library('uploadhandler_lib',$array);
	}
}