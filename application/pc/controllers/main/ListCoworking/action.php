<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('main/maindino','admin/admindino','admin/captcha'));
		$this->load->library(array('email'));
	}
		
	public function index($data){
		$data['id'] = intval($this->uri->rsegment(5));
			
			if(intval($data['id'])==0)
				$this->_index($data);
			else
				$this->_loadPage($data);
		
		
				
	}
	
	private function _index($data){
	   $whereValue['status']    = 1;
	   
	   $data['results']         = $this->maindino->loadTable($data['result_menu']['menu']->title_url,NULL,$whereValue,1,'ASC');	
	   $data["links"] 		    = $this->pagination->create_links();
	   
	   /*load module*/
	   //Load menu home
		$data['listModuleCoworking'] = $this->maindino->loadTable('modulecoworking',NULL,array("status"=>1),1,'ASC');
		
		if($data['listModuleCoworking']):
			$i=0;
			foreach($data['listModuleCoworking'] as $md):
				$array = array();
				$result = $this->maindino->GetValueFrom('menu','id',$md->menu_id,'*');	
				if($md->str!=NULL && $md->str!=0):
					$array = explode(',',$md->str);
					$data['listModule'][$i]['list']      = $this->maindino->loadTableWhereIn($result->title_url,NULL,array("status"=>1),$array,$md->layout==0 ? 2 : 4);
					$data['listModule'][$i]['title_url'] = $result->title_url;
					$data['listModule'][$i]['title_en']  = $md->title_en;
					$data['listModule'][$i]['title_vn']  = $md->title_vn;
				endif;
				unset($result);
				$i++;
			endforeach;
			unset($i);
		endif;
	   
	   /*Contact*/
	    $action = webtitleUrl(getParam($this,'action'));
		$this->form_validation->set_rules('fullname'     , 'Fullname'		 , 'trim|max_length[128]|xss_clean');
		$this->form_validation->set_rules('subject'      , 'Subject'	      , 'trim|required|max_length[128]|xss_clean');
		$this->form_validation->set_rules('email'	    , 'Email'		 	, 'trim|required|valid_email|max_length[128]|xss_clean');
		$this->form_validation->set_rules('content'	    , 'Content'		, 'trim|xss_clean');
		
		$fileXML         = $data['define_folder']['xml']."content_subject.xml";
		$data['readXmlsubject'] = simplexml_load_file($fileXML);
		//var_dump()
		//var_dump($this->form_validation->run()) ;
		if($action=='send'):
			if($this->form_validation->run() == FALSE || isset($data['wrong'])){
				$arr = $this->captcha() ;
				$data['image']        = $arr['image'];
				$data['word']         = $arr['word'];	
	
		
				$data['template']        = "main/ListCoworking/list.php";
	 		    $this->load->view('main/template/layout',$data);
			}else{
				$this->sendEmail($data);
			}
		else:
			$arr = $this->captcha() ;
			$data['image']          = $arr['image'];
			$data['word']           = $arr['word'];	
			$fileXML 			    = $data['define_folder']['xml'].$data['lang'].$data['define_folder']['xml_menu'].$data['result_menu']['menu']->id.".xml";
			$data['readXML']     = simplexml_load_file($fileXML);
	
			$data['template']        = "main/ListCoworking/list.php";
	   		$this->load->view('main/template/layout',$data);
		endif;
	   
	  
	}
	
	private function _loadPage($data){
	   $whereValue['status']    = 1;
	   
	   $data['results']         = $this->maindino->loadTable($data['result_menu']['menu']->title_url,NULL,$whereValue,1,'ASC');	
		
	   $data['item']           = $this->maindino->GetValueFrom($data['result_menu']['menu']->title_url,'id',$data['id'],'*') ;
	   $data['readXml']        = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['result_menu']['menu']->title_url.'/',$data['id']);
	   $data['meta']		   = $data['readXml']['meta']; 
	   
	   //Load others
	   $whereOther['status']   = 1;
	   $whereOther['id !=']    = $data['id'];  		
	   $data['listOthers']= $this->maindino->loadTableWhereIn($data['result_menu']['menu']->title_url,NULL,$whereOther,explode(',',$data['item']->str),4);	
	   
	   $data['template']  = "main/ListCoworking/item.php";
	   $this->load->view('main/template/layout',$data);	
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
		
		/*$captcha  = $this->input->post('ma_xt');
		$cap      = $this->captcha->checkCaptcha($captcha);
		
		
		if($cap==1){*/
			$id = $this->admindino->AddTable('contact_inbox',$array);			
		
			if ($id != FALSE){
				$setData['array']  =$array;
				if($setData['configSite'][0]->info->allowsendemail==1):
					$this->emailGmail($setData);
				else:
					$thk = $setData['lang']=="en" ? $setData["configSite"][0]->info->thankyou_en : $setData["configSite"][0]->info->thankyou_vn; 	
						?> <script type="text/javascript">
							    alert("<?=$thk?>");
								location.href="<?=base_url()?>";
							</script>;
                            
                   <?php 
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
        
        $this->email->from($data['configSite'][0]->info->smtpusername, 'Web Admin Arcboxco.com');
        $this->email->to($data['configSite'][0]->info->emailReply);    
        $this->email->subject('New Contact from Arcboxco.com');
		$body = '<table cellpadding="0" cellpadding="0">
		<tr><td><strong>Tên:</strong> &nbsp;</td><td>'.$data['array']['fullname'].'</td></tr>
		<tr><td><strong>Email:</strong> &nbsp;</td><td>'.$data['array']['email'].'</td></tr>
		<tr><td><strong>Chủ Đề:</strong> &nbsp;</td><td>'.$data['array']['subject'].'</td></tr>
		<tr><td><strong>Nội dung:</strong> &nbsp;</td><td>'.$data['array']['content'].'</td></tr>
		</table>';
		
        $this->email->message($body);    
        
        if($this->email->send()){
       		$thk = $data['lang']=="en" ? $data["configSite"][0]->info->thankyou_en : $data["configSite"][0]->info->thankyou_vn; 	
				?> <script type="text/javascript">
							    alert("<?=$thk?>");
								location.href="<?=base_url()?>";
							</script>;
                            
                   <?php 
		}
        else
        {
            show_error($this->email->print_debugger());
        }
				
	}
}

