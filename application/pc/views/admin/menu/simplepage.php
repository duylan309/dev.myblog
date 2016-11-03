<div class="paneBlock">
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
  <td class="t1" style="vertical-align:top"><label>Left Column</label></td>
  <td class="t3"><div class="content-tab-1">
      <ul class="jquery-tabs-1">
        <li><a href="#">VN</a></li>
        <li><a href="#">EN</a></li>
        <li><a href="#">JP</a></li>
      </ul>
      <div class="jquery-panes-1"> 
        <!-- Block 1-->
         <div class="paneBlock-1">
          <textarea name="content_vn" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$readXML_vn->info->content?></textarea>
        </div>
        <!-- Block 2-->
        <div class="paneBlock-1">
          <textarea name="content_en" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$readXML_en->info->content?></textarea>
        </div>
        <div class="paneBlock-1">
          <textarea name="content_jp" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$readXML_jp->info->content?></textarea>
        </div>
      </div>
      </div>
   </td>
</tr>

    <tr>
  <td class="t1" style="vertical-align:top"><label>Right Column</label></td>
  <td class="t3"><div class="content-tab-1">
      <ul class="jquery-tabs-1">
        <li><a href="#">VN</a></li>
        <li><a href="#">EN</a></li>
        <li><a href="#">JP</a></li>
      </ul>
      <div class="jquery-panes-1"> 
        <!-- Block 1-->
        <div class="paneBlock-1">
        <textarea name="description_vn" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$readXML_vn->info->description?></textarea>
        </div>
        <!-- Block 2-->
        <div class="paneBlock-1">
          <textarea name="description_en" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$readXML_en->info->description?></textarea>
        </div>
        <div class="paneBlock-1">
          <textarea name="description_jp" class="mceEditor" style="width:100%; border:0px; background:none; height:350px;"><?=$readXML_jp->info->description?></textarea>
        </div>
      </div>
    </div></td>
</tr>

  </table>
</div>
