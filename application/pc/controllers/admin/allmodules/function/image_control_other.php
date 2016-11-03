<?php 

if($_FILES['file_images']['name']){
	$data["db"]['image'] = mktime().str_replace(" ","_",$_FILES['file_images']['name']);
	$imageName = mktime().str_replace(" ","_",$_FILES['file_images']['name']);	
	
	if($data["db"]["id"] != NULL)
	$this->deleteOldImage($this->input->post($data["db"]["id"])); //delete old image
			// deleteOldImage($image,$folder_image)
	if(!empty($imageName))
	{
	$config['file_name']	= $imageName;
	$config['upload_path'] = "./upload/".$setData['FOLDERIMAGE'];
	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	$config['max_size']	= '20000';
	$config['remove_spaces']  = TRUE;
	$config['overwrite'] = TRUE;
	$this->load->library('upload', $config);
	if (!$this->upload->do_upload('file_images'))
	{
		$error = array('error' => $this->upload->display_errors());
		$data1['mess'] = $error;
	}
	else
	{
		$data1 = array('upload_data' => $this->upload->data());
		$data1['mess'] = "Upload Thanh Cong";
	}

	$data["db"]['image'] = $imageName;
	
	}

}else{
	unset($data["db"]['image']);
}

if($data["db"]["id"] != NULL){
	if($this->input->post('action-del_image')==1){
		$this->deleteOldImage($this->input->post($data["db"]["id"])); //delete old image
		$data["db"]['image'] = '';
	}
}	

?>