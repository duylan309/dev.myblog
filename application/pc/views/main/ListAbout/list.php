<div class="banner-bg CenterContent mBread"><img height="330" src="<?=base_url().'upload/menu/'.$result_menu['menu']->image?>" /></div>
<?=$this->load->view('main/template/breadcrumbs.php')?>
<section id="About">
  <table width="100%" class="Center" cellpadding="0" cellspacing="0">
    <tr>
      <td class="col1" width="230"><ul class="jquery-tabs">
          <?php if($results):?>
          <?php foreach($results as $item):?>
          <li><a class="" href="<?=base_url().$result_menu['menu']->title_url.'/'.strtolower($item->title_url).'_'.$item->id.'.html'?>">
            <?=$lang=="en" ? $item->title_en : $item->title_vn?>
            </a></li>
          <?php endforeach;?>
          <?php endif;?>
        </ul></td>
      <td class="col2" ><div class="jquery-panes">
          <?php $readXml = $this->dinosaur_lib->loadXml($lang,'/'.$result_menu['menu']->title_url.'/',$results[0]->id);?>
          <header><h1><?=$lang=="en" ? $results[0]->title_en :$results[0]->title_vn?></h1></header>
          <div class="paneBlock">
            <?=$readXml['description'] != ''  && count($readXml['description']) != 0? $readXml['description'] : ''?>
          </div>
          <div class="clearfix"></div>
          
          <div class="navi">
       
        <?php if(intval($item_next->id) != 0):?>
        <a class="more" href="<?=base_url().$result_menu['menu']->title_url.'/'.$item_next->title_url.'_'.$item_next->id.'.html'?>">&nbsp;<i class="fa fa-caret-right"></i></a>
        <?php endif;?>
        
         <?php if(intval($item_prev->id) != 0):?>
        <a class="more" href="<?=base_url().$result_menu['menu']->title_url.'/'.$item_prev->title_url.'_'.$item_prev->id.'.html'?>">&nbsp; <i class="fa fa-caret-left"></i>&nbsp;</a> 
        <?php endif;?>
      </div>
        </div></td>
    </tr>
  </table>
  </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
//    $("ul.jquery-tabs").tabs("div.jquery-panes > div");
      $('.jquery-tabs li a').first().addClass('current');
});
</script> 
