<?=$this->load->view('main/template/breadcrumbs.php');?>

<div class="tableArticles">
  <?php if(!empty($result_menu['menu']->image)):?>
  <div class="bg"><img src="<?=base_url().'upload/menu/'.$result_menu['menu']->image?>" /></div>
  <?php endif;?>
  <h1>
    <?=$lang=="en" ? $item->title_en : $item->title_vn?>
  </h1>
  <br />
  <article>
    <div class="content">
      <p class="date">
        <?=$language->DATE?>
        :
        <?=date('d/m/Y',strtotime($item->date))?>
      </p>
      <div class="clearfix"></div>
      <?=$readXml['description']?>
    </div>
  </article>
</div>
<div class="clearfix"></div>

