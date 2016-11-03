<!-- TEMPLATE TAB -->

<div id="template_tab_header" class="hidden">
  <li>
    <a href="" data-toggle="tab"><span>SEO</span><i class="fa fa-times text-danger pull-right"></i></a>
  </li>
</div>
<!-- END TEAMPLATE TAB -->

<!-- TEMPLATE TAB CONTENT -->
<div id="template_tab_content" class="hidden">
  <div data-new-tab-content tab-content class="tab-pane fade col-sm-12">
    
    <div data-title class="form-group col-sm-12">
      <div class="row">
        <label class="col-sm-3"><?=$language->TITLE?></label>
        <div tab-control class="col-sm-9">
          <input data-url type="hidden" name="tab-tab_url_title[]" value="">
          <input name="tab-tab_title_vn[]"  class="input form-control" type="text" size="50" value="" />
        </div>
      </div>  
    </div>

    <div data-content class="form-group col-sm-12">
      <div class="row">
        <label class="col-sm-3"><?=$language->LONGTEXT?></label>
        <div tab-control class="col-sm-9">
          
          <textarea data-area-vn name="tab-tab_description_vn[]" class="form-control" style="width:100%; border:0px; background:none; height:350px;">
          </textarea>
       
        </div>
      </div>  
    </div>
  </div>  
</div>
<!-- END TEMPLATE TAB CONTENT -->

<!-- POPUP ADD TAB -->
<div class="modal" id="addTabContent" tabindex="-1" role="dialog" aria-labelledby="addTabContent">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?=$lang=="en" ? "Add Tab" : "Thêm Tab"?></h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <label class="col-sm-3"><?=$language->TITLE?></label>
            <div class="col-sm-9">
              <input class="input form-control" require  data-tab-title-vn type="text" size="50" value="" />
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?=$language->CANCEL?></button>
        <button type="button" id="addTabButton" class="btn btn-primary"><?=$language->SAVE?></button>
      </div>
    </div>
  </div>
</div>
<!-- POPUP ADD TAB -->