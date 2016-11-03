<div id="ListService" class="Center">
  <aside class="submenu-dichvu">
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
  <div class="tableService">
    <div class="asidemenu">
      <ul class="jquery-tabs-1">
        <?php if($results):?>
        <?php foreach($results as $item):?>
        <li>
          <?=$lang=='en' ? $item->title_en : $item->title_vn?>
        </li>
        <?php endforeach;?>
        <?php endif;?>
      </ul>
    </div>
    <div class="jquery-panes-1">
      <?php if($results):?>
      <?php foreach($results as $item):?>
      <?php $readXml = $this->dinosaur_lib->loadXml($lang,'/'.$result_menu['menu']->title_url.'/',$item->id);?>
      <div class="paneBlock-1">
        <?=$readXml['description']?>
      </div>
      <?php endforeach;?>
      <?php unset($results);?>
      <?php endif;?>
    </div>
  </div>
</div>

<div class="clearfix"></div>