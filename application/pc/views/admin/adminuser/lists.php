<form method="post" class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=adminuser&action=lists&id=0&function=null" id="searchSubmit">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
        <?=$lang=="en" ? "Account Admin management" :"Quản trị tài khoản Admin"?>
        <a class="btn btn-default btn-primary btn-success funSave pull-right btn-sm"
            href="<?=base_url().ADMINBASE?>?page=adminuser&action=update&id=0&function=Save">
            <i class="fa fa-check"></i> <?=$lang=="en" ? "Add" :"Thêm"?>
          </a>
      <a class="btn btn-default pull-right btn-sm m-r-15" href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=lists&id=0&function=null">
        <i class="fa fa-ban"></i> <?=$language->CANCEL?>
      </a>

      </h3>
      <ol class="breadcrumb">
        <li>
          <i class="fa fa-dashboard"></i>  <a href="<?=base_url().ADMINBASE?>">Dashboard</a>
        </li>
        <li class="active">
          <i class="fa fa-table"></i> 
          <a href="<?=isset($getMenuAdmin->title_url) ? base_url().ADMINBASE.'page='.$page.'&action=lists&id=0&function=null' : '#'?>">
           <?=$lang=="en" ? "Account Admin management" :"Quản trị tài khoản Admin"?>
          </a>
        </li>
      </ol>
    </div>
  </div>



  <div class="row">
    <div class="col-sm-12">
      <div>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th><?=$language->UPDATE;?></th>
              <th><div class="sortTable" table="<?=$lang=="en" ? "title_en" : "title_vn"?>" ><?=$lang=="en" ? "Name" :"Tên"?></div></th>
              <th><div class="sortTable">Title</div></th>
              <th><div class="sortTable">Email</div></th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($results):
            foreach ($results as $row){
            ?>
            <tr id="<?=$row->id?>">
             
              <td data-action class="col-sm-1">
                <label title="edit" style="margin:3px 5px">
                  <a href="<?=base_url().ADMINBASE?>?page=adminuser&action=update&id=<?=$row->id;?>&function=Item">
                  <i class="fa fa-edit"></i>&nbsp;  </a>
                </label>
                <label title="delete">
                  <a href="<?=base_url().ADMINBASE?>?page=adminuser&action=remove&id=<?=$row->id;?>&function=null" class="funDelete"> <i class="fa fa-trash-o"></i>&nbsp; </a>
                </label>
              </td>
              <td data-title class="col3">
                <img class="img-rounded img-admin-thumb" src="<?=SOURCEFOLDER.'user/'.$row->image?>">
                <span class="titleResult">
                  <?=$row->name?>
                </span>
              </td>
              <td data-title class="col3">
                <?=$row->title?>
              </td>
              <td data-email class="col3">
                <i class="fa fa-envelope-o"></i> <?=$row->email?>
              </td>
            </tr>
            <?php
            }
            endif;
            ?>
          </tbody>
          
        </table>
        <div class="row">
          <div class="col-sm-12 text-left">
            <?php echo $links; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<div class="loadding"></div>