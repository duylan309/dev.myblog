<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dinosaur_lib {
	public $arrMN = array();

	public function createMenu($data, $parent=0,$i=0,$source=0,$lang,$menu_url,$text1='',$current=NULL,$image=0){
			if($current!=NULL)
				$slect = $current;
			else 
				$slect = 0;
			
			if($data):
			foreach($data as $k => $value):
				if($value->cat == $parent):
					$sl = $slect!=0 && $slect==$value->id ? 'class="current"' : '';
					$text               =  $lang=="en"?$value->title_en:$value->title_vn;
					
					if($image==0):
						$array['list']   	  =  '<li '.$sl.'><a href="'.base_url().$menu_url.'/'.$value->title_url.'_'.$value->id.'.html">'.$text1.$text .'</a>';
					else:
						$array['list']   	  =  '<li '.$sl.'><a href="'.base_url().$menu_url.'/'.$value->title_url.'_'.$value->id.'.html"><image src="'.base_url().'/upload/'.$menu_url.'_cat/'.$value->image.'">'.$text1.$text .'</a>';				
				    endif;
					
					$array['id']        =  $value->id;
					$array['cat']       =  $parent;
					$array['parent']    =  $i;
					$getValueKey        =  explode("/",$source);
					$array['source']    =  isset($getValueKey[1]) ? $getValueKey[1] :$getValueKey[0];
					$array['getKey']    =  count($getValueKey)-1;
					
					array_push($this->arrMN,$array);
					
					unset($data[$k]);
					$this->createMenu($data ,$value->id,$i+1,$source.'/'.$value->id,$lang,$menu_url,$text1.'');
					
				endif;
			endforeach;
			endif;
			return $this->arrMN;	 
	}	

	public function _getSubMenu($listData,$key_id,$id_name,$base_url,$lang){

		$data['string'] = '<ul id="'.$id_name.'" class="sub_menu navbar-nav">';
		$count = 0;
		$data["key"] = array();
		foreach ($listData as $key => &$value) {
			if($value->parent == $key_id){
				$title = $lang == "en" ? $value->title_en : $value->title_vn;
				$data['string'] .= '<li current-menu-sub="'.$value->title_url.'"><a href="'.$base_url.$value->title_url.'">'.$title.'</a></li>';
				$count = 1;
				array_push($data["key"],$key);
				unset($listData[$key]);
			}
		}
		$data['data'] = $listData;
		$data['string'] .= "</ul>";
		$data['string'] = $count != 0 ? $data["string"] : '';
		return $data;
	}
	 
 public function getIdMenu($data, $parent=0,$source=0,$array = array()){
	
	if($data):
		foreach($data as $k => $value):
			if($value->cat == $parent):
				$array[]        =  intval($value->id);
				unset($data[$k]);
				$array = $this->getIdMenu($data ,$value->id,$source.'/'.$value->id,$array);					
			endif;
		endforeach;
	endif;

	return $array;	 
 }	



 public function _showMenuTree($data,$key_id = 0,$array_holder = array(),$str_holder = '',$parent_before = 0,$counter =0){
   echo $key_id == 0 ? "<ul>" : "";
   foreach($data as $key => &$value):
     if(intval($value->parent) == $key_id){
         
         if(($value->parent == 0 || $value->parent == 1) && $value->id != $parent_before){ echo '</ul>';}

         if($value->parent != 0 && ($value->parent != $parent_before)){ echo "<ul>"; $parent_before = $value->parent; }
         
         echo'<li> <a href="'.$value->title_url.'">'.$value->title_en.'</a>';
         
         $counter++;
         unset($data[$key]);
         _showMenuTree($data,$value->id,$array_holder,$str_holder,$parent_before,$counter);
         echo '</li>';
     }
   endforeach;  
   echo count($data)*count($data) == $parent_before ? "</ul" : "";
 }


 
 public function getMenuAdmin($data, $parent=0,$text='--',$i=0,$source=0){
			if($data):
			foreach($data as $k => $value):
				if($value->cat == $parent):
					$array['text_en']   =  $text.'|'.$value->title_en;
					$array['text_vn']   =  $text.'|'.$value->title_vn;	
					$array['id']        =  $value->id;
					$array['cat']       =  $parent;
					$array['parent']    =  $i;
					$getValueKey        =  explode("/",$source);
					$array['source']    =  isset($getValueKey[1]) ? $getValueKey[1] :$getValueKey[0];
					array_push($this->arrMN,$array);
					
					unset($data[$k]);
					$this->getMenuAdmin($data ,$value->id ,$text.'---' ,$i+1,$source.'/'.$value->id);
					
				endif;
			endforeach;
			endif;
			return $this->arrMN;	 
 }	
 
 public function getArr($array=array()){
		 $this->arrMN = $array;
		 return; 
 }
 
 public function xml_postdata($data,$seo_title,$seo_keyword,$seo_description){
											
			$info['info'] = array();
			$info1 = array();
			$info1['@attributes']  = array('langId'=>1);
			foreach($data as $item => $key):
					$info1[$item]  =  array('@value' => $key);
			endforeach;
			$info1['meta']         = array(); 
			$info1['meta']['title']      = array('@value'=>$seo_title);
			$info1['meta']['keyword']    = array('@value'=>$seo_keyword);
			$info1['meta']['description']= array('@value'=>$seo_description);
			array_push($info['info'],$info1);								
			return $info;
}		

public function xml_post($title,$content,$description,$seo_title,$seo_keyword,$seo_description,$seo_facebook_image = null){
			$information = array();
			$meta_facebook = isset($seo_facebook_image) && !empty($seo_facebook_image) ? $seo_facebook_image : '';
			$content = $content != '' ? $content : '';
			$description = $description != '' ? $description : '';
			$information = array(
				'info' => array(
					array(
						'@attributes' => array(
							'langId' => '1'
						),
						'title' =>  array(
							'@value' => $title,
						),
												
						'content' => array(
							'@value' => $content,
						),
						'description' => array(
							'@value' => $description,
						),
						'image_facebook' => array(
							'@value' => $meta_facebook,
						),
						
						'meta'=>array(
						
							'title'=>array(
								'@value' => $seo_title
							),
							'keyword'=>array(
								'@value' => $seo_keyword
							),
							'description'=>array(
								'@value' => $seo_description
							),
						),
					),
				)
			);
			
			return $information;
	}

	public function xml_post_project(array$title,$hotline,$download,$content,$description,$seo_title,$seo_keyword,$seo_description){
			$information = array();
			
			$content = $content != '' ? stripslashes($this->utf8_for_xml($content)) : '';
			$description = $description != '' ? stripslashes($this->utf8_for_xml($description)) : '';
			
			$information = array(
				'info' => array(
					array(
						'@attributes' => array(
							'langId' => '1'
						),
						'title' =>  array(
							'@value' => stripslashes($this->utf8_for_xml($title)),
						),

						'hotline' =>  array(
							'@value' => stripslashes($this->utf8_for_xml($hotline)),
						),

						'download' =>  array(
							'@value' => stripslashes($this->utf8_for_xml($download)),
						),
												
						'content' => array(
							'@value' => $content,
						),
						'description' => array(
							'@value' => $description,
						),
						
						'meta'=>array(
						
							'title'=>array(
								'@value' => stripslashes($this->utf8_for_xml($seo_title))
							),
							'keyword'=>array(
								'@value' => stripslashes($this->utf8_for_xml($seo_keyword))
							),
							'description'=>array(
								'@value' => stripslashes($this->utf8_for_xml($seo_description))
							),
						),
					),
				)
			);
				//	print_r($information);		
			return $information;
	}
	
	public function loadMeta($lang,$define_folder,$id){
		$fileXml 				     = "./xmldata/".$lang.$define_folder.$id.".xml";
	
		$readXml 	     			 = simplexml_load_file($fileXml);
		$meta['title']       		 = $readXml->info->meta->title;
		$meta['keyword']     		 = $readXml->info->meta->keyword;
		$meta['description'] 		 = $readXml->info->meta->description; 
		
		return $meta;
	}
	
	public function utf8_for_xml($string)
	{
		return preg_replace ('/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u', ' ', $string);
	}
	
	public function loadXml($lang,$define_folder,$id){
		$fileXml 				     = "./xmldata/".$lang.$define_folder.$id.".xml";
	
		$readXml 	     			 = simplexml_load_file($fileXml);
		
		$array = $readXml->info;
		$array = json_encode($readXml->info);
        $array = json_decode($array, true);
        
		$xml = array();
		foreach($array as $item => $key ):
			$xml[$item] = $key;
		endforeach; 
		$meta['title']     		     = $readXml->info->meta->title;
		$meta['keyword']     		 = $readXml->info->meta->keyword;
		$meta['description'] 		 = $readXml->info->meta->description; 
		
		$xml['meta']                 = $meta;
		return $xml;
	}

	public function loadDataXml($define_folder,$id){
		$fileXml 				     = $define_folder.$id.".xml";
	
		$readXml 	     			 = simplexml_load_file($fileXml);
		
		$array = $readXml->info;
		$array = json_encode($readXml->info);
        $array = json_decode($array, true);
        
		$xml = array();
		foreach($array as $item => $key ):
			$xml[$item] = $key;
		endforeach; 
		$meta['title']     		     = $readXml->info->meta->title;
		$meta['keyword']     		 = $readXml->info->meta->keyword;
		$meta['description'] 		 = $readXml->info->meta->description; 
		
		$xml['meta']                 = $meta;
		return $xml;
	}

	public function loadXmlGeneral($lang,$define_folder,$id){
		$fileXml 				     = "./xmldata/".$lang.$define_folder.$id.".xml";
	
		$readXml 	     			 = simplexml_load_file($fileXml);
		
		$array = $readXml;
		$array = json_encode($readXml);
        $array = json_decode($array, true);
        
		$xml = array();
		foreach($array as $item => $key ):
			$xml[$item] = $key;
		endforeach; 
		$meta['title']     		     = $readXml->meta->title;
		$meta['keyword']     		 = $readXml->meta->keyword;
		$meta['description'] 		 = $readXml->meta->description; 
		
		$xml['meta']                 = $meta;
		return $xml;
	}

	public function loadPageNavigate(){
		//PHAN TRANG
		$data['session']		   = $value['session'];
		$data['coutAll']           = $value['coutAll'];
		
		$config 				   = array();
		$config["base_url"]        = base_url().ADMINBASE."?page=".$value['page']."&action=lists&id=0&function=null";
		$config["per_page"]        = 20;
        $config["uri_segment"]     = 3;
		$config["total_rows"]      = $value['coutAll'];
		$config["typeMain"] 	   = 'admin';
		$config['cur_page'] 	   = getParam($this,'per_page');

		//config for bootstrap pagination class integration
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['first_link']      = false;
        $config['last_link']       = false;
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']	   = '&laquo';
        $config['prev_tag_open']   = '<li class="prev">';
        $config['prev_tag_close']  = '</li>';
        $config['next_link'] 	   = '&raquo';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';

	    $this->pagination->initialize($config);	 
		$page  					   = getParam($this,'per_page') ? getParam($this,'per_page') : 0;
		
		$whereValue['status']      = intval($data['session']['status']);
		$sortValue       		   = intval($data['session']['sort'])==0 ? 'DESC' : 'ASC';
		$sort 					   = $data['session']['sortTable'];
		
 		$whereLike['id']           =  $data['session']['where']['id'];
		$whereLike['title_'.$value['lang']]        =  $data['session']['where']['title_'.$value['lang']];
		$data["results"]           = $this->admindino->ListItems($value['page'],$config["per_page"], $page ,$data['session']['where'],$whereValue,$sort,$sortValue);//Get result from search
		$data["links"]             = $this->pagination->create_links();
	}


}

/* End of file Someclass.php */