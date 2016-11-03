<form data-form-validate class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=isset($result->id) ? $result->id : 0?>&function=Save" method="post" id="submitForm" enctype="multipart/form-data">
  <!-- Page Heading -->
  <?=$this->load->view('admin/allmodules/table/header_with_action.php')?>
  <div class="listContent p-10">
    
    <?=$this->load->view('admin/allmodules/tab_header/info.php')?>
    
    <div class="tab-content m-t-30">
     
      <div id="info" class="tab-pane fade in active col-sm-6">
        <div class="form-group">
            <label class="col-sm-3"><?=$language->FULLNAME?></label>
            <div class="col-sm-9">
            <?=$result->fullname?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3"><?=$language->EMAIL?></label>
            <div class="col-sm-9">
            <?=$result->email?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3"><?=$lang=="en" ? "Phone" : "Số Điện Thoại"?></label>
            <div class="col-sm-9">
            <?=$result->phone?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3"><?=$lang=="en" ? "Subject" : "Chủ Đề"?></label>
            <div class="col-sm-9">
            <?=$result->subject?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3"><?=$lang=="en" ? "Date" : "Ngày"?></label>
            <div class="col-sm-9">
            <?=$result->date?>
            </div>
        </div>
          
        <div class="form-group">
            <label class="col-sm-3"><?=$language->CONTENT?></label>
            <div class="col-sm-9">
            <?=$result->content?>
            </div>
        </div>  

      </div>

    </div>

    <input hidden="hidden" name="more-type_hidden" value="<?=isset($result->type) ? $result->type :""?>" />
    <input hidden="hidden" name="db-id" value="<?=isset($result->id) ? $result->id:""?>" />
    <input hidden="hidden" name="more-url_hidden" value="<?=isset($result->title_url) ? $result->title_url:""?>" />
  </div>
</form>

