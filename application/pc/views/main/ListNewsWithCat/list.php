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
<section id="subMenu" class="Center">
  <ul class="sub cl0">
    <?php $keyold = 0?>
    <?php if($results_cat != -1):?>
    <?php for($i=0;$i<count($arrMenu);$i++):?>
    <?php if($arrMenu[$i]['getKey']>$keyold):?>
    <ul class="sub cl<?=$arrMenu[$i]['getKey']?>">
      <?=$arrMenu[$i]['list']?>
      <?php endif;?>
      <?php if($arrMenu[$i]['getKey']==$keyold && $i!=0):?>
      </li>
      <?=$arrMenu[$i]['list']?>
      <?php endif;?>
      <?php if($keyold==0 && $i==0):?>
      <?=$arrMenu[$i]['list']?>
      <?php endif;?>
      <?php if($arrMenu[$i]['getKey']<$keyold ):?>
      <div class="clearfix"></div>
      </li>
      <?php if($i!=0):?>
      <?php for($a=0;$a<($keyold-$arrMenu[$i]['getKey']);$a++):?>
    </ul>
    <?php endfor;?>
    <?php endif;?>
    <?=$arrMenu[$i]['list']?>
    <?php endif;?>
    <?php $keyold = $arrMenu[$i]['getKey'];?>
    <?php endfor;?>
    <?php unset($arrMenu);?>
    <?php else:?>
    <li class="current"><a href="#">
      <?=$lang=="en" ? $result_menu['menu']->title_en : $result_menu['menu']->title_vn?>
      </a></li>
    <?php endif;?>
  </ul>
</section>
<div class="clearfix"></div>
<section id="ContainerDetail" class="Center">
  <?php if($results_cat != -1 && $results_hot == -1):?>
  <?=$readXml['description']?>
  <?php elseif($results_hot!=-1):?>
  <?=$this->load->view('main/ListNewsWithCat/listHot.php')?>
  <?php else:?>
  <?=$meta['info']['description']?>
  <?php endif;?>
</section>
<section id="OtherLists" class="Center">
  <?php if($results):?>
  <?php $i=1;?>
  <section id="subMenu" class="Center">
    <ul class="sub cl0">
      <li class="current"> <a href="#">
        <?=$lang=="en" ? 'Other '.$result_menu['menu']->title_en : $result_menu['menu']->title_vn.' Khác'?>
        </a> </li>
    </ul>
  </section>
  <div class="clearfix"></div>
  <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <?php foreach($results as $item):?>
      <?php $readXml = $this->dinosaur_lib->loadXml($lang,'/'.$result_menu['menu']->title_url.'/',$item->id);?>
      <?php if($item->image):?>
      <td class="boxInfo BoxNews <?=$i%3==0 && $i!=1?'lastTd" align="left':''?>"><a style="text-align:left" href="<?=base_url().$result_menu['menu']->title_url.'/'.$item->title_url.'_'.$item->cat.'_'.$item->id.'.html'?>"> </a> <a href="<?=base_url().$result_menu['menu']->title_url.'/'.$item->title_url.'_'.$item->cat.'_'.$item->id.'.html'?>" > <img class="img" alt="<?=$item->alt_image?>" src="<?=base_url()?>upload/<?=$result_menu['menu']->title_url?>/<?=$item->image?>"> </a>
        <h2>
          <?=$lang=="en"?word_limiter($item->title_en,4):word_limiter($item->title_vn,4)?>
        </h2>
        <p class="date">Posted:
          <?=date('d-n-Y',strtotime($item->date))?>
        </p>
        <div class="content-small">
          <?=word_limiter($readXml['content'],20)?>
        </div>
        <?php endif;?>
        <?= $i%3==0  && $i!=1? '</td></tr><tr>' : '</td>'?>
        <?php $i++?>
        <?php endforeach;?>
    <tr>
      <td colspan="2"><div class="pageIndex"> <?php echo $links; ?> </div></td>
    </tr>
  </table>
  <?php endif;?>
</section>
<script type="text/javascript">
$(document).ready(function() {
   
		$('.cl0 li').first().addClass('current');
	
});
</script>