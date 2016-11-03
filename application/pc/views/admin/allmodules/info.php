<div class="form-group">
    <label class="col-sm-3"><?=$language->TITLE?></label>
    <div class="col-sm-9">
          <input class="input form-control" name="db-title_vn" type="text" size="50" value="<?=isset($result->title_vn) ? $result->title_vn : ""?>" />
          <input class="input form-control" name="db-title_en" type="hidden" size="50" value="<?=isset($result->title_en) ? $result->title_en : ""?>" />
    </div>
</div>
<div class="form-group">
    <label class="col-sm-3"><?php echo $language->URL?></label>
    <div class="col-sm-9">
      <input data-validate class="form-control" type="text" id="titleUrl" name="db-title_url" size="50" value="<?=isset($result->title_url) ? $result->title_url : ""?>" onchange="checkUrl(0,'<?=$page?>','<?=base_url()?>')" />
      <small> <span class="checkURL"></span> (Ví dụ: http://website.com/sp/+ Url)</small>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3"><?php echo $language->STATUS?></label>
    <div class="col-sm-9">
      <?php $options=NULL;
          if($define_folder["Status"]):
            foreach($define_folder["Status"] as $key=> $value):
                      $options[$key] = $value;
            endforeach;
          endif;
          echo form_dropdown('db-status" class="form-control', $options, set_value('status',isset($result->status)?$result->status:""));
        ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3"><?php echo $language->SORT?></label>
    <div class="col-sm-9">
      <input class="form-control" type="text" size="4" name="db-sort" value="<?=isset($result->sort) ? $result->sort : ""?>"/>
    </div>
</div>


