<form data-form-validate class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=config_content&action=update&id=0&function=Save" method="post" id="submitForm" enctype="multipart/form-data">
 
  <?=$this->load->view('admin/allmodules/table/header_with_action.php')?>
  
  <div class="listContent p-10">
    
    <?php 
    $data['more_menu'] = '';
    $data['more_menu'] .= '<li><a href="#consultant" data-toggle="tab">'.$language->CONSULTANT.'</a></li>';                                   
    $data['more_menu'] .= '<li><a href="#insurance" data-toggle="tab">'.$language->INSURANCE.'</a></li>';                                   
    ?>

    <?=$this->load->view('admin/allmodules/tab_header/info_config.php',$data)?>
    
    <div class="tab-content m-t-30">

      <div id="info" class="tab-pane fade in active col-sm-6">
        <div class="form-group">
            <label class="col-sm-3">Online</label>
            <div class="col-sm-9">
                <input type="checkbox"  name="online" value="1" <?=isset($readXML->info->online) ? ($readXML->info->online == 1 ? "checked='checked'" :"") : ""?>  /> On/Off
            </div>
        </div>

        <?=$this->load->view('admin/allmodules/tab_content/social.php')?>
      </div>

      <div id="banner" class="tab-pane fade in col-sm-12">
        <div class="form-group">
            <label class="col-sm-3"><?=$lang=="en" ? "Banner Left" : "Banner Nhỏ Bên Trái"?></label>
            <div class="col-sm-9">
              <textarea name="banner_left" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:250px;">
              <?=isset($readXML) ? $readXML->info->banner_left : ""?>
              </textarea>
            </div>
        </div>
      </div>
      
      <?=$this->load->view('admin/allmodules/tab_content/email_config.php')?>
      <?=$this->load->view('admin/allmodules/tab_content/footer.php')?>
      
      <div id="consultant" class="tab-pane fade in col-sm-12">
        
        <div class="form-group">
            <label class="col-sm-2"><?=$lang=="en" ? "Percentage" : "Tỷ lệ"?></label>
            <div class="col-sm-10">
              <input class="form-control" value="<?=isset($readXML) ? $readXML->info->content_consultant_percent : ""?>" name="content_consultant_percent">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2"><?=$lang=="en" ? "Content Left" : "Nội Dung Bên Trái"?></label>
            <div class="col-sm-10">
         
              <textarea name="content_consultant_left_vn" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:350px;">
                <?=isset($readXML) ? $readXML->info->content_consultant_left_vn : ""?>
              </textarea>
              <input type="hidden" name="content_consultant_left_en" value="">
                
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2"><?=$lang=="en" ? "Content Right" : "Nội Dung Bên Phải"?></label>
            <div class="col-sm-10">
                <textarea name="content_consultant_right_vn" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:350px;">
                  <?=isset($readXML) ? $readXML->info->content_consultant_right_vn : ""?>
                </textarea>
                <input type="hidden" name="content_consultant_right_en" value="">
            </div>
        </div>
        </div>
        <div id="insurance" class="tab-pane fade in col-sm-12">
        <div class="form-group">
            <label class="col-sm-2"><?=$lang=="en" ? "Percentage" : "Tỷ lệ"?></label>
            <div class="col-sm-10">
              <input class="form-control" value="<?=isset($readXML) ? $readXML->info->content_insurance_percent : ""?>" name="content_insurance_percent">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2"><?=$lang=="en" ? "Content Left" : "Nội Dung Bên Trái"?></label>
            <div class="col-sm-10">
             
              <textarea name="content_insurance_left_vn" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:350px;">
                <?=isset($readXML) ? $readXML->info->content_insurance_left_vn : ""?>
              </textarea>
              <input type="hidden" name="content_insurance_left_en" value="">
                
              
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2"><?=$lang=="en" ? "Content Right" : "Nội Dung Bên Phải"?></label>
            <div class="col-sm-10">
          
              <textarea name="content_insurance_right_vn" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:350px;">
                <?=isset($readXML) ? $readXML->info->content_insurance_right_vn : ""?>
              </textarea>
              <input type="hidden" name="content_insurance_right_en" value="">
            
            </div>
        </div>


      </div>

    </div>
  </div>
</form>