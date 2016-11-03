<?php 

$pathdir_image  	   =  "./upload/".$setData['page'].'/'.$result->image;
$pathdir_image_store   =  "./upload/storage/".$setData['page'].'/'.$setData['id'];
$pathdir_xml_vn 	   =  "./xmldata/vn/".$setData['page'].'/'.$setData['id'].'.xml';
$pathdir_xml_en 	   =  "./xmldata/en/".$setData['page'].'/'.$setData['id'].'.xml';
				
unlink($pathdir_image);			
unlink($pathdir_xml_vn);
unlink($pathdir_xml_en);

				
if(delete_files($pathdir_image_store , true))
		rmdir($pathdir_image_store);

?>