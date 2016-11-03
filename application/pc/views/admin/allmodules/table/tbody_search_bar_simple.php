<tr class="tSearch">
  <td></td>
  <td><input type="text"
    placeholder="<?=$lang=="en"?"Searching...":"Tìm kiếm...."?>"
    class="fSearch fTitle form-control col-sm-6 input-sm"
    name="fTitle"
    data-search
    id="fTitle"
    onchange="searchTitle('<?=$lang?>','menu','<?=base_url()?>')"
  value="<?=$session['where']['title_'.$lang] ? $session['where']['title_'.$lang] : ''?>"/></td>
  <td ></td>
  <td class="col-sm-1">
    <select data-search name="fStatus"  class="fSearch fStatus form-control input-sm" id="fStatus">
      <option value="-1"><?php echo $language->ALL; ?></option>
      <?php foreach($define_folder["Status"] as $key=> $value):?>
      <option value="<?php echo $key;?>" <?php echo isset($session['status'])?$session['status']==$key?"selected":"":""?>>
        <?=$value?>
      </option>
      <?php endforeach; ?>
    </select>
  </td>
</tr>