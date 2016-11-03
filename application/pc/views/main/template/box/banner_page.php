<?php if(is_file('./upload/menu/'.$menu['image']) && $page != 'home'):?>
<div class="fullscreen banner-wrap background-cover-top background-small c-center" style="background:url(<?=base_url().'upload/menu/'.$result_menu['menu']->image?>) no-repeat">
  <div class="container">
    <div class="banner">
      	<div class="banner-title">
      	</div>
    </div>
  </div>
</div>
<?php endif;?>