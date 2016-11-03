<div class="mainMiddle">
  <form action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=$result->id?>&function=Save" method="post" id="submitForm" enctype="multipart/form-data">
    <div class="subhead">
      <ul>
        <li style="float:left"> <a href="#" class="btn clearmenu">
          <h2 style="color:#fff;font-size:10pt;margin-left:20px">Edit
            <?=$lang=='en' ? $result->title_en : $result->title_vn?>
          </h2>
          </a> </li>
          <li>
          <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=lists&id=<?=$row->id?>&function=null">
             <i class="fa fa-ban"></i>&nbsp;<?=$language->CANCEL?>
            </a></label>
        </li>
         <li>
          <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=remove&id=<?=$result->id?>&function=null" class="funDelete">
            <i class="fa fa-trash-o"></i>&nbsp;  <?=$language->DELETE?>
            </a> </label>
        </li>
        <li> <label style="width:190px" class="btn buttonAdd"><a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=gallery&id=0&function=photo">
       <i class="fa fa-image"></i>&nbsp; <?=$language->GALLERY?>(680x400)
        </a></label></li>
        <li>
          <label class="btn buttonAdd btn-success" class="btn buttonAdd">
         <i class="fa fa-save"></i>&nbsp; <input class="funSave" type="submit" value="save" name="save" />  
          </label>
        </li>

        
      </ul>
      <div class="clear"></div>
    </div>
    
    
    <div class="listContent">
    <div class="uiContent">
      <div class="content-tab">
        <ul class="jquery-tabs rightMenu">
          <li><a href="#">Info</a></li>
          <li><a href="#">Image</a></li>	 
         <li><a href="#">Details</a></li>
          <li><a href="#">SEO</a></li>
        </ul>
        <div class="jquery-panes"> 
          <!-- Block 1-->
          <div class="paneBlock">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
               <?=$this->load->view('admin/allmodules/edit_info.php')?>
             
            </table>
          </div>
           <div class="paneBlock">
             <?=$this->load->view('admin/allmodules/edit_image.php')?>
           </div>
          <div class="paneBlock">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
             <?=$this->load->view('admin/allmodules/add_content_small.php')?>
             <?=$this->load->view('admin/allmodules/add_content_full.php')?>
            </table>
          </div>
          <!-- Block-------------------->
        
          <div class="paneBlock">
            <?=$this->load->view('admin/allmodules/edit_meta.php')?>
          </div>
          
        </div>
      </div>
    </div>
    <input hidden="hidden" name="image_id" value="<?=$result->image?>" />
    <input hidden="hidden" name="id" value="<?=$result->id?>" />
  </form>
</div>
