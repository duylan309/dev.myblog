<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	 	$this->load->model(array('main/maindino','admin/admindino'));
	}

	public function index($data){
		$data['action']  = $this->uri->rsegment(4);
		switch($data['action']):
			case 'dangky':
				 $this->formDangky($data);
				 break;
		endswitch;
	}
	
	private function formDangky($data){
		$data['content_page_en'] = 'Ngay sau khi chúng tôi nhận được đơn hàng.<br> Nhân viên kinh doanh của công ty sẽ phản hồi lại quý khách trong thời gian sớm nhất.';
		$data['content_page_vn'] = 'Ngay sau khi chúng tôi nhận được đơn hàng.<br> Nhân viên kinh doanh của công ty sẽ phản hồi lại quý khách trong thời gian sớm nhất.';
		$data['title_page_en']   = 'Đặt Hàng Giao Diện';
		$data['title_page_vn']   = 'Đặt Hàng Giao Diện';
		
		//////////////////////////////////////
		$data['companyname']     = '';
		$data['fullname']        = '';
		$data['address']         = '';
		$data['phone']           = '';
		$data['email']           = '';

		$this->form_validation->set_rules('companyname'  , 'Tên Doanh Nghiệp/ Cửa Hàng' , 'trim|required|xss_clean');
		$this->form_validation->set_rules('fullname'     , 'Têm Của Bạn'		        , 'trim|required|xss_clean');
		$this->form_validation->set_rules('address'      , 'Địa Chỉ'	                , 'trim|required|xss_clean');
		$this->form_validation->set_rules('phone'        , 'Số Điện Thoại'			  , 'trim|required|xss_clean');
		$this->form_validation->set_rules('email'	    , 'Email'		              , 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('other'	    , 'Yêu Cầu Khác'		       , 'trim|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		
		$data['id']              = $this->input->post('id');
		$data['base']            = $this->input->post('page');
		$data['item']            = $this->maindino->GetValueFrom($data['base'],'id',$data['id'],'*') ;
	   	$data['readXml']         = $this->dinosaur_lib->loadXml($data['lang'],'/'.$data['base'].'/',$data['id']);
		if($this->input->post('send')):
			if($this->form_validation->run() == FALSE){
				
		
				$data['template']  	    = "main/dangky/form.php";		
				$this->load->view('main/template/layout-notitle',$data);
			}else{
				$this->_send($data);
			}
		else:
			$data['template']  	    = "main/dangky/form.php";		
			$this->load->view('main/template/layout-notitle',$data);
		endif;
		
	}
	
	private function _send($data){
		$array['companyname']     = $this->input->post('companyname');
		$array['fullname']        = $this->input->post('fullname');
		$array['address']         = $this->input->post('address');
		$array['phone']           = $this->input->post('phone');
		$array['email']           = $this->input->post('email');
		$array['other']           = stripcslashes($this->input->post('other'));
		$array['template_id']     = $this->input->post('id');
		$array['date']            = date('y-m-d');
		$array['status']          = 0;
		$array['table']           = $this->input->post('page');
		$array['id']              = NULL;
		
		$id = $this->admindino->AddTable('order_tempalate',$array);	
		if($id):
			$data['template']  	    = "main/dangky/thankyou.php";		
			$this->load->view('main/template/layout-notitle',$data);
		else:
			$data['template']  	    = "main/dangky/form.php";		
			$this->load->view('main/template/layout-notitle',$data);
		endif;	
			
	}
	
	private function _sendEmail($data){
			
		$this->load->library('phpmailer_lib');
		$this->phpmailer_lib->IsSMTP(); // we are going to use SMTP
		$this->phpmailer_lib->SMTPAuth   = true; // enabled SMTP authentication
		$this->phpmailer_lib->SMTPSecure = "tls";  // prefix for secure protocol to connect to the server
		$this->phpmailer_lib->Host       = "smtp.live.com";      // setting GMail as our SMTP server
		$this->phpmailer_lib->Port       = 587;                   // SMTP port to connect to GMail
		$this->phpmailer_lib->Username   = "ryan.le14@live.com";  // user email address
		$this->phpmailer_lib->Password   = "gaconunin";            // password in GMail
		$this->phpmailer_lib->AddReplyTo("ryan.le14@live.com","Firstname Lastname");  //email address that receives the response
		$this->phpmailer_lib->Subject    = "Email subject";
		$this->phpmailer_lib->Body      = "HTML message";
		$this->phpmailer_lib->AltBody    = "Plain text message";
		$address = "ryan.le14@live.com"; // Who is addressed the email to
		$this->phpmailer_lib->AddAddress($address, "John Doe");
		    
		if (!$this->phpmailer_lib->Send()) {
			echo "Mailer Error: " . $this->phpmailer_lib->ErrorInfo;
		} else {
			echo "Message sent!";
		}
	}

	private function _index($data){
		$data['template']  	 = "main/dangky/all.php";		
		$this->load->view('main/template/layout',$data);
	}
	
	
}

