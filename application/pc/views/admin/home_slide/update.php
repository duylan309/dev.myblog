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
          <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=lists&id=<?=$row->id?>&function=null"> <i class="fa fa-ban"></i>&nbsp;
            <?=$language->CANCEL?>
            </a></label>
        </li>
        <li>
          <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=remove&id=<?=$result->id?>&function=null" class="funDelete"> <i class="fa fa-trash-o"></i>&nbsp;
            <?=$language->DELETE?>
            </a> </label>
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
          <li><a href="#">Thông tin chung</a></li>
          <li><a class="image" <?=$result->type==1 ? 'style="display:none"' : ''?> href="#">Hình ảnh</a></li>
          <li><a class="video" <?=$result->type==0 ? 'style="display:none"' : ''?> href="#">Video</a></li>
         
        </ul>
        <div class="jquery-panes"> 
          <!-- Block 1-->
          <div class="paneBlock">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td class="t1"><label>
                    <?=$language->TITLE?>
                  </label></td>
                <td class="t3">
                        <div class="content-tab-1">
                    <ul class="jquery-tabs-1">
                      <li><a href="#">VN</a></li>
                      <li><a href="#">EN</a></li>
                    </ul>
                    <div class="jquery-panes-1"> 
                      <!-- Block 1-->
                      <div class="paneBlock-1">
                        <input class="input" name="title_vn" type="text" size="50" value="<?=$result->title_vn?>" />
                      </div>
                      <!-- Block 2-->
                      <div class="paneBlock-1">
                        <input class="input" name="title_en" type="text" size="50" value="<?=$result->title_en?>" />
                      </div>
                    </div>
                  </div>
                    </td>
              </tr>
              <tr>
                <td class="t1"><label>Link</label></td>
                <td class="t3"><input type="text" id="titleUrl" name="titleUrl" size="50" value="<?=$result->title_url?>" />
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
            <tr><td class="t1"><label>Loại</label></td><td class="t3"><?php
					if($define_folder["TypeHome"]):
                        foreach($define_folder["TypeHome"] as $key=> $value)
                        {
							$options[$key] = $value; 
                      
                        }
						
                   endif;
				   			
				echo form_dropdown('type" class="typeHome', $options, set_value('type',$result->type));
				?></td></tr>            
              <tr>
                <td class="t1"><label class="label">
                    <?=$language->SORT?>
                  </label></td>
                <td class="t3"><input type="text" size="4" name="sort" value="<?=$result->sort?>"/></td>
              </tr>
               <tr>
  <td class="t1" style="vertical-align:top"><label>Left Content</label></td>
  <td class="t3"><div class="content-tab-1">
      <ul class="jquery-tabs-1">
        <li><a href="#">VN</a></li>
        <li><a href="#">EN</a></li>
      </ul>
      <div class="jquery-panes-1"> 
        <!-- Block 1-->
        <div class="paneBlock-1">
          <textarea name="content_left_vn" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$result->content_left_vn?></textarea>
        </div>
        <!-- Block 2-->
        <div class="paneBlock-1">
          <textarea name="content_left_en" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$result->content_left_en?></textarea>
        </div>
    
      </div>
    </div></td>
</tr>
             <tr>
  <td class="t1" style="vertical-align:top"><label>Right Content</label></td>
  <td class="t3"><div class="content-tab-1">
      <ul class="jquery-tabs-1">
        <li><a href="#">VN</a></li>
        <li><a href="#">EN</a></li>
      </ul>
      <div class="jquery-panes-1"> 
        <!-- Block 1-->
        <div class="paneBlock-1">
          <textarea name="content_vn" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$result->content_vn?></textarea>
        </div>
        <!-- Block 2-->
        <div class="paneBlock-1">
          <textarea name="content_en" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$result->content_en?></textarea>
        </div>
    
      </div>
    </div></td>
</tr>

            </table>
          </div>
          <div class="paneBlock">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td class="t1"><label> Alt_image </label></td>
                <td class="t3"><input type="text" name="alt_image" value="<?=$result->alt_image?>" /></td>
              </tr>
              <tr>
                <td class="t1"><label>
                    <?=$language->IMAGE?> (960px x 380px)
                  </label></td>
                <td class="t3"><?php
				 $data = array(
				  'name'        => 'file_images',
				  'id'          => 'file_images',
						 );
	     		 echo form_upload($data);
				?>
                  <br>
                  <?php	
				 
				  if(is_file($image_link)): ?>
                  <div style="text-align:center" class="gallery"> <a href="<?=base_url().$image_link?>"><img  src="<?=base_url().$image_link?>" width="120"/></a> </div>
                  <div style="text-align:center">
                    <?=$language->DELETE?>
                    &nbsp; &nbsp;
                    <input type="checkbox" name="del_image" value="1" />
                  </div>
                  <?php
			endif;
			?></td>
              </tr>
            </table>
          </div>
          <div class="paneBlock">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td class="t1"><label> youtube link </label></td>
                <td class="t3"><input size="100" type="text" name="youtube_link" value="<?=$result->youtube_link?>" /></td>
              </tr>
              
            </table>
          </div>
        
        </div>
      </div>
    </div>
    <input hidden="hidden" name="image_id" value="<?=$result->image?>" />
    <input hidden="hidden" name="id" value="<?=$result->id?>" />
  </form>
</div>

<script type="application/javascript">
$(document).ready(function() {
    $('.typeHome').change(function() {
        if($(this).val() == 0){
			$('.image').css('display','block');
			$('.video').css('display','none');
		}else{
			$('.video').css('display','block');
			$('.image').css('display','none');	
		}
		
    });
});
</script>
