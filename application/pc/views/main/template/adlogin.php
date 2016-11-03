<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administrator</title>
<link href="<?=asset_url()?>/style/admin/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen" />
<style type="text/css">
* {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
body {
	margin: 0;
	pading: 0;
	color: #999999;
	width:1000px;height:500px;
	font-size: 14px;
	font-weight: bold;
	background:url(./images/black_denim.png) repeat;
}
li {
	list-style: none;
}
#login-wrapper {
	margin: 0 0 0 -160px;
	width: 320px;
	text-align: center;
	z-index: 99;
	position: absolute;
	top: 0;
	left: 50%;
}
#login-top {
	height: 120px;
	left: 50%;
	margin-left: -275px;
	padding-bottom: 75px;
	padding-top: 77px;
	position: relative;
	text-align: center;
	width: 550px;
}
label {
	width: 70px;
	float: left;
}
input.text-input {
	width: 167px;
	float: right;
	border-top-right-radius: 4px;
	border-bottom-right-radius: 4px;
	border: none;
	color: #fff;
	padding:10px 8px;background:url(../images/bg-footer.png) repeat;
	font-size: 13px;
}
input.buttonSubmit {
	float: left;
	padding: 10px 10px;
	color: #fff;
	font-size: 13px;
	background:url(../images/bg-footer.png) repeat;
	border-radius: 4px;
	border:none;
	cursor: pointer;
	letter-spacing: 1px;
	width: 220px;
	margin-top: 3px;
}
input.buttonSubmit:hover {
	font-weight:bold;
}
div.error {
	padding: 8px;
	background: rgba(52, 4, 0, 0.4);
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
	border-radius: 8px;
	border: solid 1px transparent;
	margin: 6px 0;
}
#ma_xt{width:200px;border-radius:4px;}
a {
	text-decoration: none;
	color: #999999;
}
p {
	margin: 8px;
}
.fa{position:absolute;font-size:14px;left:24px;line-height:36px;color:#922679;background:url(../images/bg-footer.png) repeat;width:34px;height:36px;border-bottom-left-radius:4px;border-top-left-radius:4px;}
</style>
</head>

<body id="login">
<div id="login-wrapper" class="png_bg">
 
  <div id="login-content" style="margin-left: -127px;left:50%;   margin-top: 100px;  padding: 15px;    position: relative; border-radius: 4px 4px 4px 4px;  width: 234px;">
      <?php
			    echo form_open(base_url().'adlogin?action=check'); 
				
				//PASSWORD
				$password = array(
						  'name'        => 'l_password',
						  'id'          => 'l_password',
						  'value'       => '',
						  'class'	   => 'text-input',
						  'placeholder' => 'Your password',	
						);
				echo '<p><i class="fa fa-key"></i>'.form_password($password).'</p><br style="clear: both;" />'; 
				echo form_error('l_password');  
				//CAPCHA
			    if($error>=5):
				echo  '<p>'.$image;
				$capcha = array(
						  'name'        => 'ma_xt',
						  'id'          => 'ma_xt',
						  'value'       => set_value('ma_xt',''),
						  'class'	   => 'text-input',
					);
				echo '<p>'.form_input($capcha).'</p><br style="clear: both;" />'; 
				echo form_error('capcha');  
				endif;
				
				//SUBMIT
				$submit = array(
						  'name'        => 'Submit',
						  'value'       => 'Login',
						  'class'	   => 'buttonSubmit',
						  	
						);			        
				echo '<p>'.form_submit($submit).'</p><br style="clear: both;" />'; 
				echo form_fieldset_close(); 
			   ?>
  
  </div>
</div>
</body>
</html>
