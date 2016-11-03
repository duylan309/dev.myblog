<?=$this->load->view('main/template/breadcrumbs.php');?>

<div class="ListTeam">
  <table width="100%" cellspacing="0" cellpadding="0">
    <?php if($results):?>
    <?php foreach($results as $item):?>
    <?php $readXml = $this->dinosaur_lib->loadXml($lang,'/'.$result_menu['menu']->title_url.'/',$item->id);?>
    <tr valign="top">
      <?php if($item->image):?>
      <td class="img"><img width="309" height="309" alt="<?=$item->alt_image?>" src="<?=base_url()?>upload/<?=$result_menu['menu']->title_url?>/<?=$item->image?>"></td>
      <?php endif;?>
      <td <?=$item->image ? '' : 'colspan="2"'?> class="content"><h2>
          <?=$item->title_en?>
        </h2>
        <p>
          <?=$readXml['content']?>
        </p></td>
    </tr>
    <?php endforeach;?>
    <?php endif;?>
  </table>
  <div class="pageIndex"> <?php echo $links; ?> </div>
</div>
<div class="clearfix"></div>
