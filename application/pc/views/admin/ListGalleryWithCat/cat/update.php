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
           <i class="fa fa-ban"></i>&nbsp;  <?=$language->CANCEL?>
            </a></label>
        </li>
       <li>
          <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=remove&id=<?=$result->id?>&function=null" class="funDelete">
           <i class="fa fa-trash-o"></i>&nbsp;  <?=$language->DELETE?>
            </a> </label>
        </li>
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
                        <?php
						 $data = array(
						  'name'        => 'title_vn',
						  'id'          => 'title_vn',
						  'value'       => set_value('title_vn',$result->title_vn),
						  'maxlength'   => '100',
						  'size'        => '50',
						  'class'	   => 'input',	
						  
						);
			
						echo form_input($data);
						?>
                      </div>
                      <!-- Block 2-->
                      <div class="paneBlock-1">
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
						?>
                      </div>
                    </div>
                  </div></td>
              </tr>
              <tr>
                <td class="t1"><label><?php echo $language->URL?></label></td>
                
                <td class="t3"><input type="text" id="titleUrl" name="titleUrl" size="50" value="<?=$result->title_url?>" onchange="checkUrl(<?=$result->id?>,'album','<?=base_url()?>')" />
                  <span class="checkURL"></span> (Ví dụ: http://website.com/sp/+ Url) </td>
              </tr>
              <!--<tr class="showCategory">
                <?php if($arrCat):?>
                <td class="t1"><label>
                    <?=$language->CATEGORY?>
                  </label></td>
                
                <td class="t3"><select name="cat" id="cat" style="width:160px;" >
                   <option value="0" <?=$result->cat==0 ? "selected" : ""?>>Parent</option>
				
                <?php foreach($arrCat as $key ):?>
                <?php if($key['cat'] != $result->id && $key['source'] != $row->id):?>
                <option <?=$key['id'] == $result->id ?'style="background:#333;color:#fff"' :'' ?> value="<?=$key['id']?>" <?=$key['id'] == $result->cat ? "selected" : ""?>> <?=$lang=='en' ? $key['text_en']: $key['text_vn']?></option>
                <?php endif;?>
                <?php endforeach;?>
              </select>
                  
                  
                  </td>
                <?php endif; ?>
              </tr>-->
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
                <td class="t1"><label>
                    <?=$language->DAY?>
                  </label></td>
                
                <td class="t3"><input id="dp1" name="date" type="text" value="<?=$result->date?>" /></td>
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
                    <?=$language->IMAGE?>
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
                <td class="t1" style="vertical-align:top"><label>Short Content</label></td>
                
                <td class="t3"><div class="content-tab-1">
                    <ul class="jquery-tabs-1">
                      <li><a href="#">VN</a></li>
                      <li><a href="#">EN</a></li>
                    </ul>
                    <div class="jquery-panes-1"> 
                      <!-- Block 1-->
                      <div class="paneBlock-1">
                        <textarea name="content_vn" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$readXML_vn->info->content?>
</textarea>
                      </div>
                      <!-- Block 2-->
                      <div class="paneBlock-1">
                        <textarea name="content_en" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$readXML_en->info->content?>
</textarea>
                      </div>
                    </div>
                  </div></td>
              </tr>
              <tr>
                <td class="t1" style="vertical-align:top"><label>Full Content</label></td>
                
                <td class="t3"><div class="content-tab-1">
                    <ul class="jquery-tabs-1">
                      <li><a href="#">VN</a></li>
                      <li><a href="#">EN</a></li>
                    </ul>
                    <div class="jquery-panes-1"> 
                      <!-- Block 1-->
                      <div class="paneBlock-1">
                        <textarea name="description_vn" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$readXML_vn->info->description?>
</textarea>
                      </div>
                      <!-- Block 2-->
                      <div class="paneBlock-1">
                        <textarea name="description_en" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$readXML_en->info->description?>
</textarea>
                      </div>
                    </div>
                  </div></td>
              </tr>
            </table>
          </div>
          <!-- Block-------------------->
          
          <div class="paneBlock">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td class="t1"><label><?php echo $language->METATITLE;?></label></td>
                
                <td class="t3"><div class="content-tab-1">
                    <ul class="jquery-tabs-1">
                      <li><a href="#">VN</a></li>
                      <li><a href="#">EN</a></li>
                    </ul>
                    <div class="jquery-panes-1"> 
                      <!-- Block 1-->
                      <div class="paneBlock-1">
                        <textarea name="meta_title_vn" rows="3" style="width:250px"><?=$readXML_vn->info->meta->title?>
</textarea>
                      </div>
                      <!-- Block 2-->
                      <div class="paneBlock-1">
                        <textarea name="meta_title_en" rows="3" style="width:250px"><?=$readXML_en->info->meta->title?>
</textarea>
                      </div>
                    </div>
                  </div></td>
              </tr>
              <tr>
                <td class="t1"><label><?php echo $language->METAKEYWORD?></label></td>
                
                <td class="t3"><div class="content-tab-1">
                    <ul class="jquery-tabs-1">
                      <li><a href="#">VN</a></li>
                      <li><a href="#">EN</a></li>
                    </ul>
                    <div class="jquery-panes-1"> 
                      <!-- Block 1-->
                      <div class="paneBlock-1">
                        <textarea name="meta_keyword_vn" rows="3" style="width:250px"><?=$readXML_vn->info->meta->keyword?>
</textarea>
                      </div>
                      <!-- Block 2-->
                      <div class="paneBlock-1">
                        <textarea name="meta_keyword_en" rows="3" style="width:250px" ><?=$readXML_en->info->meta->keyword?>
</textarea>
                      </div>
                    </div>
                  </div></td>
              </tr>
              <tr>
                <td class="t1"><label><?php echo $language->METADESCRIPTION?></label></td>
                
                <td><div class="content-tab-1">
                    <ul class="jquery-tabs-1">
                      <li><a href="#">VN</a></li>
                      <li><a href="#">EN</a></li>
                    </ul>
                    <div class="jquery-panes-1"> 
                      <!-- Block 1-->
                      <div class="paneBlock-1">
                        <textarea rows="3" style="width:250px" name="meta_description_vn" ><?=$readXML_vn->info->meta->description?>
</textarea>
                      </div>
                      <!-- Block 2-->
                      <div class="paneBlock-1">
                        <textarea rows="3" style="width:250px"  name="meta_description_en"><?=$readXML_en->info->meta->description?>
</textarea>
                      </div>
                    </div>
                  </div></td>
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
