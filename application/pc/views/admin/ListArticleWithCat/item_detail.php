<form data-form-validate class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=isset($result->id) ? $result->id : 0?>&function=Save" method="post" id="submitForm" enctype="multipart/form-data">
  <!-- Page Heading -->
  <?=$this->load->view('admin/allmodules/table/header_with_action.php')?>
  <div class="listContent p-10">
    
    <?=$this->load->view('admin/allmodules/tab_header/info_image_content_seo_other.php')?>
    
    <div class="tab-content m-t-30">
     
      <div id="info" class="tab-pane fade in active col-sm-6">
        <?=$this->load->view('admin/allmodules/info.php')?>
        
        <div class="form-group">
          <label class="col-sm-3"><?=$lang=="en" ? "Category" : "Danh Mục"?></label>
          <div class="col-sm-9">
            <select class="form-control" name="db-cat">  
            <option value="0"><?=$lang=="en" ? "Choose Category" : "Chọn Danh Mục"?></option>
            <?php if(isset($results_cat) && count($results_cat)){
                  foreach($results_cat as $cat):?>
                  <option <?=isset($result->cat) ? ($result->cat == $cat->id ? 'selected="selected"' : ""):""?> 
                          value="<?=$cat->id?>"><?=$lang=="en" ? $cat->title_en : $cat->title_vn?>
                  </option>
            <?php endforeach;}?>
            </select>      
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3"><?=$lang=="en" ? "Post By" : "Đăng bởi"?></label>
          <div class="col-sm-9">
            <div class="row">
            <?php if(isset($results_admin) && count($results_admin)){
                  foreach($results_admin as $admin):?>
                  <div class="col-sm-12">
                    <div class="radio">
                        <label>
                          <input  value="<?=$admin->id?>" 
                                  name="db-postby" <?=isset($result->postby) ? ($result->postby == $admin->id ? 'checked="checked"' : ""):""?> 
                                  type="radio">
                          <img class="img-rounded img-admin-thumb" src="<?=SOURCEFOLDER?>user/<?=$admin->image?>" />
                          <?=$admin->name?>
                        </label>
                      </div>
                  </div>
            <?php endforeach;}?>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3"><?=$lang=="en" ? "Tags" : "Tags"?></label>
          <div class="col-sm-9">
            <textarea class="input form-control tags" name="db-tag"><?=isset($result->tag) ? $result->tag : ""?> </textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3"><?=$lang=="en" ? "Releated" : "Liên quan"?></label>
          <div class="col-sm-9">
            <textarea class="input form-control tags" name="db-related"><?=isset($result->related) ? $result->related : ""?> </textarea>
          </div>
        </div>

      </div>
      <?=$this->load->view('admin/allmodules/tab_content/content.php')?>
      <?=$this->load->view('admin/allmodules/tab_content/image_other.php')?>
      <?=$this->load->view('admin/allmodules/tab_content/meta.php')?>
      <?=$this->load->view('admin/allmodules/tab_content/others_article.php')?>
    </div>

    <input hidden="hidden" name="more-type_hidden" value="<?=isset($result->type) ? $result->type :""?>" />
    <input hidden="hidden" name="db-id" value="<?=isset($result->id) ? $result->id:""?>" />
    <input hidden="hidden" name="more-url_hidden" value="<?=isset($result->title_url) ? $result->title_url:""?>" />
  </div>
</form>