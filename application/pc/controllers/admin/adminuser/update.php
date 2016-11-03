<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->helper("url");
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('session');
		$this->load->model(array('admin/adminuser','admin/admindino'));
		$this->load->library('xmlwrite');
	}
	
		
	public function UpdateItem($setData){
		$id = $setData['id'];
		$result_first = $this->adminuser->editItem($id);	
		$result = $result_first->result();	
		$data['result'] = $result[0];
		$image = './upload/user/'.$data['result']->image;
		$data['image_link'] = $image;
				
		//LANGUAGE
		$data['check_new']         = $setData['check_new'];
		$data['define_folder']     = $setData['define_folder'];
		$data['language']          = $setData['language']; 
		$data['lang']              = $setData['lang'];	
		$data['page']              = $setData['page'];
		$data['AdminMenu']         = $setData['AdminMenu'];
		//TEMPLATE
		$data['template'] = "admin/adminuser/".$setData['action'].".php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	public function ChangePass($setData){
		$id = $setData['id'];
		$result_first = $this->adminuser->editItem($id);	
		$result = $result_first->result();	
		$data['result'] = $result[0];
		//LANGUAGE
		$data['check_new']         = $setData['check_new'];
		$data['define_folder']     = $setData['define_folder'];
		$data['language']          = $setData['language']; 
		$data['lang']              = $setData['lang'];	
		$data['page']              = $setData['page'];
		$data['AdminMenu']         = $setData['AdminMenu'];
		//TEMPLATE

		$data['error'] = isset($setData['error']) && count($setData['error']) ? $setData['error'] : ''; 

		$data['template'] = "admin/adminuser/changepass.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	public function newPassword($setData){
		$id = $setData['id'];			
		$data['oldpassadmin']     =md5(mysql_real_escape_string($this->input->post('oldpassadmin')));
		$data['newpassadmin']     = $this->input->post('newpassadmin');
		$data['confirmpassadmin'] = md5(mysql_real_escape_string($this->input->post('confirmpassadmin')));
		$data['id']=$id;
		//getPass
		$result_first = $this->adminuser->editItem($id);	
		$result = $result_first->result();	
		
		if($data['oldpassadmin'] === $result[0]->passadmin ){
			$do = $this->adminuser->ChangePass($data);
			if($do){
				redirect(base_url().ADMINBASE.'?page=adminuser&action=lists&id=0&function=null&alert=updated');
			}
		}else{		
			$setData['error'] = "Your current password is wrong ! Please try again.";
			$this->ChangePass($setData);
		}
	}
	
	public function runItem($setData){
		$data["db"]["id"]    = $setData['id'];
		$setData["page"]     = "user";


		require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/image_control.php');

		if(isset($data["db"]["image"])){
			$data['image']            = $data["db"]["image"];
		}	

		$data['name'] 		      = $this->input->post('name');
		$data['description']      = $this->input->post('description');
		$data['alt_image'] 		  = $this->input->post('alt_image');
		$data['useradmin'] 		  = $this->input->post('useradmin');
		$data['email'] 		      = $this->input->post('email');
		$data['title'] 		      = $this->input->post('title');
		$data['id'] 			  = $setData['id'];	

		unset($data['db']);

		$do = $this->adminuser->updateItem($data);
		
		if($do == TRUE){
			redirect(base_url().ADMINBASE.'?page=adminuser&action=lists&id=0&function=null&alert=updated');
		}
	}
	
	///ADD NEW ITEM
	public function AddNew($setData){
					
		$data['useradmin'] 		  = $this->input->post('useradmin');
		$data['newpassadmin'] 	  = $this->input->post('newpassadmin');
		$data['confirmpassadmin'] = $this->input->post('confirmpassadmin');
		$data['email'] 			  = $this->input->post('email');
		
		$data['id'] 			   = NULL;	

		if($data['useradmin']==''){
			$setData['error'] = "Please fill your username !";
			$this->AddItem($setData);
		}else{
			$do = $this->adminuser->AddItem($data);
			if($do){
				redirect(base_url().ADMINBASE.'?page=adminuser&action=lists&id=0&function=null&alert=updated');

			}
		}
		
	}
	
	public function AddItem($setData){
		if(isset($setData['error']))
		$data['error']=$setData['error'];		
		
		$data['check_new']         = $setData['check_new'];
		$data['define_folder']     = $setData['define_folder'];
		$data['language']          = $setData['language']; 
		$data['lang']              = $setData['lang'];	
		$data['page']              = $setData['page'];
		$data['AdminMenu']         = $setData['AdminMenu'];
		//TEMPLATE
		$data['template'] = "admin/adminuser/add.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}


	private function deleteOldImage($database,$id,$path){
		$result = $this->admindino->GetValueFrom('adminuser','id',$id,'image');
		$fileOldImage = $path.$result->image;
		echo $fileOldImage;
		if(is_file($fileOldImage)){
		
			unlink($fileOldImage);
		
		}

		return TRUE;
	}
}

