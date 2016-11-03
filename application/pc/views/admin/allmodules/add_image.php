<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td class="t1"><label> Alt_image </label></td>
    <td class="t3"><input type="text" name="alt_image" value="" /></td>
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
				?></td>
  </tr>
</table>
