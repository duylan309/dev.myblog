<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/elfinder2/css/jquery-ui.css">
<script type="text/javascript" src="<?=base_url()?>assets/elfinder2/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/elfinder2/js/jquery-ui.min.js"></script>

<!-- elFinder CSS (REQUIRED) -->
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/elfinder2/css/elfinder.min.css">
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url()?>assets/elfinder2/css/theme.css">

<!-- elFinder JS (REQUIRED) -->
<script type="text/javascript" src="<?=base_url()?>assets/elfinder2/js/elfinder.min.js"></script>
<!-- elFinder translation (OPTIONAL) -->
<script type="text/javascript" src="<?=base_url()?>assets/elfinder2/js/i18n/elfinder.ru.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#elfinder-tag').elfinder({
				url: '<?=base_url()?>admin/upload/run/0/null',
				requestType : 'post',
				
			}).elfinder('instance');
		});
	</script>

<div class="mainMiddle">
  <div id="elfinder-tag"></div>
</div>
<div class="loadding"></div>
