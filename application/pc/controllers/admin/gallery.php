<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->model('admin/admindino');
	}
		
	public function GalleryItem($setData){
		$setData['listPhoto']  = $this->listArray($setData['page'],$setData['id']);	
		$setData['template'] = "admin/template/box/".$setData['action'].".php";		
		$this->load->view('admin/template/adminLayout',$setData);
	}
	
	public function GalleryItemMd($setData){
		$setData['listPhoto']  = $this->listArray($setData['page'],$setData['id']);	
		$setData['template'] = "admin/template/box/gallerymd.php";		
		$this->load->view('admin/template/adminLayout',$setData);
	}
	
	public function GalleryPhotoList($setData){
		$setData['upload'][$setData['page']]=$setData['id'];//change session name
		
		$result = $this->$setData['page']->listPhoto($setData['id']);	
		$setData['listPhoto'] = $result;
		
		$setData['template'] = "admin/template/box/".$setData['action'].".php";		
		$this->load->view('admin/template/adminLayout',$setData);
	}
	
	public function listArray($page,$id){
		$array['album_id'] = $id;
		$result  = $this->admindino->loadTable($page.'_photo',NULL, $array);	
		$lenght  = $this->admindino->CountPhoto($page.'_photo','album_id',$id);
		$array   = NULL;
		for($i=0;$i<$lenght;$i++):
			$array[$i]['id']        = $result[$i]->id;
			$array[$i]['name'] 	    = $result[$i]->name;
			$array[$i]['alt_image'] = $result[$i]->alt_image;
			$array[$i]['content']   = $result[$i]->content;
			$array[$i]['linkphoto'] = $result[$i]->linkphoto;
			$array[$i]['sort']      = $result[$i]->sort;
			$array[$i]['size']      = 0;	
			$array[$i]['url']       = 'upload/storage/'.$page.'/'.$id.'/'.$result[$i]->name;
			$array[$i]['thumbnail_url'] = 'upload/storage/'.$page.'/'.$id.'/thumbnail/'.$result[$i]->name;
			$array[$i]['delete_url'] = base_url().'phpupload/php/?file='.$result[$i]->name;
			$array[$i]['DELETE']  = 'DELETE';
		endfor;
	
		return $array;
	}
	
	
}

