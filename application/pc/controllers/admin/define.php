<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
class Define extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('admin/checknew','admin/admindino'));
	}
	
	public function setDefine()
	{			
		$data['define_folder'] = array(
		"vietnam"=>"vn",
		"english"=>"en",
		"japan"=>"jp",
		
		"storage"=>"storage/",
		
		"image"=>"upload/",
		"image_article"=>"upload/article/",
		"image_album"=>"upload/album",
		"image_product"=>"upload/product/",
		"image_product_cat"=>"upload/product_cat/",
		"image_menu"=>"upload/menu/",
		"image_category"=>"upload/category/",
		"image_image_home"=>"upload/image_home/",
									
		"xml"=>"xmldata/",
		"xml_vn"=>"xmldata/vn/",
		"xml_en"=>"xmldata/en/",
		"xml_news"=>"/news/",
		"xml_about"=>"/about/",
		"xml_album"=>"/album/",
		"xml_contact_content"=>"/contact_content/",
		"xml_config_content"=>"/config_content/",
		"xml_product"=>"/product/",
		"xml_category"=>"/category/",
		"xml_day"=>"/day/",
		"xml_menu"=>"/menu/",
		"xml_home"=>"/home/",
		"xml_tag"=>"/tag/",
		"xml_article"=>"/article/",
		"xml_main_home"=>"/main_home/",
	
		"views_contact_content"=>"/contact_content/",
		"views_config_content"=>"/config_content/",
		"views_client"=>"/client/",
		"views_category"=>"/category/",
		"views_month"=>"/month/",
		"views_day"=>"/day/",
		"views_menu"=>"/menu/",
		"views_home"=>"/home/",
		"views_about"=>"/about/",
		"views_schedule"=>"/schedule/",
		"views_main_home"=>"/main_home/",
		
		"TypeHome" => array(
					0=> 'Hình Ảnh',
					1=> 'Video',
					),	
										
		"Status" => array(
					0=> 'Unpublish',
					1=> 'Publish',
					),

		"TypeTitle" => array(
					0=> 'Sub',
					1=> 'Main',
					),

		"ModuleColumn" => array(
					1=> '1 column',
					2=> '2 columns',
					),	
					
		"Role" => array(
					0=> 'Editer',
					1=> 'Admin',
					),
		
		"TypeMenu" => array(
					0=> 'Home',
					1=> 'Single Page',
					8=> 'Single Gallery Page',
					2=> 'List Articles',
					3=> 'List Articles With Categories',
					4=> 'List Gallery',
					5=> 'List Gallery With Categories',
				  	6=> 'List Client',
					7=> 'List Contact',
					9=> 'Link Url',
				   10=> 'Other Install'
				   ),
		
		"ModuleType" => array(
					0=> '-- SlideShow',
					1=> '-- HTML',
					2=> '-- Favarious Article',
				),
					
		"ModulePosition" => array(
					0=> 'Banner',
					3=> 'Right',
					4=> 'Bottom',
					),							
										
		"Online" => array(
					0=> 'Online',
					1=> 'Offline',
					),

					
		"Layout" => array(
					0=> 'Style 1',
					1=> 'Style 2'
					),
		
		"Sort" => array(
					0=> '1->100..',
					1=> '100..->1',
					),
					

		);
		return $data['define_folder'];
	}

	public function SeoName()
	{			
		$seo_name["dangkygiaodien"]="dang-ky-giao-dien";
		$seo_name["home"]="";
		$seo_name["home_text"]="home";
		$seo_name["booking"]="booking";
		$seo_name["admin"]="admin";
		$seo_name["category"]="category";
		$seo_name["cart"]="cart";
		
		return $seo_name;
	}
	
	public function checkNew(){
		$result['inbox'] = $this->checknew->check_inbox();
		return $result;   	
	}
	
	public function LoadMenus(){
		$result = $this->admindino->loadTable('menu',NULL,NULL);	
		return $result;
	}
	
	public function loadConfig(){
		$fileLink = "./xmldata/webinfo.xml";
		$readConfig = simplexml_load_file($fileLink);
		return $readConfig;
	}
	
	public function getType($title_url){
		$result = $this->admindino->GetValueFrom('menu','title_url',$title_url,'*');
		if($result!= false)
			return $result;
		else
			return false;	
	}

	public function getTypeId($ID){
		$result = $this->admindino->GetValueFrom('menu','id',$ID,'*');
		if($result!= false)
			return $result;
		else
			return false;	
	}
	
	
	
}

?>