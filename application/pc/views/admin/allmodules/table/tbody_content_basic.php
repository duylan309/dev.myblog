<?php
if($results):

  foreach ($results as $row):?>

  <tr id="<?=$row->id?>">
    <td class="th-inner" data-delete width="10">
        <input class="checkdel" type="checkbox" value="<?=$row->id?>" name="checkdel[]">
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
        <input class="changetitle form-control input-sm" value="<?=$lang =='vn'  ? $row->title_vn : $row->title_en;?>" onchange="changeTitle(<?=$row->id?>,'<?=$lang?>','<?=$page_table_sql?>','<?=base_url()?>')" />
      </span>
    </td>
    <td data-image class="col-sm-1 text-center">
      <?=$row->image ? '<img class="img-responsive img-thumbnail" src="'.base_url().'upload/'.$page.'/'.$row->image.'"  />' : '<i class="fa fa-image"></i>' ?>
    </td>
    <td data-date data-date class="col-sm-1">
      <?=$row->date?>
    </td>
    
    <td data-sort class="col-sm-1 text-center">
      <span>
        <input class="changesort form-control input-sm" value="<?=$row->sort?>" page="<?=$page_table_sql?>" onchange="changeSort(<?=$row->id?>,'<?=$page_table_sql?>','<?=base_url()?>','',0)" />
      </span>
    </td>
    <td data-status class="col-sm-1 text-center">
      <label onclick="changePublish(<?=$row->id?>,'<?=$page_table_sql?>','<?=base_url()?>')" class="iconSetup form-control no-border no-shadow">
        <div class="choosevalue" value="<?=$row->status?>">
          <?=$row->status==0?'<button class="btn btn-primary btn-danger btn-xs">Hide</button>&nbsp;':'<button class="btn btn-primary btn-success btn-xs">Show</button>&nbsp;'?>
        </div>
      </label>
    </td>
  </tr>

  <?php
  endforeach;

endif;?>