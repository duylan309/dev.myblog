<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">
		<?=$page_title?>
		<a class="btn btn-default btn-primary pull-right btn-sm" href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=0&function=add">
			<i class="fa fa-plus"></i> <?=$language->ADD?>
		</a>
		<div class="btn btn-default btn-danger pull-right btn-sm delclass m-r-15" data-role="<?=$page?>" data-last-value="<?=base_url()?>">
			<i class="fa fa-trash-o"></i> <?=$language->DELETE?>
		</div>
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
