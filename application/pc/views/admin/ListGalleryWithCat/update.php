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
          <label style="width:140px" class="btn buttonAdd"><a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=gallery&id=0&function=photo"> <i class="fa fa-image"></i>&nbsp;
            <?=$language->GALLERY?>
            (width:633px) </a></label>
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
            <li><a href="#">Extra Info</a></li>
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
                          <?php $data = array('name'        => 'title_vn', 'value'       => set_value('title_vn',$result->title_vn),'size'        => '50'); echo form_input($data);?>
                        </div>
                        <!-- Block 2-->
                        <div class="paneBlock-1">
                          <?php $data = array('name'        => 'title_en', 'value'       => set_value('title_en',$result->title_en),'size'        => '50'); echo form_input($data);?>
                        </div>
                      </div>
                    </div></td>
                </tr>
                <tr>
                  <td class="t1"><label><?php echo $language->URL?></label></td>
                  <td class="t3"><input type="text" id="titleUrl" name="titleUrl" size="50" value="<?=$result->title_url?>" onchange="checkUrl(<?=$result->id?>,'album','<?=base_url()?>')" />
                    <span class="checkURL"></span> (Ví dụ: http://website.com/sp/+ Url) </td>
                </tr>
                 <tr>
                  <td class="t1"><label class="label"> Link more</label></td>
                  <td class="t3"><input type="text" name="linkmore" size="100" value="<?=$result->linkmore?>" /></td>
                </tr>
                <tr>
                  <td class="t1"><label>
                      Address
                    </label></td>
                  <td class="t3"><div class="content-tab-1">
                      <ul class="jquery-tabs-1">
                        <li><a href="#">VN</a></li>
                        <li><a href="#">EN</a></li>
                      </ul>
                      <div class="jquery-panes-1"> 
                        <!-- Block 1-->
                        <div class="paneBlock-1">
                          <?php $data = array('name'        => 'address_vn', 'value'       => set_value('address_vn',$result->address_vn),'size'        => '50'); echo form_input($data);?>
                        </div>
                        <!-- Block 2-->
                        <div class="paneBlock-1">
                        <div class="paneBlock-1">
                          <?php $data = array('name'        => 'address_en', 'value'       => set_value('title_en',$result->address_en),'size'        => '50'); echo form_input($data);?>
                        </div>
                      </div>
                    </div></td>
                </tr>
                
                <tr>
                  <td class="t1"><label>
                   Main view
                    </label></td>
                  <td class="t3"><?php unset($options);
					if($define_folder["TypeView"]):
                        foreach($define_folder["TypeView"] as $key=> $value){
							$options[$key] = $value; 
                        }
                    endif;
				   			
				    echo form_dropdown('mainview', $options, set_value('mainview',$result->mainview));
				?>
                  </td>
                </tr>
                <tr>
                  <td class="t1"><label class="label"> Acreage</label></td>
                  <td class="t3"><input type="text" name="acreage" size="50" value="<?=$result->acreage?>" /></td>
                </tr>
                 <tr>
                  <td class="t1"><label class="label"> Tree</label></td>
                  <td class="t3"><input type="text" name="tree" size="50" value="<?=$result->tree?>" /></td>
                </tr>
                 <tr>
                  <td class="t1"><label class="label"> Block</label></td>
                  <td class="t3"><input type="text" name="block" size="50" value="<?=$result->block?>" /></td>
                </tr>
                 <tr>
                  <td class="t1"><label class="label"> Apartment</label></td>
                  <td class="t3"><input type="text" name="apartment" size="50" value="<?=$result->apartment?>" /></td>
                </tr>
                
                 <tr>
                  <td class="t1"><label class="label"> Process</label></td>
                  <td class="t3"> <input type="text" name="available" size="10" value="<?=$result->available?>" /> :Available<br /><br />
                                  <input type="text" name="process" size="10" value="<?=$result->process?>" /> :Processing<br /><br />
                                  <input type="text" name="sold" size="10" value="<?=$result->sold?>" /> :Sold<br />
</td>
                </tr>
               
                <tr class="showCategory">
                  <?php if($arrCat):?>
                  <td class="t1"><label>
                      <?=$language->CATEGORY?>
                    </label></td>
                  <td class="t3"><?php foreach($result_cat as $rcat => $key ):?>
                    <?php $checked=""?>
                    <?php foreach($cat as $catitem => $catkey):?>
                    <?php if($catkey == $key->id):?>
                    <?php $checked = "checked='checked'"?>
                    <?php unset($cat[$catitem])?>
                    <?php endif;?>
                    <?php endforeach;?>
                    <input type="checkbox" value="<?=$key->id?>" value="<?=$key->id?>" name="cat[]" <?=$checked?> />
                    <?=$lang=='en' ? $key->title_en : $key->title_vn?>
                    <br>
                    <?php endforeach;?></td>
                  <?php endif; ?>
                </tr>
                
                 
                
               
                
                <tr>
                  <td class="t1"><label class="label"><?php echo $language->STATUS?></label></td>
                  <td class="t3"><?php unset($options);
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
              <tr class="showCategory">
                  <td class="t1"><label> Property Types</label></td>
                  <td class="t3"><?php foreach($result_kinds as $kin => $key ):?>
                    <?php $checked=""?>
                    <?php foreach($kinds as $kinditem => $kindkey):?>
                    <?php if($kindkey == $key->id):?>
                    <?php $checked = "checked='checked'"?>
                    <?php unset($kinds[$kindkey])?>
                    <?php endif;?>
                    <?php endforeach;?>
                    <input type="checkbox" value="<?=$key->id?>" value="<?=$key->id?>" name="kind[]" <?=$checked?> />
                    <img style="vertical-align:middle;" src="<?=base_url()?>upload/kinds/<?=$key->image?>" alt="<?=$key->alt_image?>" width="20" height="20" /> <?=$lang=="en" ? $key->title_en : $key->title_vn?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php endforeach;?></td>
                </tr>
               <tr class="showCategory">
                  <td class="t1"><label> Views</label></td>
                  <td class="t3"><?php foreach($result_views as $kin => $key ):?>
                    <?php $checked=""?>
                    <?php foreach($views as $viewitem => $viewkey):?>
                    <?php if($viewkey == $key->id):?>
                    <?php $checked = "checked='checked'"?>
                    <?php unset($views[$viewkey])?>
                    <?php endif;?>
                    <?php endforeach;?>
                    
                  <div class="icon"><input type="checkbox" value="<?=$key->id?>" value="<?=$key->id?>" name="view[]" <?=$checked?> /> <img style="vertical-align:middle;" src="<?=base_url()?>upload/views/<?=$key->image?>" alt="<?=$key->alt_image?>" width="20" height="20" /> <?=$lang=="en" ? $key->title_en : $key->title_vn?></div>
                    <?php endforeach;?></td>
              
                </tr>
              
                <tr class="showCategory">
                  <?php if($arrCat):?>
                  <td class="t1"><label> Features </label></td>
                  <td class="t3"><?php foreach($result_features as $fea => $key ):?>
                    <?php $checked=""?>
                    <?php foreach($feature as $featureitem => $featurekey):?>
                    <?php if($featurekey == $key->id):?>
                    <?php $checked = "checked='checked'"?>
                    <?php unset($cat[$featurekey])?>
                    <?php endif;?>
                    <?php endforeach;?>
                    <div class="icon"><input type="checkbox" value="<?=$key->id?>" value="<?=$key->id?>" name="feature[]" <?=$checked?> />
                    <img style="vertical-align:middle;margin-right:10px" src="<?=base_url()?>upload/features/<?=$key->image?>" alt="<?=$key->alt_image?>" width="20" height="20" /> <?=$lang=="en" ? $key->title_en : $key->title_vn?></div>
                    <?php endforeach;?></td>
                  <?php endif; ?>
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
                      (310px x 200px) </label></td>
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
                  <td class="t1"><label class="label"> Hotline</label></td>
                  <td class="t3"><input type="text" name="hotline" size="50" value="<?=$readXML_vn->info->hotline?>" /></td>
                </tr>

               <tr>
                  <td class="t1" style="vertical-align:top"><label>Download</label></td>
                  <td class="t3">
                  <div class="downloadbox">
                          <textarea name="download" class="mceEditor" style="width:100%; border:0px; background:none; height:100px !important;">
                        <?=$readXML_vn->info->download?>
</textarea>
</div>

<style>
.downloadbox #download_ifr{
  height: 100px !important;
}
</style>
                       </td>
                </tr>

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
                  <td class="t1"><?php echo $language->METATITLE;?></td>
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
                  <td class="t1"><?php echo $language->METAKEYWORD?></td>
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
                  <td class="t1"><?php echo $language->METADESCRIPTION?></td>
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

<style>
.icon{width:132px;margin-bottom:10px;float:left}
</style>