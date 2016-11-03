<div class="form-group">
  <label class="col-sm-2"><?=$language->LONGTEXT?></label>
  
  <div class="col-sm-10">
   
    <textarea name="more-description_vn" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:250px;">
    <?=isset($readXML_vn) ? $readXML_vn->info->description : ""?>
    </textarea>
    <input class="form-control" type="hidden" name="more-description_en" value="" />
    
  </div>
</div>