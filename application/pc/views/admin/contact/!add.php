<div class="deleteHeight">
   <?php //echo form_open_multipart('admin/client/rundo')?>
   <form action="<?=base_url()?>admin/client/update/0/Save" method="post" id="add_client" enctype="multipart/form-data">
    <div class="subhead">
      <input type="submit" value="<?php echo $language->SAVE?>" name="add_client" id="add_client" class="btn buttonAdd btn-success" />
           <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url()?>admin/client/lists/0/null">
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
                <td class="t3"><!-- Block 1-->
                  
                  <div class="content-tab-1">
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
						  'value'       => set_value('title_vn',''),
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
						  'value'       => set_value('title_en',''),
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
                <td class="t2">&nbsp;</td>
                <td class="t3"><?php
						 $data = array(
						  'name'        => 'titleUrl',
						  'id'          => 'titleUrl',
						  'value'       => set_value('title_url',''),
						  'maxlength'   => '100',
						  'size'        => '50',
						  'class'	   => 'input',	
						  
						);
			
						echo form_input($data);
						?>
                  <span class="checkURL"></span> (Ví dụ: http://website.com/sp/+ Url) </td>
              </tr>
             
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
				   			
				echo form_dropdown('status', $options, set_value('status',''));
				?>
                  
                  
                 </td>
              </tr>
            
              <tr>
                <td class="t1"><label class="label">
                    <?=$language->SORT?>
                  </label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><input type="text" size="4" name="sort" value=""/></td>
              </tr>
            </table>
          </div>
          
          <!-- Block 3-->
          
          <div class="paneBlock">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td class="t1"><label>
                    <?=$language->DAY?>
                  </label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><input name="date" type="text" value="<?=date('m/j/Y',mktime())?>" class="date demo_vista" /></td>
              </tr>
              
              <tr>
                <td class="t1"><label>The first content</label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><div class="content-tab-1">
                    <ul class="jquery-tabs-1">
                      <li><a href="#">VN</a></li>
                      <li><a href="#">EN</a></li>
                    </ul>
                    <div class="jquery-panes-1">
                      <div class="paneBlock-1">
                        <textarea name="content_vn" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"></textarea>
                      </div>
                      <div class="paneBlock-1">
                        <textarea name="content_en" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"></textarea>
                      </div>
                    </div>
                  </div></td>
              </tr>
              <tr>
                <td class="t1"><label>The second content</label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><div class="content-tab-1">
                    <ul class="jquery-tabs-1">
                      <li><a href="#">VN</a></li>
                      <li><a href="#">EN</a></li>
                    </ul>
                    <div class="jquery-panes-1">
                      <div class="paneBlock-1">
                        <textarea name="description_vn" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"></textarea>
                      </div>
                      <div class="paneBlock-1">
                        <textarea name="description_en" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"></textarea>
                      </div>
                    </div>
                  </div></td>
              </tr>
            </table>
          </div>
         
          <!-- Block-------------------->
          
          <div class="paneBlock">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td class="t1"><?php echo $language->METATITLE;?></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><div class="content-tab-1">
                    <ul class="jquery-tabs-1">
                      <li><a href="#">VN</a></li>
                      <li><a href="#">EN</a></li>
                    </ul>
                    <div class="jquery-panes-1">
                      <div class="paneBlock-1">
                       <?php
						 $data = array(
						  'name'        => 'meta_title_vn',
						  'id'          => 'meta_title_vn',
						  'value'       => set_value('meta_title_vn',''),
						  'maxlength'   => '100',
						  'size'        => '50',
						  'rows'		=> '1',
						  'cols'		=> '50',
						  'class'	   => 'input',	
						  
						);
			
						echo form_input($data);
						?>
                        
                      </div>
                      <div class="paneBlock-1">
                        <?php
						 $data = array(
						  'name'        => 'meta_title_en',
						  'id'          => 'meta_title_en',
						  'value'       => set_value('meta_title_en',''),
						  'maxlength'   => '100',
						  'size'        => '50',
						  'rows'		=> '1',
						  'cols'		=> '50',
						  'class'	   => 'input',	
						  
						);
			
						echo form_input($data);
						?>
                      </div>
                    </div>
                  </div></td>
              </tr>
              <tr>
                <td class="t1"><?php echo $language->METAKEYWORD?></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><div class="content-tab-1">
                    <ul class="jquery-tabs-1">
                      <li><a href="#">VN</a></li>
                      <li><a href="#">EN</a></li>
                    </ul>
                    <div class="jquery-panes-1">
                      <div class="paneBlock-1">
                        <textarea rows="3" cols="50" name="meta_keyword_vn"></textarea>
                      </div>
                      <div class="paneBlock-1">
                        <textarea rows="3" cols="50" name="meta_keyword_en"></textarea>
                      </div>
                    </div>
                  </div></td>
              </tr>
              <tr>
                <td class="t1"><?php echo $language->METADESCRIPTION?></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><!-- Block 1-->
                  
                  <div class="content-tab-1">
                    <ul class="jquery-tabs-1">
                      <li><a href="#">VN</a></li>
                      <li><a href="#">EN</a></li>
                    </ul>
                    <div class="jquery-panes-1">
                      <div class="paneBlock-1">
                        <textarea rows="3" cols="50" name="meta_description_vn"></textarea>
                      </div>
                      <div class="paneBlock-1">
                        <textarea rows="3" cols="50" name="meta_description_en"></textarea>
                      </div>
                    </div>
                  </div></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

 <?php //echo form_close(); ?>
 </form>
</div>
