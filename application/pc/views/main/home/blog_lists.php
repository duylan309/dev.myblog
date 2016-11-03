<?php if(isset($results_blogs) && count($results_blogs)):?>
<div class="blogs">	
<?php foreach($results_blogs as $blog):?>
<?php $readXml = $this->dinosaur_lib->loadDataXml(SOURCEXML.$lang.XMLBLOG,$blog->id);?>

<div class="blog">
	<div class="row">
		<div class="col-sm-3">
			<div class="img">
				<a title="<?=$lang=="en" ? $blog->title_en : $blog->title_vn?>" href="<?=base_url().$blog->title_url.'_'.$blog->id.EXTENSION?>" title="<?=$lang=="en" ? $blog->title_en : $blog->title_vn?>">
					<img alt="<?=$blog->alt_image?>" class="img-responsive" src="<?=IMAGEBLOG.$blog->image?>">
				</a>
			</div>
		</div>
		<div class="col-sm-9">
			<div class="content">
				<h2>
					<a title="<?=$lang=="en" ? $blog->title_en : $blog->title_vn?>" class="text-color1" href="<?=base_url().$blog->title_url.'_'.$blog->id.EXTENSION?>" title="<?=$lang=="en" ? $blog->title_en : $blog->title_vn?>">
						<?=$lang=="en" ? $blog->title_en : $blog->title_vn?>
					</a>
				</h2>
				<div class="description">
					<?=isset($readXml['content']) && !is_array($readXml['content']) ? ($lang=="en" ? word_limiter($readXml['content'],15) : word_limiter($readXml['content'],30)) : ''?>
				</div>
			</div>
		</div>
	</div>		
</div>
<?php endforeach;?>
</div>
<?php endif;?>	
<?=isset($links) && count($links) ? $links : ''?>
