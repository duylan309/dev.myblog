<form data-form-validate class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=isset($result->id) ? $result->id : 0?>&function=Save" method="post" id="submitForm" enctype="multipart/form-data">
  <!-- Page Heading -->
  <?=$this->load->view('admin/allmodules/table/header_with_action.php')?>
  <div class="listContent p-10">
    
    <?=$this->load->view('admin/allmodules/tab_header/info_image_content_seo.php')?>
    
    <div class="tab-content m-t-30">
     
      <div id="info" class="tab-pane fade in active col-sm-6">
        <?=$this->load->view('admin/allmodules/info.php')?>
      </div>
      <?=$this->load->view('admin/allmodules/tab_content/content.php')?>
      <?=$this->load->view('admin/allmodules/tab_content/image.php')?>
      <?=$this->load->view('admin/allmodules/tab_content/meta.php')?>
    </div>

    <input hidden="hidden" name="more-type_hidden" value="<?=isset($result->type) ? $result->type :""?>" />
    <input hidden="hidden" name="db-id" value="<?=isset($result->id) ? $result->id:""?>" />
    <input hidden="hidden" name="more-url_hidden" value="<?=isset($result->title_url) ? $result->title_url:""?>" />
  </div>
</form>