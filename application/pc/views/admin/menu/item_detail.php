<form class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=menu&action=update&id=<?=isset($result->id) ? $result->id : 0?>&function=Save" method="post" id="submitForm" enctype="multipart/form-data">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
      <?=isset($result->id) ? ($lang=="en" ? 'Edit Menu' :'Chỉnh sửa Menu ') : ($lang=="en" ? 'Create New Menu' :'Tạo menu ')?>
      <button class="btn btn-default btn-primary btn-success funSave pull-right btn-sm" type="submit" value="save">
        <i class="fa fa-check"></i> <?=$lang=="en" ? "Save" :"Lưu"?>
      </button>
      
       <?php if(isset($result->id)):?>
        <?php if($result->type == 8):?>
        <a class="btn btn-default btn-primary pull-right btn-sm m-r-15" href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=gallery&id=<?=$result->id?>&function=photo">
          <i class="fa fa-image"></i> <?=$language->GALLERY?>
        </a>          
        <?php endif;?>  
      <?php endif;?>

      <a class="btn btn-default pull-right btn-sm m-r-15" href="<?=base_url().ADMINBASE?>?page=menu&action=lists&id=0&function=null">
        <i class="fa fa-ban"></i> <?=$language->CANCEL?>
      </a>

      </h3>
      <ol class="breadcrumb">
        <li>
          <i class="fa fa-dashboard"></i>  <a href="<?=base_url()?>admin">Dashboard</a>
        </li>
        <li class="active">
          <i class="fa fa-table"></i> <a href="<?=base_url().ADMINBASE?>?page=menu&action=lists&id=0&function=null"> <?=$lang=="en" ? 'Menu management' :'Quản trị menu'?> </a>
        </li>
      </ol>
    </div>
  </div>


  

  <div class="listContent p-10">
    
     <?php if(isset($result)):?>
        <?php if($result->type==1 || $result->type==2 || $result->type==8 || $result->type==0 ):?>
          <?=$this->load->view('admin/allmodules/tab_header/info_image_content_seo.php')?>
        <?php else:?>
          <?=$this->load->view('admin/allmodules/tab_header/info_seo.php')?>
        <?php endif;?>  
      <?php else:?>
          <?=$this->load->view('admin/allmodules/tab_header/info_seo.php')?>
      <?php endif;?>  
    
    <div class="tab-content m-t-30">
      <div id="info" class="tab-pane fade in active col-sm-6">
        <?=$this->load->view('admin/allmodules/info.php')?>

        <?php if(!isset($result->id)):?>
        <div class="form-group">
          <label class="col-sm-3"><?=$lang=="en" ? "Type" : "Loại"?></label>
          <div class="col-sm-9">
            <?php $options=NULL;
            if($define_folder["TypeMenu"]):
            foreach($define_folder["TypeMenu"] as $key=> $value)
            {
              if( $key == 1 || $key == 8 || $key == 2 || $key == 3 || $key == 0 || $key == 9 || $key == 10 ):
                $options[$key] = $value;
              endif;
            }
            endif;
            echo form_dropdown('db-type" id="menuType" class="form-control', $options, set_value('type',isset($result->type) ? $result->type : ""));
            ?>
          </div>
        </div>
      <?php endif;?>

        <div class="form-group">
          <label class="col-sm-3"><?=$lang=="en" ? "Group" : "Nhóm"?></label>
          <div class="col-sm-9">
            <select class="form-control" name="db-parent">  
            <option value="0">Main Menu</option>
            <?php if(isset($AdminMenu) && count($AdminMenu)){
                  foreach($AdminMenu as $m):?>
                  <?php if($m->parent == 0 || $m->parent == 1):?>
                  <option <?=isset($result->parent) ? ($result->parent == $m->id ? 'selected="selected"' : ""):""?> value="<?=$m->id?>"><?=$lang=="en" ? $m->title_en : $m->title_vn?></option>
                  <?php endif;?>
            <?php endforeach;
                  }?>
            </select>      
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-3">Admin Sort</label>
          <div class="col-sm-9">
            <input class="form-control" type="text" size="4" name="db-sort_admin" value="<?=isset($result->sort_admin) ? $result->sort_admin : ""?>"/>                </div>
          </div>
        </div>
        
        <?php if(isset($result)):?>
          
          <?php if($result->type==1 || $result->type==2 || $result->type==8 || $result->type==0):?>
            <?=$this->load->view('admin/allmodules/tab_content/content.php')?>
            <?=$this->load->view('admin/allmodules/tab_content/image.php')?>
          <?php elseif($result->type==7):?>     
                <?=$this->load->view('admin/menu/contact.php')?>
          <?php else:?>
            <?=$this->load->view('admin/menu/nodetail.php')?>     
          <?php endif?>

        <?php endif;?>  
        
        <?=$this->load->view('admin/allmodules/tab_content/meta.php')?>
      
      </div>
    </div>
    <input hidden="hidden" name="db-id" value="<?=isset($result->id) ? $result->id:""?>" />
    <input hidden="hidden" name="more-type_hidden" value="<?=isset($result->type) ? $result->type :""?>" />
    <input hidden="hidden" name="more-url_hidden" value="<?=isset($result->title_url) ? $result->title_url:""?>" />
  </form>