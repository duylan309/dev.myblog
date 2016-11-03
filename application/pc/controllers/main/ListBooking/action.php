<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino','admin/admindino','admin/captcha'));
		$this->load->library(array('email'));
	}
		
	public function index($data){
		$this->loadContact($data);
	}
	
	public function loadContact($setData){
		$action = webtitleUrl(getParam($this,'action'));
		$this->form_validation->set_rules('name'        , 'name'	    , 'trim|max_length[128]|xss_clean');
		$this->form_validation->set_rules('size'        , 'size'	    , 'trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('phone'	    , 'phone'		, 'trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('address'	    , 'Address'		, 'trim|xss_clean');
		$this->form_validation->set_rules('date'	    , 'date'		, 'trim|xss_clean');
		$this->form_validation->set_rules('time'	    , 'time'		, 'trim|xss_clean');
		$fileXML         = $setData['define_folder']['xml'].$setData['lang']."/booking_content.xml";
		$setData['readXmlsubject'] = simplexml_load_file($fileXML);
		//var_dump(	$setData['readXmlsubject'] );
		if($action=='send'):
			if($this->form_validation->run() == FALSE || isset($setData['wrong'])){
				$arr = $this->captcha() ;
				$setData['image']          = $arr['image'];
				$setData['word']           = $arr['word'];	
				$fileXML 			    = $setData['define_folder']['xml'].$setData['lang'].$setData['define_folder']['xml_menu'].$setData['result_menu']['menu']->id.".xml";
				$setData['readXML']     = simplexml_load_file($fileXML);
		
				$setData['template']  = "main/ListBooking/contact.php";
				$this->load->view('main/template/layout',$setData);
			}else{
				$this->sendEmail($setData);
			}
		else:
			$arr = $this->captcha() ;
			$setData['image']          = $arr['image'];
			$setData['word']           = $arr['word'];	
			$fileXML 			    = $setData['define_folder']['xml'].$setData['lang'].$setData['define_folder']['xml_menu'].$setData['result_menu']['menu']->id.".xml";
			$setData['readXML']     = simplexml_load_file($fileXML);
	
			$setData['template']  = "main/ListBooking/contact.php";
	  		$this->load->view('main/template/layout',$setData);
		endif;
		
	}

	
	public function captcha()
	{
		$vals = array(
					    'img_path' => './captcha/',
						'img_url' => base_url().'/captcha/',
						'font_path' => './assets/fonts/museo-700/museosans_700-webfont.ttf',
						'word' => random_string('alnum', 4),
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
	
	public function sendEmail($setData){
		$array = array(     "id"=>NULL,
							"fullname"     => $this->input->post('fullname'),
							"phone"        => $this->input->post('phone'),
							"address"      => $this->input->post('address'),
							"size"         => $this->input->post('size'),
							"phone"        => $this->input->post('phone'),
							"time"         => $this->input->post('time'),
							"location"     => $this->input->post('location') == 0 ? "Tuktuk 1 - Lê Thánh Tôn" : "Tuktuk 2 - Lý Tự Trọng",
							"status"       => 0,
							"date"	       => date('y-m-d',strtotime($this->input->post('date'))));
		
		/*$captcha  = $this->input->post('ma_xt');
		$cap      = $this->captcha->checkCaptcha($captcha);
		
		
		if($cap==1){*/
			$id = $this->admindino->AddTable('booking_inbox',$array);			
		
			if ($id != FALSE){
				$setData['array']  =$array;
				if($setData['configSite'][0]->info->allowsendemail==1):
					$this->emailGmail($setData);
				else:
					$setData['thank'] = $setData['readXmlsubject']->info->thank;
					$setData['template']  = "main/ListBooking/thankyou.php";
	  				$this->load->view('main/template/layout',$setData);
					
				endif;
			//}
			
		}else{
			$setData['wrong']         = "Please check the text above and try again.";	
			$this->loadContact($setData);
		}					
	}
	
	private function emailGmail($data){
		$config['useragent']        = 'CodeIgniter';        
		$config['protocol']         = 'smtp';        
		/*$config['smtp_host']        = 'mail.sic.edu.vn';
		$config['smtp_user']        = 'webmail@sic.edu.vn';
		$config['smtp_pass']        = 'admin@@123';
		$config['smtp_port']        = 25;*/
		$config['smtp_host']        = $data['configSite'][0]->info->smtphost;
		$config['smtp_user']        = $data['configSite'][0]->info->smtpusername;
		$config['smtp_pass']        = $data['configSite'][0]->info->smtppassword;
		$config['smtp_port']        = intval($data['configSite'][0]->info->smtpport);
		
		$config['smtp_timeout']     = 5;
		$config['wordwrap']         = TRUE;
		$config['wrapchars']        = 76;
		$config['mailtype']         = 'html';
		$config['charset']          = 'utf-8';
		$config['validate']         = FALSE;
		$config['priority']         = 3;
		$config['crlf']             = "\r\n";
		$config['newline']          = "\r\n";
		$config['bcc_batch_mode']   = FALSE;
		$config['bcc_batch_size']   = 200;

		$this->email->initialize($config);
        $this->email->set_newline("\r\n");
        
        $this->email->from($data['configSite'][0]->info->smtpusername, 'New booking from Tuktuk');
        $this->email->to($data['configSite'][0]->info->emailReply);    
        $this->email->subject('New Booking from Tuktukthaibistro.com');
		$body = '<table cellpadding="0" cellpadding="0">
		<tr><td><strong>Nhà hàng:</strong> &nbsp;</td><td>'.$data['array']['location'].'</td></tr>
		<tr><td><strong>Tên:</strong> &nbsp;</td><td>'.$data['array']['fullname'].'</td></tr>
		<tr><td><strong>Số lượng:</strong> &nbsp;</td><td>'.$data['array']['size'].'</td></tr>
		<tr><td><strong>Số điện thoại:</strong> &nbsp;</td><td>'.$data['array']['phone'].'</td></tr>
		<tr><td><strong>Ngày:</strong> &nbsp;</td><td>'.$data['array']['date'].'</td></tr>
		<tr><td><strong>Thời gian:</strong> &nbsp;</td><td>'.$data['array']['time'].'</td></tr>
		<tr><td><strong>Địa chỉ:</strong> &nbsp;</td><td>'.$data['array']['address'].'</td></tr>
		
		</table>';
		
        $this->email->message($body);    
        
        if($this->email->send()){
       				$data['thank'] = $data['readXmlsubject']->info->thank;
					$data['template']  = "main/ListBooking/thankyou.php";
	  				$this->load->view('main/template/layout',$data);
		}
        else
        {
            show_error($this->email->print_debugger());
        }
				
	}
	
}

