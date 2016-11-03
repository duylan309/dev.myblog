<?php
if(isset($tab_array->tab) && count($tab_array)){
$i=0;
foreach($tab_array->tab as $value):?>
<div id="<?=$value->url?>" class="tab-pane fade col-sm-12">
  
  <div data-title class="form-group col-sm-12">
    <div class="row">
      <label class="col-sm-3"><?=$language->TITLE?></label>
      <div tab-control class="col-sm-9">
        <input data-url type="hidden" name="tab-tab_url_title[]" value="<?=$value->url?>">
        <input name="tab-tab_title_vn[]" class="input form-control" type="text" size="50" value="<?=isset($readXML_vn->tab[$i]->title) && count($readXML_vn->tab[$i]->title) ? $readXML_vn->tab[$i]->title : ''?>" />
      </div>
    </div>
  </div>
  <div data-content class="form-group col-sm-12">
    <div class="row">
      <label class="col-sm-3"><?=$language->LONGTEXT?></label>
      <div tab-control class="col-sm-9">
        <textarea data-area-vn name="tab-tab_description_vn[]" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:350px;">
        <?=isset($readXML_vn->tab[$i]->description) && count($readXML_vn->tab[$i]->description) ?$readXML_vn->tab[$i]->description : ''?>
        </textarea>
      </div>
    </div>  
  </div>
</div>
<?php $i++; endforeach;}?>