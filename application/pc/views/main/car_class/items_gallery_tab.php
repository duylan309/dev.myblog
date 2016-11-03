<div id="gallery" class="tab-pane">
	<div class="textarea">
		<?php if(isset($images_photos) && $images_photos){?>
			<?php foreach($images_photos as $photo):?>
				<img class="img-responsive" src="<?=base_url()?>upload/storage/<?=$FOLDERCONTROL?>/<?=$FOLDERCONTROL?>_photo/<?=$item->id?>/<?=$photo->title_url?>">
			<?php endforeach;?>	
		<?php }?>	
	</div>
</div>