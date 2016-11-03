<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
		
	public function Action($data)
	{
		// TẠO FOLDER UPLOAD CHUNG
		if($_FILES['image_upload']['name']){
			
			$data["db"]['image'] = mktime().str_replace(" ","_",$_FILES['image_upload']['name']);
			$imageName = mktime().str_replace(" ","_",$_FILES['image_upload']['name']);	

			if(!empty($imageName))
			{
				$config['file_name']	= $imageName;
				$config['upload_path'] = "./upload/images/";
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '20000';
				$config['remove_spaces']  = TRUE;
				$config['overwrite'] = TRUE;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('image_upload'))
				{
					$error = array('error' => $this->upload->display_errors());
					$data['mess'] = $error;
				}
				else
				{
					$data1 = array('upload_data' => $this->upload->data());
					$data['mess'] =  $data['lang'] ? "Uploaded" : "Đăng tải thành công";
				}

				$data["db"]['image'] = $imageName;
			}

			echo $imageName.','.$data['mess'];
		}else{
			$error = $data['lang'] ? 'No photo' : 'Không có hình ảnh';
			echo ' ,'.$error;
		}	

	}
	
	
}

