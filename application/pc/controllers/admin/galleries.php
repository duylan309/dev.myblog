<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Galleries extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->model('admin/admindino');
	}
		
	public function GalleryItem($setData){
		$setData['listPhoto']  = $this->listArray($setData);
		$setData['template']   = "admin/template/box/".$setData['action'].".php";		
		$this->load->view('admin/template/adminLayout',$setData);
	}
	
	public function listArray($setData){
		$array['album_id'] = $setData['id'];
		$result  = $this->admindino->loadTable($setData['TABLEGALLERY'],NULL, $array);	
		$lenght  = $this->admindino->CountPhoto($setData['TABLEGALLERY'],'album_id',$setData['id']);
		$array   = NULL;
		for($i=0;$i<$lenght;$i++):
			$array[$i]['id']        = $result[$i]->id;
			$array[$i]['name'] 	    = $result[$i]->name;
			$array[$i]['alt_image'] = $result[$i]->alt_image;
			$array[$i]['content']   = $result[$i]->content;
			$array[$i]['linkphoto'] = $result[$i]->linkphoto;
			$array[$i]['sort']      = $result[$i]->sort;
			$array[$i]['size']      = 0;	
			// $array[$i]['url']       = 'upload/storage/'.$page.'/'.$id.'/'.$result[$i]->name;
			// $array[$i]['thumbnail_url'] = 'upload/storage/'.$page.'/'.$id.'/thumbnail/'.$result[$i]->name;
			$array[$i]['url']       = 'upload/storage/'.$setData['FOLDERCONTROL'].'/'.$setData['TABLEGALLERY'].'/'.$setData['id'].'/'.$result[$i]->name;
			$array[$i]['thumbnail_url'] = 'upload/storage/'.$setData['FOLDERCONTROL'].'/'.$setData['TABLEGALLERY'].'/'.$setData['id'].'/thumbnail/'.$result[$i]->name;
			$array[$i]['delete_url'] = base_url().'phpupload/php/?file='.$result[$i]->name;
			$array[$i]['DELETE']  = 'DELETE';
		endfor;
	
		return $array;
	}
	
	
}

