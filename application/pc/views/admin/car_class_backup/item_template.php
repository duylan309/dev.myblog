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
          <ul class="nav nav-tabs">
            <li class="active"><a href="#vn_new_tab_added" data-toggle="tab">VN</a></li>
            <li><a href="#en_new_tab_added" data-toggle="tab">EN</a></li>  
          </ul>

          <div tab-panel-control class="tab-content">
            <div id="vn_new_tab_added" class="tab-pane active">
              <input name="tab-tab_title_vn[]"  class="input form-control" type="text" size="50" value="" />
            </div>
            <div id="en_new_tab_added" class="tab-pane">
              <input name="tab-tab_title_en[]"  class="input form-control" type="text" size="50" value="" />
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
            <li class="active"><a href="#vn_lt" data-toggle="tab">VN</a></li>
            <li><a href="#en_lt" data-toggle="tab">EN</a></li>
          </ul>
          <div class="tab-content">
            <div id="vn_lt" class="tab-pane active">
              <textarea data-area-vn name="tab-tab_description_vn[]" class="form-control" style="width:100%; border:0px; background:none; height:350px;">
              </textarea>
              
            </div>
            <div id="en_lt" class="tab-pane">
              <textarea data-area-en id="" name="tab-tab_description_en[]" class="form-control" style="width:100%; border:0px; background:none; height:350px;">
              </textarea>
            </div>
          </div>
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
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#vn_new_tab" data-toggle="tab">VN</a></li>
                  <li><a href="#en_new_tab" data-toggle="tab">EN</a></li>  
                </ul>

                <div class="tab-content">
                  <div id="vn_new_tab" class="tab-pane active">
                    <input class="input form-control" require  data-tab-title-vn type="text" size="50" value="" />
                  </div>
                  <div id="en_new_tab" class="tab-pane">
                    <input class="input form-control" require data-tab-title-en type="text" size="50" value="" />
                  </div>
                </div>
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