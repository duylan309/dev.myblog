<div id="content" class="tab-pane fade m-t-15 col-sm-12">
  <div class="form-group">
      <label class="col-sm-2"><?=$language->SHORTTEXT?></label>
      <div class="col-sm-10">
       
        <textarea name="more-content_vn" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:250px;">
          <?=isset($readXML_vn) ? $readXML_vn->more->content : ""?>
        </textarea>
   
        <input class="form-control" type="hidden" name="more-content_en" value="" />
        
      </div>
  </div>

  <div class="form-group">
      <label class="col-sm-2"><?=$language->LONGTEXT?></label>
      <div class="col-sm-10">
      
        <textarea name="more-description_vn" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:350px;">
          <?=isset($readXML_vn) ? $readXML_vn->more->description : ""?>
        </textarea>
     
        <input class="form-control" type="hidden" name="more-description_en" value="" />
        
      </div>
  </div>

</div>