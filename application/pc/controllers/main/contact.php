<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->library(array('email','form_validation','session'));
		$this->load->helper(array('form','date','html','url','captcha'));
		$this->load->model(array('admin/captcha','main/md_contact'));

	}
			
	public function loadContact($setData){
		$setData['fullname']	   = '';
		$setData['email']	      = '';
		$setData['subject']		= '';
		$setData['phone']		  = '';
		$setData['content']	    = '';
		
		$this->form_validation->set_rules('fullname'     , 'Fullname'		 , 'trim|max_length[128]|xss_clean');
		$this->form_validation->set_rules('subject'      , 'Subject'	      , 'trim|required|max_length[32]|xss_clean');
		$this->form_validation->set_rules('phone'        , 'Phone'			, 'trim|required|max_length[32]|xss_clean');
		$this->form_validation->set_rules('email'	    , 'Email'		 	, 'trim|required|valid_email|max_length[128]|callback_check_email|xss_clean');
		$result = $this->form_validation->run();
		
		if($result == FALSE || isset($setData['wrong']) ){
			
			$arr = $this->captcha() ;
			$setData['image']          = $arr['image'];
			$setData['word']           = $arr['word'];	
			$fileXML 			      = $setData['define_folder']['xml'].'en'.$setData['define_folder']['xml_contact_content']."contact_content.xml";
			$setData['readXML_en']       = simplexml_load_file($fileXML);
			
			$fileXML_vn 			      = $setData['define_folder']['xml'].'vn'.$setData['define_folder']['xml_contact_content']."contact_content.xml";
			$setData['readXML_vn']       = simplexml_load_file($fileXML_vn);
		
			$setData['template']      = "main/contact/all.php";		
			$this->load->view('main/template/layout',$setData);
		}else{
			$this->sendEmail($setData);
		}
		//TEMPLATE
		
	}
	
	public function sendEmail($setData){
		$fileXML 			      = $setData['define_folder']['xml'].$setData['lang'].$setData['define_folder']['xml_contact_content']."contact_content.xml";
		$setData['readXML']       = simplexml_load_file($fileXML);
			
		$data['fullname'] = $this->input->post('fullname');
		$data['email']    = $this->input->post('email');	
		$data['subject']  = $this->input->post('subject');
		$data['phone']    = $this->input->post('phone');
		$data['content']  = $this->input->post('content');   
		$captcha  = $this->input->post('ma_xt');
		$cap      = $this->captcha->checkCaptcha($captcha);
		
		if($cap==1){
		$id = $this->md_contact->Savecontact($data);		
		
		if ($id != FALSE){
			$setData['template']      = "main/contact/thankyou.php";		
			$this->load->view('main/template/layout',$setData);
	 	}
		
		}else{
			$setData['wrong']         = "Please check the text above and try again.";	
		    
			$this->loadContact($setData);
		}
		
			
	}
	
	
	public function captcha()
	{
		$vals = array(
			'img_path' => './captcha/',
			'img_url' => base_url().'captcha/',
			'font_path' => base_url().'fonts/1.ttf',
			'img_width' => '195',
			'img_height' => 35,
			'expiration' => 3600
  			);
    
		$cap = create_captcha($vals);	
		//////////////save session////////
		$sess = array(
				'word' => $cap['word'],
				'ip_address' => $this->input->ip_address(),
				'time' => mktime()+3600,
		);	/*
		$this->session->set_userdata($sess);*/
		/////////////////////////////////////////
		$this->captcha->save_captcha($sess);
		////////////////////////////////////////
		return $cap;
	}
}

