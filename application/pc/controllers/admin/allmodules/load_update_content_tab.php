<?php 

///XML DATA
		$fileXML_en =$setData['define_folder']['xml'].$setData['define_folder']['english'].'/'.$setData['page'].'_tab/'.$data['result']->id.".xml";
		$data['readXML_en'] = simplexml_load_file($fileXML_en);
		$fileXML_vn =$setData['define_folder']['xml'].$setData['define_folder']['vietnam'].'/'.$setData['page'].'_tab/'.$data['result']->id.".xml";
		$data['readXML_vn'] = simplexml_load_file($fileXML_vn);
	

?>