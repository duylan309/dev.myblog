<div id="seo" class="tab-pane fade m-t-15 col-sm-6">
  <div class="form-group">
      <label class="col-sm-3"><?=$language->METATITLE?></label>
      <div class="col-sm-9">
            <?php ?>
            <input class="form-control" type="text" name="seo-meta_title_vn" value="<?=isset($readXML_vn) ? $readXML_vn->info->meta->title : ""?>" />
            <input class="form-control" type="hidden" name="seo-meta_title_en" value="<?=isset($readXML_en) ? $readXML_en->info->meta->title: ""?>" />
        
      </div>
  </div>
  <div class="form-group">
      <label class="col-sm-3"><?=$language->METAKEYWORD?></label>
      <div class="col-sm-9">
        <textarea class="form-control" rows="3" cols="50" name="seo-meta_keyword_vn"><?=isset($readXML_vn) ? $readXML_vn->info->meta->keyword : ""?></textarea>
        <input class="form-control" type="hidden" name="seo-meta_keyword_en" value="<?=isset($readXML_en) ? $readXML_en->info->meta->keyword: ""?>" />
      </div>
  </div>
  <div class="form-group">
      <label class="col-sm-3"><?=$language->METADESCRIPTION?></label>
      <div class="col-sm-9">
        <textarea class="form-control" rows="3" cols="50" name="seo-meta_description_vn"><?= isset($readXML_vn) ? $readXML_vn->info->meta->description : ""?></textarea>
        <input class="form-control" type="hidden" name="seo-meta_description_en" value="<?=isset($readXML_en) ? $readXML_en->info->meta->description: ""?>" />
      </div>
  </div>

  <?=$this->load->view('admin/allmodules/tab_content/image_meta.php')?>
  

</div>  

