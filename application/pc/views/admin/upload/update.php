<div class="deleteHeight">
   <?php //echo form_open_multipart('admin/article/rundo')?>
   <form action="<?=base_url()?>admin/article/update/<?=$result->id?>/Save" method="post" id="add_article" enctype="multipart/form-data">
    <div class="subhead">
      <input type="submit" value="<?php echo $language->SAVE?>" name="add_article" id="add_article" class="btn buttonAdd btn-success" />
      <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url()?>admin/article/remove/<?=$result->id?>/null" class="funDelete">
        <?=$language->DELETE?>
        </a> </label>
    <!--  <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url()?>admin/article/gallery/<?=$result->id?>/null">
        <?=$language->GALLERY?>
        </a></label>-->
      <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url()?>admin/article/lists/0/null">
        <?=$language->CANCEL?>
        </a></label>
    </div>
    <div class="uiContent">
      <div class="content-tab">
        <ul class="jquery-tabs rightMenu">
          <li><a href="#">Info</a></li>
          <li><a href="#">Details</a></li>
          <li><a href="#">SEO</a></li>
        </ul>
        <div class="jquery-panes"> 
          <!-- Block 1-->
          <div class="paneBlock">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
               <tr>
                <td class="t1"><label>
                    <?=$language->TITLE?>
                  </label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><input type="hidden" name="title_vn" value="0" />
                  <?php
						 $data = array(
						  'name'        => 'title_en',
						  'id'          => 'title_en',
						  'value'       => set_value('title_en',$result->title_en),
						  'maxlength'   => '100',
						  'size'        => '50',
						  'class'	   => 'input',	
						  
						);
			
						echo form_input($data);
						?></td>
              </tr>
              <tr>
                <td class="t1"><label><?php echo $language->URL?></label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3">	<input type="text" id="titleUrl" name="titleUrl" size="50" value="<?=$result->title_url?>" onchange="checkUrl(<?=$result->id?>,'article','<?=base_url()?>')" />
                
                <span class="checkURL"></span> (Ví dụ: http://website.com/sp/+ Url)</td>
              </tr>
               <tr>
               <td class="t1"><label>
                   Alt_image
                  </label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><input type="text" name="alt_image" value="<?=$result->alt_image?>" />
                </td>
               
               </tr>
              <tr>
                <td class="t1"><label>
                    <?=$language->IMAGE?>
                  </label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3">
                  <?php
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
           <tr>
                <td class="t1"><label>
                    <?=$language->CATEGORY?>
                  </label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><select name="cat" id="cat" style="width:160px;">
                    <?php
					foreach($result_cat as $key )
					{								
					?>
                        <option value="<?=$key->id?>" <?=$key->id == $result->cat ? "selected" : ""?>>
                        <?=$lang='en' ? $key->title_en: $key->title_vn?>
                        </option>
                    <?php
					}
					?>
                  </select></td>
              </tr>
              
              </tr>
                <input type="hidden" name="style" value="0" />
              <tr>
                <td class="t1"><label class="label"><?php echo $language->STATUS?></label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3">
                    <?php
					if($define_folder["Status"]):
                        foreach($define_folder["Status"] as $key=> $value)
                        {
							$options[$key] = $value; 
                      
                        }
                   endif;
				   			
				echo form_dropdown('status', $options, set_value('status',$result->status));
				?>
                  
                  
                 </td>
              </tr>
              <tr>
                <td class="t1"><label class="label">
                    <?=$language->SORT?>
                  </label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><input type="text" size="4" name="sort" value="<?=$result->sort?>"/></td>
              </tr>
            
                <td class="t1"><label>
                    <?=$language->DAY?>
                  </label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3">
      <input id="dp1" name="date" type="text" value="<?=date('j M Y',$result->date)?>" /></td>
      
        </tr>
            </table>
          </div>
          
          <!-- Block 3-->
          
          <div class="paneBlock">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
              <tr>
            
              <tr>
             
            
            <input type="hidden" name="content_vn" value="0" />
            <input type="hidden" name="content_en" value="0" />
              <tr>
                <td class="t1"><label>Content</label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><input type="hidden" name="description_vn" value="0" />
                        <textarea name="description_en" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$readXML_en->info->description?>
</textarea>
                      </td>
              </tr>
            </table>
          </div>
          <!-- Block-------------------->
          
          <div class="paneBlock">
             <table border="1" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td class="t1"><?php echo $language->METATITLE;?></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><input type="hidden" name="meta_title_vn" value="0" />
                  <?php
						 $data = array(
						  'name'        => 'meta_title_en',
						  'id'          => 'meta_title_en',
						  'value'       => set_value('meta_title_en',$readXML_en->info->meta->title),
						  'maxlength'   => '100',
						  'size'        => '50',
						  'rows'		=> '1',
						  'cols'		=> '50',
						  'class'	   => 'input',	
						  
						);
			
						echo form_input($data);
						?></td>
              </tr>
              <tr>
                <td class="t1"><?php echo $language->METAKEYWORD?></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><input type="hidden" name="meta_keyword_vn" value="0" />
                  <textarea rows="3" cols="50" name="meta_keyword_en"><?php echo $readXML_en->info->meta->keyword;?></textarea></td>
              </tr>
              <tr>
                <td class="t1"><?php echo $language->METADESCRIPTION?></td>
                <td class="t2">&nbsp;</td>
                <td><input type="hidden" name="meta_description_vn" value="0" />
                  <textarea rows="3" cols="50" name="meta_description_en"><?php echo $readXML_en->info->meta->description;?></textarea></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <input hidden="hidden" name="image_id" value="<?=$result->image?>" />
    <input hidden="hidden" name="id" value="<?=$result->id?>" />
 <?php //echo form_close(); ?>
 </form>
</div>
