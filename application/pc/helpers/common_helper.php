<?php
	function redirectTo($url) {
		header('Location: ' . $url) ;
		exit ;
	}
	
	function exceptions_error_handler($severity, $message, $filename, $lineno) {
		if (error_reporting() == 0) {
			return;
		}
		if (error_reporting() & $severity) {
			throw new ErrorException($message, 0, $severity, $filename, $lineno);
		}
	}

	function getParam($request, $action) {
		if($request->input->post($action) == ''){
			return $request->input->get($action);
		} else {
			return $request->input->post($action);
		}
	}
	
	function genRandomPassword($length = 8) {
		$dict = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
		shuffle($dict);
   		$pass = '';
		for($i = 0; $i < $length; $i++){
	    	$pass .= $dict[rand(0, count($dict) - 1)];
		}  
		return $pass;
	}
	
	function splitCustomerHelper($str){
		$split = explode(";", $str);
		return $split;
	}
	
	function novus_sendMail($params) {
		require_once APPPATH . '/third_party/phpmailer/class.phpmailer.php';

		$mail = new PHPMailer(true);

		try {
			$mail->CharSet = "utf-8";
			$mail->IsSMTP() ;
			$mail->SMTPAuth = true ;

			$mail->SMTPSecure = ( isset($params['ssl']) ) ? $params['ssl'] : '' ;
			$mail->Username = $params['username'];
			$mail->Password = $params['password'];
			$mail->Host     = $params['host'];
			$mail->Port     = $params['port'];
			$mail->From     = $params['from'];
			$mail->FromName = $params['from_name'];
			$mail->Subject  = $params['subject'];
			$mail->Body     = $params['body'];
			$mail->AltBody  = ( isset($params['alt_body']) ) ? $params['alt_body'] : '' ;
			$to             = $params['to'];
			$to_name        = ( isset($params['to_name']) ) ? $params['to_name'] : '' ;
			if ( isset($params['add_bbc']) ) $mail->AddBCC($params['add_bbc']);
			if ( isset($params['reply_to']) ) $mail->AddReplyTo($params['reply_to']);

			if( isset($params['attachment']) ) {
				$mail->AddAttachment($params['attachment']) ;
			}

			$mail->IsHTML(true) ;
			$mail->AddAddress($to, $to_name) ;
			$mail->Send() ;
			return true ;

		} catch (phpmailerException $e) {
			return false;
		} catch (Exception $e) {
			return false;
		}
		return false;
	}
	
	function sendMail($content, $options){

		$body   = "Mot khach hang da gui thong tin lien he den NOVUS.<p>".$content['s_content'];
		$params = array();				
		$params['from']      = $content['s_email'];
		$params['from_name'] = $content['s_name'];
		$params['to']        = $options['mail_admin'];
		$params['subject']   = $options['mail_subject'];
		$params['body']      = $body;
		$params['host']      = $options['mail_host'];
		$params['username']  = $options['mail_username'];
		$params['password']  = $options['mail_password'];
		$params['port']      = $options['mail_port'];
		
		if(!novus_sendMail($params)){
			
		}
	}	
?>