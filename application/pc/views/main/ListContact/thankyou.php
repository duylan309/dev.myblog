<div class="container-section">
  <div class="row">
    <div class="col-sm-3">
      <nav id="bs-navbar" class="collapse navbar-collapse menu-left">
        <ul class="nav nav-pills nav-stacked">
          <?=$lang=="en" ? "<li>Menu</li>" : ""?>
          <?=$this->load->view('main/template/box/menu_right.php')?>
        </ul>
      </nav>

      <div class="section-banner m-t-15 ">
        <?=isset($configSite[0]->info->banner_left) ? $configSite[0]->info->banner_left : ''?></td>
      </div>

    </div>

    <div class="col-sm-9 border-left">
        <div class="text-area">
        	<?=$thank?>
        	<br />
        	<a style="color:#776a62" href="<?=base_url()?>">
        	<?=$lang=="en" ? "< Back to homepage" :"< Quay lại trang chủ"?>
        	</a> 
			
        </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>


