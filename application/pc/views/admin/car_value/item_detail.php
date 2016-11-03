<form data-form-validate class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=isset($result->id) ? $result->id : 0?>&function=Save" method="post" id="submitForm" enctype="multipart/form-data">
  <!-- Page Heading -->
  <?=$this->load->view('admin/allmodules/table/header_with_action.php')?>
  <div class="listContent p-10">
    
    <?=$this->load->view('admin/allmodules/tab_header/info_array_mutiple_simple.php')?>
    
    <div class="tab-content m-t-30" >
     
      <div id="info" class="tab-pane fade in active col-sm-12">
        <?php if(isset($results) && count($results)):?>
            <?php foreach($results as $value):?>
            <div class="form-group">
              <label class="col-sm-1 text-left"><?=$language->TITLE?></label>
              <input type="hidden" value="<?=$value->id?>" name="id[]" />

              <div class="col-sm-6">
                <input class="input input-sm form-control" name="title_vn[]" type="text" size="50" value="<?=isset($value->title_vn) ? $value->title_vn : ""?>" />
                <input class="input input-sm form-control" name="title_en[]" type="hidden" size="50" value="" />
              </div>
              
              <div class="col-sm-2">
                  <?php $options=NULL;
                      if($define_folder["Status"]):
                        foreach($define_folder["Status"] as $key=> $value_sub):
                                  $options[$key] = $value_sub;
                        endforeach;
                        unset($value_sub);
                      endif;
                      echo form_dropdown('status[]" class="form-control input-sm', $options, set_value('status',isset($value->status) ? $value->status: ""));
                    ?>
              </div>
              <div class="col-sm-2  ">
                  <?php $options=NULL;
                    if($define_folder["TypeTitle"]):
                      foreach($define_folder["TypeTitle"] as $key=> $value_sub):
                                $options[$key] = $value_sub;
                      endforeach;
                      unset($value_sub);
                    endif;
                    echo form_dropdown('type_title[]" class="form-control input-sm', $options, set_value('type_title',isset($value->type_title) ? $value->type_title: ""));?>  
              </div>
              <div class="col-sm-1">
               <i class="fa fa-trash-o text-danger" data-old></i> 
               <input type="hidden" class="delete-row" value="0" name="delete_row[]">
              
                  <i class="fa fa-arrows btn"></i>
              </div>

            </div>
            <?php endforeach;?>
        <?php endif;?>
       
      </div>
    </div>
    
    <div class="clearfix"></div>
    <div class="add-form">
      <div class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> <?=$lang=="en" ? 'Add' : 'Thêm'?></div>
    </div>

    </div>
</form>

<style>
#info .form-group{
  margin-bottom: 0px;
  padding-top: 8px;
  padding-bottom: 5px;
}

#info .form-group label{
  margin-bottom: 0px;
}

#info .form-group:nth-child(2n){
  background: #EEE;
}

.add-form{
  margin-top: 20px;
  text-align: center;
}

#info .form-group .col-sm-4 input{
  margin-bottom: 5px;
}

.fa-trash-o{
  cursor: pointer;
}

</style>
<script type="text/javascript">
  $(document).ready(function(){
 // ADD BUTTON
    $('.add-form .btn').click(function() {
      $( "#template_form .form-group" ).clone().appendTo("#info");
    });

    $('[data-old]').on('click',function(){
      $(this).next('.delete-row').val(1);
      $(this).closest('.form-group').hide();
    })

    $(document).on('click','[data-new]',function(){
      $(this).closest('.form-group').remove();
    })




    var el = document.getElementById('info')
    Sortable.create(el, {
      handle: '.fa-arrows',
      animation: 150,
    });
  });  
</script>


<!-- TEMPLATE FORM -->
<div id="template_form" data-count="" class="hidden">
  <div class="form-group">
      <input type="hidden" value="0" name="id[]" />
      <label class="col-sm-1 text-left"><?=$language->TITLE?></label>
      <div class="col-sm-6">
        <input class="input input-sm form-control" name="title_vn[]" type="text" size="50" value="<?=isset($result->title_vn) ? $result->title_vn : ""?>" />
        <input class="input input-sm form-control" name="title_en[]" type="hidden" size="50" value="" />
      </div>
     
      <div class="col-sm-2">
          <?php $options=NULL;
              if($define_folder["Status"]):
                foreach($define_folder["Status"] as $key=> $value_sub):
                          $options[$key] = $value_sub;
                endforeach;
              endif;
              echo form_dropdown('status[]" class="form-control input-sm', $options, set_value('status',''));
            ?>
      </div>
      <div class="col-sm-2">
          <?php $options=NULL;
            if($define_folder["TypeTitle"]):
              foreach($define_folder["TypeTitle"] as $key=> $value_sub):
                        $options[$key] = $value_sub;
              endforeach;
              unset($value_sub);
            endif;
            echo form_dropdown('type_title[]" class="form-control input-sm', $options, set_value('type_title',''));?>
      </div>
      <div class="col-sm-1">
          <i class="fa fa-trash-o text-danger" data-new></i> 
          <input type="checkbox" class="hidden delete-row" value="1" name="delete_row">
              
          <i class="fa fa-arrows btn"></i>
      </div>
  </div>
</div>
<!-- END TEMPLATE -->




