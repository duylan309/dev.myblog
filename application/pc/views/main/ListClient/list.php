<?=$this->load->view('main/template/breadcrumbs.php');?>

<div id="ListClient">
  <?php if($results):?>
    <table width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <?php $i=1?>
		<?php foreach($results as $item):?>
        <td <?=$i%5==0 ? 'class="last"' : ''?>>
		<a <?=$item->title_url == "#" ? "" : 'target="_blank"'?> href="<?=$item->title_url?>" > <img width="178" height="178" alt="<?=$item->alt_image?>" src="<?=base_url()?>upload/<?=$result_menu['menu']->title_url?>/<?=$item->image?>"> </a>
        
        <?php if($i%5==0):?>
        </td></tr><tr>
        <?php else:?>
        </td>
		<?php endif;?>
        
		<?php $i++;?>
        <?php endforeach;?>
      
    </table>
    <?php unset($results);?>
  <?php endif;?>
</div>
