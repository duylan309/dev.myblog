<?php if($results):?>

<div id="breadcrumbs">
  <div class="square"></div>
  <a  href="#">
 	 <?=$lang=='en' ? "Search: " : "Tìm kiếm: "?> <span class="search_bread"><?=isset($search_value) ? $search_value : ''?></span>
  </a> 
  <div class="clearfix"></div>
</div>
<table id="ListSearch" class="searchTable" cellpadding="0" cellspacing="0">

<?php foreach($results as $keyUrl):?>
	<?php if($keyUrl['lists']):?>
    	<?php foreach($keyUrl['lists'] as $itemSearch):?>
        <?php $readXml = $this->dinosaur_lib->loadXml($lang,'/'.$keyUrl['title_url'].'/',$itemSearch->id);?>
         <?php if($keyUrl['type'] == 2 || $keyUrl['type'] == 4):?>
      		<?php $lik = base_url().$keyUrl['title_url'].'/'.$itemSearch->title_url.'_'.$itemSearch->id.'.html'?>	
		 <?php else:?>
            <?php $lik = base_url().$keyUrl['title_url'].'/'.$itemSearch->title_url.'_'.$itemSearch->cat.'_'.$itemSearch->id.'.html'?>
         <?php endif;?>
        <td>
        <hr />
        <div class="clearfix"></div>
        <div class="date">
          <?=date('M d, Y',strtotime($itemSearch->date))?>
        </div>
        <div class="title"> <?=$lang=="en" ? $itemSearch->title_en : $itemSearch->title_vn?></div>
        <div class="content">
            <?=$readXml['content']?>
          </div>
          
          <a href="<?=$lik?>" class="readmore">
          <?=$language->READMORE?>
          </a>
          
      </td><tr>
		<?php endforeach;?>
    <?php endif;?>	
<?php endforeach;?>
<tr>
<td>
<div class="pageIndex"> 
  <?php if($links):?><hr />
  <div class="clearfix">
  <?php endif;?>
  <?php echo $links; ?> </div>
</td>
</tr>
</table>
 
<?php endif;?>
