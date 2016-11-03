<div class="banner-bg CenterContent mBread" id=""><img height="330" src="<?=base_url().'upload/menu/'.$result_menu['menu']->image?>" /></div>
<?=$this->load->view('main/template/breadcrumbs.php')?>
<section id="About">
  <table width="100%" class="Center" cellpadding="0" cellspacing="0">
    <tr>
      <td class="col1" width="230"><ul class="jquery-tabs">
          <?php if($results):?>
          <?php foreach($results as $catitem):?>
          <li><a class="<?=$catitem->id==$item->id ? 'current':""?>" href="<?=base_url().$result_menu['menu']->title_url.'/'.strtolower($catitem->title_url).'_'.$catitem->id.'.html'?>">
            <?=$lang=="en" ? $catitem->title_en : $catitem->title_vn?>
            </a></li>
          <?php endforeach;?>
          <?php endif;?>
        </ul><div id="showcontent" ></div></td>
        
      <td class="col2" id="showcontent" ><div id="showcontent" class="jquery-panes">
           <header><h1><?=$lang=="en" ? $item->title_en :$item->title_vn?></h1></header>
          <div class="paneBlock">
            <?=$readXml['description'] != ''  && count($readXml['description']) != 0? $readXml['description'] : ''?>
          </div>
          <div class="clearfix"></div>
          <div class="navi">
       
        <?php if(intval($item_next->id) != 0):?>
        <a class="more" href="<?=base_url().$result_menu['menu']->title_url.'/'.$item_next->title_url.'_'.$item_next->id.'.html'?>"><i class="fa fa-caret-right"></i></a>
        <?php endif;?>
        <?php if(intval($item_prev->id) != 0):?>
        <a class="more" href="<?=base_url().$result_menu['menu']->title_url.'/'.$item_prev->title_url.'_'.$item_prev->id.'.html'?>"><i class="fa fa-caret-left"></i></a> 
        <?php endif;?>
      </div>
        </div></td>
    </tr>
  </table>
  </div>
</section>

