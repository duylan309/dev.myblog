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
        <header><h5><?=$lang=="en" ? $result_menu['menu']->title_en : $result_menu['menu']->title_vn?></h5></header>
        <div class="text-area">
        
          <form class="validate-form form" method="post" action="<?=base_url().$page?>?action=send#Contact">
            <div class="row">
            
              <div class="col-sm-3">
                <div class="form-group">
                  <input class="form-control input-sm" name="fullname" type="input" required value="<?php echo set_value('fullname'); ?>" placeholder="<?=$lang=="en" ? "Name" :"Tên" ?>">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <input class="form-control input-sm" name="email" type="input" required value="<?php echo set_value('email'); ?>" placeholder="<?=$lang=="en" ? "Email" :"Email" ?>">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <input class="form-control input-sm" name="phone" type="input" required value="<?php echo set_value('phone'); ?>" placeholder="<?=$lang=="en" ? "Phone" :"Số Điện Thoại" ?>">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <select name="subject" required class="form-control input-sm">
                      <option value=""><?=$lang=="en" ? "Choose Subject" : "Chọn Chủ Đề"?></option>
                      <option <?=isset($_GET['type']) ? ($_GET['type'] == 1 ? 'selected="selected"' : '' ) :''?> value="<?=$language->REQUESTBROCHURE?>"><?=$language->REQUESTBROCHURE?></option>
                      <option <?=isset($_GET['type']) ? ($_GET['type'] == 2 ? 'selected="selected"' : '' ) :''?> value="<?=$language->REQUESTDRIVE?>"><?=$language->REQUESTDRIVE?></option>
                      <option <?=!isset($_GET['type']) ? 'selected="selected"' : '' ?> value="<?=$lang=="en" ? "Other" : "Khác"?>"><?=$lang=="en" ? "Other" : "Khác"?></option>
                  </select> 
                </div>
              </div>
            
              <div class="col-sm-12">
                <div class="form-group">
                  <textarea class="form-control input-lg" required name="content"><?php echo set_value('content'); ?> </textarea> 
                </div>
              </div>
              
              <div class="col-sm-12 text-right">
                <div class="form-group">
                  <button class="btn btn-send" value="<?=$language->SEND?>" name="send_btn_con">
                    <i class="fa fa-send"></i> <?=$language->SEND?>
                  </button>
                </div>
              </div>

            </div>
          </form>

        </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>

