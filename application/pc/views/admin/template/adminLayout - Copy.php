<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator page</title>
<link href="<?=asset_url()?>/style/admin/main.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?=asset_url()?>/style/admin/font-awesome.min.css" rel="stylesheet" type="text/css" media="screen" />
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700&subset=latin,vietnamese,latin-ext' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.tools.min.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.lightbox-0.5.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/admin/adjava.js"></script>
<script type="text/javascript" src="<?=asset_url()?>plugin/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		//mode : "textareas",
		mode : "specific_textareas",
		elements : 'absurls',
		editor_selector : "mceEditor",
		theme : "advanced",
		plugins : "jbimages,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
 
// ===========================================
// Put PLUGIN'S BUTTON on the toolbar
// ===========================================
 
theme_advanced_buttons4 : "jbimages,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_resizing : true,
		relative_urls : false,
	});

function ajax_(url_,data_,success,loading){
	$.ajax({
		type:"POST",
		url:url_,
		data:data_,		
		beforeSend: function (){
			$(success).html(loading);
		},	
		success:function(html){	
			$(success).html(html);
		}	
	 });	
}
</script>
<script type="text/javascript">
$(document).ready(function(){

	$(".new_info h2.title").click(function(){
		
		$(this).next().slideToggle();
	});
	$(".new_info h2.title").next().hide();	
	
	$(".meta_click").click(function(){
		$(".meta_table").slideToggle();
	})
	
	$("ul.jquery-tabs").tabs("div.jquery-panes > div");
	$("ul.jquery-tabs-1").tabs("div.jquery-panes-1 > div");
	$(function() {
		//$('a.gallery').lightBox();
		// $(".menuHeader").floatingFixed({ padding: 0 });
	});
	///Function Inside File
	$(".funDelete").click(function(){
		if(!confirm("yes no question ?"))
			return false ;	
	})
	
	$("#fStatus,#fId, #fCompany ,#fCat,#fMenu,#fCol,#fProduct ,#fTop, #fSort, #fStyle, #fTitle,#fClass,#fGrade,#fType,#fPosition").change(function(){
		$("#searchSubmit").submit();
	})
		
	$('#fId, #fUrl, #fTitle, #fSort" ').blur(function(){
		$("#searchSubmit").submit();
	})
	
	$('.sortTable').click(function(){
		$(".inputSortTable").attr('value',$(this).attr('table'));
		$(this).find('.fa').toggleClass("fa-angle-down");		
		$("#searchSubmit").submit();
	})
	
	$(".sortTable[table="+$('.inputSortTable').attr('value')+"]").after($('.inputSortValue').attr('value')==1 ? '<i class="fa fa-angle-up"></i>' : '<i class="fa fa-angle-down"></i>');
	
	$('#searchArticle').change(function(){
		    var linkset = '<?=base_url()?>admin?page=ajax&action=searcharticle/'+$(this).attr('id_old')+'/'+$(this).attr('name_menu')+'/'+$(this).attr('value');
			var loading = '<img src="<?=base_url()?>images/icon/loading.gif" width="15" height="15" >';
			var success = $('.detailTable');
			aJax(linkset,success,loading);
	})
	
	$('.tableAdmin').css('min-height',$(window).height());
	if ($(".ch_url").is(':checked') )
			$(".ch_url").next().slideDown();	
		$(".ch_url").click(function(){				
			if ($(this).is(':checked') )
				$(this).next().slideDown();
			else
				$(this).next().slideUp();                                    
		})

});
</script>
</head>

<body>
<table class="tableAdmin" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="280" valign="top" style="padding:0"><aside class="menuHeader">
        <?php $this->load->view('admin/template/box/menu.php'); ?>
      </aside></td>
    <td style="padding:0" valign="top"><div id="container">
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
      </div></td>
  </tr>
</table>
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