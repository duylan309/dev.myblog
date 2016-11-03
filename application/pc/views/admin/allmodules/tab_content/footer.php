<div id="footer" class="tab-pane fade m-t-15 col-sm-12">
	<div class="form-group">
	  <label class="col-sm-3"><?=$lang=="en" ? "Footer Home 1" : "Footer Home 1"?></label>
	  <div class="col-sm-9">
	    <textarea name="home_footer_1" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:150px;">
	    <?=isset($readXML) ? $readXML->info->home_footer_1 : ""?>
	    </textarea>
	  </div>
	</div>
	<div class="form-group">
	  <label class="col-sm-3"><?=$lang=="en" ? "Footer Home 2" : "Footer Home 2"?></label>
	  <div class="col-sm-9">
	    <textarea name="home_footer_2" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:150px;">
	    <?=isset($readXML) ? $readXML->info->home_footer_2 : ""?>
	    </textarea>
	  </div>
	</div>
	<div class="form-group">
	  <label class="col-sm-3"><?=$lang=="en" ? "Footer Home 3" : "Footer Home 3"?></label>
	  <div class="col-sm-9">
	    <textarea name="home_footer_3" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:150px;">
	    <?=isset($readXML) ? $readXML->info->home_footer_3 : ""?>
	    </textarea>
	  </div>
	</div>
	<div class="form-group">
	  <label class="col-sm-3"><?=$lang=="en" ? "Footer Home 4" : "Footer Home 4"?></label>
	  <div class="col-sm-9">
	    <textarea name="home_footer_4" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:150px;">
	    <?=isset($readXML) ? $readXML->info->home_footer_4 : ""?>
	    </textarea>
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-sm-3"><?=$lang=="en" ? "Footer Left" : "Footer Left"?></label>
	  <div class="col-sm-9">
 
        <textarea name="footer_left_vn" class="mceEditor form-control" style="width:100%; border:0px; background:none; height:250px;">
          <?=isset($readXML) ? $readXML->info->footer_left_vn : ""?>
        </textarea>
       
        <input class="form-control" type="hidden" name="footer_left_en" value="" />
        	
	  </div>
	</div>
	
	<div class="form-group">
	  <label class="col-sm-3">Copyright</label>
	  <div class="col-sm-9">
	    <input class="form-control" type="text"  name="copyright" value="<?=isset($readXML->info->copyright) ? $readXML->info->copyright : ""?>"  />
	  </div>
	</div>
</div>