<div class="row list-contents">
  <?php if($results):?>
  <?php $i = 1?>
  <?php foreach($results as $item):?>
  <?php $readXml = $this->dinosaur_lib->loadXml($lang,'/'.$result_menu['menu']->title_url.'/',$item->id);?>
  <div id="<?=$i?>" class="item">
    <div class="row">
      <div class="col-sm-3">
        <a href="<?=base_url().$result_menu['menu']->title_url.'/'.$item->title_url.'_'.$item->id.EXTENSION?>">
          <img class="img-responsive" src="<?=isset($item->image) && count($item->image) ? base_url().'upload/'.$result_menu['menu']->title_url.'/'.$item->image : base_url().'images/default-image-thumb.jpg'?>">  
        </a>
      </div>
      <div class="col-sm-9">
        <h5 class="title"><?=$lang=="en" ? $item->title_en :$item->title_vn?></h5>
        <div class="description">
          <?=isset($readXml["content"]) && count($readXml["content"]) ? $readXml["content"] : ''?>
        </div>
        <a href="<?=base_url().$result_menu['menu']->title_url.'/'.$item->title_url.'_'.$item->id.EXTENSION?>">
          <?=$language->VIEWMORE?>
        </a>
      </div>
    </div>
  </div>
  <?php $i++?>
  <?php endforeach;?>
  <?php endif?>
  <?=isset($links) && count($links) ? $links : ''?>
</div>