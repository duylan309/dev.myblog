<div class="class_cars_section_other class_car_style">
  <div class="container">
  <?php if(isset($results_car_style) && count($results_car_style)):?>
  <?php foreach($results_car_style as $style):?>
  <div class="row">
   <header class="col-sm-12"><p><?=$lang=="en" ? $style->title_en : $style->title_vn?></p></header>
   <div class="clearfix"></div>
    <?php if(isset($results_car_class) && count($results_car_class)):?>
      <?php foreach($results_car_class as $key => &$class):?>
        <?php if($class->cat == $style->id):?>
        <a href="<?=base_url().$link_car_class.'/'.$class->title_url.'_'.$class->id.EXTENSION?>" data-target="#<?=$class->title_url?>">
          <div class="item-class-car-other background-cover-top col-sm-6" class="dropdown"
            style="background:url(<?=isset($class->image_other) && !empty($class->image_other) ? base_url().'upload/images/'.$class->image_other : base_url().'/images/default-image-thumb.jpg'?>) no-repeat">
            <div class="content">
              <div class="price"><p><?=$lang=="en" ? "Price From" : "Giá Từ"?></p><?=$class->price?></div>
              
              <?=$lang=='en' ? $class->title_en : $class->title_vn?>
            </div>
            
          </div>
        </a>
        <?php unset($results_car_class[$key]); endif;?>
      <?php endforeach;?>  
    <?php endif;?>
  </div>

  <?php endforeach;?>  
  <?php endif;?>  

   
  </div>
</div>

