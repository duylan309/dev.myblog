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
        <ul class="nav nav-tabs">
          <li class="active"><a href="#vn_title_<?=$value->url?>" data-toggle="tab">VN</a></li>
          <li><a href="#en_title_<?=$value->url?>" data-toggle="tab">EN</a></li>
        </ul>
        <div tab-panel-control class="tab-content">
          <div id="vn_title_<?=$value->url?>" class="tab-pane active">
            <input name="tab-tab_title_vn[]" class="input form-control" type="text" size="50" value="<?=isset($readXML_vn->tab[$i]->title) && count($readXML_vn->tab[$i]->title) ? $readXML_vn->tab[$i]->title : ''?>" />
          </div>
          <div id="en_title_<?=$value->url?>" class="tab-pane">
            <input name="tab-tab_title_en[]" class="input form-control" type="text" size="50" value="<?=isset($readXML_en->tab[$i]->title) && count($readXML_en->tab[$i]->title) ? $readXML_en->tab[$i]->title : ''?>" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <div data-content class="form-group col-sm-12">
    <div class="row">
      <label class="col-sm-3"><?=$language->LONGTEXT?></label>
      <div tab-control class="col-sm-9">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#vn_content_<?=$value->url?>" data-toggle="tab">VN</a></li>
          <li><a href="#en_content_<?=$value->url?>" data-toggle="tab">EN</a></li>
        </ul>
        <div class="tab-content">
          <div id="vn_content_<?=$value->url?>" class="tab-pane active">
            <textarea data-area-vn name="tab-tab_description_vn[]" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:350px;">
            <?=isset($readXML_vn->tab[$i]->description) && count($readXML_vn->tab[$i]->description) ?$readXML_vn->tab[$i]->description : ''?>
            </textarea>
            
          </div>
          <div id="en_content_<?=$value->url?>" class="tab-pane">
            <textarea data-area-en id="" name="tab-tab_description_en[]" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:350px;">
            <?=isset($readXML_en->tab[$i]->description) && count($readXML_en->tab[$i]->description) ? $readXML_en->tab[$i]->description : ''?>
            </textarea>
          </div>
        </div>
      </div>
    </div>  
  </div>
</div>
<?php $i++; endforeach;}?>