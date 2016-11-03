<table cellpadding="0" cellspacing="0">
<tr>
<td width="341"></td>
<td width="341" valign="bottom" align="center"><a href="<?=base_url()?>"><img class="logo" src="<?=base_url().'images/iconlogo.jpg'?>" /></a></td>
<td width="341">
<div class="search_form">
<?php echo form_open(base_url().'search'); ?>
<input class="search_box" name="search" value="" placeholder="Search..." />

</form>
<div class="search_btn"></div>
</div>
</td>
</tr>
</table>

<script type="text/javascript">
$(document).ready(function() {
    $(".search_btn").click(function(){
		$(".search_form form").submit();
	})
});
</script>