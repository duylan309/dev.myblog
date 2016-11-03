<div id="email" class="tab-pane fade m-t-15 col-sm-6">
  <div class="form-group">
      <label class="col-sm-3">Send by SMTP On/Off</label>
      <div class="col-sm-9">
        <input type="checkbox"  name="allowsendemail" value="1" <?=isset($readXML->info->allowsendemail) ? ( $readXML->info->allowsendemail == 1 ? "checked='checked'" : "") : ""?>  />
      </div>
  </div>

  <div class="form-group">
      <label class="col-sm-3">Email Receivel</label>
      <div class="col-sm-9">
        <input class="form-control" type="text"  name="emailReply" value="<?=isset($readXML->info->emailReply) ? $readXML->info->emailReply : ""?>"  />
      </div>
  </div>

  <div class="form-group">
      <label class="col-sm-3">Smtp host</label>
      <div class="col-sm-9">
        <input class="form-control" type="text"  name="smtphost" value="<?=isset($readXML->info->smtphost) ? $readXML->info->smtphost : ""?>"  />
      </div>
  </div>

  <div class="form-group">
      <label class="col-sm-3">Smtp port</label>
      <div class="col-sm-9">
        <input class="form-control" type="text"  name="smtpport" value="<?=isset($readXML->info->smtpport) ? $readXML->info->smtpport : ""?>"  />
      </div>
  </div>

  <div class="form-group">
      <label class="col-sm-3">Smtp Username</label>
      <div class="col-sm-9">
        <input class="form-control" type="text"  name="smtpusername" value="<?=isset($readXML->info->smtpusername) ? $readXML->info->smtpusername : ""?>"  />
      </div>
  </div>

  <div class="form-group">
      <label class="col-sm-3">Smtp Password</label>
      <div class="col-sm-9">
        <input class="form-control" type="text"  name="smtppassword" value="<?=isset($readXML->info->smtppassword) ? $readXML->info->smtppassword : ""?>"  />
      </div>
  </div>
</div>  
