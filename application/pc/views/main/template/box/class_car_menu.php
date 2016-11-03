<div class="container-section no-min-height">
	<div class="row">
		<div class="col-sm-3">
			<div class="button btn_class_cars" data-toggle="collapse" type="button" data-target="#ClassCar">
				<?=$lang=="en" ? "All Vehicles" : "All Vehicles"?> <i class="fa fa-fw fa-chevron-down pull-right"></i>
			</div>
			<div id="ClassCar" class="collapse class_cars_lists">
				<div class="class_cars_section">
					<?php if(isset($car_class_menu) && count($car_class_menu)):?>
						<div href="#" move-left><i class="fa fa-chevron-left"></i></div>
						<div href="#" move-right><i class="fa fa-chevron-right"></i></div>

						<div class="container">
						<?php ?>
							<?php $i=0; foreach($car_class_menu as $menu => $key):?>
							
							<?=$i == 0 ? ( $menu == 0 ? '<div  class="col-car data-first">' :'<div  class="col-car">') : ''?>
								
								<div class="item-class-car" class="dropdown">
									<div class="img">
										<a href="<?=base_url().$key->menu_title_url.'/'.$key->title_url.'_'.$key->id.EXTENSION?>" data-target="#<?=$key->title_url?>">
										<img class="img-reponsive" 
									 		 src="<?=isset($key->image) && count($key->image) && !empty($key->image) ? base_url().'upload/'.FOLDERCONTROLCARCATEGORY.'/'.$key->image : base_url().'/images/default-image-thumb.jpg'?>">
										</a>
									</div>

									<a href="<?=base_url().$key->menu_title_url.'/'.$key->title_url.'_'.$key->id.EXTENSION?>" data-target="#<?=$key->title_url?>">
										<?=$lang=='en' ? $key->title_en : $key->title_vn?>
									</a>
										<p><?=$lang=='en' ? $key->style_title_en : $key->style_title_vn?></p>

								</div>	

							<?=$i == 1 || count($car_class_menu)-1 == $menu ? '</div>' : ''?>

							<?php $i = $i == 1 ? 0 : $i+1; endforeach; unset($key)?>
						</div>
					<?php endif;?>
				</div>
			</div>
		</div>

		<div class="col-sm-9">
			<div class="navbar navbar-default class_car_menu">
				<nav id="bs-navbar" class=" navbar-collapse">
					<?php if(isset($car_class_menu) && count($car_class_menu)):?>
					<ul class="nav navbar-nav navbar-left">
						<?php foreach($car_class_menu as $menu => $key):?>
						<li class="dropdown">
							<a href="<?=base_url().$key->menu_title_url.'/'.$key->title_url.'_'.$key->id.EXTENSION?>" data-target="#<?=$key->title_url?>">
								<?=$lang=='en' ? $key->title_en : $key->title_vn?>
							</a>
						</li>
						<?php endforeach; unset($key)?>
					</ul>
					<?php endif;?>
				</nav>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.kinetic.min.js"></script>
<script type="text/javascript" src="<?=asset_url()?>javascript/jquery.smoothdivscroll-min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$(".class_cars_section .container").smoothDivScroll({
			hotSpotScrolling: false,
			touchScrolling: false,
			manualContinuousScrolling: false,
			mousewheelScrolling: false,
			scrollToEasingFunction: "easeOutCirc",
			tartAtElementId: ".data-first"
		});

		$('[move-left]').click(function(event) {
	        $(".class_cars_section .container").smoothDivScroll("move", -310);
		});

		$('[move-right]').click(function(event) {
	        $(".class_cars_section .container").smoothDivScroll("move", 310);
		});

		
	});
</script>