<div class="subhead">
  <div class="btn buttonAdd delclass" style="color:#C9535D" data-role="contact" data-last-value="<?=base_url()?>" >
    <?=$language->DELETE?>
  </div>
  <div class="clear"></div>
</div>
<div class="mainMiddle">
  <div class="TopBannerTitle"> Total: <?php echo " ( ".$coutAll." )";?> </div>
  <div class="clear"></div>
  <form method="post" action="<?=base_url()?>admin/contact/lists/0/null" id="searchSubmit">
    <input type="hidden" name="function" value="on" />
    <table width="100%"  cellspacing="0" cellpadding="0" border="1" style="border-collapse:collapse" bordercolor="#D6D6D6" class="listItem">
      <thead>
        <tr class="thead">
          <td class="colCheck"><input id="check_all" type="checkbox"></td>
          <td class="colUpdate"><?=$language->UPDATE;?></td>
          <td class="colId"><label> ID </label></td>
          <td class="colFullname" ><label><?php echo $language->FULLNAME;?></label></td>

          <td class="colDate"><?=$language->DATE?></td>
        </tr>
      </thead>
      <tr class="tSearch">
        <td ></td>
        <td ></td>
        <td ><input type="text" class="fSearch fId" name="fId" id="fId" value="<?=$session['id'] ? $session['id'] : '' ?>"/></td>
        <td ></td>
      
       
        <td class="col7"></td>
      </tr>
      <tbody class="detailTable">
        <?php 
	//var_dump($results);
	if($results):
	foreach ($results as $row){	
	?>
        <tr id="<?=$row->id?>">
          <td><input class="checkdel" type="checkbox" value="<?=$row->id?>" name="checkdel[]"></td>
          <td class="col1"><label title="edit" style="margin:3px 5px"> <a href="<?=base_url()?>admin/contact/update/<?=$row->id;?>/Item"> <img src="<?=base_url()?>images/icon/edit/b_edit.jpg" style="border:none" /> </a> </label>
            <label title="delete"> <a href="<?=base_url()?>admin/contact/remove/<?=$row->id;?>/null" class="funDelete"> <img src="<?=base_url()?>images/icon/edit/b_del.jpg" title="<?=$row->id;?>"/> </a> </label></td>
          <td class="col2"><span><?php echo $row->id;?></span></td>
          <td><a style="color:#<?=$row->status==0 ? 'c03' : '111'?>" href="<?=base_url()?>admin/contact/update/<?=$row->id;?>/Item"> <?=$row->fullname?> <?=$row->status==0 ? '<span class="new">(New)</span>' : ' ';?> </a></td>
          <td class="col7"><?=date('d M Y',$row->date)?></td>
        </tr>
        <?php
	}
	endif;
	?>
      </tbody>
    </table>
    <div class="pageIndex"> <?php echo $links; ?> </div>
  </form>
</div>
<div class="loadding"></div>
