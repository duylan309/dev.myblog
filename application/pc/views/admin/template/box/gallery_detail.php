<form class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=<?=$FOLDERCONTROL?>&action=savephoto&id=0&function=Item&position=<?=isset($POSITIONIMG) ? $POSITIONIMG : ""?>" method="post" id="submitForm" enctype="multipart/form-data">
  <input hidden="hidden" name="id" value="<?=$result->id?>" />
  <input hidden="hidden" name="parent_id" value="<?=$result->album_id?>" />

  
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
      <?=$lang=="en" ? "Edit" : "Chỉnh sửa"?> <?=$result->name?>
      <button class="btn btn-default btn-primary btn-success funSave pull-right btn-sm" type="submit" value="save">
      <i class="fa fa-check"></i> <?=$lang=="en" ? "Save" :"Lưu"?>
      </button>
      
      <a class="btn btn-default pull-right btn-sm m-r-15" href="<?=base_url().ADMINBASE?>?page=<?=$FOLDERCONTROL?>&action=gallery&id=0&function=photo&position=<?=isset($POSITIONIMG) ? $POSITIONIMG : ""?>">
        <i class="fa fa-ban"></i> <?=$language->CANCEL?>
      </a>
      </h3>
      <ol class="breadcrumb">
        <li>
          <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>admin">Dashboard</a>
        </li>
        <li class="active">
          <i class="fa fa-table"></i> <a href="<?=base_url().ADMINBASE?>?page=<?=$FOLDERCONTROL?>&action=gallery&id=0&function=photo&position=<?=isset($POSITIONIMG) ? $POSITIONIMG : ""?>"><?=$result->name?> </a>
        </li>
      </ol>
    </div>
  </div>
  <div class="listContent p-10">
    
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#info" data-toggle="tab">Info</a>
      </li>
      <li>
        <a href="#content" data-toggle="tab">Content</a>
      </li>
    </ul>

    <div class="tab-content m-t-30">


      <div id="info" class="tab-pane fade in active col-sm-6">
        
        <div class="form-group">
          <label class="col-sm-2">Alt Image</label>
          <div class="col-sm-10">
            <input class="form-control" type="text" name="alt_image" value="<?=isset($result->alt_image) ? $result->alt_image : ""?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2">URL</label>
          <div class="col-sm-10">
            <input class="form-control" type="text" name="linkphoto" value="<?=isset($result->linkphoto) ? $result->linkphoto : ""?>" />
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2"><?php echo $language->STATUS?></label>
          <div class="col-sm-10">
            <?php $options=NULL;
            if($define_folder["Status"]):
            foreach($define_folder["Status"] as $key=> $value):
            $options[$key] = $value;
            endforeach;
            endif;
            echo form_dropdown('db-status" class="form-control', $options, set_value('status',isset($result->status)?$result->status:""));
            ?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2"><?php echo $language->SORT?></label>
          <div class="col-sm-10">
            <input class="form-control" type="text" size="4" name="sort" value="<?=isset($result->sort) ? $result->sort : ""?>"/>
          </div>
        </div>
      </div>

      <div id="content" class="tab-pane fade in col-sm-12">
      
        <div class="form-group">
          <label class="col-sm-2"><?=$language->CONTENT?></label>
          <div class="col-sm-10">
            
            <textarea name="content" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:350px;">
            <?=$result->content?>
            </textarea>
            
          </div>
        </div>

      </div>
    </div>
  </div>
</form>