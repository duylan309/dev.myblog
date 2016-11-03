<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator page</title>
<link href="<?=asset_url()?>/style/admin/main.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?=asset_url()?>/style/admin/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen" />
<!--<link href='http://fonts.googleapis.com/css?family=Noto+Sans&subset=latin,vietnamese' rel='stylesheet' type='text/css'>-->
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700&subset=latin,vietnamese,latin-ext' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.tools.min.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.lightbox-0.5.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/admin/adjava.js"></script>

<script type="text/javascript">
$(document).ready(function(){

	$("#fStatus,#fId, #fCompany ,#fCat,#fMenu,#fCol,#fProduct ,#fTop, #fSort, #fStyle, #fTitle,#fClass,#fGrade,#fType,#fPosition").change(function(){
		$("#searchSubmit").submit();
	})
		
	$('#fId, #fUrl, #fTitle, #fSort" ').blur(function(){
		$("#searchSubmit").submit();
	})

});
</script>
</head>

<body>

<div id="container">
  <div class="header">
    <?=$this->load->view('admin/template/footer.php')?>
  </div>
  <div id="main_content">
    <?php 

  if(!empty($template))
  $this->load->view($template); 
   
   ?>
    <div class="clearfix"></div>
  </div>
  <div class="langChange"></div>
 <!-- <?php $this->load->view('admin/template/box/new.php',$check_new)?>-->
</div>

<link rel="stylesheet" media="screen" type="text/css" href="<?=asset_url()?>style/admin/datepicker.css" />
<script type="text/javascript" src="<?=asset_url()?>javascript/date/bootstrap-datepicker.js"></script> 
<script type="text/javascript">
$(function() {
		
		 $('#dp1').datepicker({
				format: 'yyyy-mm-dd'
			});
			
		 $('#dp2').datepicker({
				format: 'dd-mm-yyyy'
			});	
		 	
});
</script>
</body>
</html>