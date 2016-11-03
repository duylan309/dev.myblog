<div id="Projects" class="otherp">
  <?php if(count($listOthers) > 0 && $listOthers):?>
  <div class="white homeproject tb3">
    <table width="100%" cellpadding="0" cellspacing="0" class="Center">
      <tr>
        <td  class="htitle"><?=$lang=='en' ? 'Others '.$result_menu['menu']->title_en : $result_menu['menu']->title_vn.' Khác'?></td>
      </tr>
      <tr>
        <td><?php $a = 1;?>
          <?php if(count($listOthers)<4):?>
          <?php foreach($listOthers as $item):?>
          <?php $cat=explode(',',$item->cat); ?>
          <div class="boxProject col<?=$a?>">
            <div class="img CenterContent"> <img alt="<?=$item->alt_image?>" src="<?=base_url()?>upload/<?=$result_menu['menu']->title_url?>/<?=$item->image?>">
              <div class="morehover CenterContent"><a class="rmore" href="<?=base_url().$result_menu['menu']->title_url?>/<?=$item->title_url.'_'.$cat[0].'_'.$item->id.'.html'?>">
                <?=$lang=="en" ? "Read more" : "Xem thêm"?>
                </a></div>
            </div>
            <div class="title"> <a href="<?=base_url().$result_menu['menu']->title_url?>/<?=$item->title_url.'_'.$cat[0].'_'.$item->id.'.html'?>">
              <?=$lang=="en" ? $item->title_en : $item->title_vn?>
              </a> </div>
          </div>
          <?php $a++?>
          <?php endforeach;?>
          <div class="clearfix"></div>
          <?php else:?>
          <div class="jcarousel-wrapper slideshowHome">
            <div class="jcarousel">
              <ul>
                <?php if(isset($listOthers)):?>
                <?php foreach($listOthers as $item):?>
                <?php $cat=explode(',',$item->cat); ?>
                <li>
                  <div class="boxProject col">
                    <div class="img CenterContent"> <img alt="<?=$item->alt_image?>" src="<?=base_url()?>upload/<?=$result_menu['menu']->title_url?>/<?=$item->image?>">
                      <div class="morehover CenterContent"><a class="rmore" href="<?=base_url().$result_menu['menu']->title_url?>/<?=$item->title_url.'_'.$cat[0].'_'.$item->id.'.html'?>">
                        <?=$lang=="en" ? "Read more" : "Xem thêm"?>
                        </a></div>
                    </div>
                    <div class="title"> <a href="<?=base_url().$result_menu['menu']->title_url?>/<?=$item->title_url.'_'.$cat[0].'_'.$item->id.'.html'?>">
                      <?=$lang=="en" ? $item->title_en : $item->title_vn?>
                      </a> </div>
                  </div>
                </li>
                <?php endforeach;?>
                <?php endif;?>
              </ul>
            </div>
            <a href="#" class="jcarousel-control-prev">&lsaquo;</a> <a href="#" class="jcarousel-control-next">&rsaquo;</a> </div>
          <div class="clearfix"></div>
          <?php endif;?></td>
      </tr>
    </table>
  </div>
  <?php endif;?>
</div>
