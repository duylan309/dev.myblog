<div class="class_cars_section_other">
    <header>
      <p><?=$lang=="en" ? "Other cars" : "Có thể bạn quan tâm"?></p>
    </header>
  <?php if(isset($results) && count($results)):?>
    <div href="#" move-left><i class="fa fa-chevron-left"></i></div>
    <div href="#" move-right><i class="fa fa-chevron-right"></i></div>
    <div class="container">
      <?php $i=0; foreach($results as $menu => $item):?>
       
        <div class="item-class-car-other background-cover-top" class="dropdown"
              style="background:url(<?=isset($item->image_other) && !empty($item->image_other) ? base_url().'upload/images/'.$item->image_other : base_url().'/images/default-image-thumb.jpg'?>) no-repeat">
          <div class="content">
            <div class="price"><p><?=$lang=="en" ? "Price From" : "Giá Từ"?></p><?=$item->price?></div>        
    
            <a href="<?=base_url().$result_menu['menu']->title_url.'/'.$item->title_url.'_'.$item->id.EXTENSION?>" data-target="#<?=$item->title_url?>">
              <?=$lang=='en' ? $item->title_en : $item->title_vn?>
            </a>

          </div>
        </div> 

      <?php $i = $i == 1 ? 0 : $i+1; endforeach; unset($item)?>
    </div>
  <?php endif;?>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    $(".class_cars_section_other .container").smoothDivScroll({
      hotSpotScrolling: false,
      touchScrolling: false,
      manualContinuousScrolling: false,
      mousewheelScrolling: false,
      scrollToEasingFunction: "easeOutCirc",
    });

    $('[move-left]').click(function(event) {
          $(".class_cars_section_other .container").smoothDivScroll("move", -324);
    });

    $('[move-right]').click(function(event) {
          $(".class_cars_section_other .container").smoothDivScroll("move", 324);
    });

    $('.class_cars_section_other .item-class-car-other').click(function() {
      var link = $(this).find('a').attr('href');
      location.href = link;
    }); 

  });
</script>
