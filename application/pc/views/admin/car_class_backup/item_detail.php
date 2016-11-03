<form data-form-validate data-form class="form-horizontal" 
      action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=isset($result->id) ? $result->id : 0?>&function=Save" 
      method="post" 
      id="submitForm" 
      enctype="multipart/form-data">
  <!-- Page Heading -->
  
  <?php 

  $data_header['more_header'] = isset($result) && count($result) ? 
                                  ' <a  class="btn btn-default btn-primary pull-right btn-sm m-r-15" 
                                        href="'.base_url().ADMINBASE.'?page='.$page.'&action=gallery&id='.$result->id.'&function=photo&position=gallery">
                                    <i class="fa fa-image"></i> '.$language->GALLERY.'</a>' : '';
  $data_header['more_header'] .= isset($result) && count($result) ? ' <a  class="btn btn-default btn-primary pull-right btn-sm m-r-15" 
                                      href="'.base_url().ADMINBASE.'?page='.$page.'&action=gallery&id='.$result->id.'&function=photo&position=banner">
                                    <i class="fa fa-image"></i> '.$language->BANNER.'</a>' : '';                                   
  $data_header['more_header'] .= isset($result) && count($result) ? 
                                  '<a class="btn btn-info pull-right btn-sm m-r-15" data-toggle="modal" data-target="#addTabContent">
                                    <i class="fa fa-plus"></i> '.$language->ADDTAB.'
                                  </a>' : '';

  ?>


  <?=$this->load->view('admin/allmodules/table/header_with_action.php',$data_header)?>
  <div class="listContent p-10">
    
    <?php 
    $data['more_menu'] = '';
    $tab_array = $lang == "en" ? (isset($readXML_en) && count($readXML_en) ? $readXML_en : '')
                               : (isset($readXML_vn) && count($readXML_vn) ? $readXML_vn : '');

    if(isset($tab_array->tab) && count($tab_array)){
      foreach($readXML_en->tab as $value):
         $data['more_menu'] .= '<li><a data-toggle="tab" data-id='.$value->url.' href="#'.$value->url.'">'.$value->title.' <i class="fa fa-times text-danger pull-right"></i></a> </li>';
      endforeach; 
    }

    ?>
   

    <?=$this->load->view('admin/allmodules/tab_header/info_image_content_seo.php',$data)?>
    
    <div class="tab-content m-t-30 tab-content-control">
     
      <div id="info" class="tab-pane fade in active col-sm-6">
        <?=$this->load->view('admin/allmodules/info.php')?>
        
        <!-- CATEGORY -->
        
        <div class="form-group">
          <label class="col-sm-3"><?=$lang=="en" ? "Car's Kinh" : "Loại Xe"?></label>
          <div class="col-sm-9">
            <select class="form-control" name="db-cat">  
            <option value="0"><?=$lang=="en" ? "Choose Style" : "Chọn Loại"?></option>
            <?php if(isset($results_car_style) && count($results_car_style)){
                  foreach($results_car_style as $car_style):?>
                  <option <?=isset($result->cat) ? ($result->cat == $car_style->id ? 'selected="selected"' : ""):""?> 
                          value="<?=$car_style->id?>"><?=$lang=="en" ? $car_style->title_en : $car_style->title_vn?>
                  </option>
            <?php endforeach;}?>
            </select>      
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3"><?=$lang=="en" ? "Price" : "Giá"?></label>
          <div class="col-sm-9">
            <input class="form-control" 
                    name="db-price" 
                    value="<?=isset($result->price) && count($result->price) ? $result->price : ''?>">
          </div>
        </div>


      </div>
      <?=$this->load->view('admin/allmodules/tab_content/image_other.php')?>
      <?=$this->load->view('admin/allmodules/tab_content/content_more.php')?>
      <?=$this->load->view('admin/allmodules/tab_content/meta.php')?>
      <?php require(FCPATH . APPPATH . 'views/admin/'.$FOLDERCONTROL.'/item_tab_content.php');?>
      
    </div>

    <input hidden="hidden" name="more-type_hidden" value="<?=isset($result->type) ? $result->type :""?>" />
    <input hidden="hidden" name="db-id" value="<?=isset($result->id) ? $result->id:""?>" />
    <input hidden="hidden" name="more-url_hidden" value="<?=isset($result->title_url) ? $result->title_url:""?>" />
  </div>
</form>

<style>
#tab .form-group{
  margin-bottom: 0px;
  padding-top: 25px;
  padding-bottom: 5px;
  font-size:11px;
}

#tab .form-group label.col-sm-12{
  background:#999;
  padding-top:5px;
  font-size: 14px;
  padding-bottom:5px;
}

#tab .form-group label{
  margin-bottom: 0px;
}

#tab .form-group:nth-child(2n){
  background: #EEE;
}

.add-form{
  margin-top: 20px;
  text-align: center;
}

#tab .form-group .col-sm-4 input{
  margin-bottom: 5px;
}

</style>

<?php require(FCPATH . APPPATH . 'views/admin/'.$FOLDERCONTROL.'/js_action.php');?>
<?php require(FCPATH . APPPATH . 'views/admin/'.$FOLDERCONTROL.'/item_template.php');?>