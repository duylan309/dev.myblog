<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('admin/admindino'));
	}
	
	public function ItemAction($data){
		// IF UPDATE
		if(isset($data["id"]) && $data["id"] != 0){
			$id = $data['id'];
			$data['result'] = $this->admindino->GetValueFrom($data['TABLESQL'],'id',$id,'*');	
			
			//IMAGE
			$image = './upload/'.$data["FOLDERIMAGE"].'/'.$data['result']->image;
			$data['image_link'] = $image;
			
			$fileXML_en =$data['define_folder']['xml_en'].'/'.$data["FOLDERXML"].'/'.$data['result']->id.".xml";
			$data['readXML_en'] = simplexml_load_file($fileXML_en);
			$fileXML_vn =$data['define_folder']['xml_vn'].'/'.$data["FOLDERXML"].'/'.$data['result']->id.".xml";
			$data['readXML_vn'] = simplexml_load_file($fileXML_vn);

			$array_vn = json_encode($data['readXML_vn']->tab);
	        $array_vn = json_decode($array_vn, true);
			$data["tab_vn"] = $array_vn;

			$array_en = json_encode($data['readXML_en']->tab);
	        $array_en = json_decode($array_en, true);
			$data["tab_en"] = $array_en;
		}

		$data['results_car_value'] = $this->admindino->loadTable(TABLECARVALUE,NULL,NULL,NULL);	
		$data['results_car_style'] = $this->admindino->loadTable(TABLECARSTYLE,NULL,NULL,NULL);	

		$data['template'] = "admin/".$data["FOLDERCONTROL"]."/item_detail.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}

	public function saveData($setData){
		//SET XML FOLDER
		$post = $this->input->post();
		$alert = '';
		if($post){

			foreach ($post as $key => $value):
				$getKey = explode("-", $key);
				$getLangKey = explode("_", $key);
				//var_dump($getLangKey);

				if($getKey[0] != "extra" && $getKey[0] != "tab" && $getKey[1] != "" && !is_array($value)){
					
					if($getKey[1] != "title_url"):
						$data[$getKey[0]][$getKey[1]] = stripslashes($value);
					else:			
						$data[$getKey[0]][$getKey[1]] = strtolower(webtitleUrl(webKillVN($value)));
					endif;


					if(count($getLangKey) > 1){
						if($getLangKey[count($getLangKey)-1] == "vn")
						$row_xml_vn[str_replace("seo","meta",$getKey[0])][str_replace(array("_vn","meta_"), "", $getKey[1])] = $value;
						else
						$row_xml_en[str_replace("seo","meta",$getKey[0])][str_replace(array("_en","meta_"), "", $getKey[1])] = $value;
					}else{
						$row_xml_vn[str_replace("seo","meta",$getKey[0])][$getKey[1]] = $value[0];
						$row_xml_en[str_replace("seo","meta",$getKey[0])][$getKey[1]] = $value[0];
					}
					unset($post[$key]);
				}

			endforeach;	


			//GET EXTRA
			if(isset($post) && count($post) !=0){
				
				foreach ($post as $key_extra => $value_extra):
					$getKeyExtra = explode("-", $key_extra);
					$getLangKey  = explode("_", $key_extra);

					$i=0;
					foreach($value_extra as $key_extra_sub => $value_extra_sub):
						if(count($getLangKey) > 1 && $getLangKey[1] != "url"){
							if($getLangKey[count($getLangKey)-1] == "vn")
							$row_xml_vn[$getKeyExtra[0]][$i][str_replace("_vn","",$getLangKey[1])] = $value_extra_sub;
							else
							$row_xml_en[$getKeyExtra[0]][$i][str_replace("_en","",$getLangKey[1])] = $value_extra_sub;
						}else{
							$row_xml_vn[$getKeyExtra[0]][$i][str_replace("_title","tab_",$getLangKey[1])] = $value_extra_sub;
							$row_xml_en[$getKeyExtra[0]][$i][str_replace("_title","tab_",$getLangKey[1])] = $value_extra_sub;
						}

					$i++;
					endforeach;	
				
				endforeach;	
			}

			require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/image_control_other.php');

			if($data["db"]["id"] == NULL){ // INSERT TABLE
				
				$data["db"]["date"] = date('y-m-d');
				$data["db"]['id'] = $this->admindino->AddTable($setData["TABLESQL"],$data["db"]);

				if($data["db"]['id'] == TRUE){
					require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/xml_control_other.php');
					$alert = '&alert=added';
					
				}else{
					die();
				}

				redirect(base_url().ADMINBASE.'?page='.$setData["FOLDERCONTROL"].'&action=lists&id=0&function=null'.$alert);

			}else{ // UPDATE TABLE
				$result = $this->admindino->UpdateTable($setData["TABLESQL"],$data["db"],$data["db"]["id"]);
				
				if($result == TRUE){

					require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/xml_control_other.php');
					$alert = '&alert=updated';
					
				}else{
					die();
				}
				redirect(base_url().ADMINBASE.'?page='.$setData["FOLDERCONTROL"].'&action=lists&id=0&function=null'.$alert);

			}		

		}else{
			die();
		}			
	}
	
	public function getCat($table){
			$this->load->model('admin/'.$table);
			$article_cat = $this->$table->getTitleId();
			return $article_cat->result();
	}
	///DELETE OLD IMAGE	
	function deleteOldImage($image,$folder_image){
			$fileOldImage = "./upload/".$folder_image.'/'.$image;
			if(is_file($fileOldImage))
			unlink($fileOldImage);
			
			return TRUE;
	}
	
}

