<div class="Center">
  <div class="headertitle blue" <?=$listOthers ? 'style="margin-top:0"' : ''?>>
    <hr class="left">
    <div class="clearfix"></div>
    <?=$lang=="en" ? "Others" : "Khác"?>
  </div>
</div>
<div id="Gallery">
  <?php if($listOthers):?>
  <?php foreach($listOthers as $itemother):?>
  <div class="boxGallery"> <a href="<?=base_url().$result_menu['menu']->title_url.'/'.$itemother->title_url.'_'.$itemother->id.'.html'?>" >
    <div class="title">
      <?=$lang=="en" ? $item->title_en: $item->title_vn?>
    </div>
    <div class="img"> <img alt="<?=$item->alt_image?>" src="<?=base_url()?>upload/<?=$result_menu['menu']->title_url?>/<?=$itemother->image?>"> </div>
    <div class="caption_content">
      <?php $readXmlother = $this->dinosaur_lib->loadXml($lang,'/'.$result_menu['menu']->title_url.'/',$itemother->id);?>
      <?=$readXmlother['content']?>
    </div>
    </a> </div>
  <?php endforeach;?>
  <?php unset($listOthers);?>
  <?php endif;?>
  
</div>
 <input class="page_get" type="hidden" name="getpage" value="0" />

<script type="text/javascript" src="<?=asset_url()?>javascript/daili/masonry.min.js"></script> 
<script type="text/javascript" src="<?=asset_url()?>javascript/daili/imagesloaded.min.js"></script> 
<script type="application/javascript">
$(document).ready(function() {
	   var $container = $('#Gallery');  
	     $container.css({'width':$(window).innerWidth()});
	    MasonryLoad();
		
		function MasonryLoad(){
			 $container.imagesLoaded(function(){
		  $container.masonry({
			itemSelector : '.boxGallery',
			columnWidth : $container.innerWidth()/4,
		  });
		});
		}
		
		$(window).resize(function() {
		  $container.css({'width':$(window).innerWidth()});
		  MasonryLoad();
		}); 
		
		var maxpage    = <?=$maxpage?>;
		var page       = 0;
		/*loadpage*/
		
	 	
		function __ajax(url_,data_,success,loading){
		
			return $.ajax({
				type:"POST",
				url:url_,
				data:data_,		
				beforeSend: function (){
					$(success).append(loading);
				},
				success: function(html){
					//	$container.append(html).masonry( 'appended', html, true );
					
				}
				
			 }).done(function(html){
			var el = jQuery(html);
            jQuery("#Gallery").append(el).masonry( 'appended', el, true );
		
		})	 
		};
	
	
		 
		  $(window).scroll(function() {
			//var sizeImage = itemWidth-60;
			if($(window).scrollTop() + $(window).height()+1> $(document).height()) {
			page = parseInt($('.page_get').attr('value'))+1;
			if(parseInt(maxpage) > (page)){
			data="page="+page+"&id=<?=$id?>&ajax=1&str=<?=$item->str?>";
			$('.page_get').attr('value',page);
			__ajax("<?=base_url().$page?>",data,$(".btn_more"), "");
			}
			}
		}); 
});
</script>