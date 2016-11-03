<ul class="nav nav-tabs">
 	<li class="active">
 		<a href="#technical" data-toggle="tab">
 			<?=$lang=="en" ? "Technical information" : "Thông số kỹ thuật"?></a>
	</li>
 	<li>
 		<a href="#gallery" data-toggle="tab"><?=$lang=="en" ? "Gallery" : "Hình ảnh"?></a>
	</li>
	
	<?php 
	if(isset($readXml['tab']) && count($readXml['tab'])){
		if(isset($readXml['tab'][1])){
			
			$i=0; foreach($readXml['tab'] as $value):?>

				<li class="">
					<a href="#<?=$value['url']?>" data-toggle="tab"> <?=$value['title']?> </a>
				</li>

			<?php $i++; endforeach;

		}else{?>
			
			<li class="">
				<a href="#<?=$readXml['tab']['url']?>" data-toggle="tab"> <?=$readXml['tab']['title']?> </a>
			</li>

		<?php }
	}?>

</ul>

<div class="tab-content">

<?=$this->load->view('main/'.$FOLDERCONTROL.'/item_comparison.php')?>
<?=$this->load->view('main/'.$FOLDERCONTROL.'/items_gallery_tab.php')?>

<?php 
if(isset($readXml['tab']) && count($readXml['tab'])){
	if(isset($readXml['tab'][1])){ 
		$i=0; foreach($readXml['tab'] as $value):?>
		<div id="<?=$value['url']?>" class="tab-pane">
		<div class="text-area">
        	<?=isset($value['description']) && count($value['description']) ? str_replace('src="upload','src="'.base_url().'upload',$value['description']) :''?></div>
		</div>	
	<?php $i++; endforeach;
	}else{?>
		<div id="<?=$readXml['tab']['url']?>" class="tab-pane">
			<div class="text-area"><?=$readXml['tab']['description']?></div>
		</div>	
	<?php }
}?>	
  
</div>
