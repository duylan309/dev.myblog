<!DOCTYPE html>
<html lang="en">
<head>
<title>404 Page Not Found</title>
<?=$this->load->view('main/template/header.php');?>
</head>

<body><div id="dashboard">
<div class="bg_contact">
<img src="<?=base_url()?>images/disclaimer.jpg">
</div>
<div class="disclaimerContainer">
<div class="content_dis" style="width:306px;left:50%;margin-left:-153px">
<h1 style=" color: #FFCB08;font-size: 92pt; font-weight: bold; line-height: normal;margin: 0;padding: 0;">404...</h1>
<p style="line-height: normal;margin: 0;padding: 0;">Sorry! The page you're looking for cannot be found.</p>
<div class="lineyellow" style="width:100%;margin:15px 0 18px"></div>

<a class="btn-404" href="<?=base_url()?>">GO BACK TO HOMEPAGE</a>
<a style="margin-left:10px;background:#FFCB08;" class="btn-404" href="<?=base_url()?>#/contact">CONTACT US</a>
</div></div>

<script type="application/javascript">
$(document).ready(function() {
    $('.bg_contact img').fullBg();
});
</script>




</div>
<script type="text/javascript">
$(document).ready(function() {
    $('.ic_caption,.bg_caption,.ic_right_nav,.ic_left_nav').css('display','none');
});
</script>
<style>
.ic_caption,.bg_caption{display:none}
.btn-404{background:#fff;margin-top:15px;font-weight:bold;color:#111;padding:5px 11px}
a.btn-404:hover{color:#111}
</style>
</body>
</html>