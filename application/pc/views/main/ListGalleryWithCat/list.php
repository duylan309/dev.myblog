<div id="Projects" >
  <?php if(count($results) > 0):?>
  <div class="table Center">
    <?php $a = 1;?>
    <?php foreach($results as $item):?>
    <?php $cat=explode(',',$item->cat); ?>
    <div class="boxProject col<?=$a?>">
      <div class="title"> <a href="<?=base_url().$result_menu['menu']->title_url?>/<?=$item->title_url.'_'.$cat[0].'_'.$item->id.'.html'?>">
        <?=$lang=="en" ? $item->title_en : $item->title_vn?>
        </a> </div>
      <div class="img CenterContent"> <img alt="<?=$item->alt_image?>" src="<?=base_url()?>upload/<?=$result_menu['menu']->title_url?>/<?=$item->image?>">
      <div class="morehover CenterContent"><a class="rmore" href="<?=base_url().$result_menu['menu']->title_url?>/<?=$item->title_url.'_'.$cat[0].'_'.$item->id.'.html'?>"><?=$lang=="en" ? "Read more" : "Xem thêm"?></a></div>
       </div>
    </div>
 
  <?php $a++?>
  <?php $a==5 ? $a=1 : $a?>
  <?php endforeach;?>
  <div class="clearfix"></div>
 
  <?php if($links):?>
  <div class="pageIndex"> <?php echo $links; ?> </div>
  <?php endif;?>
</div>
<?php endif;?>
</div>
