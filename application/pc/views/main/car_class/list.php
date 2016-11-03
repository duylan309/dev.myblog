<div class="container-section">
  <div class="row">
    <div class="col-sm-12">
      <div id="" class="class_cars_lists_no_slide">
        <div class="class_cars_section">
          <?php if(isset($car_class_menu) && count($car_class_menu)):?>
            
            <div class="container">
              <?php $i=0; foreach($car_class_menu as $menu => $key):?>
              <?=$i == 0 ? ( $menu == 0 ? '<div  class="col-car data-first">' :'<div  class="col-car">') : ''?>
                
                <div class="item-class-car" class="dropdown">
                  <div class="img">
                    <img class="img-reponsive" src="<?=base_url().'upload/'.FOLDERCONTROLCARCATEGORY.'/'.$key->image?>">
                  </div>
                  <a href="#" data-target="#<?=$key->title_url?>">
                    <?=$lang=='en' ? $key->title_en : $key->title_vn?>
                  </a>
                    <p><?=$lang=='en' ? $key->style_title_en : $key->style_title_vn?></p>

                </div>  

              <?=$i == 1 ? '</div>' : ''?>
              <?php $i = $i == 1 ? 0 : $i+1; endforeach; unset($key)?>
            </div>
          <?php endif;?>
        </div>
      </div>
    </div>  
</div>

