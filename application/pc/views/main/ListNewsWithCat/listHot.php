<div class="jcarousel-wrapper" style="margin-bottom:25px">
  <div class="jcarousel slideNews">
    <ul>
      <?php foreach($results_hot as $hot_item):?>
      <?php $readXml_hot = $this->dinosaur_lib->loadXml($lang,'/'.$result_menu['menu']->title_url.'/',$hot_item->id);?>
      <li>
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td width="435"><a href="<?=base_url().$result_menu['menu']->title_url.'/'.$hot_item->title_url.'_'.$hot_item->cat.'_'.$hot_item->id.'.html'?>">
              <div class="img"><img width="435" height="315" src="<?=base_url()?>upload/<?=$result_menu['menu']->title_url?>/<?=$hot_item->image?>"></div>
              </a></td>
            <td><div class="slideNewsRight">
                <div class="title">
                  <?=$lang=="en" ? $hot_item->title_en : $hot_item->title_vn?>
                </div>
                <div class="date">Post:
                  <?=date('d F,Y',strtotime($hot_item->date))?>
                </div>
                <div class="detail">
                  <?=$readXml_hot['content']?>
                </div>
              </div></td>
          </tr>
        </table>
      </li>
      <?php endforeach;?>
    </ul>
  </div>
  <a href="#" class="jcarousel-control-prev">&lsaquo;</a> <a href="#" class="jcarousel-control-next">&rsaquo;</a> </div>
<div class="clearfix"></div>
