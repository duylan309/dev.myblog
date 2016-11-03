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
		
		$data['define_folder']= $setData['define_folder'];
		
		///XML DATA
		$fileXML=$setData['define_folder']['xml']."webinfo.xml";
		$data['readXML'] = simplexml_load_file($fileXML);
		$data['check_new']    = $setData['check_new'];
		//LANGUAGE
		$data['language']     = $setData['language']; 
		$data['lang']         = $setData['lang'];
		$data['page']         = $setData['page'];
		$data['AdminMenu']    = $setData['AdminMenu'];

		$data['page_title']   = $setData['language']->WEBCONFIG;
		//TEMPLATE
		$data['template'] = "admin/config_content/update.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
	
	public function runItem($setData){
		$file_xml = $setData['define_folder']['xml']."webinfo.xml";	

		foreach ($_POST as $key => $value):
			$row[$key] = stripslashes($value);
		endforeach;	
		

		$information = array( "info" => $row );

		
		$xml = $this->xmlwrite->createXML('information', $information);
		$xml->save($file_xml);
	    redirect(base_url().ADMINBASE.'?page=config_content&action=update&id=0&function=Item&alert=updated');
		
	}
	
	private function Conv($str){
		
    $mapping = array();
    foreach (get_html_translation_table(HTML_ENTITIES, ENT_QUOTES) as $char => $entity){
        $mapping[$entity] = '&#' . ord($char) . ';';
    }
    return str_replace(array_keys($mapping), $mapping, $str);
	
	}
	
}

