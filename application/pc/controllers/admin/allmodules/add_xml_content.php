<?php 

$file_xml_en = $setData['define_folder']['xml'].$setData['define_folder']['english'].'/'.$setData['page'].'/'.$do.".xml";	
$file_xml_vn = $setData['define_folder']['xml'].$setData['define_folder']['vietnam'].'/'.$setData['page'].'/'.$do.".xml";	
																	
			$information_en = $this->dinosaur_lib->xml_post(	    'Edit title',
																	stripslashes('edit short content'),
																	stripslashes('edit full content'),
																	stripcslashes('SEO title'),
																	stripcslashes('SEO keyword'),
																	stripcslashes('SEO description'));
																	
			$information_vn = $this->dinosaur_lib->xml_post(	    'Chỉnh sửa tiêu đề',
																	stripslashes('Chỉnh sửa nội dung ngắn'),
																	stripslashes('Chỉnh sửa nội dung đầy đủ'),
																	stripcslashes('Tiêu đề SEO'),
																	stripcslashes('Từ khóa SEO'),
																	stripcslashes('Miêu tả SEO'));
																	
			
			
			$xml_en = $this->xmlwrite->createXML('information', $information_en);
			$xml_en->save($file_xml_en);
			
			$xml_vn = $this->xmlwrite->createXML('information', $information_vn);
			$xml_vn->save($file_xml_vn);
			
		

?>