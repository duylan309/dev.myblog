<div class="container-section">
  <div class="row">
    <div class="col-sm-12">
      <div class="text-area page-detail">
      
        <?=isset($readXml['more']['description']) && count($readXml['more']['description']) ? $readXml['more']['description'] : ''?>         
      </div> 
    </div>
  </div>

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

    <div class="col-sm-9 border-left car_tab_content">
        <?=$this->load->view('main/'.$FOLDERCONTROL.'/items_section.php')?>
    </div>
  </div>

  <!-- OTHER NEWS -->
  <div class="other-items no-margin">
    
  </div>
</div>      

