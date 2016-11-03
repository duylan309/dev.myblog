<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="80%" class="info"><?=$lang=="en" ? $configSite[0]->info->address_en : $configSite[0]->info->address_vn;?></td>
    <td width="20%" class="copy"><!--
<?php if(!empty($configSite[0]->info->facebooklink)):?>
    <a target="_blank" href="<?=$configSite[0]->info->facebooklink?>"><i style="color:#3b5998" class="fa fa-facebook-square"></i></a>
    <?php endif;?>
    <?php if(!empty($configSite[0]->info->twitterlink)):?>
    <a target="_blank" href="<?=$configSite[0]->info->twitterlink?>"><i style="color:#55acee" class="fa fa-twitter-square"></i></a>
    <?php endif;?>
    <?php if(!empty($configSite[0]->info->linkedinlink)):?>
    <a target="_blank" href="<?=$configSite[0]->info->linkedinlink?>"> <i style="color:#069" class="fa fa-linkedin-square"></i></a>
    <?php endif;?>
    <?php if(!empty($configSite[0]->info->tumblrlink)):?>
    <a target="_blank" href="<?=$configSite[0]->info->tumblrlink?>"><i class="fa fa-tumblr-square" style="color:#529ecc"></i></a>
    <?php endif;?>
    <?php if(!empty($configSite[0]->info->youtubelink)):?>
    <a target="_blank" href="<?=$configSite[0]->info->youtubelink?>"><i style="color:#cc181e" class="fa fa-youtube-square"></i></a>
    <?php endif;?>
    <?php if(!empty($configSite[0]->info->googlelink)):?>
    <a target="_blank" href="<?=$configSite[0]->info->googlelink?>"><i style="color:#dd4b39" class="fa fa-google-plus-square"></i></a>
    <?php endif;?>-->
      
      <?=$configSite[0]->info->copyright;?></td>
  </tr>
</table>
