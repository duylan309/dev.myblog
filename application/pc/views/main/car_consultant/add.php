<div class="mainMiddle">
  <form action="<?=base_url()?>admin/adminuser/update/0/Save" method="post" id="submitForm" enctype="multipart/form-data">
    <div class="subhead">
      <ul>
        <li style="float:left"> <a href="#" class="btn clearmenu">
          <h2 style="color:#fff;font-size:10pt;margin-left:20px">Add New User</h2>
          </a> </li>
        <li>
          <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url()?>admin/adminuser/lists/0/null"> <i class="fa fa-ban"></i>&nbsp;
            <?=$language->CANCEL?>
            </a></label>
        </li>
      
      </ul>
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
                    <?=$language->USERNAME?>
                  </label></td>
                <td class="t3">
				<?php if(isset($error)){echo '<span class="error">'.$error.'</span>';}?>
				<?php
						 $data = array(
						  'name'        => 'useradmin',
						  'id'          => 'useradmin',
						  'value'       => set_value('useradmin',''),
						  'maxlength'   => '100',
						  'size'        => '50',
						  'class'	   => 'input useradmin',	
						  'rules'   	   => 'required'
						 );
			
						echo form_input($data);
					?>
                  <span class="resultuser"></span>  </td>
              </tr>
              <tr>
                <td class="t1"><label>
                    <?=$language->YOURPASSADMIN?>
                  </label></td>
                <td class="t3"><?php
						 $data = array(
						  'name'        => 'newpassadmin',
						  'id'          => 'newpassadmin',
						  'value'       => set_value('newpassadmin',''),
						  'maxlength'   => '100',
						  'size'        => '50',
						  'class'	   => 'input newpassadmin',
						  'type' 		=> 'password',	
						  
						);
						
						echo form_input($data);
						?></td>
              </tr>
              <tr>
                <td class="t1"><label>
                    <?=$language->CONFIRMPASSADMIN?>
                  </label></td>
                <td class="t3"><?php
						 $data = array(
						  'name'        => 'confirmpassadmin',
						  'id'          => 'confirmpassadmin',
						  'value'       => set_value('confirmpassadmin',''),
						  'maxlength'   => '100',
						  'size'        => '50',
						  'class'	   => 'input confirmpassadmin',
						  'type' 		=> 'password',	
						  'style'	   => 'float:left',		
						  
						);
						$js = 'onchange="checkPassword()"';
						echo form_input($data,'',$js);
						?>
                  <span class="resultCheckpass"></span></td>
              </tr>
              <tr>
                <td class="t1"><label class="label"><?php echo $language->EMAIL?></label></td>
                <td class="t3"><?php
						 $data = array(
						  'name'        => 'email',
						  'id'          => 'email',
						  'value'       => set_value('email',''),
						  'maxlength'   => '100',
						  'size'        => '50',
						  'class'	   => 'input',
						  'type' 		=> 'email',		
						  
						);
			
						echo form_input($data);
						?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php //echo form_close(); ?>
  </form>
</div>
