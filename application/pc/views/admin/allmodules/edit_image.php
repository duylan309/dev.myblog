
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td class="t1"><label> Alt_image </label></td>
    <td class="t3"><input type="text" name="alt_image" value="<?=isset($result->alt_image) ? $result->alt_image : ""?>" /></td>
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
<input hidden="hidden" name="image_id" value="<?=$result->image?>" />
