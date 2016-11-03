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
		$this->load->model('admin/contact');
	}
	
		
	public function UpdateItem($setData){
		$id = $setData['id'];
		$this->contact->setStatus($id);
		$result_first = $this->contact->editItem($id);	
		$result = $result_first->result();	
		$data['result'] = $result[0];
	
		//IMAGE
		$data['define_folder']= $setData['define_folder'];
		
		$data['check_new']    = $setData['check_new'];
		//LANGUAGE
		$data['language'] = $setData['language']; 
		$data['lang'] = $setData['lang'];
		//TEMPLATE
		$data['template'] = "admin/contact/".$setData['action'].".php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	public function runItem($setData){
		$data['id'] = $this->input->post('id');			
		$data['fullname'] = $this->input->post('fullname');
		$data['address'] = $this->input->post('address');
		$data['phone'] = $this->input->post('phone');
		$data['email'] = $this->input->post('email');
		$data['title'] = $this->input->post('title');
		$data['content'] = $this->input->post('content');
		$data['date']= strtotime($this->input->post('date'));
		$data['status'] = $this->input->post('status');
		
		$do = $this->contact->updateItem($data);
		redirect(base_url().'admin/contact/lists/0/null');
	
	}
	
	
	///ADD NEW ITEM
	public function AddNew($setData){
		$data['fullname'] = $this->input->post('fullname');
		$data['address'] = $this->input->post('address');
		$data['phone'] = $this->input->post('phone');
		$data['email'] = $this->input->post('email');
		$data['title'] = $this->input->post('title');
		$data['content'] = $this->input->post('content');
		$data['date']= strtotime($this->input->post('date'));
		$data['status'] = $this->input->post('status');
		$data['id'] = NULL;	
		
		$do = $this->contact->AddItem($data);
				
		redirect(base_url().'admin/contact/lists/0/null');
		
	}
	
		
	public function AddItem($setData){
		$data['define_folder']= $setData['define_folder'];
		//LANGUAGE
		$data['language'] = $setData['language']; 
		$data['lang'] = $setData['lang'];
		//TEMPLATE
		$data['template'] = "admin/contact/add.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
}

