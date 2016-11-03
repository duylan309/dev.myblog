<ul class="nav navbar-nav side-nav menu-left-admin">
  <li class="<?=getParam($this,'page') == "menu" ? "selected" : "" ?>">
    <?=anchor(base_url().ADMINBASE.'?page=menu&action=lists&id=0&function=null', '<i class="fa fa-bars"></i>  Menu' , 'title="Menu"')?>
  </li>
  <li>
    <a data-toggle="collapse" href="#" data-target="#module_home">
      <i class="fa fa-fw fa-arrows-v"></i> Module Home <i class="fa fa-fw fa-caret-down"></i>
    </a>
    <ul id="module_home" class="collapse">
      <li class="<?=getParam($this,'page') == "home_slide" ? "selected" : "" ?>">
        <?=anchor(base_url().ADMINBASE.'?page=home_slide&action=lists&id=0&function=null','<i class="fa fa-angle-right"></i> Slideshow', 'title="Slideshow"')?>
      </li>
      <li class="hidden">
        <?=anchor(base_url().ADMINBASE.'?page=home_content&action=update&id=0&function=Item','<i class="fa fa-angle-right"></i> Home content', 'title="Section Module"')?>
      </li>
    </ul>
  </li>
  <li>
    <a data-toggle="collapse" href="#" data-target="#menu_ariticles">
      <i class="fa fa-fw fa-table"></i> <?=$lang=="en" ? 'Article management' : 'Quản trị bài viết'?> <i class="fa fa-fw fa-caret-down"> </i>
    </a>
    <ul id="menu_ariticles" class="collapse">
      <?php if($AdminMenu):?>
      <?php foreach($AdminMenu as $menu => $value):?>
      <?php if($value->type==2):?>
      <li class="<?=getParam($this,'page') == $value->title_url ? "selected" : "" ?>">
        <?=anchor(base_url().ADMINBASE.'?page='.$value->title_url.'&action=lists&id=0&function=null', $lang=="en" ?$value->title_en: $value->title_vn , 'title="'.$value->title_en.'"')?>
      </li>
      <?php unset($AdminMenu[$menu])?>
      <?php elseif($value->type==3):?>
      <li class="<?=getParam($this,'page') == $value->title_url ? "selected" : "" ?>">
        <?=anchor(base_url().ADMINBASE.'?page='.$value->title_url.'&action=lists&id=0&function=null', $lang=="en" ?$value->title_en: $value->title_vn , 'title="'.$value->title_en.'"')?>
      </li>
      <li class="<?=getParam($this,'page') == $value->title_url.'_cat' ? "selected" : "" ?>">
        <?=anchor(base_url().ADMINBASE.'?page='.$value->title_url.'_cat&action=lists&id=0&function=null', $lang=="en" ? $value->title_en.' Categories': 'Danh mục '.$value->title_vn , 'title="'.$value->title_en.'"')?>
      </li>
      <?php endif;
      endforeach;
      endif;?>
    </ul>
  </li>
  
  <li class="hidden">
    <a data-toggle="collapse" href="#" data-target="#menu_gallery">
      <i class="fa fa-fw fa-table"></i>
      <?=$lang=="en" ? 'Gallery management' : 'Quản trị thư viện ảnh'?>
      <i class="fa fa-fw fa-caret-down"> </i>
    </a>
    <ul id="menu_gallery" class="collapse">

      <?php if($AdminMenu):?>
        <?php foreach($AdminMenu as $menu => $value):?>
          <?php if($value->type==4 || $value->type == 5):?>
          <li class="<?=getParam($this,'page') == $value->title_url ? "selected" : "" ?>">
             <?=anchor(base_url().ADMINBASE.'?page='.$value->title_url.'&action=lists&id=0&function=null', $lang=="en" ?$value->title_en: $value->title_vn , 'title="'.$value->title_en.'"')?>
          </li>
          <?php unset($AdminMenu[$menu])?>
          <?php endif;
        endforeach;
      endif;?>
    </ul>
  </li>

  <li>
    <a data-toggle="collapse" href="#" data-target="#menu_other">
      <i class="fa fa-fw fa-table"></i>
      <?=$lang=="en" ? 'Other Table' : 'Quản trị cài đặt riêng'?>
      <i class="fa fa-fw fa-caret-down"> </i>
    </a>
    <ul id="menu_other" class="collapse">
      <?php if($AdminMenu):?>
        <?php foreach($AdminMenu as $menu => $value):?>
          <?php if($value->type==10 && $value->table_control !=FOLDERCONTROLCONTACT && $value->no_sql != 1):?>
          
          <?php if($value->table_control == 'car_value'){?>
          <li class="<?=getParam($this,'page') == $value->table_control ? "selected" : "" ?>"> <?=anchor(base_url().ADMINBASE.'?page='.$value->table_control.'&action=update&id=0&function=add', $lang=="en" ?$value->title_en: $value->title_vn , 'title="'.$value->title_en.'"')?></li>
          <?php }else{?>
          <li class="<?=getParam($this,'page') == $value->table_control ? "selected" : "" ?>"> <?=anchor(base_url().ADMINBASE.'?page='.$value->table_control.'&action=lists&id=0&function=null', $lang=="en" ?$value->title_en: $value->title_vn , 'title="'.$value->title_en.'"')?></li>
          <?php }?>

          <?php unset($AdminMenu[$menu])?>
          <?php endif;
        endforeach;
      endif;?>
    </ul>
  </li>

  <?php if($AdminMenu):?>
  <?php foreach($AdminMenu as $menu):?>
  <?php if( $menu->type==10 && $menu->table_control == FOLDERCONTROLCONTACT):?>
  <li class="<?=getParam($this,'page') == $value->table_control ? "selected" : "" ?>">
    <a data-toggle="collapse" href="#" data-target="#menu_contact">
      <i class="fa fa-fw fa-envelope"></i>
      <?=$lang=="en" ? " Contact management" : "Quản trị liên hệ"?>
      <i class="fa fa-fw fa-caret-down"> </i>
    </a>
    <ul id="menu_contact" class="collapse">
      <li class="<?=getParam($this,'page') == $menu->table_control ? "selected" : "" ?>">
        <?=anchor(base_url().ADMINBASE.'?page='.$menu->table_control.'&action=lists&id=0&function=null', $lang=="en"?"<i class='fa fa-dowload'></i> Inbox" :"<i class='fa fa-download'></i> Hộp thư" , 'title="'.$menu->title_en.'"')?>
      </li>
      <li class="<?=getParam($this,'page') == "contact_content" ? "selected" : "" ?>">
        <?=anchor(base_url().ADMINBASE.'?page=contact_content&action=update&id=0&function=Item', '<i class="fa fa-angle-right"></i>  Nội dung liên hệ', 'title="Nội dung trang chủ"')?>
      </li>
    </ul>
  </li>
  <?php endif;?>
  <?php endforeach;?>
  <?php endif;?>
 
  <li class="hidden">
    <?=anchor(base_url().ADMINBASE.'?page=upload&action=lists&id=0&function=null', '<i class="fa fa-upload"></i>  Upload' , 'title="Upload"')?>
  </li>
 
  <li>
    <a data-toggle="collapse" href="#" data-target="#menu_config">
      <i class="fa fa-fw fa-cog"></i>
      <?php echo $language->WEBCONFIG;?>
      <i class="fa fa-fw fa-caret-down"> </i>
    </a>
    <ul id="menu_config" class="collapse">
      <li class="<?=$page=='config_content' ? "selected" : ""?>">
        <?=anchor(base_url().ADMINBASE.'?page=config_content&action=update&id=0&function=Item', $lang=="en" ? '<i class="fa fa-wrench"></i> General setting': '<i class="fa fa-wrench"></i> Cài đặt chung' , 'title="'.$language->WEBCONFIG.'"')?>
      </li>
      <li class="<?=$page=='adminuser' ? "selected" : ""?>">
        <?=anchor(base_url().ADMINBASE.'?page=adminuser&action=lists&id=0&function=null', '<i class="fa fa-user"></i>  '.$language->HOMEADMIN , 'title="'.$language->HOMEADMIN.'"')?>
        
      </li>
    </ul>
  </li>
</ul>