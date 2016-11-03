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
                        <input class="input" name="title_vn" type="text" size="50" value="<?=$result->title_vn?>" />
                      </div>
                      <!-- Block 2-->
                      <div class="paneBlock-1">
                        <input class="input" name="title_en" type="text" size="50" value="<?=$result->title_en?>" />
                      </div>
                    </div>
                  </div></td>
              </tr>
              
            <tr>
              <td class="t1"><label class="label"><?=$lang=="en" ? "Layout" : "Giao diện"?></label></td>
              <td class="t3"><?php
					if($define_folder["Layout"]):
                        foreach($define_folder["Layout"] as $key=> $value)
                        {
							$options[$key] = $value; 
                      
                        }
                   endif;
				   			
				echo form_dropdown('layout', $options, set_value('layout',$result->layout));
				?></td>
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
            <tr><td class="t1" colspan="2"><div style="float:left" onclick="openWin('<?=base_url().ADMINBASE?>?page=<?=$page?>&action=other&id=<?=$row->id?>&function=Item')" class="btn buttonAdd btn-success" class="btn buttonAdd" ><?=$lang == "en" ? "Change" : "Thay đổi"?></div></td></tr>
             
              <tr>
                <td class="t1" colspan="2">
                    <table class="moduletable listItem" border="0" cellpadding="0" cellspacing="0" width="80%">
                          <thead>
                              <th width="50">Id</th>
                               <th width="50">Image</th>
                              <th>Title</th>
                            
                          </thead>
                         
                           <tbody class="detailTable">
       			   <?php if(isset($listArticleChoose)):?>
                            <?php foreach($listArticleChoose as $articlechoose):?>
                              <tr id="<?=$articlechoose->id?>">
                               <td class="col1"><span>
                                  <?=$articlechoose->id?>
                                  </span></td>
                               <td><img class="otherimg" src="<?=base_url()?>upload/<?=$menu_item->title_url?>/<?=$articlechoose->image?>" /></td>
                                <td> <?=$lang=="en" ? $articlechoose->title_en : $articlechoose->title_vn?> </td>
                               
                              
                              </tr>
							<?php endforeach;?>
                            <?php endif;?>
                           </tbody>
                    </table>
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
