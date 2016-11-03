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
        <?=isset($configSite[0]->info->banner_left) ? str_replace('src="upload','src="'.base_url().'upload',$configSite[0]->info->banner_left) : ''?></td>
      </div>
    </div>
    <div class="col-sm-9 border-left">
      <div class="text-area page-detail">
        <h1 class="title">
          <?=$lang=="en" ? $item->title_en : $item->title_vn?>
          <br>
          <small><?=$lang=="en" ? "Date: " : "Ngày đăng: "?> <?=$item->date?></small>
        </h1>
        <div class="description">
          <?=$readXml['description']?>
        </div>         
      </div>
      
      <!-- OTHER NEWS -->
      <div class="listContent other-items">
        <header> <h4><?=$language->OTHERNEWS?></h4></header>
        <?php $data['results'] = $listOther;?>
        <?=$this->load->view('main/ListArticle/items_section.php',$data)?>
      </div>
    </div>
    
  </div>
</div>      

