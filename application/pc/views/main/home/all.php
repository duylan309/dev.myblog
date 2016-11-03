<div banner-home class="fullscreen b-cover c-center" style="background:url(<?=base_url()?>images/banner-home.jpg) no-repeat">
  <div class="container">
    <div class="banner">
      	<div class="banner-title">
      	</div>
    </div>
  </div>
</div>

<div class="container-section container">
  <div class="row">
    <div class="col-xs-12 col-sm-9">
      <?=$this->load->view('main/home/blog_lists.php')?>
    </div>
    <div class="col-xs-12 col-sm-3 ">

    </div>
  </div>

	<div class="content hidden">
		<?=isset($readXml->info->description) && count($readXml->info->description) ? $readXml->info->description : ''?>
	</div>

</div>
