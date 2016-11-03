<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Readimg {
 
   // public $path_dir = null;
	public function &readImageDir($path_dir){
	if(! is_dir($path_dir))
		return false;
		
	$folder = opendir($path_dir); // Use 'opendir(".")' if the PHP file is in the same folder as your images. Or set a relative path 'opendir("../path/to/folder")'.
    $pic_types = array("jpg", "jpeg", "gif", "png");
    $index = array();
     
    while ($file = readdir ($folder)) {
		if(in_array(substr(strtolower($file), strrpos($file,".") + 1),$pic_types))
		{
			array_push($index,$file);
		}
    }
    closedir($folder);
	return $index;
	}
		
	
	
}

// ------------------------------------------------------------------------

/* End of file xml_helper.php */
/* Location: ./system/helpers/xml_helper.php */