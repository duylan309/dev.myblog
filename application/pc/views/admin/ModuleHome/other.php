<div class="mainMiddle">
  <form  action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=other&id=<?=$row->id?>&function=Item" method="post" id="searchSubmit" enctype="multipart/form-data">
    <div class="subhead">
      <ul>
        <li style="float:left"> <a href="#" class="btn clearmenu">
          <h2 style="color:#fff;font-size:10pt;margin-left:20px">Edit
            <?=$lang=='en' ? $result->title_en : $result->title_vn?>
          </h2>
          </a> </li>
         <li>
          <label onclick="javascript:window.close();" style="width:100px" class="btn buttonAdd"><a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=lists&id=<?=$row->id?>&function=null">
             <i class="fa fa-ban"></i>&nbsp; <?=$language->CANCEL?>
            </a></label>
        </li>
        
        <li>
          <label class="btn buttonAdd btn-success" class="btn buttonAdd">
         <i class="fa fa-save"></i>&nbsp; <input class="funSave" type="submit" value="save" name="save" />  
          </label>
        </li>
       
      </ul>
      <div class="clear"></div>
    </div>
    
    
    <div class="listContent">
    <div class="uiContent">
      <div class="content-tab">
        <ul class="jquery-tabs rightMenu">
            <li><a onclick="openOtherArcticle(<?=base_url()?>)"  href="#">Bài viết liên quan</a></li>
        </ul>
        <div class="jquery-panes"> 
        
            <div class="paneBlock">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td class="t1">Search</td>
                <td class="t3">
                 <input type="hidden" name="function" value="on" />
                <input class="fSearch fTitle" id="fTitle" name="fTitle" size="40" value="<?=$session['where']['title_vn'] ? $session['where']['title_vn'] : ''?>" /></td>
              </tr>
              <tr>
                <td class="t1" colspan="2">
                    <table class="moduletable listItem" border="0" cellpadding="0" cellspacing="0" width="80%">
                          <thead>
                              <th>Checkbox</th>
                              <th width="50">Id</th>
                              <th>Image</th>
                              <th>Title</th>
                              <th>Sort</th>
                          </thead>
                          
                           <tbody class="detailTable">
       						<?php if(isset($listArticleChoose)):?>
                            <?php foreach($listArticleChoose as $articlechoose):?>
                              <tr id="<?=$articlechoose->id?>">
                                <td><input checked="checked" type="checkbox" value="<?=$articlechoose->id?>" name="getIdArticle[]"></td>
                                <td class="col1"><span>
                                  <?=$articlechoose->id?>
                                  </span></td>
                                <td><img class="otherimg" src="<?=base_url()?>upload/<?=$menu_item->title_url?>/<?=$articlechoose->image?>" /></td>
                                <td> <?=$articlechoose->title_en?></td>
                                <td class="col6"><span><input class="changesort" value="<?=$articlechoose->sort?>" page="<?=$page?>" onchange="changeSortMenu(<?=$articlechoose->id?>,'<?=$page?>','<?=base_url()?>',0,0)" /></span>
                                  </label></td>
                              
                              </tr>
							<?php endforeach;?>
                            <?php endif;?>
                            
							<?php if($listArticle):?>
                            <?php foreach($listArticle as $article):?>
                          <tr id="<?=$article->id?>">
                            <td><input class="" type="checkbox" value="<?=$article->id?>" name="getIdArticle[]"></td>
                            <td class="col1"><span>
                              <?=$article->id?>
                              </span></td>
                              <td><img class="otherimg" src="<?=base_url()?>upload/<?=$menu_item->title_url?>/<?=$article->image?>" /></td>
                            <td> <?=$article->title_en?></td>
                            <td class="col6"><span><input class="changesort" value="<?=$article->sort?>" page="<?=$page?>" onchange="changeSortMenu(<?=$article->id?>,'<?=$page?>','<?=base_url()?>',0,0)" /></span>
                              </label></td>
                          
                          </tr>
                          <?php endforeach;?>
                          <?php endif;?>
                          <tr><td colspan="4"> <div class="pageIndex"><?=$links?></div></td></tr>
                          </tbody>
                    </table>
                </td>
            </table>
          </div>
        </div>
      </div>
    </div>
   
    <input hidden="hidden" name="id" value="<?=$result->id?>" />
  </form>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".funSave").on("click", function(e){
		e.preventDefault();
		$('#searchSubmit').attr('action', "<?=base_url()?>admin/<?=$page?>/other/<?=$result->id?>/Save").submit();
	});
	
});
</script>