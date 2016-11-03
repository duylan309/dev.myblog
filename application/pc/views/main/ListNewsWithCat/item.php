<section id="Banner">
  <?php if(!empty($result_menu['menu']->image)):?>
 <div class="bg-images"> <img width="100%" src="<?=base_url().'upload/menu/'.$result_menu['menu']->image?>" />
    <div class="titleImage">
      <div class="tt">
        <?=$lang=="en" ? $result_menu['menu']->image_title_en:$result_menu['menu']->image_title_vn?>
      </div>
      <div class="ct">
        <?=$lang=="en" ? $result_menu['menu']->image_content_en : $result_menu['menu']->image_content_vn?>
      </div>
    </div>
  </div>
  <?php endif;?>
</section>
<div class="clearfix"></div>
<table width="100%" cellpadding="0" cellspacing="0" class="Center">
  <tr>
    <td><section id="ContainerDetail" class="ContentDetail">
        <h1>
          <?=$lang=="en" ? $item->title_en : $item->title_vn?>
        </h1>
        <p class="date">
          <?=date('d F, Y',strtotime($item->date))?>
        </p>
        <br />
        <article>
          <div class="content">
            <?=$readXml['description']?>
          </div>
          <br />
          <div class="clearfix"></div>
        </article>
      </section></td>
    <td width="217"><div class="RightColumn">
        <section id="OtherLists">
          <?php if($results):?>
          <?php $i=1;?>
          <section id="subMenu" >
            <ul class="sub cl0">
              <li class="current"> <a href="#">
                <?=$lang=="en" ? 'Other '.$result_menu['menu']->title_en : $result_menu['menu']->title_vn.' Khác'?>
                </a> </li>
            </ul>
          </section>
          <div class="clearfix"></div>
          <table width="100%" cellspacing="0" cellpadding="0" >
            <?php foreach($results as $item):?>
            <?php $readXml = $this->dinosaur_lib->loadXml($lang,'/'.$result_menu['menu']->title_url.'/',$item->id);?>
            <?php if($item->image):?>
            <tr>
              <td class="boxInfo BoxNews" style="padding-bottom:10px"><a style="text-align:left" href="<?=base_url().$result_menu['menu']->title_url.'/'.$item->title_url.'_'.$item->cat.'_'.$item->id.'.html'?>">
                <h2 style="margin-bottom:0">
                 <?=$lang=="en"?word_limiter($item->title_en,4):word_limiter($item->title_vn,4)?>
                </h2>
                <p class="date" style="margin-bottom:5px">
                  <?=$lang=="en" ? 'Posted: '.date('d-n-Y',strtotime($item->date)) : 'Đăng ngày: '.date('d-n-Y',strtotime($item->date))?>
                </p>
                </a> <a href="<?=base_url().$result_menu['menu']->title_url.'/'.$item->title_url.'_'.$item->cat.'_'.$item->id.'.html'?>" > <img class="img" alt="<?=$item->alt_image?>" src="<?=base_url()?>upload/<?=$result_menu['menu']->title_url?>/<?=$item->image?>"> </a>
                <?php endif;?></td>
            </tr>
            <?php $i++?>
            <?php endforeach;?>
            <tr>
              <td colspan="2"><div class="pageIndex"> <?php echo $links; ?> </div></td>
            </tr>
          </table>
          <?php endif;?>
        </section>
      </div></td>
  </tr>
</table>
