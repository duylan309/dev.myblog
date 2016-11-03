<div class="fullscreen banner-wrap background-cover-top background-small" style="background:url(<?=base_url().'upload/menu/'.$result_menu['menu']->image?>) no-repeat">
  <div class="container">
    <div class="banner">
      
    </div>
  </div>
</div>

<div class="container container-section simple-gallery">
  <div class="row">
  <?php if($results_gallery):?>
  <?php $i=1?>
  <?php foreach($results_gallery as $itemabout):?>
  <div class="item col-sm-4">
   <a class="fancybox" 
      data-fancybox-group="gallery"
      href="<?=base_url()?>upload/storage/menu/<?=$result_menu['menu']->id?>/<?=$itemabout->title_url?>"> 
    <img class="img-responsive" src="<?=base_url()?>upload/storage/menu/<?=$result_menu['menu']->id?>/<?=$itemabout->title_url?>" alt="<?=$itemabout->alt_image?>">
   </a> 
  </div>

  <?php $i++?>
  <?php endforeach;?>
  </div>
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


<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?=asset_url()?>style/main/jquery.fancybox.css?v=2.1.5" media="screen" />
<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?=asset_url()?>style/main/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.fancybox-buttons.js?v=1.0.5"></script> 
<script type="text/javascript">
            $(document).ready(function() {
                 
              $('.fancybox').fancybox({
        openEffect  : 'none',
        closeEffect : 'none',
        autoScale: true,
 // if fancybox 2.x
        fitToView: true,
        prevEffect : 'none',
        nextEffect : 'none',
        maxWidth: $(document).innerWidth()-80,
      // minHeight: 1050,
        closeBtn  : false,

        helpers : {
          title : {
            type : 'inside'
          },
          buttons : {}
        },

        afterLoad : function() {
          this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
        }
      });
});
</script>

