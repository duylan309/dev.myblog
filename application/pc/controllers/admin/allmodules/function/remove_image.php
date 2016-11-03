<?php 

private function deleteOldImage($database,$id,$path){
	$result = $this->admindino->GetValueFrom($database,'id',$id,'image');
	$fileOldImage = $path.$result->image;
	if(is_file($fileOldImage)){
	
		unlink($fileOldImage);
	
	}

	return TRUE;
}