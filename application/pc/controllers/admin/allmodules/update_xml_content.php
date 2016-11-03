<?php 
$file_xml_en = $setData['define_folder']['xml'].$setData['define_folder']['english'].'/'.$setData['page'].'/'.$id.".xml";	
$file_xml_vn = $setData['define_folder']['xml'].$setData['define_folder']['vietnam'].'/'.$setData['page'].'/'.$id.".xml";
		
			$information_en = $this->dinosaur_lib->xml_post(	stripcslashes($data['title_en']),
																!empty($_REQUEST["content_en"])? stripcslashes($_REQUEST["content_en"]) : '&nbsp;',
																!empty($_REQUEST["description_en"]) ? stripcslashes($_REQUEST["description_en"]) : '&nbsp;',
																stripcslashes($this->input->post('meta_title_en')),  															  																stripcslashes($_REQUEST["meta_keyword_en"]),
																stripcslashes($_REQUEST["meta_description_en"]));
					
			$information_vn = $this->dinosaur_lib->xml_post(	stripcslashes($data['title_vn']),
																!empty($_REQUEST["content_vn"]) ? stripcslashes($_REQUEST["content_vn"]) : '&nbsp;',
																!empty($_REQUEST["description_vn"]) ? stripcslashes($_REQUEST["description_vn"]) : '&nbsp;',
																stripcslashes($this->input->post('meta_title_vn')),
																stripcslashes($_REQUEST["meta_keyword_vn"]),
																stripcslashes($_REQUEST["meta_description_vn"]));
												
																											
			$xml_en = $this->xmlwrite->createXML('information', $information_en);
			$xml_en->save($file_xml_en);
			
			$xml_vn = $this->xmlwrite->createXML('information', $information_vn);
			$xml_vn->save($file_xml_vn);
			
?>