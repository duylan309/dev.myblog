<div class="mainMiddle">  <form method="post" action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=lists&id=<?=$row->id?>&function=null" id="searchSubmit">
   <div class="subhead">
    <ul>
      <li style="float:left"> <a href="#" class="btn clearmenu">
        <h2 style="color:#fff;font-size:10pt;margin-left:20px">Module Home &nbsp;&nbsp;&nbsp; -&nbsp;&nbsp;&nbsp; </h2>
        </a> </li>
          <li style="float:left;width:500px"><input style="padding:7px 15px" type="text" placeholder="Search......" class="fSearch fTitle" name="fTitle" id="fTitle" onchange="searchTitle('<?=$lang?>','<?=$page?>','<?=base_url()?>')" value="<?=$session['where']['title_'.$lang] ? $session['where']['title_'.$lang] : ''?>"/></li>
      <li> <a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=$row->id?>&function=add">
        <label id="add_new" class="btn"> <i class="fa fa-plus"></i>&nbsp;
          <?=$language->ADD?>
        </label>
        </a></li>
      <li>
        <div class="btn buttonAdd delclass" style="color:#C9535D" data-role="<?=$page?>" data-last-value="<?=base_url()?>" >
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
          <td class="colCheck" ><input id="check_all" type="checkbox"></td>
          <td class="colUpdate"><?=$language->UPDATE;?></td>
          <td class="colId"><div class="sortTable" table="id" > ID</div></td>
          <td class="colTitle" ><div class="sortTable" table="<?=$lang=="en" ? "title_en" : "title_vn"?>" ><?php echo $language->TITLE;?></div></td>
          
          <td class="colSort"><div class="sortTable" table="sort"><?php echo $language->SORT;?></div></td>
          <td class="colStatus" ><?=$language->STATUS?></td>
        </tr>
      </thead>
      <tr class="tSearch">
        <td ></td>
        <td ></td>
        <td ><input type="text" class="fSearch fId" name="fId" id="fId" value="<?=$session['where']['id'] ? $session['where']['id'] : '' ?>"/></td>
        <td ><input type="text" class="fSearch fTitle" name="fTitle" id="fTitle" onchange="searchTitle('<?=$lang?>',<?=$page?>,'<?=base_url()?>')" value="<?=$session['where']['title_'.$lang] ? $session['where']['title_'.$lang] : ''?>"/></td>
      
        <td ></td>
          
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
	//var_dump($results);
	if($results):
	foreach ($results as $row){	
	?>
        <tr id="<?=$row->id?>">
          <td><input class="checkdel" type="checkbox" value="<?=$row->id?>" name="checkdel[]"></td>
          <td class="col1"><label title="edit" style="margin:3px 5px"> <a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=$row->id?>&function=Item"><i class="fa fa-edit"></i>&nbsp; </a> </label>
            <label title="delete"> <a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=remove&id=<?=$row->id?>&function=null" class="funDelete"> <i class="fa fa-trash-o"></i>&nbsp;</a> </label></td>
          <td class="col2"><span><?php echo $row->id;?></span></td>
          <td class="col3"><span class="titleResult">
            <input class="changetitle" value="<?=$lang=="en" ? $row->title_en : $row->title_vn;?>" onchange="changeTitle(<?=$row->id?>,'<?=$lang?>','<?=$page?>','<?=base_url()?>')" />
            </span></td>
          
          <td class="col6"><span>
            <input class="changesort" value="<?=$row->sort?>" page="<?=$page?>" onchange="changeSort(<?=$row->id?>,'<?=$page?>','<?=base_url()?>',0,0)" />
            </span>
            </label></td>
              
          <td class="col7"><label onclick="changePublish(<?=$row->id?>,'<?=strtolower($page)?>','<?=base_url()?>')" class="iconSetup">
            <div class="choosevalue" value="<?=$row->status?>"> <?=$row->status==0?'<i class="fa fa-times-circle"></i>&nbsp;':'<i class="fa fa-check-circle"></i>&nbsp;'?></div>
            </label></td>
        </tr>
        <?php
	}
	endif;
	?>
      </tbody>
    </table>
    <div class="pageIndex"> <?php echo $links; ?> </div>
  </div></form>
</div>
<div class="loadding"></div>
