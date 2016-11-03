<div id="image" class="tab-pane fade m-t-15 col-sm-6">

  <div class="form-group">
      <label class="col-sm-2">Alt Image</label>
      <div class="col-sm-10">
        <input class="form-control" type="text" name="db-alt_image" value="<?=isset($result->alt_image) ? $result->alt_image : ""?>" />
      </div>
  </div>

  <?php if(isset($result) && isset($image_link) && is_file($image_link)):?>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
          <img  src="<?=base_url().$image_link?>" width="200"/>
          <div class="checkbox">
            <label>
              <input name="action-del_image" value="1" type="checkbox"> Delete Image
            </label>
          </div>
        </div>
    </div>    
  <?php endif;?>

  <div class="form-group">
      <label class="col-sm-2"><?=$language->IMAGE?></label>
      <div class="col-sm-10">
        <?php $data = array( 'name' => 'file_images', 'id' => 'file_images');
              echo form_upload($data);?>
      </div>
  </div>

</div>  
