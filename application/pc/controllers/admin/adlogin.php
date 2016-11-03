<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adlogin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/configadmin');
		$this->load->model('admin/captcha');
	}
	
	public function Login()
	{	
		$data['error'] = $this->session->userdata('error_count');
		$arr = $this->captcha() ;
		$data['image'] = $arr['image'];
		$data['word']  = $arr['word'];		
		$this->form_validation->set_rules('l_username','','required'); 
		$this->form_validation->set_rules('l_password','','required'); 
		$this->load->view('admin/template/adlogin',$data);
	}	

	public function checkUser(){
		$username = $this->input->post('l_username');
		$password = $this->input->post('l_password');
		$value_error = $this->session->userdata('error_count');
		
		if($value_error>=5){
			$captcha    = $this->input->post('ma_xt');
			$cap        = $this->captcha->checkCaptcha($captcha);
		}
		
		if($value_error==FALSE || $value_error<5){
			$result = $this->configadmin->CheckAdmin($username,$password);	
		}elseif($value_error>=5){
				if($cap==1){
				$result = $this->configadmin->CheckAdmin($username,$password);
				}
		}
		//if($cap==1)
		//	$result = $this->configadmin->CheckAdmin($username,$password);
				
		redirect(base_url().'admin/');
	}
	
	public function logoutAdmin(){
		$this->session->unset_userdata('admin');
		$this->session->sess_destroy();
		redirect(base_url().'admin/');
	}
	
	public function captcha()
	{
		$vals = array(  'img_path' => './captcha/',
						'img_url' => base_url().'/captcha/',
						'font_path' => './assets/fonts/museo-700/museosans_700-webfont.ttf',
						'img_width' => '215',
						'img_height' => 35,
						'word' => random_string('alnum', 4),
						'expiration' => 3600);
    
		$cap = create_captcha($vals);	

		$sess = array(  'word' => $cap['word'],
						'ip_address' => $this->input->ip_address(),
						'time' => $cap['time']);	
		$this->captcha->save_captcha($sess);
		return $cap;
	}
}

?>