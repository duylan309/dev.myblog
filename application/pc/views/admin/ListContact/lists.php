<form method="post" class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=lists&id=0&function=null" id="searchSubmit">
  <input type="hidden" name="function" value="on" />
  <input class="inputSortValue" type="hidden" value="<?=$session['sort']==0 ? 1 : 0 ?>" name="fSort" />
  <input class="inputSortTable" type="hidden" value="<?=$session['sortTable']?>" name="fsortTable" />
  <!-- Page Heading -->
  <?=$this->load->view('admin/allmodules/table/header_with_delete.php')?>
  
  <div class="row">
    <div class="col-sm-12">
      <div>
        <table class="table table-bordered table-hover">
          <?=$this->load->view('admin/allmodules/table/thead_basic.php')?>


          <tbody>
            <!--- SEARCH -->
            <?=$this->load->view('admin/allmodules/table/tbody_content_contact.php')?>
          </tbody>
      
        </table>
        <div class="row">
          <div class="col-sm-12 text-left">
            <?php echo $links; ?>
          </div>
        </div>
    </div>
  </div>

</form>
<!-- 
<div class="mainMiddle">
<form method="post" action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=lists&id=<?=$row->id?>&function=null" id="searchSubmit">
   <div class="subhead">
    <ul>
      <li style="float:left"> <a href="#" class="btn clearmenu">
        <h2 style="color:#fff;font-size:10pt;margin-left:20px"><?=$lang=="en" ? $getMenuAdmin->title_en:$getMenuAdmin->title_vn?>&nbsp;&nbsp;&nbsp; -&nbsp;&nbsp;&nbsp; Total: <?php echo " ( ".$coutAll." )";?> </h2>
        </a> </li>
        <li style="float:left;width:500px"><input style="padding:7px 15px" type="text" placeholder="Search......" class="fSearch fTitle" name="fTitle" id="fTitle" onchange="searchTitle('<?=$lang?>','<?=$page?>','<?=base_url()?>')" value="<?=$session['where']['fullname'] ? $session['where']['fullname'] : ''?>"/></li>  
      <li>
        <div class="btn buttonAdd delclass" style="color:#C9535D" data-role="<?=$page.'_inbox'?>" data-last-value="<?=base_url()?>" >
         <i class="fa fa-trash-o"></i>&nbsp;   <?=$language->DELETE?>
        </div>
      </li>
    </ul>
    <div class="clear"></div>
  </div>
  <div class="listContent">
  
    <input type="hidden" name="function" value="on" />
     <input class="inputSortValue" type="hidden" value="<?=$session['sort']==0 ? 1 : 0 ?>" name="fSort" />
    <input class="inputSortTable" type="hidden" value="<?=$session['sortTable']?>" name="fsortTable" />
    <table width="100%"  cellspacing="0" cellpadding="0" border="1" style="border-collapse:collapse" bordercolor="#D6D6D6" class="listItem">
      <thead>
        <tr class="thead">
          <tr class="thead">
          <td class="colCheck"><input id="check_all" type="checkbox"></td>
          <td class="colUpdate"><?=$language->UPDATE;?></td>
          <td class="colId"><div class="sortTable" table="id" > ID</div></td>
          <td class="colTitle" ><div class="sortTable" table="fullname" ><?php echo $language->FULLNAME;?></div></td>
         <td class="colTitle"><div class="sortTable" table="date" ><?php echo $language->DATE;?></div></td>
          <td class="colStatus" ><label id="sort_status"><?=$language->STATUS?></td>
        </tr>
        </tr>
      </thead>
       <tr class="tSearch">
        <td ></td>
        <td ></td>
        <td ><input type="text" class="fSearch fId" name="fId" id="fId" value="<?=$session['where']['id'] ? $session['where']['id'] : '' ?>"/></td>
        <td ></td>
        <td class="col7"></td>
        <td class="col7"><select name="fStatus"  class="fSearch fStatus" id="fStatus">
            <option value="-1"><?php echo $language->ALL; ?></option>
            <?php
                        foreach($define_folder["Status"] as $key=> $value)
                        {
                        ?>
            <option value="<?php echo $key;?>" <?php echo isset($session['status'])?$session['status']==$key?"selected":"":""?>>
            <?=$value?>
            </option>
            <?php	
                        }
                    ?>
          </select></td>
      </tr>
      <tbody class="detailTable">
        <?php 
	if($results):
	foreach ($results as $row){	
	?>
       <tr id="<?=$row->id?>">
          <td><input class="checkdel" type="checkbox" value="<?=$row->id?>" name="checkdel[]"></td>
          <td class="col1"><label title="edit" style="margin:3px 5px"> <a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=$row->id?>&function=Item"> <i class="fa fa-edit"></i>&nbsp;  </a> </label>
            <label title="delete"> <a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=remove&id=<?=$row->id?>&function=null" class="funDelete">  <i class="fa fa-trash-o"></i>&nbsp; </a> </label></td>
          <td class="col2"><span><?php echo $row->id;?></span></td>
          <td><a style="color:#<?=$row->status==0 ? 'c03' : '111'?>" href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=$row->id?>&function=Item"> <?=$row->fullname?>  </a></td>
          <td><?=$row->date?></td> 
          <td class="col7">
            <div><a style="color:#<?=$row->status==0 ? 'c03' : '111'?>" href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=$row->id?>&function=Item"><?=$row->status==0 ? '<span class="new">(New)</span>' : 'Read';?></a></div>
            </td>
        </tr>
        <?php
	}
	endif;
	?>
      </tbody>
    </table>
    <div class="pageIndex"> <?php echo $links; ?> </div>
 </div> </form>
</div>
<div class="loadding"></div> -->
