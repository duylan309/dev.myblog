<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Onepay_lib {
	
	
	public function OnepayMakeUrlVisa($data_secure,$data){
		//$SECURE_SECRET = "6D0870CDE5F24F34F3915FB0045120DB";
		$SECURE_SECRET = $data_secure['secure_secret'];

		//$vpcURL = $_POST["virtualPaymentClientURL"] . "?";
		$vpcURL = $data["virtualPaymentClientURL"] . "?";
		
		//unset($_POST["virtualPaymentClientURL"]); 
		unset($data["virtualPaymentClientURL"]); 
		
		//$data['AgainLink']=urlencode($_SERVER['HTTP_REFERER']);
		//$_POST['AgainLink']=urlencode($_SERVER['HTTP_REFERER']);
		
		//$md5HashData = $SECURE_SECRET; Khởi tạo chuỗi dữ liệu mã hóa trống
		$md5HashData = "";
		
		ksort ($data);
		
		// set a parameter to show the first pair in the URL
		$appendAmp = 0;
		
		foreach($data as $key => $value) {
		
			// create the md5 input and URL leaving out any fields that have no value
			if (strlen($value) > 0) {
				
				// this ensures the first paramter of the URL is preceded by the '?' char
				if ($appendAmp == 0) {
					$vpcURL .= urlencode($key) . '=' . urlencode($value);
					$appendAmp = 1;
				} else {
					$vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
				}
				//$md5HashData .= $value; sử dụng cả tên và giá trị tham số để mã hóa
				if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
					$md5HashData .= $key . "=" . $value . "&";
				}
			}
		}
		//xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa
		$md5HashData = rtrim($md5HashData, "&");
		// Create the secure hash and append it to the Virtual Payment Client Data if
		// the merchant secret has been provided.
		if (strlen($SECURE_SECRET) > 0) {
			//$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($md5HashData));
			// Thay hàm mã hóa dữ liệu
			$vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $md5HashData, pack('H*',$SECURE_SECRET)));
		}
		
		return $vpcURL;	
	}//end function
	
	public function OnepayMakeUrlAtm($data_secure,$data){
		
		$SECURE_SECRET = $data_secure['secure_secret'];

		// add the start of the vpcURL querystring parameters
		// *****************************Lấy giá trị url cổng thanh toán*****************************
		$vpcURL = $data["virtualPaymentClientURL"] . "?";
		
		// Remove the Virtual Payment Client URL from the parameter hash as we 
		// do not want to send these fields to the Virtual Payment Client.
		// bỏ giá trị url và nút submit ra khỏi mảng dữ liệu
		unset($data["virtualPaymentClientURL"]); 
		unset($_POST["SubButL"]);
		
		//$stringHashData = $SECURE_SECRET; *****************************Khởi tạo chuỗi dữ liệu mã hóa trống*****************************
		$stringHashData = "";
		// sắp xếp dữ liệu theo thứ tự a-z trước khi nối lại
		// arrange array data a-z before make a hash
		ksort ($data);
		
		// set a parameter to show the first pair in the URL
		// đặt tham số đếm = 0
		$appendAmp = 0;
		
		foreach($data as $key => $value) {
		
			// create the md5 input and URL leaving out any fields that have no value
			// tạo chuỗi đầu dữ liệu những tham số có dữ liệu
			if (strlen($value) > 0) {
				// this ensures the first paramter of the URL is preceded by the '?' char
				if ($appendAmp == 0) {
					$vpcURL .= urlencode($key) . '=' . urlencode($value);
					$appendAmp = 1;
				} else {
					$vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
				}
				//$stringHashData .= $value; *****************************sử dụng cả tên và giá trị tham số để mã hóa*****************************
				if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
					$stringHashData .= $key . "=" . $value . "&";
				}
			}
		}
		//*****************************xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa*****************************
		$stringHashData = rtrim($stringHashData, "&");
		// Create the secure hash and append it to the Virtual Payment Client Data if
		// the merchant secret has been provided.
		// thêm giá trị chuỗi mã hóa dữ liệu được tạo ra ở trên vào cuối url
		if (strlen($SECURE_SECRET) > 0) {
			//$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($stringHashData));
			// *****************************Thay hàm mã hóa dữ liệu*****************************
			$vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)));
		}
		
		return $vpcURL;
		
	}
}