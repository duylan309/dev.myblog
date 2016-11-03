<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header">
		<?=isset($result) ? '<small class="fa fa-refresh"></small>' : '<small class="fa fa-plus"></small>'?> <?= isset($getMenuAdmin->title_en) || isset($getMenuAdmin->title_vn) ? ($lang=="en" ? $getMenuAdmin->title_en : $getMenuAdmin->title_vn) : $page_title?>
	
	    <button class="btn btn-default btn-primary btn-success funSave pull-right btn-sm" type="submit" value="save">
        	<i class="fa fa-check"></i> <span><?=$lang=="en" ? "Save" :"Lưu"?></span>
        </button>

		<?php if(isset($result) && isset($result->id)):?>
		<a class="funDelete btn btn-default btn-danger pull-right btn-sm m-r-15" href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=remove&id=<?=$result->id?>&function=null">
			<i class="fa fa-trash-o"></i> <?=$language->DELETE?>
		</a>
		<?php endif;?>
		
		<?=isset($more_header) && count($more_header) ? $more_header : ''?>
	
		<a class="btn btn-default pull-right btn-sm m-r-15" href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=lists&id=0&function=null">
		  <i class="fa fa-ban"></i> <?=$language->CANCEL?>
		</a>

		</h3>
		<ol class="breadcrumb">
			<li>
				<i class="fa fa-dashboard"></i>  <a href="<?=base_url().ADMINBASE?>">Dashboard</a>
			</li>
			<li class="active">
				<i class="fa fa-table"></i> <a href="<?=isset($getMenuAdmin->title_url) ? base_url().ADMINBASE.'page='.$page.'&action=lists&id=0&function=null' : '#'?>"> <?=isset($getMenuAdmin->title_en) || isset($getMenuAdmin->title_vn) ? ($lang=="en" ? $getMenuAdmin->title_en : $getMenuAdmin->title_vn) : $page_title?> </a>
			</li>
		</ol>
	</div>
</div>
