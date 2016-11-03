<form data-form-validate class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=isset($result->id) ? $result->id : 0?>&function=Save" method="post" id="submitForm" enctype="multipart/form-data">
  <!-- Page Heading -->
 
  <?=$this->load->view('admin/allmodules/table/header_with_action.php')?>
  <div class="listContent p-10">

    <?=$this->load->view('admin/allmodules/tab_header/info_image_seo.php')?>
    
    <div class="tab-content m-t-30">
     
      <div id="info" class="tab-pane fade in active col-sm-6">
        <?=$this->load->view('admin/allmodules/info.php')?>
      </div>
      <?=$this->load->view('admin/allmodules/tab_content/image.php')?>
      <?=$this->load->view('admin/allmodules/tab_content/meta.php')?>
    </div>

    <input hidden="hidden" name="more-type_hidden" value="<?=isset($result->type) ? $result->type :""?>" />
    <input hidden="hidden" name="db-id" value="<?=isset($result->id) ? $result->id:""?>" />
    <input hidden="hidden" name="more-url_hidden" value="<?=isset($result->title_url) ? $result->title_url:""?>" />
  </div>
</form>


<style>
#tab .form-group{
  margin-bottom: 0px;
  padding-top: 25px;
  padding-bottom: 5px;
  font-size:11px;
}

#tab .form-group label.col-sm-12{
  background:#999;
  padding-top:5px;
  font-size: 14px;
  padding-bottom:5px;
}

#tab .form-group label{
  margin-bottom: 0px;
}

#tab .form-group:nth-child(2n){
  background: #EEE;
}

.add-form{
  margin-top: 20px;
  text-align: center;
}

#tab .form-group .col-sm-4 input{
  margin-bottom: 5px;
}
</style>
