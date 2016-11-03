<link href="<?=asset_url()."style/main/jquery.jscrollpane.css"?>" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<?=asset_url()?>javascript//jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.jscrollpane.min.js"></script>
<?=$this->load->view('main/template/breadcrumbs.php')?>
<div id="Projectsdetail">
  <div class="Center">
    <div class="left"> 
      <!--- SLIDESHOW -->
      <?=$this->load->view('main/ListGalleryWithCat/gallery.php');?>
    </div>
    <div class="right">
      <h1>
        <?=$lang=="en" ? $item->title_en : $item->title_vn?>
      </h1>
      <div class="description">
        <?=$readXml['content']?>

      <br>
        <div class="extra" style="display:none">
          <?php if(isset($readXml['hotline'])):?>
          <div class="download-i"><img src="<?=base_url()?>images/hotline.png" width="20" height="20" style="float:left;margin-right:5px;margin-top:-4px"> &nbsp; <div class="faa" style="color:#e29e24;margin-top:-2px"><span style="color:#101077;font-family:'regular'">Hotline:</span> <?=$readXml['hotline']?></div><div class="clearfix"></div></div>
          <?php endif;?>

       <div class="clearfix"></div>
       
       <?php if(isset($readXml['download'])):?>
          <div class="download-i"><img src="<?=base_url()?>images/download.png" width="20" height="20" style="float:left;margin-right:5px;margin-top:-4px"> <div class="faa" style="margin-top:-2px"><?=$readXml['download']?></div><div class="clearfix"></div></div>
       <?php endif;?>

        </div>
      </div>
      <?php if($item->linkmore != '#'):?>
     
      <a target="_blank" style="display:none"> class="morelink" href="<?=$item->linkmore?>">
       <?=$lang=="en" ? "Read more" : "Xem nhà tại JINN"?> <!--"Xem thêm"?-->
        &nbsp; <i class="fa fa-caret-right"></i>  
      </a>
      <div class="clearfix"></div>
      <?php endif;?>  


     <!-- <?php if($readXml['description']!=''):?>
      <div class="more">
        <?=$lang=="en" ? "Read more" : "Xem thêm"?>
        &nbsp; <i class="fa fa-caret-right"></i> 
      </div>
      <div class="clearfix"></div>
      <?php endif;?>-->


      <?php if($listImage):?>
      <div class="connected-carousels">
        <div class="navigation"> <a href="#" class="prev prev-navigation">&lsaquo;</a> <a href="#" class="next next-navigation">&rsaquo;</a>
          <div class="carousel carousel-navigation">
            <ul>
              <?php  foreach($listImage as $img):?>
              <li> <img alt="<?=$img->alt_image?>" width="" height="" src="<?=base_url()?>upload/storage/<?=$result_menu['menu']->title_url.'/'.$item->id.'/thumbnail/'.$img->name?>"> </li>
              <?php endforeach;?>
            </ul>
            
          </div>
        </div>
      </div><?php endif;?>
    </div> 
    <div class="clearfix"></div>
    
    <!-- CONTENT -->
    <div class="maincontent">
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td class="co1"><?=$lang=="en" ? "Overview" : "Tổng quan"?></td>
          <td class="co2" style="border-top:none"><div class="address"> <img width="25" height="25" src="<?=base_url()?>images/mhicon/42x42/place.png" />
              <?=$lang=="en" ? $item->address_en : $item->address_vn?>
            </div>
            <div class="iconinfo"><img width="25" height="25" src="<?=base_url()?>images/mhicon/42x42/south.png" />
              <?=$define_folder['TypeView'][$item->mainview]?>
            </div>
            <div class="iconinfo"><img width="25" height="25" src="<?=base_url()?>images/mhicon/42x42/square-area.png" />
              <?=$item->acreage?>
            </div>
            <div class="iconinfo"><img width="25" height="25" src="<?=base_url()?>images/mhicon/42x42/square-tree.png" />
              <?=$item->tree?>
            </div>
            <div class="iconinfo"><img width="25" height="25" src="<?=base_url()?>images/mhicon/42x42/blook.png" /> <strong>
              <?=$lang=="en" ? "Blocks:":"Khu:"?>
              </strong>
              <?=$item->block?>
            </div>
            <div class="iconinfo"><img width="25" height="25" src="<?=base_url()?>images/mhicon/42x42/apartment.png" /> <strong>
              <?=$lang=="en" ? "Apartment:":"Căn hộ:"?>
              </strong>
              <?=$item->apartment?>
            </div>
            <div class="iconinfo"> <strong>
              <?=$lang=="en" ? 'Available:' : 'Còn Trống:'?>
              </strong>
              <?=$item->available?>
            </div>
            <div class="iconinfo"> <strong>
              <?=$lang=="en" ? 'Processing:' : 'Đang giao dịch:'?>
              </strong>
              <?=$item->process?>
            </div>
            <div class="iconinfo"> <strong>
              <?=$lang=="en" ? 'Sold:' : 'Đã bán:'?>
              </strong>
              <?=$item->sold?>
            </div>
            <div class="clearfix"></div></td>
        </tr>
        <tr>
          <td class="co1"><?=$lang=="en" ? "Property type" : "Các loại căn hộ"?></td>
          <td class="co2"><?php if($listApartment):?>
            <?php foreach($listApartment as $ap):?>
            <div class="iconinfo"><img width="25" height="25" src="<?=base_url()?>upload/kinds/<?=$ap->image?>" />
              <?=$lang=="en" ? $ap->title_en : $ap->title_vn?>
            </div>
            <?php endforeach;?>
            <?php endif;?></td>
        </tr>
        <tr>
          <td class="co1"><?=$lang=="en" ? "Views" : "Hướng căn hộ"?></td>
          <td class="co2"><?php if($listViews):?>
            <?php foreach($listViews as $vi):?>
            <div class="iconinfo"><img width="25" height="25" src="<?=base_url()?>upload/views/<?=$vi->image?>" />
              <?=$lang=="en" ? $vi->title_en : $vi->title_vn?>
            </div>
            <?php endforeach;?>
            <?php endif;?></td>
        </tr>
        <tr>
          <td class="co1"><?=$lang=="en" ? "Utilities" : "Tiện ích"?></td>
          <td class="co2"><?php if($listViews):?>
            <?php foreach($listFeatures as $fe):?>
            <div class="iconinfo"><img width="25" height="25" src="<?=base_url()?>upload/features/<?=$fe->image?>" />
              <?=$lang=="en" ? $fe->title_en : $fe->title_vn?>
            </div>
            <?php endforeach;?>
            <?php endif;?></td>
        </tr>
      </table>
    </div>
  </div>
</div>
<div class="popup">
  <div class="overbg"></div>
  <div class="overcontent">
    <div class="title">
      <?=$lang=="en" ? $item->title_en : $item->title_vn?>
    </div>
    <div class="content scroll-pane">
      <?=$readXml['description']?>
    </div>
  </div>
</div>
<?=$this->load->view('main/ListGalleryWithCat/other.php')?>
<script type="text/javascript">
$(document).ready(function() {
    $('.more').click(function() {
        $('.popup').css('display','block');$('.scroll-pane').jScrollPane();
    });
	
	$('.overbg').click(function() {
        $('.popup').css('display','none');
    });
	
});

$(function()
			{
				
			});
</script>

<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?=asset_url()?>style/main/jquery.fancybox.css?v=2.1.5" media="screen" />
<!-- Add Button helper (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?=asset_url()?>style/main/jquery.fancybox-buttons.css?v=1.0.5" />
<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.fancybox-buttons.js?v=1.0.5"></script> 
<script type="text/javascript">
            $(document).ready(function() {
                 
             	$('.fancybox').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',
				autoScale: false,
 // if fancybox 2.x
				fitToView: false,
				prevEffect : 'none',
				nextEffect : 'none',
				maxWidth: $(document).innerWidth()-80,
   // minHeight: 1050,
				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});
});
</script>