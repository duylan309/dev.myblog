<tr class="tSearch">
  <td data-checkbox></td>
  <td data-action></td>
  <td data-title>
  <input type="text"
    data-search
    placeholder="<?=$lang=="en"?"Searching...":"Tìm kiếm...."?>"
    class="fSearch fTitle form-control col-sm-6 input-sm"
    name="fTitle"
    id="fTitle"
    value="<?=$session['where']['title_'.$lang] ? $session['where']['title_'.$lang] : ''?>"/></td>
  <td data-image></td>
  <td data-date></td>
  <td data-sort></td>
  <td data-status>
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