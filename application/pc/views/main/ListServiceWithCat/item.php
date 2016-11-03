<div id="ListArticles" class="Center">
  <aside class="submenu">
    <div class="title-sub">Danh Mục</div>
    <ul>
      <?php $keyold =0?>
      <?php if($arrMenu):?>
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
      <?php endif;?>
    </ul>
  </aside>
  <div class="tableArticles">
    <div class="boxSectionArticle">
      <div class="title">
        <h4>
          <?=$item->title_en?>
        </h4>
      </div>
      <p class="date">
        <?=$lang=="en" ? 'Date: ' : 'Ngày : '?>
        <?=date('d/m/Y',strtotime($item->date))?>
      </p>
      <div class="img"> <a href="<?=base_url().$result_menu['menu']->title_url.'/'.$item->title_url.'_'.$item->cat.'_'.$item->id.'.html'?>" > <img alt="<?=$item->alt_image?>" src="<?=base_url()?>upload/<?=$result_menu['menu']->title_url?>/<?=$item->image?>"> </a></div>
      <div class="caption">
        <p>
          <?=$readXml['description']?>
        </p>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
<div id="SimplePage"> <br>
</div>
