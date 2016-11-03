<section id="Menu_food">
  <div class="bgblack"></div>
  <div class="left_arr"></div>
  <div class="right_arr"></div>
  <div id="makeMeScrollable">
  
    <?php if($results_menu_items!=-1):?>
    <?php if($results_menu_items_tab!=-1):?>
    <?php for($i=0;$i<count($results_menu_items_tab);$i++):?>
    <div class="FoodBox">
    <div class="img-header"><img src="<?=base_url().'upload/'.$result_menu['menu']->title_url.'/'.$results_menu_items_tab[$i]['image']?>" alt="<?=$results_menu_items_tab[$i]['alt_image']?>" width="386" height="172" /></div>
      <div class="hbox" style="background:<?=$results_menu_items_tab[$i]['color']?>;color:<?=$results_menu_items_tab[$i]['font_color']?>">
        <div class="title_vn">
          <?=$results_menu_items_tab[$i]['title_en']?> <span><img src="<?=base_url()?>images/icon-dishes.png" width="18" height="19" /></span> <?=$results_menu_items_tab[$i]['title_vn']?>
        </div>
       
      </div>
      <table class="foodTable" cellpadding="0" cellspacing="0" width="100%">
        <?php foreach($results_menu_items_tab[$i]['lists'] as $item_tab):?>
        <tr>
          <td width="85%" valign="top" align="left">
          <p class="tjp"><?=$item_tab->title_jp?></p>
          <p class="tvn">
              <?=$lang=="en" ? $item_tab->title_en : $item_tab->title_vn?>
            </p>
            <p class="ten">
              <?=$lang=="en" ? $item_tab->title_vn : $item_tab->title_en?>
            </p></td>
          <td width="15%" valign="top" align="right" ><p class="price">
              <?=$item_tab->price?>
              K</p></td>
        </tr>
        <?php endforeach;?>
      </table>
    </div>
    <?php endfor;?>
    <?php endif;?>
    <?php endif;?>
  </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?=asset_url()."style/main/smoothDivScroll.css"?>" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="<?=asset_url()?>javascript/daili//jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?=asset_url()?>javascript/daili//jquery.mousewheel.min.js" type="text/javascript"></script></script>
<script src="<?=asset_url()?>javascript/daili/jquery.kinetic.min.js" type="text/javascript"></script> 
<script src="<?=asset_url()?>javascript/daili/jquery.smoothdivscroll.min.js" type="text/javascript"></script> 
<script type="text/javascript">
$(document).ready(function() {	
			$("div#makeMeScrollable").smoothDivScroll({
			  // touchScrolling: true,
			   hotSpotScrolling: true
			});
			
			$('#makeMeScrollable').css({'width':($(window).width()-1136)/2-173-20+1136});
			
			$(window).resize(function() {
                $('#makeMeScrollable').css({'width':($(window).width()-1136)/2-173-20+1136});
				//$('.scrollableArea').animate({left:positionDiv.left-305}, 800);
            });
			
			
			$(".right_arr").click(function() {
			  $("#makeMeScrollable").smoothDivScroll("move", 305);
			
			});
			
			$(".left_arr").click(function() {
			  $("#makeMeScrollable").smoothDivScroll("move", -305);   
			});
			
			
			
});
</script>
<style>
.FoodBox{cursor:pointer}
.foodTable{opacity:0.1}
.FoodBox:hover .foodTable{opacity:1}
.up{position:fixed;bottom:100px;width:100px;height:100px;cursor:pointer}
.bgblack{width:100%;height:100%;position:absolute;z-index:1000;left:0;top:0}
</style>
