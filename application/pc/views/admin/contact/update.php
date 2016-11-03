<div class="deleteHeight">
   <?php //echo form_open_multipart('admin/contact/rundo')?>
   <form action="<?=base_url()?>admin/contact/update/<?=$result->id?>/Save" method="post" id="add_contact" enctype="multipart/form-data">
    <div class="subhead">
       <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url()?>admin/contact/remove/<?=$result->id?>/null" class="funDelete">
        <?=$language->DELETE?>
        </a> </label>
  
      <label style="width:100px" class="btn buttonAdd"><a href="<?=base_url()?>admin/contact/lists/0/null">
        <?=$language->CANCEL?>
        </a></label>
    </div>
    <div class="uiContent">
      <div class="content-tab">
        <ul class="jquery-tabs rightMenu">
          <li><a href="#">Info</a></li>
         
        </ul>
        <div class="jquery-panes"> 
          <!-- Block 1-->
          <div class="paneBlock">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td class="t1"><label>
                    <?=$language->FULLNAME?>
                  </label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><!-- Block 1-->
                  
                <?=$result->fullname?></td>
              </tr>	
              <tr>
                <td class="t1"><label>
                    <?=$language->TITLE?>
                  </label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><?=$result->title?></td>
              </tr>
              <tr>
                <td class="t1"><label>Email</label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><?=$result->email?></td>
              </tr>
             

              <tr>
                <td class="t1"><label class="label"><?php echo $language->CONTENT?></label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><?=$result->content?></td>
              </tr>
             
              <tr>
                <td class="t1"><label class="label">
                    <?=$language->DATE?>
                  </label></td>
                <td class="t2">&nbsp;</td>
                <td class="t3"><?=date('d M Y',$result->date)?></td>
              </tr>
            </table>
          </div>
         
        </div>
      </div>
    </div>
     <input hidden="hidden" name="id" value="<?=$result->id?>" />
 <?php //echo form_close(); ?>
 </form>
</div>
