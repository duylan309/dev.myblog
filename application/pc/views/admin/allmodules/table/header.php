<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header">
    <?=$page_title?>
    <a class="btn btn-default btn-primary pull-right btn-sm" href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=0&function=add">
      <i class="fa fa-plus"></i> <?=$language->ADD?>
    </a>  
    </h3>
    <ol class="breadcrumb">
      <li>
        <i class="fa fa-dashboard"></i>  <a href="<?=base_url().ADMINBASE?>">Dashboard</a>
      </li>
      <li class="active">
        <i class="fa fa-table"></i> <?=$page_title?>
      </li>
    </ol>
  </div>
</div>