<?php
	$file_xml_vn = $setData['define_folder']['xml_vn'].$setData["FOLDERXML"].'/'.$data["db"]['id'].".xml";
	$file_xml_en = $setData['define_folder']['xml_en'].$setData["FOLDERXML"].'/'.$data["db"]['id'].".xml";
	$information_vn = $this->dinosaur_lib->xml_post(stripcslashes($data["db"]['title_vn']),
													isset($data["more"]["content_vn"]) ? stripcslashes($data["more"]["content_vn"]) : "",
													isset($data["more"]["description_vn"]) ? stripcslashes($data["more"]["description_vn"]) : "",
													stripcslashes($data["seo"]['meta_title_vn']),
													stripcslashes($data["seo"]["meta_keyword_vn"]),
													stripcslashes($data["seo"]["meta_description_vn"]));
	
	$information_vn = isset($row_xml_vn) ? $row_xml_vn : $information_vn;

	$xml_vn = $this->xmlwrite->createXML('information', $information_vn);
	$xml_vn->save($file_xml_vn);
		

	$information_en = $this->dinosaur_lib->xml_post(stripcslashes($data["db"]['title_en']),
													isset($data["more"]["content_en"]) ? stripcslashes($data["more"]["content_en"]) : "",
													isset($data["more"]["description_en"]) ? stripcslashes($data["more"]["description_en"]) : "",
													stripcslashes($data["seo"]['meta_title_en']),
													stripcslashes($data["seo"]["meta_keyword_en"]),
													stripcslashes($data["seo"]["meta_description_en"]));
		
	$information_en = isset($row_xml_en) ? $row_xml_en : $information_en;

	$xml_en = $this->xmlwrite->createXML('information', $information_en);
	$xml_en->save($file_xml_en);
?>