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
		$this->load->library('xmlwrite');
	}
	
		
	public function UpdateItem($setData){
		
		require(FCPATH . APPPATH . 'controllers/admin/allmodules/load_general_files.php');
		
		///XML DATA
		$fileXML_vn =$setData['define_folder']['xml'].$setData['define_folder']['vietnam']."/home_content.xml";
		$data['readXML_vn'] = simplexml_load_file($fileXML_vn);
		
		$fileXML_en =$setData['define_folder']['xml'].$setData['define_folder']['english']."/home_content.xml";
		$data['readXML_en'] = simplexml_load_file($fileXML_en);
		

		//TEMPLATE
		$data['page_title'] = $data["lang"] == "en" ? "Home Content" : "Nội Dung Trang Chủ";
		
		$data['template'] = "admin/home_content/update.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	public function runItem($setData){
				
		$file_xml_vn = $setData['define_folder']['xml'].$setData['define_folder']['vietnam']."/home_content.xml";	
		$file_xml_en = $setData['define_folder']['xml'].$setData['define_folder']['english']."/home_content.xml";	
		
		$information_vn = array(
				'info' => array(
					array(
						'@attributes' => array(
							'langId' => '1'
						),
						'content'=>array(
							'@value' => stripcslashes($_REQUEST["more-content_vn"])
						),
						'description'=>array(
							'@value' => stripcslashes($_REQUEST["more-description_vn"])
						),
						
					),
				)
			);
			
			$xml_vn = $this->xmlwrite->createXML('information', $information_vn);
			$xml_vn->save($file_xml_vn);
			
			$information_en = array(
				'info' => array(
					array(
						'@attributes' => array(
							'langId' => '1'
						),
						'content'=>array(
							'@value' => stripcslashes($_REQUEST["more-content_en"])
						),
						'description'=>array(
							'@value' => stripcslashes($_REQUEST["more-description_en"])
						),
						
					),
				)
			);
			
			$xml_en = $this->xmlwrite->createXML('information', $information_en);
			$xml_en->save($file_xml_en);
			
	        redirect(base_url().ADMINBASE.'?page=home_content&action=update&id=0&function=Item&alert=updated');


		
	}
	
	
}

