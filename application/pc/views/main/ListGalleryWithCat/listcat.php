<div id="Projects" >
  <?php if(count($results) > 0):?>
  <?php for($i=0;$i<count($results);$i++):?>
  <div class="<?=$i%2==0 ? "grey" : "white" ?> tb<?=count($results[$i]['data'])?>">
   <table width="100%" cellpadding="0" cellspacing="0" class="Center">
    <tr>
    <td colspan="<?=count($results[$i]['data'])?>" class="htitle"><?=$results[$i]['title']?></td>
    </tr>
    <tr>
      <?php $a = 1;?>
      <?php foreach($results[$i]['data'] as $item):?>
      <?php $cat=explode(',',$item->cat); ?>
      <td class="col<?=$a?>"><a href="<?=base_url().$result_menu['menu']->title_url?>/<?=$item->title_url.'_'.$cat[0].'_'.$item->id.'.html'?>"><div class="boxProject">
          <div class="img"> <img alt="<?=$item->alt_image?>" src="<?=base_url()?>upload/<?=$result_menu['menu']->title_url?>/<?=$item->image?>"> </div>
          <div class="title"><?=$lang=="en" ? $item->title_en : $item->title_vn?></div>
        </div></a></td>
        <?php $a++?>
      <?php endforeach;?>
    </tr>
  </table>
  </div>
  <?php endfor;?>
  <?php endif;?>
</div>
