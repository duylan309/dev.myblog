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
      <div class="content">
        <div class="listContent">
          <header> <h4><?=$lang=="en" ? $result_menu["menu"]->title_en : $result_menu["menu"]->title_vn?></h4></header>
          <?=$this->load->view('main/ListArticle/items_section.php')?>
        </div>
      </div>
    </div>  
</div>