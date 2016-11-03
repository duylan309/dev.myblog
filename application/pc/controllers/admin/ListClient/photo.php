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
		$id        = $this->input->post('id');
		$sort      = $this->input->post('sort');
		
		for($i=0; $i<count($id);$i++):
			$array['content'] = $content[$i];
			$array['alt_image'] = $alt_image[$i];
			$array['sort'] = $sort[$i];
			$this->admindino->UpdateTable($setData['page'].'_photo',$array,$id[$i]);
		endfor;
		redirect(base_url().ADMINBASE.'?page='.$setData['page'].'&action=gallery&id='.$setData['id'].'&function=photo');
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
	
		$this->load->library('uploadhandler_lib',$array);
	}
}