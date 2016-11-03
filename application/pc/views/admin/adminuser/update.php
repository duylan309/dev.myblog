<form class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=adminuser&action=update&id=<?=$result->id?>&function=Save" method="post" id="submitForm" enctype="multipart/form-data">
  <input hidden="hidden" name="id" value="<?=$result->id?>" />
  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
      <?=$lang=="en" ? "Update User" : "Cập Nhật Admin"?>    
        <button class="btn btn-default btn-primary btn-success funSave pull-right btn-sm" type="submit" value="save">
            <i class="fa fa-check"></i> <?=$lang=="en" ? "Save" :"Lưu"?>
          </button>
      
      <a class="btn btn-default pull-right btn-sm m-r-15" 
        href="<?=base_url().ADMINBASE?>?page=adminuser&action=lists&id=0&function=null">
        <i class="fa fa-ban"></i> <?=$language->CANCEL?>
      </a>

      </h3>
      <ol class="breadcrumb">
        <li>
          <i class="fa fa-dashboard"></i>  <a href="<?=base_url().ADMINBASE?>">Dashboard</a>
        </li>
        <li class="active">
          <i class="fa fa-table"></i> 
          <a href="<?=base_url().ADMINBASE?>?page=adminuser&action=lists&id=0&function=null"> 
            <?=$lang=="en" ? "Account Admin management" :"Quản trị tài khoản Admin"?>
          </a>
        </li>
      </ol>
    </div>
  </div>
  <div class="listContent p-10">
    
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#info" data-toggle="tab">Info</a>
      </li>
    </ul>   

    <div class="tab-content m-t-30">
     
      <div id="info" class="tab-pane fade in active col-sm-12">
        <?php if(isset($result) && isset($image_link) && is_file($image_link)):?>
          <div class="form-group">
              <div class="col-sm-6 col-sm-offset-2">
                <img class="img-responsive img-rounded" src="<?=base_url().$image_link?>" width="200"/>
                <div class="checkbox">
                  <label>
                    <input name="action-del_image" value="1" type="checkbox"> Delete Image
                  </label>
                </div>
              </div>
          </div>    
        <?php endif;?>

        <div class="form-group">
            <label class="col-sm-2"><?=$language->IMAGE?></label>
            <div class="col-sm-6">
              <?php $data = array( 'name' => 'file_images', 'id' => 'file_images');
                    echo form_upload($data);?>
            </div>
        </div>
        
        <input type="hidden" name="old_image" value="<?=$result->image?>">
  
        <div class="form-group">
            <label class="col-sm-2">Alt Image</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="alt_image" value="<?=isset($result->alt_image) ? $result->alt_image : ""?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2"><?=$lang=="en" ? "Name" : "Tên"?></label>
            <div class="col-sm-6">
              <input rules="required" class="form-control input" type="text" size="4" name="name" value="<?=$result->name?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2"><?=$lang=="en" ? "Title" : "Chức vụ"?></label>
            <div class="col-sm-6">
              <input rules="required" class="form-control input" type="text" size="4" name="title" value="<?=$result->title?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2">Username</label>
            <div class="col-sm-6">
              <input rules="required" class="form-control input useradmin" type="text" size="4" name="useradmin" value="<?=$result->useradmin?>"/>
              <?php if(isset($error) && count($error)): ?><small class="error text-danger"><?=$error?></small><?php endif;?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2"><?=$lang=="en" ? "Password" : "Mật khẩu"?></label>
            <div class="col-sm-6">
              <a class="btn input-sm btn-danger" href="<?=base_url().ADMINBASE?>?page=adminuser&action=update&id=<?=$result->id?>&function=ChangePass">
                <div class="changePass"><?=$lang=="en" ? "Change password" : "Thay đổi mật khẩu"?></div>
              </a>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2"><?php echo $language->EMAIL?></label>
            <div class="col-sm-6">
            <?php
               $data = array(
                'name'        => 'email',
                'id'          => 'email',
                'value'       => set_value('email',$result->email),
                'maxlength'   => '100',
                'size'        => '50',
                'class'    => 'input form-control',
                'type'    => 'email',   
                
              );
        
              echo form_input($data);
              ?>

            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2"><?=$lang=="en" ? "Description" : "Miêu tả"?></label>
            <div class="col-sm-10">
            <textarea name="description" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:250px;">
                <?=$result->description?>
              </textarea>
            </div>
        </div>


      </div>

   </div>

</form>

   
 