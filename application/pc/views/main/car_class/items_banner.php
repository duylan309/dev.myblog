
<?php if(isset($images_banner) && $images_banner):?>
<div id="carousel" class="carousel slide" data-ride="carousel">
	<div class="class-car-content-banner">
		<?=isset($readXml['more']["content"]) && count($readXml['more']["content"]) ? $readXml['more']["content"] : ''?>
	</div>
	<!-- Indicators -->
	<?php if(isset($images_banner)):?>
	<ol class="carousel-indicators">
		<?php for($i=0;$i<count($images_banner);$i++):?>
		<li data-target="#carousel" data-slide-to="<?=$i?>" <?=$i==0 ? 'class="active"' : ""?>></li>
		<?php endfor;?>
	</ol>
	<?php endif;?>
	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">
		<?php if(isset($images_banner)):?>
		<?php $i=0; foreach($images_banner as $banner):?>
		<div class="item <?=$i==0? "active":""?>">
			<div class="fullscreen banner-wrap background-cover-center item-background c-center" 
				 style="background:url(<?=base_url()?>upload/storage/<?=$FOLDERCONTROL?>/<?=$FOLDERCONTROL?>_banner/<?=$item->id?>/<?=$banner->title_url?>) no-repeat">
			</div>
		</div>

		<?php if(is_file('./upload/menu/'.$result_menu['menu']->image) && $page != 'home'):?>
		
		<?php endif;?>

		<?php $i++; endforeach;?>
		<?php endif;?>
	</div>
	<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('.carousel').carousel({
		interval : 4000,
		keyboard : true
		});
});
</script>
<?php endif;?>

