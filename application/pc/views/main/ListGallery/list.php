<div id="Gallery">
  <?php if($results_gallery):?>
  <?php $i=1?>
  <?php foreach($results_gallery as $itemabout):?>
  <div class="box col<?=$i?>">
  <a class="fancybox" href="<?=base_url().$menu_gallery->title_url.'/'.$itemabout->title_url.'_'.$itemabout->id.'.html'?>">
  <div class="boxGallery">
    <div class="img"> <img alt="<?=$itemabout->alt_image?>" src="<?=base_url()?>upload/<?=$menu_gallery->title_url?>/<?=$itemabout->image?>"> </div>
    <div class="overplay">
      <div class="title">
        <?=$lang=="en" ? $itemabout->title_en : $itemabout->title_vn?>
      </div>
    </div>
  </div>
  </a>
  </div>
  <?php $i++?>
  <?php endforeach;?>
  <?php unset($results);?>
 <div class="clearfix"></div>
  <?php if($links):?>
  <div class="Center" style="text-align:right;padding:50px 0">
    <div class="pageIndex"> <?php echo $links; ?> </div>
  </div>
  <?php endif;?>
  <?php endif;?>
</div>
<input class="page_get" type="hidden" name="getpage" value="0" />
