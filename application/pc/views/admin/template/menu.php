<style>
.line {
	border-bottom: dotted 1px #000;
}
</style>
<div class="middle">
  <div class="new_info" id="">
    <h2 class="title">
      <?=anchor(base_url().'admin/', 'HOME' , 'title="HOME"')?>
    </h2>
  </div>
</div>

<div class="middle">
  <div class="new_info" id="">
    <h2 class="title">
      <?=anchor(base_url().'admin/menu/lists/0/null', 'MENU' , 'title="MENU"')?>
    </h2>
  </div>
</div>

<div class="middle">
  <div class="new_info" id="">
    <h2 class="title">
      <?=anchor(base_url().'admin/album/lists/0/null', 'Album' , 'title="Album"')?>
    </h2>
  </div>
</div>
<div class="middle">
  <div class="new_info" id="">
    <h2 class="title">
      <?=anchor(base_url().'admin/photo/lists/0/null', 'Photo' , 'title="Photo"')?>
    </h2>
  </div>
</div>
<div class="middle">
  <div class="new_info" id="">
    <h2 class="title">
      <?=anchor(base_url().'admin/member/lists/0/null', 'Member' , 'title="member"')?>
    </h2>
  </div>
</div>

<div class="middle">
  <div class="new_info" id="">
    <h2 class="title">
      <?=anchor(base_url().'admin/upload/lists/0/null', 'Upload' , 'title="Upload"')?>
    </h2>
  </div>
</div>

<div class="middle">
  <div class="new_info" id="">
    <h2 class="title"><?php echo $language->WEBCONFIG;?></h2>
    <ul class="content">
      <li>
        <?=anchor(base_url().'admin/config_content/update/0/Item', $language->WEBCONFIG , 'title="'.$language->WEBCONFIG.'"')?>
      </li>
      <li>
        <?=anchor(base_url().'admin/adminuser/lists/0/null', $language->HOMEADMIN , 'title="'.$language->HOMEADMIN.'"')?>
      </li>
    </ul>
  </div>
</div>
