<?php 
		$fileXML_en =$setData['define_folder']['xml_en'].'/'.$setData['page'].'/'.$data['result']->id.".xml";
		$data['readXML_en'] = simplexml_load_file($fileXML_en);
		$fileXML_vn =$setData['define_folder']['xml_vn'].'/'.$setData['page'].'/'.$data['result']->id.".xml";
		$data['readXML_vn'] = simplexml_load_file($fileXML_vn);
?>