<?=$this->load->view('main/template/breadcrumbs.php')?>

<div class="detailContent Center">
  <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td width="710"><div class="detail"><header>
          <h1>
            <?=$lang=="en" ? $item->title_en : $item->title_vn?>
          </h1>
        </header>
        
        <?php if($listImage):?>
    <?php $i=1;?>
    <?php foreach($listImage as $mdSlide):?>
    <div class="itemimg cl<?=$i?>">
      <div class="img"><a class="fancybox" data-fancybox-group="gallery" href="<?=base_url()?>upload/storage/<?=$page?>/<?=$mdSlide->album_id?>/<?=$mdSlide->name?>" > <img width="185" height="185" alt="<?=$item->alt_image?>" src="<?=base_url()?>upload/storage/<?=$page?>/<?=$mdSlide->album_id?>/<?=$mdSlide->name?>"> </a></div>
    </div>
    <?php $i++;?>
    <?php $i = $i==5 ? 1 : $i?>
    <?php endforeach;?>
    <?php endif;?>
        <div class="clearfix"></div>
        <div class="content-page">
          <?=$readXml['description']?>
        </div></div></td>
      <td width="220" class="right newest"><?php if($listNewest !=-1):?>
        <header>
          <?=$lang=="en" ? "Latest Activities" : "Hoạt động mới"?>
        </header>
        <?php foreach($listNewest as $new):?>
        <?php $arr_id[] = $new->id?>
        <div class="boxGallery">
          <div class="img"><img width="375" height="275" src="<?=base_url()?>upload/<?=$result_menu['menu']->title_url?>/<?=$new->image?>" alt="<?=$new->alt_image?>" /></div>
        
         <a href="<?=base_url().$result_menu['menu']->title_url.'/'.$new->title_url.'_'.$new->id.'.html'?>">
          <div class="overplay">
            <div class="title">
              <?=$lang=="en" ? $new->title_en : $new->title_vn?>
            </div>
          </div>  </a>
            
        </div>
        <?php endforeach;?>
        <?php endif;?>
        
       </td>
    </tr>
  </table>
  <?php if($listOthers):?>
  <div class="others">
    <header>
      <?=$lang=="en" ? "Other Activity" : "Hoạt động khác"?>
    </header>
    <table class="lists Center" width="100%" cellpadding="0" cellspacing="0">
      <?php $i=1?>
      <?php foreach($listOthers as $other):?>
      <?php $readXml = $this->dinosaur_lib->loadXml($lang,'/'.$result_menu['menu']->title_url.'/',$other->id);?>
      
        <td class="col<?=$i?>" width="33.33333%"><div class="img"><a href="<?=base_url().$result_menu['menu']->title_url.'/'.$other->title_url.'_'.$other->id.'.html'?>" > <img alt="<?=$other->alt_image?>" width="378" height="276" src="<?=base_url()?>upload/<?=$result_menu['menu']->title_url?>/<?=$other->image?>"> </a></div>
          <div class="title"> <a href="<?=base_url().$result_menu['menu']->title_url.'/'.$other->title_url.'_'.$other->id.'.html'?>" >
           <?=word_limiter($lang=="en" ? $other->title_en : $other->title_vn,9)?> 
            </a></div>
          <div class="content">
            <?=word_limiter($readXml['content'],16)?>
          </div>
          <?php if($i == 3):?>
          <?php echo '</td></tr><tr>';$i=0?>
          <?php else:?>
          <?php echo '</td>';?>
          <?php endif;?>
          <?php $i++?>
          <?php endforeach;?>
    </table>
  </div>
  <?php endif;?>
</div>

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
<style>
.detailContent .itemimg{width:160px;height:130px;float:left;margin-bottom:10px;margin-right:10px;overflow:hidden}
.detailContent .itemimg img{width:160px;height:130px;vertical-align:middle}
.detailContent .cl4{margin-right:0}
.boxGallery{margin-bottom:10px}
.boxGallery .overplay{}
</style>