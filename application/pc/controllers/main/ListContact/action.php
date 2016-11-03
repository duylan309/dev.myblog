<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino','admin/admindino','admin/captcha'));
		$this->load->library(array('email'));
	}
		
	public function index($data){
		$data['TABLESQL']      = TABLECONTACT;
		$data['FOLDERCONTROL'] = FOLDERCONTROLCONTACT;
		$this->loadContact($data);
	}
	
	public function loadContact($setData){
		$action = webtitleUrl(getParam($this,'action'));
		$this->form_validation->set_rules('fullname'    , 'Fullname'		, 'trim|max_length[128]|xss_clean');
		$this->form_validation->set_rules('email'	    , 'Email'		 	, 'trim|required|valid_email|max_length[128]|xss_clean');
		$this->form_validation->set_rules('content'	    , 'Content'		    , 'trim|xss_clean');
		$this->form_validation->set_rules('subject'	    , 'Subject'		    , 'trim|required|xss_clean');
		
		if($action=='send'):
			if($this->form_validation->run() == FALSE || isset($setData['wrong'])){
				$arr = $this->captcha() ;
				$setData['image']          = $arr['image'];
				$setData['word']           = $arr['word'];	
			    $fileXML                   = $setData['define_folder']['xml'].$setData['lang'].$setData['define_folder']['xml_contact_content']."contact_content.xml";
				$setData['readXMLinfo']    = simplexml_load_file($fileXML);
				
				$fileXMLmenu			   = $setData['define_folder']['xml'].$setData['lang'].$setData['define_folder']['xml_menu'].$setData['result_menu']['menu']->id.".xml";
				$setData['readXML']        = simplexml_load_file($fileXMLmenu);
				
				$setData['template']       = "main/".$setData['FOLDERCONTROL']."/contact.php";
				$this->load->view('main/template/layout',$setData);
			}else{
				$this->sendEmail($setData);
			}
		else:
			$arr = $this->captcha() ;
			$setData['image']          = $arr['image'];
			$setData['word']           = $arr['word'];	
			$fileXML                   = $setData['define_folder']['xml'].$setData['lang'].$setData['define_folder']['xml_contact_content']."contact_content.xml";
			$setData['readXMLinfo']    = simplexml_load_file($fileXML);
			$fileXMLmenu			   = $setData['define_folder']['xml'].$setData['lang'].$setData['define_folder']['xml_menu'].$setData['result_menu']['menu']->id.".xml";
			$setData['readXML']        = simplexml_load_file($fileXMLmenu);
			$setData['template']       = "main/".$setData['FOLDERCONTROL']."/contact.php";
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
							"content"      => $this->input->post('content'),
							"subject"      => $this->input->post('subject'),
							"email"        => $this->input->post('email'),
							"status"       => 0,
							"date"	     => date('y-m-d'));
	
		$id = $this->admindino->AddTable($setData['TABLESQL'],$array);			
		
			if ($id != FALSE){
				$setData['array']  =$array;
				if($setData['configSite'][0]->info->allowsendemail==1):
					$this->emailGmail($setData);
				else:
				
				    $fileXML                   = $setData['define_folder']['xml'].$setData['lang'].$setData['define_folder']['xml_contact_content']."contact_content.xml";
			     	$setData['readXMLinfo']    = simplexml_load_file($fileXML);
					$setData['thank']          = $setData['readXMLinfo']->info->thankyou;
					
					$fileXMLmenu			    = $setData['define_folder']['xml'].$setData['lang'].$setData['define_folder']['xml_menu'].$setData['result_menu']['menu']->id.".xml";
					$setData['readXML']     = simplexml_load_file($fileXMLmenu);
					
					$setData['template']  = "main/".$setData['FOLDERCONTROL']."/thankyou.php";
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
        
        $this->email->from($data['configSite'][0]->info->smtpusername, 'New contact from chihoacuisine.com');
        $this->email->to($data['configSite'][0]->info->emailReply);    
        $this->email->subject('New contact from chihoacuisine.com');
		$body = '<table cellpadding="0" cellpadding="0">
		<tr><td><strong>Tên:</strong> &nbsp;</td><td>'.$data['array']['fullname'].'</td></tr>
		<tr><td><strong>Email:</strong> &nbsp;</td><td>'.$data['array']['email'].'</td></tr>
		<tr><td><strong>Nội dung:</strong> &nbsp;</td><td>'.$data['array']['content'].'</td></tr>
		</table>';
		
        $this->email->message($body);    
        
        if($this->email->send()){
       				$data['thank'] = $data['readXMLinfo']->info->thank;
					$data['template']  = "main/".$data['FOLDERCONTROL']."/thankyou.php";
	  				$this->load->view('main/template/layout',$data);
		}
        else
        {
            show_error($this->email->print_debugger());
        }
				
	}
	
}

