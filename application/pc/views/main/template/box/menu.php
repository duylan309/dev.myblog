<div class="navbar navbar-default bg-color1">
  <div class="navbar-header">
    <a class="navbar-brand" href="<?=base_url()?>">
      <img src="<?=base_url().'images/logo.png'?>" />
    </a>

    <button aria-controls="bs-navbar"
            aria-expanded="false"
            class="collapsed
            navbar-toggle"
            data-target="#bs-navbar"
            data-toggle="collapse"
            type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-bars"></span>
    </button>  

  </div>

  <nav id="bs-navbar" class="collapse navbar-collapse">
    <ul menu-left class="nav navbar-nav navbar-left">
      <?php $this->load->view('main/template/box/menu_right.php') ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php //$this->load->view('main/template/box/menu_right.php')?>
      <li><a class="btn-sm bg-color3" href="https://thue.today/page/employer"><i class="fa fa-file-text-o"></i> Đăng tin tuyển dụng</a></li>
      <li><a class="btn-sm bg-color6" href="https://thue.today">Người tìm việc</a></li>
      <!-- <li><a class="btn-sm bg-color6" href="#"><i class="fa fa-lock"></i> Đăng nhập</a></li> -->
    </ul>  
  </nav>
</div>  

  
