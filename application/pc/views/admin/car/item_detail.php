<form data-form-validate class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=isset($result->id) ? $result->id : 0?>&function=Save" method="post" id="submitForm" enctype="multipart/form-data">
  <!-- Page Heading -->
  <?=$this->load->view('admin/allmodules/table/header_with_action.php')?>
  <div class="listContent p-10">
   <?php $data['more_menu'] = '<li><a href="#tab" data-toggle="tab">Information</a></li>';?>
    <?=$this->load->view('admin/allmodules/tab_header/info_image_seo.php',$data)?>
    
    <div class="tab-content m-t-30">
     
      <div id="info" class="tab-pane fade in active col-sm-6">
        <?=$this->load->view('admin/allmodules/info.php')?>
        <div class="form-group">
            <label class="col-sm-3"><?=$language->PRICE?></label>
            <div class="col-sm-9">
              <input id="price" class="input form-control" name="db-price" type="text" size="50" value="<?=isset($result->price) ? $result->price : ""?>" />
            </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3"><?=$lang=="en" ? "Car's Class" : "Dòng Xe"?></label>
          <div class="col-sm-9">
            <select class="form-control" name="db-cat">  
            <option value="0"><?=$lang=="en" ? "Choose Category" : "Chọn Dòng"?></option>
            <?php if(isset($results_car_category) && count($results_car_category)){
                  foreach($results_car_category as $car):?>
                  <option <?=isset($result->cat) ? ($result->cat == $car->id ? 'selected="selected"' : ""):""?> 
                          value="<?=$car->id?>"><?=$lang=="en" ? $car->title_en : $car->title_vn?>
                  </option>
            <?php endforeach;}?>
            </select>      
          </div>
        </div>

        

      </div>

      <?=$this->load->view('admin/allmodules/tab_content/image.php')?>
      <?=$this->load->view('admin/allmodules/tab_content/meta.php')?>

      <div id="tab" class="tab-pane fade in col-sm-12">
        <?php if(isset($results_car_value) && count($results_car_value)):?>
        <?php foreach($results_car_value as $value):?>
          <div class="form-group">
          <?php if($value->type_title == 1):?>
            <label class="col-sm-12 text-left"><?=$lang=="en" ? $value->title_en : $value->title_vn?></label>
          <?php else:?>
            <label class="col-sm-2 text-left"><?=$lang=="en" ? $value->title_en : $value->title_vn?></label>
            <input type="hidden" value="<?=$value->id?>" name="extra-<?=$value->id?>-id[]" />
            <div class="col-sm-5">
              <input class="input input-sm form-control" name="extra-<?=$value->id?>-title_vn[]" type="text" size="50" value="<?=isset($extra_vn['id'.$value->id]["title"]) && !is_array($extra_vn['id'.$value->id]["title"]) ? $extra_vn['id'.$value->id]["title"] : ""?>" />
              <input class="input input-sm form-control" name="extra-<?=$value->id?>-title_en[]" type="hidden" size="50" value="" />
              
            </div>
          <?php endif;?>  
          </div>  
        <?php endforeach;?>  
        <?php endif;?>
      </div>

      
    </div>

    <input hidden="hidden" name="more-type_hidden" value="<?=isset($result->type) ? $result->type :""?>" />
    <input hidden="hidden" name="db-id" value="<?=isset($result->id) ? $result->id:""?>" />
    <input hidden="hidden" name="more-url_hidden" value="<?=isset($result->title_url) ? $result->title_url:""?>" />
  </div>
</form>


<style>
#tab .form-group{
  margin-bottom: 0px;
  padding-top: 8px;
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
