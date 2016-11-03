<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="430" align="left"><div class="logo"><a href="<?=base_url()?>"> <img src="<?=base_url().'images/logo.png'?>" /></a></div></td>
    <td valign="bottom" align="right"><div class="menu"> <
        <ul id="nav">
          <?php foreach($listMenu as $menu):?>
          <li><a class="<?=$menu->title_url==$page?'selected':''?>" href="<?=base_url().$menu->title_url?>">
            <?=$lang=='en'? $menu->title_en : $menu->title_vn?>
            </a>
            <?php endforeach;?>
          </li>
        </ul>
      </div></td>
  </tr>
</table>
