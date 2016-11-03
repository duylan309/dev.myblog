<form data-form-validate class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=contact_content&action=update&id=0&function=Save" method="post" id="submitForm" enctype="multipart/form-data">
  <?=$this->load->view('admin/allmodules/table/header_with_action.php')?>
  <div class="listContent p-10">
    <?=$this->load->view('admin/allmodules/tab_header/info.php')?>
    <div class="tab-content m-t-30">

      <div id="info" class="tab-pane fade in active col-sm-12">
      
        <div class="form-group">
            <label class="col-sm-2"><?=$lang=="en" ? "Thank you" : "Nội dung cám ơn"?></label>
            <div class="col-sm-10">
      
              <textarea name="thankyou_vn" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:350px;">
                <?=isset($readXML_vn) ? $readXML_vn->info->thankyou : ""?>
              </textarea>
          
              <input name="thankyou_en" class="input form-control" type="hidden" size="50" value="" />
              
            </div>
        </div>



    </div>    

  </div>


</form>
