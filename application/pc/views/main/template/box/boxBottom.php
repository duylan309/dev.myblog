<ul class="Box_bottom">
  <li class="li"><?php if(count($listFooter['list_buying_guide'])!=0):?>
    <ul>
      <li class="header_title">Buying guide</li>
      <?php foreach($listFooter['list_buying_guide'] as $guide): ?>
      <li><a href="<?=base_url().'company/'.$guide->id.'/'.$guide->title_url.'.html'?>">
        <?=$lang=="en" ? $guide->title_en : $guide->title_vn?>
        </a> </li>
      <?php endforeach;?>
    </ul><?php endif;?>
  </li>
  <li class="li"> <?php if(count($listFooter['list_follow_us'])!=0):?>
    <ul>
      <li class="header_title">Follow us</li>
      <?php foreach($listFooter['list_follow_us'] as $follow): ?>
      <?php if($follow->check_link==1 ? $link = $follow->link : $link = $follow->title_url)?>
      <li> <a target="_blank" href="<?=$link?>">
        <?= $lang=="en" ? $follow->title_en : $follow->title_vn?>
        </a> </li>
      <?php endforeach;?>
    </ul><?php endif;?>
  </li>
 
  <li class="li"> <?php if(count($listFooter['list_policies'])!=0):?>
    <ul>
      <li class="header_title">Policies</li>
      <?php foreach($listFooter['list_policies'] as $policies): ?>
      <li><a href="<?=base_url().'company/'.$policies->id.'/'.$policies->title_url.'.html'?>">
        <?= $lang=="en" ? $policies->title_en : $policies->title_vn?>
        </a> </li>
      <?php endforeach;?>
    </ul><?php endif;?>
  </li>
  
  <li class="li"><?php if(count($listFooter['list_company'])!=0):?>
    <ul>
      <li class="header_title">Company</li>
      <?php foreach($listFooter['list_company'] as $company): ?>
      <li><a href="<?=base_url().'company/'.$company->id.'/'.$company->title_url.'.html'?>">
        <?= $lang=="en" ? $company->title_en : $company->title_vn?>
        </a> </li>
      <?php endforeach;?>
    </ul><?php endif;?>
  </li>
</ul>
