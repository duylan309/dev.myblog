<?php 
	$file_xml_vn = $setData['define_folder']['xml_vn'].$setData['page'].'/'.$data["db"]['id'].".xml";	
	$file_xml_en = $setData['define_folder']['xml_en'].$setData['page'].'/'.$data["db"]['id'].".xml";	



	$information_vn = $this->dinosaur_lib->xml_post(	stripcslashes($data["db"]['title_vn']),
														stripcslashes($data["more"]["content_vn"] ? $data["more"]["content_vn"] : ""),
														stripcslashes($data["more"]["description_vn"] ? $data["more"]["description_vn"] : ""),
														stripcslashes($data["seo"]['meta_title_vn']),
														stripcslashes($data["seo"]["meta_keyword_vn"]),
														stripcslashes($data["seo"]["meta_description_vn"]),
														isset($data["seo"]["image_facebook_vn"]) ? $data["seo"]["image_facebook_vn"] : null );
		
	$xml_vn = $this->xmlwrite->createXML('information', $information_vn);
	$xml_vn->save($file_xml_vn);
		
	$information_en = $this->dinosaur_lib->xml_post(	stripcslashes($data["db"]['title_en']),
														stripcslashes($data["more"]["content_en"] ? $data["more"]["content_en"] : ""),
														stripcslashes($data["more"]["description_en"] ? $data["more"]["description_en"] : ""),
														stripcslashes($data["seo"]['meta_title_en']),
														stripcslashes($data["seo"]["meta_keyword_en"]),
														stripcslashes($data["seo"]["meta_description_en"]),
														isset($data["seo"]["image_facebook_en"]) ? $data["seo"]["image_facebook_en"] : null);
														
	$xml_en = $this->xmlwrite->createXML('information', $information_en);
	$xml_en->save($file_xml_en);
?>