<form class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=adminuser&action=update&id=<?=$result->id?>&function=newPassword" method="post" id="submitForm" enctype="multipart/form-data">

<!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
      <?=$lang=="en" ? "Change Password" : "Thay Đổi Mật Khẩu"?>    
        <button class="btn btn-default btn-primary btn-success funSave pull-right btn-sm" name="save" type="submit" value="save">
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
     
      <div id="info" class="tab-pane fade in active col-sm-6">
        
          <?php
          
          if(isset($error)){
            
            echo '<div class="form-group">
                     <label class="col-sm-3"></label>
                     <div class="col-sm-9"><p class="error text-danger">'.$error.'</p></div>
                  </div>'; 
          }
          ?>

        <div class="form-group">
            <label class="col-sm-3"><?=$lang=="en" ? "Your current password" : "Mật khẩu hiện tại"?></label>
            <div class="col-sm-9">

            <?php
             $data = array(
              'name'        => 'oldpassadmin',
              'id'          => 'oldpassadmin',
              'value'       => set_value('oldpassadmin',''),
              'maxlength'   => '100',
              'size'        => '50',
              'class'    => 'input form-control oldpassadmin',
              'type'    => 'password',  
              
            );
            
            echo form_input($data);
            ?>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-3"><?=$lang=="en" ? "New password" : "Mật khẩu mới"?></label>
            <div class="col-sm-9">

            <?php
             $data = array(
              'name'        => 'newpassadmin',
              'id'          => 'newpassadmin',
              'value'       => set_value('newpassadmin',''),
              'maxlength'   => '100',
              'size'        => '50',
              'class'    => 'input form-control newpassadmin',
              'type'    => 'password',  
              
            );
            
            echo form_input($data);
            ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3"><?=$lang=="en" ? "Confirm new password" : "Xác nhận mật khẩu mới"?></label>
            <div class="col-sm-9">

           <?php
             $data = array(
              'name'        => 'confirmpassadmin',
              'id'          => 'confirmpassadmin',
              'value'       => set_value('confirmpassadmin',''),
              'maxlength'   => '100',
              'size'        => '50',
              'class'    => 'input form-control confirmpassadmin',
              'type'    => 'password',  
              'style'    => 'float:left',   
              
            );
            $js = 'onchange="checkPassword()"';
            echo form_input($data,'',$js);
            ?>
                        <small class="resultCheckpass text-danger"></small>
            </div>
        </div>

      </div>
    </div>
  </div>    

</form>

