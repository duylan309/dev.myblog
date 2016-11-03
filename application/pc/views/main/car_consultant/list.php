<div class="container-section">
  <div class="row">
    <div class="col-sm-3">
      <nav id="bs-navbar" class="collapse navbar-collapse menu-left">
        <ul class="nav nav-pills nav-stacked">
          <?=$lang=="en" ? "<li>Menu</li>" : ""?>
          <?=$this->load->view('main/template/box/menu_right.php')?>
        </ul>
      </nav>

      <div class="section-banner m-t-15 ">
        <?=isset($configSite[0]->info->banner_left) ? str_replace('src="upload','src="'.base_url().'upload',$configSite[0]->info->banner_left) : ''?></td>
        
      </div>

    </div>

    <div class="col-sm-9 border-left car_consultant_content">
        <form class="form_consultant" action="<?=base_url().$result_menu['menu']->title_url?>" method="get">
        
        <div class="consultant">
          <div class="row">
            <label class="col-sm-12"><?=$lang=="en" ? "Car Loan" : "Mua xe trả góp"?></label>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <?=$lang=="en" ? (isset($configSite[0]->info->content_consultant_left_en) ? $configSite[0]->info->content_consultant_left_en : '')  : (isset($configSite[0]->info->content_consultant_left_vn) ? str_replace('src="upload','src="'.base_url().'upload',$configSite[0]->info->content_consultant_left_vn) : '') ?>
              </div>
            <div class="col-sm-8">
              <?=$lang=="en" ? (isset($configSite[0]->info->content_consultant_right_en) ? $configSite[0]->info->content_consultant_right_en : '')  : (isset($configSite[0]->info->content_consultant_right_vn) ? str_replace('src="upload','src="'.base_url().'upload',$configSite[0]->info->content_consultant_right_vn) : '') ?>
           
              <div class="math">
                <header><?=$lang=="en" ? "Find The Price" : "Tính Giá Xe"?></header>
                <div class="content">
                  <div class="row">
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <select class="form-control input-sm car_category" name="">  
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
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <select class="form-control input-sm car_value" name="">  
                        <option value="0"><?=$lang=="en" ? "Choose Car" : "Chọn Xe"?></option>
                        <?php if(isset($results_car) && count($results_car)){
                              foreach($results_car as $car):?>
                              <option data-cat="<?=$car->cat?>" data-price="<?=$car->price?>" <?=isset($result->cat) ? ($result->cat == $car->id ? 'selected="selected"' : ""):""?> 
                                      value="<?=$car->price?>"><?=$lang=="en" ? $car->title_en : $car->title_vn?>
                              </option>
                        <?php endforeach;}?>
                        </select>    
                      </div>     

                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <select class="form-control input-sm car_year" name="">  
                        <option value="0"><?=$lang=="en" ? "Choose Year" : "Chọn Số Năm Vay"?></option>
                        <?php for($i = 1 ;$i <8 ;$i++):?>
                              <option value="<?=$i*12?>"><?=$i.' '?><?=$lang=="en" ? "years" : "Năm"?>
                              </option>
                        <?php endfor;?>
                        </select>   
                      </div>     

                    </div>

                    <div class="col-sm-8">
                      <div class="form-group"> 
                        <input  id="price_loan"
                                class="form-control car_money input-sm" 
                                name="car_money" 
                                type="input"
                                value="" 
                                placeholder="<?=$lang=="en" ? "How much do you want to loan?" : "Đánh vào số phần % muốn vay"?>">    
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="form-group"> 
                       <div class="btn btn-primary input-sm" id="submit_consultant"><?=$lang=="en" ? "View Result" : "Xem Kết Quả" ?></div>
                      </div>
                    </div>
                      
                    
                    <div class="col-sm-12">
                      <div id="price_result" class="result">
                        <span><?=$lang=="en" ? "Price/month =~ " : "Số tiền/ tháng =~ "?></span>
                        <span class="pr"></span>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>
        
        <div class="insurance">
          <div class="row">
            <label class="col-sm-12"><?=$lang=="en" ? "Insurance" : "Bảo hiểm vật chất"?></label>
          </div>
          <div class="row">
            <div class="col-sm-4">
              <?=$lang=="en" ? (isset($configSite[0]->info->content_insurance_left_en) ? $configSite[0]->info->content_insurance_left_en : '')  : (isset($configSite[0]->info->content_insurance_left_vn) ? str_replace('src="upload','src="'.base_url().'upload',$configSite[0]->info->content_insurance_left_vn) : '') ?>
              </div>
            <div class="col-sm-8">
              <?=$lang=="en" ? (isset($configSite[0]->info->content_insurance_right_en) ? $configSite[0]->info->content_insurance_right_en : '')  : (isset($configSite[0]->info->content_insurance_right_vn) ? str_replace('src="upload','src="'.base_url().'upload',$configSite[0]->info->content_insurance_right_vn) : '') ?>
            
              <div class="math">
                <header><?=$lang=="en" ? "Find The Price" : "Tính Giá Bảo Hiểm"?></header>
                <div class="content">
                  <div class="row">
                    
                    <div class="col-sm-4">
                      <select class="form-control input-sm car_category" name="">  
                      <option value="0"><?=$lang=="en" ? "Choose Category" : "Chọn Dòng"?></option>
                      <?php if(isset($results_car_category) && count($results_car_category)){
                            foreach($results_car_category as $car):?>
                            <option <?=isset($result->cat) ? ($result->cat == $car->id ? 'selected="selected"' : ""):""?> 
                                    value="<?=$car->id?>"><?=$lang=="en" ? $car->title_en : $car->title_vn?>
                            </option>
                      <?php endforeach;}?>
                      </select>      
                    </div>
                    
                    <div class="col-sm-4">
                      <select class="form-control input-sm car_value" name="">  
                      <option value="0"><?=$lang=="en" ? "Choose Car" : "Chọn Xe"?></option>
                      <?php if(isset($results_car) && count($results_car)){
                            foreach($results_car as $car):?>
                            <option data-cat="<?=$car->cat?>" data-price="<?=$car->price?>" <?=isset($result->cat) ? ($result->cat == $car->id ? 'selected="selected"' : ""):""?> 
                                    value="<?=$car->price?>"><?=$lang=="en" ? $car->title_en : $car->title_vn?>
                            </option>
                      <?php endforeach;}?>
                      </select>      
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="btn btn-primary input-sm" id="submit_insurance"><?=$lang=="en" ? "View Result" : "Xem Kết Quả" ?></div>
                    </div>
                      
                    <div class="col-sm-12">
                      <div id="price_result" class="result">
                        <span><?=$lang=="en" ? "Price =~ " : "Thành Tiền =~ "?></span> <span class="pr"></span>
                      </div>
                    </div>

                  </div>
                </div>

            </div>
          </div>
        </div>
          
        </form>
  

      </div>  
    </div>
  </div>
</div>

<select class="hidden" data-total-option-car>
<option value="0"><?=$lang=="en" ? "Choose Category" : "Chọn Dòng"?></option>
<?php if(isset($results_car) && count($results_car)){
      foreach($results_car as $car):?>
      <option data-cat="<?=$car->cat?>" data-price="<?=$car->price?>" <?=isset($result->cat) ? ($result->cat == $car->id ? 'selected="selected"' : ""):""?> 
              value="<?=$car->price?>"><?=$lang=="en" ? $car->title_en : $car->title_vn?>
      </option>
<?php endforeach;}?>
</select>


<script type="text/javascript">
  $(document).ready(function() {
    $('.form_comparison select') .change(function () {
      $('.form_comparison').submit();
    })

    $('#price_loan').priceFormat({
          prefix: '',
          suffix: ' %', centsLimit: 0
      });

    $('.consultant .car_category').change(function() {
      $('.consultant .car_value').html('<option value="0"><?=$lang=="en" ? "Choose Category" : "Chọn Dòng"?></option>');
      $("[data-total-option-car]").clone().find('[data-cat="'+$(this).val()+'"]').appendTo(".consultant .car_value");
    });

    $('.insurance .car_category').change(function() {
      $('.insurance .car_value').html('<option value="0"><?=$lang=="en" ? "Choose Category" : "Chọn Dòng"?></option>');
      $("[data-total-option-car]").clone().find('[data-cat="'+$(this).val()+'"]').appendTo(".insurance .car_value");
    });

    // CONSULTANT
    $('#submit_consultant').click(function() {
      var price_car = $('.consultant .car_value').val(),
          year = $('.car_year').val(),
          money = $('.car_money').val(),
          result,first_result,result1,
          percent = '<?=$configSite[0]->info->content_consultant_percent?>';
          money = price_car * parseFloat(money) / 100;
          first_result = money / year;
          result = first_result + ((money * parseFloat(percent) / 100) / 360 * 30);
          result = result.toString().split('.')[0];

      $('.consultant .result .pr').html(result).priceFormat({
          prefix: '',
          suffix: ' VND',
          thousandsSeparator: ',',
          centsLimit: 0
      });

    });



    // INSURANCE
    $('#submit_insurance').click(function() {
      var price_car = $('.insurance .car_value').val(),
          result,
          percent = '<?=$configSite[0]->info->content_insurance_percent?>';

      result = (price_car * parseFloat(percent)) / 100;

      $('.insurance .result .pr').html(result).priceFormat({
          prefix: '',
          suffix: ' VND', centsLimit: 0
      });
    });



  });
</script>
