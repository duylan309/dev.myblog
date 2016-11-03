<script type="text/javascript" src="<?=asset_url()?>javascript/jcarousel.connected-carousels.js"></script>
<?php if($listImage):?>

<div class="connected-carousels">
  <div class="stage">
    <div class="carousel carousel-stage">
      <ul>
        <?php  foreach($listImage as $img):?>
        <li> <a class="fancybox" data-fancybox-group="gallery" href="<?=base_url()?>upload/storage/<?=$page?>/<?=$item->id?>/<?=$img->name?>" ><img alt="<?=$img->alt_image?>" width="" height="" src="<?=base_url()?>upload/storage/<?=$result_menu['menu']->title_url.'/'.$item->id.'/'.$img->name?>"> </a></li>
        <?php endforeach;?>
      </ul>
    </div>
     <a href="#" class="jcarousel-control-prev">&lsaquo;</a> <a href="#" class="jcarousel-control-next">&rsaquo;</a>
  </div>
</div>

<?php endif;?>
