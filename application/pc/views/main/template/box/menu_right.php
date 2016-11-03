<?php foreach($listMenu as $menu => &$key):?>
<?php if($key->parent == 0 || $key->parent == 1):?>
<li current-menu="<?=$key->title_url?>" class="<?=$key->title_url==$page?'selected':''?> dropdown">
  <a href="<?=$key->type != 9 ? base_url().$key->title_url : $key->title_url?>" data-target="#<?=$key->title_url?>">
    <?=$lang=='en' ? $key->title_en : $key->title_vn?>
  </a>
  <?php $getSubData = $this->dinosaur_lib->_getSubMenu($listMenu,$key->id,$key->title_url,base_url(),$lang);
  echo $getSubData["string"];
  
  if( count( $getSubData["key"] ) > 0){
    foreach ($getSubData["key"] as $unset_key) {
      unset($listMenu[$unset_key]);
    }
  }
  ?>
</li>
<?php unset($listMenu[$menu]);
endif;?>
<?php endforeach;?>