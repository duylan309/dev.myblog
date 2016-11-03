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
        <?=isset($configSite[0]->info->banner_left) ? $configSite[0]->info->banner_left : ''?></td>
      </div>

    </div>

    <div class="col-sm-9 border-left car_comparison_content">
        <form class="form_comparison" action="<?=base_url().$result_menu['menu']->title_url?>" method="get">
        
        <div class="row">
          <div class="col-sm-4 col-sm-offset-4">
            <div class="form-group">
              <?php if(isset($results_cars) && count($results_cars)):?>
              <select class="form-control input-sm" name="car_one">
                <?php foreach ($results_cars as $key => $value_car):?>
                <option <?=getParam($this,'car_one') ? (getParam($this,'car_one') == $value_car->id ? 'selected="selected"' : '') :''?> value="<?=$value_car->id?>"><?=$lang=="en" ? $value_car->title_en : $value_car->title_vn?></option>
                <?php endforeach;?>  
              </select>
              <?php endif;?>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="form-group">
              <?php if(isset($results_cars) && count($results_cars)):?>
              <select class="form-control input-sm" name="car_two">
                <?php foreach ($results_cars as $key => $value_car):?>
                <option <?=getParam($this,'car_two') ? ( getParam($this,'car_two') == $value_car->id ? 'selected="selected"' : '') :''?> value="<?=$value_car->id?>"><?=$lang=="en" ? $value_car->title_en : $value_car->title_vn?></option>
                <?php endforeach;?>  
              </select>
              <?php endif;?>
            </div>
          </div>
        </div>
        
        <table class="table table-bordered car_comparion">
        
        <?php if(isset($results_car_value) && count($results_car_value)):?>
        <?php foreach($results_car_value as $value):?>
          <tr class="row">
          <?php if($value->type_title == 1):?>
            <td class="col-sm-4 text-title"><?=$lang=="en" ? $value->title_en : $value->title_vn?></td>
            <td class="text-title"></td>
            <td class="text-title"></td>
          <?php else:?>
            <td class="col-sm-4 text-left"><?=$lang=="en" ? $value->title_en : $value->title_vn?></td>
            <td class="col-sm-4 text-left"><?=isset($readXml_car_one['id'.$value->id]["title"]) && !is_array($readXml_car_one['id'.$value->id]["title"]) ? $readXml_car_one['id'.$value->id]["title"] : ""?></td>
            <td class="col-sm-4 text-left"><?=isset($readXml_car_two['id'.$value->id]["title"]) && !is_array($readXml_car_two['id'.$value->id]["title"]) ? $readXml_car_two['id'.$value->id]["title"] : ""?></div>
          <?php endif;?>
          </tr>
        <?php endforeach;?>
        <?php endif;?>
        
        </table>

        </form>
  

      </div>  
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('.form_comparison select') .change(function () {
      $('.form_comparison').submit();
    })
  });
</script>
