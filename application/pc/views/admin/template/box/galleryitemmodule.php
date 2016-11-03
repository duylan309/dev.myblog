<div class="mainMiddle">
  <form action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=savephoto&id=0&function=Item" method="post" id="submitForm" enctype="multipart/form-data">
    <div class="subhead">
      <ul>
        <li style="float:left"> <a href="#" class="btn clearmenu">
          <h2 style="color:#fff;font-size:10pt;margin-left:20px">Edit
            <?=$result->name?>
          </h2>
          </a> </li>
          <li>
          <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=gallery&id=0&function=photo">
             <i class="fa fa-ban"></i>&nbsp;<?=$language->BACK?>
            </a></label>
        </li>
              <li>
          <label class="btn buttonAdd btn-success" class="btn buttonAdd"><a href="#" class="funSave">
         <i class="fa fa-save"></i>&nbsp;  <?php echo $language->SAVE?>
            </a> </label>
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
                <td class="t1"><label>Alt_Image</label></td>
                
                <td class="t3"><input type="text" name="alt_image" size="50" value="<?=$result->alt_image?>"/>
                </td>
              </tr>
              <tr>
                <td class="t1"><label><?php echo $language->URL?></label></td>
                
                <td class="t3"><input type="text" name="linkphoto" size="50" value="<?=$result->linkphoto?>"/>
                </td>
              </tr>
              <tr>
                <td class="t1"><label class="label"><?php echo $language->STATUS?></label></td>
                
                <td class="t3"><?php
					if($define_folder["Status"]):
                        foreach($define_folder["Status"] as $key=> $value)
                        {
							$options[$key] = $value; 
                      
                        }
                   endif;
				   			
				echo form_dropdown('status', $options, set_value('status',$result->status));
				?></td>
              </tr>
              <tr>
                <td class="t1"><label class="label">
                    <?=$language->SORT?>
                  </label></td>
                
                <td class="t3"><input type="text" size="4" name="sort" value="<?=$result->sort?>"/></td>
              </tr>
              
           
             
              <tr>
                <td class="t1" style="vertical-align:top"><label>Content</label></td>
                
                <td class="t3">
                       <textarea name="content" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$result->content?>
</textarea>
               </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
     <input hidden="hidden" name="id" value="<?=$result->id?>" />
  </form>
</div>
