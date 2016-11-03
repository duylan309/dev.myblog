<?php
if($results):

  foreach ($results as $row):?>

  <tr id="<?=$row->id?>">
    <td class="th-inner" data-delete width="10">
    </td>
    <td data-action class="col-sm-1">
      <label class="form-control no-border no-shadow">
        <a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=$row->id?>&function=Item"> <i class="fa fa-edit"></i>&nbsp; </a>
        <?php  if($row->id >0):?>
        <a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=remove&id=<?=$row->id?>&function=null" class="funDelete"> <i class="fa fa-trash-o"></i>&nbsp; </a>
        <?php endif;?>
      </label>
    </td>
    <td data-title class="col3">
      <span class="titleResult">
        <?=$lang =='vn'  ? $row->title_vn : $row->title_en;?>
      </span>
    </td>
    <td data-image class="col-sm-1 text-center">
     
    </td>
    <td data-date data-date class="col-sm-1">
    </td>
    
    <td data-sort class="col-sm-1 text-center">
      <span>
      </span>
    </td>
    <td data-status class="col-sm-1 text-center">
     
       
    </td>
  </tr>

  <?php
  endforeach;

endif;?>