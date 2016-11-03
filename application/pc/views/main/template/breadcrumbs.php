
<?php if($page!='home' && $page!=''):?>
<div id="breadcrumb">
  <header class="Center"><a href="<?=base_url()?>">
    <?=$lang=="en" ? "Home" : "Trang chủ"?>
    </a>
    <?php if(isset($page)):?>
    <i class="fa fa-caret-right"></i>
    <a href="<?=base_url().$result_menu['menu']->title_url?>">
    <?=$lang=="en" ? $result_menu['menu']->title_en : $result_menu['menu']->title_vn?>
    </a>
    <?php endif;?>
    <?php if(isset($item_cat)):?>
    <i class="fa fa-caret-right"></i>
    <a href="#>">
    <?=$lang=='en' ? $item_cat->title_en : $item_cat->title_vn?>
    </a>
    <?php endif;?>
    <?php if(isset($item)):?>
     <i class="fa fa-caret-right"></i>
    <a href="#">
    <?=$lang=='en' ? $item->title_en : $item->title_vn?>
    </a>
    <?php endif;?>
    <div class="clearfix"></div>
    
    </header>
</div>
<?php endif;?>