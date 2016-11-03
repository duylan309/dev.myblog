<div class="mainMiddle">
  <form action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=0&function=Save" method="post" id="submitForm" enctype="multipart/form-data">
    <div class="subhead">
      <ul>
        <li style="float:left"> <a href="#" class="btn clearmenu">
          <h2 style="color:#fff;font-size:10pt;margin-left:20px">Add</h2>
          </a> </li>
        <li>
          <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=lists&id=<?=$row->id?>&function=null"> <i class="fa fa-ban"></i>&nbsp;
            <?=$language->CANCEL?>
            </a></label>
        </li>
        
        <li>
          <label class="btn buttonAdd btn-success" class="btn buttonAdd">
          <i class="fa fa-save"></i>&nbsp;
          <input class="funSave" type="submit" value="save" name="save" />
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
        </ul>
        <div class="jquery-panes"> 
          <!-- Block 1-->
          <div class="paneBlock">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td class="t1"><label>
                    <?=$language->TITLE?>
                  </label></td>
                <td class="t3"><div class="content-tab-1">
                    <ul class="jquery-tabs-1">
                      <li><a href="#">VN</a></li>
                      <li><a href="#">EN</a></li>
                    </ul>
                    <div class="jquery-panes-1"> 
                      <!-- Block 1-->
                      <div class="paneBlock-1">
                        <input class="input" name="title_vn" type="text" size="50" value="" />
                      </div>
                      <!-- Block 2-->
                      <div class="paneBlock-1">
                        <input class="input" name="title_en" type="text" size="50" value="" />
                      </div>
                    </div>
                  </div></td>
              </tr>
           
             <?php if($AdminMenu):?>
             <tr>
             <td class="t1"><?=$lang=="en" ? "Choose Articles" : "Chọn bài viết"?></td> 
             <td class="t3">
             <select name="menu_id">
             <?php foreach($AdminMenu as $adMenu):?>
             		<?php if( $adMenu->type==4):?>
                    
					<option value="<?=$adMenu->id?>"><?=$lang=="en" ? $adMenu->title_en : $adMenu->title_vn?></option>
                    
					<?php endif;?>
             <?php endforeach;?>
             </select>
             </td>
             </tr>
             <?php endif;?>   
              <tr>
                <td class="t1"><label class="label">
                    <?=$language->SORT?>
                  </label></td>
                <td class="t3"><input type="text" size="4" name="sort" value=""/></td>
              </tr>
             
            </table>
          </div>
         
        </div>
      </div>
    </div>
   
  </form>
</div>
