<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Administrator page</title>
		<link href="<?=asset_url()?>/style/main/fonticon.css" rel="stylesheet" type="text/css" media="screen" />
		<!-- Bootstrap Core CSS -->
		<link href="<?=asset_url()?>/style/general/bootstrap.min.css" rel="stylesheet">
		<link href="<?=asset_url()?>/style/general/sb-admin.css" rel="stylesheet">
		<link href="<?=asset_url()?>/style/general/morris.css" rel="stylesheet">
		<link href="<?=asset_url()?>/style/admin/admin_style.css" rel="stylesheet" type="text/css" media="screen" />
		
		<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.min.js"></script>
		<script type="text/javascript" src="<?=asset_url()?>javascript/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=asset_url()?>javascript/sortable.min.js"></script>
		<script type="text/javascript" src="<?=asset_url()?>javascript/admin/adjava.js"></script>
		<script type="text/javascript" src="<?=asset_url()?>javascript/price.js"></script>
		<script type="text/javascript" src="<?=asset_url()?>plugin/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
		function elFinderBrowser (callback, value, meta) {
			tinymce.activeEditor.windowManager.open({
				file: './elfinder/elfinder.html',// use an absolute path!
				title: 'elFinder',
				width: $(window).innerWidth() - 100,	
				height: $(window).innerHeight() - 100,
				resizable: 'yes'
			}, {
				oninsert: function (file, fm) {
					var url, reg, info, url_set_site;

					// URL normalization
					// url = file.url;
					url = '<?=base_url()?>'+file.url;
					console.log(url);
					reg = /\/[^/]+?\/\.\.\//;
					while(url.match(reg)) {
						url = url.replace(reg, '/');
					}

					url_set_site = '<?=base_url()?>'+url;

					// console.log(url);

					// Make file info
					info = file.name + ' (' + fm.formatSize(file.size) + ')';

					// Provide file and text for the link dialog
					if (meta.filetype == 'file') {
						callback(url_set_site, {text: info, title: info});
					}

					// Provide image and alt text for the image dialog
					if (meta.filetype == 'image') {
						callback(url_set_site, {alt: info});
					}

					// Provide alternative source and posted for the media dialog
					if (meta.filetype == 'media') {
						callback(url_set_site);
					}
				}
			});
			return false;
		}

		function setTextEditor($ID){
			tinymce.init({
				selector: $ID,
				height: 300,
				plugins: [
				'advlist autolink lists link image charmap print preview anchor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table contextmenu paste code textcolor'
				],
				toolbar: 'undo redo | styleselect | bold italic | forecolor backcolor fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media code | fullscreen',
				link_class_list: [
				   {title: 'None', value: ''},
				   {title: 'button download', value: 'btn-download'},
				   {title: 'button link', value: 'link-arrow-right'},
				   {title: 'button banner', value: 'btn-banner'},
				   {title: 'Image', value: 'img-responsive'}, 
				],

				file_picker_callback : elFinderBrowser,

				fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt 48pt 54pt 72pt",
				cleanup : true,
				
			});
		}
		// ADD FINDER 
		
		setTextEditor('textarea.mceEditor');

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
			
			$('#price').priceFormat({
			    prefix: '',
			    suffix: ' VND',
			     centsLimit: 0
			});

			$('.menu_admin .li').click(function() {
				$(this).toggleClass('active');
			});

			$(".meta_click").click(function(){
				$(".meta_table").slideToggle();
			})
			
			$(".funDelete").click(function(){
				if(!confirm("yes no question ?"))
						return false ;
			})
			
			$('#submitForm').submit(function(){
			    
			    $("input[type='submit'],button[type='submit']")
			      .attr('disabled', 'disabled')
			      .find('span').html('<?=$lang=="en" ? "Please wait..." : "Vui lòng chờ..."?>');

			    return true;
			});
			

			// CHECK FORM VALIDATED
			var data_require  = $("[data-validate]"),
			    form_validate = $("[data-form-validate]");
			    data_require.length && data_require.on("change", function () {
		    		if($.trim(this.value).length > 0){
			        	$(this).closest(".form-group").removeClass('has-error');
		    		}else{
			        	$(this).closest(".form-group").addClass('has-error');
		    		}
			    }), form_validate.length && form_validate.on("submit", function (e) {
			    	var data_validate = 0,
	            		form_input    = $(this).find("[data-validate]");
			         
				        form_input.each(function () {
				         	if($.trim(this.value).length == 0)
				         		// console.log($.trim(this.value).length);
				         		data_validate++, $(this).closest(".form-group").addClass('has-error');
	 			     	})

	  			        if(data_validate != 0)
			 		   		e.preventDefault();
			 });   

			// $("#fStatus,#fId, #fCompany ,#fCat,#fMenu,#fCol,#fProduct ,#fTop, #fSort, #fStyle, #fTitle,#fClass,#fGrade,#fType,#fPosition").change(function(){
			// 	$("#searchSubmit").submit();
			// })
			
			$("[data-search]").blur(function(){
				$("#searchSubmit").submit();
			});

			$("[data-search]").change(function(){
				$("#searchSubmit").submit();
			});

			// So you have just to use
			$('[data-search]').bind('keypress', function(e) {
			    if (e.which === 13) {
					$("#searchSubmit").submit();
			    }
			});

			$('.type-menu').change(function() {
				var getValue = $(this).val();
				if(getValue==9){
					$('#titleUrl').stop();
				}
			});

			$('#fId, #fUrl, #fTitle, #fSort').blur(function(){
				$("#searchSubmit").submit();
			})
			
			$('.sortTable').click(function(){
				$(".inputSortTable").attr('value',$(this).attr('table'));
						$(this).find('.fa').toggleClass("fa-angle-down");
				$("#searchSubmit").submit();
			})
			
			$(".sortTable[table="+$('.inputSortTable').attr('value')+"]").after($('.inputSortValue').attr('value')==1 ? '<i class="fa fa-angle-up"></i>' : '<i class="fa fa-angle-down"></i>');
			
			$('#searchArticle').change(function(){
				    var linkset = '<?=base_url()?>admin?page=ajax&action=searcharticle&id_old='+$(this).attr('id_old')+'&menu_name='+$(this).attr('name_menu')+'&value='+$(this).attr('value');
					var loading = '<img src="<?=base_url()?>images/icon/loading.gif" width="15" height="15" >';
					var success = $('.detailTable');
					aJax(linkset,success,loading);
			})
		});
		</script>
	</head>
	<body>
		<div id="wrapper">
			<!-- Navigation -->
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<!-- TOP LEFT -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
				</div>
				
				<!-- Top Right Items -->
				<ul class="nav navbar-right top-nav">
					<?=$this->load->view('admin/template/header.php')?>
				</ul>
				<!-- MAIN MENU -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<?php $this->load->view('admin/template/box/menu.php'); ?>
				</div>
				<!-- /.navbar-collapse -->
			</nav>
			<!-- MAIN CONTAINER -->
			<div id="page-wrapper">
				<div class="container-fluid">
					<?php
						if(!empty($template))
						$this->load->view($template);
					?>
				</div>
			</div>
		</div>
		
		<?php if(isset($_GET["alert"]) && count($_GET["alert"])):?>

		<div class="popup-alert b-r-4 <?=$_GET['alert']?>">
			<div class="content-alert">
				<?=$_GET['alert'] == "updated" || $_GET['alert'] == "added" ? '<i class="fa fa-check"></i>': '<i class="fa fa-times"></i>'?>
				<?=$_GET['alert'] == "updated" ? $language->updated :($_GET["alert"]=="added" ? $language->added : $language->error)?>
			</div>
		</div>

		<?php endif;?>
	</body>
</html>