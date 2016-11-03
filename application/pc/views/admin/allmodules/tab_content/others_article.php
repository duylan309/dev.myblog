<div id="other" class="tab-pane fade m-t-15 col-sm-12">
	<div class="row">
		<div class="col-sm-6">
			
			<div class="row">
				<div class="col-sm-6">
					<h4><?=$lang=="en" ? "List Articles" : "Danh sách bài viết"?></<h4>
				</div>
				<div class="col-sm-6">
					<div    data-upload-content 
							class="btn btn-success pull-right">
							<?=$lang=="en" ? "Update" : "Cập Nhật"?>
					</div>
				</div>	
			</div>

	    	<table  table-other
	    			data-field=""
	    			data-id="<?=$result->id?>"
	    			data-limi=""
	    			data-field-value=""
	    			data-table="<?=$page?>"
	    			class="table table-bordered table-hover m-t-15">
				<thead>
				  <tr>
				    <th></th>
			    	<th>Id</th>
				    <th><?=$language->TITLE;?></th>
				  </tr>
				  <tr class="tSearch">
						<td data-checkbox></td>
						<td data-id>
							<input  type="text"
									data-search-other
									data-table="<?=$page?>"
									data-limit="20"
									data-field="id"
									class="fSearch fTitle form-control col-sm-6 input-sm"
									name="fTitle" 
									id="fTitle" 
									value="" />
						</td>
						<td data-title>
							<input  type="text"
									data-limit="20"
									data-search-other
									data-table="<?=$page?>"
									data-field="title_<?=$lang?>"
									placeholder="<?=$lang=="en"?"Searching...":"Tìm kiếm...."?>"
									class="fSearch fTitle form-control col-sm-6 input-sm"
									name="fTitle" id="fTitle" value="" />
						</td>
				  	</tr>
				</thead>
				<tbody>
					<?php if(isset($results_all) && count($results_all)):?>
					<?php $key_array = explode(',', $result->str)?>	
					<?php foreach ($results_all as $key => $row) {?>
					<tr id="<?=$row->id?>">
						<td class="th-inner" data-delete width="10">
							<input  data-check
									type="checkbox"
									<?=in_array($row->id, $key_array) ? 'checked="checked"' : ''?>
									value="<?=$row->id?>"
									name="check_other[]">
						</td>
						<td data-action class="col-sm-1">
							<?=$row->id?>
						</td>
						<td data-title class="col3">
							<span data-image><?=$row->image ? '<img class="img-responsive img-thumbnail" src="'.base_url().'upload/'.$page.'/'.$row->image.'"  />' : '<i class="fa fa-image"></i>' ?></span>
							<?=$lang=="en" ? $row->title_en : $row->title_vn?>
						</td>
					</tr>
					<?php }?>
					<?php endif;?>

					<?php if($links){echo '<tr class="page-navigate" data-page-other-navigate><td colspan="3">'.$links.'</td></tr>';}?>

				</tbody>
			</table>
			<div return-result></div>
		</div>

		<div class="col-sm-offset-1 col-sm-5">
			
			<div class="row">
				
				<div class="col-sm-9">
					<h4><?=$lang=="en" ? "List Chosen Articles " : "Danh sách bài viết được chọn"?></<h4>
				</div>

				<div class="col-sm-3">
				
				</div>	
				<!--  -->
			</div>
			
	    	<table  table-other-selected
	    			data-field=""
	    			data-id="<?=$result->id?>"
	    			data-limi=""
	    			data-field-value=""
	    			data-table="<?=$page?>"
	    			class="table table-bordered table-hover m-t-15">
				<thead>
				  <tr>
			    	<th>Id</th>
				    <th><?=$language->TITLE;?></th>
				  </tr>
				</thead>
				<tbody>
					<?php if(isset($results_chosen) && count($results_chosen)):?>
					<?php foreach ($results_chosen as $key => $row_chosen) {?>
					<tr id="<?=$row_chosen->id?>">
						<td data-action class="col-sm-1">
							<?=$row_chosen->id?>
						</td>

						<td data-title class="col3">
							<span data-image><?=$row_chosen->image ? '<img class="img-responsive img-thumbnail" src="'.base_url().'upload/'.$page.'/'.$row_chosen->image.'"  />' : '<i class="fa fa-image"></i>' ?></span>
							<?=$lang=="en" ? $row_chosen->title_en : $row_chosen->title_vn?>
						</td>
					</tr>
					<?php }?>
					<?php endif;?>
				</tbody>
			</table>

			<!--  -->

		</div>
	</div>
</div>  

<script type="text/javascript">
$(document).ready(function() {
	var $str = '<?=$result->str?>';
	var $array_selected = $str.split(",");

	$('[table-other]').on('click','[data-check]',function(){
		if($(this).prop("checked") == true ){
			$array_selected.push($(this).val());
		}else{
			var $remove = $(this).val();	
			$array_selected = $.grep($array_selected, function(value) {
			  return value != $remove;
			});
		}
	})


	$("[data-search-other]").bind("keypress", function (e) {
	    if (e.keyCode == 13) {
 			e.preventDefault();
	     	var $url   = '<?=base_url()?>admin?page=ajax&action=search',
	     		$table = $(this).attr('data-table'),
	     		$search_value = $(this).val(),
	     		$field = $(this).attr('data-field'),
	     		$limit = $(this).attr('data-limit'),
	     	 	$per_page = '';

 	     	var	$data = { "id"   : $('[table-other]').attr('data-id'), 		 
			 			  "table": $table,
			 			  "value": $search_value,
			 			  "field": $field,
			 			  "limit": $limit,
			 			  "selected[]" : $array_selected
			 			};
 	     	  

 	     	$.ajax({
 	     	    type:'POST',
 	     	    url: $url,
 	     	    data:$data,
 	     	    success:function(data){
 					$('[table-other] tbody').html(data);
 					$('[table-other]').attr({
 						'data-table': $table,
 						'data-field': $field,
 						'data-field-value': $search_value,
	     			  	"per_page" : $per_page

 					});     	        
 	     	    },
 	     	    error: function(data){
 	     	        console.log("error");
 	     	        console.log(data);
 	     	    }
 	     	});
 	 		e.preventDefault();
	    }
	});

	$(document).on("click",'[data-page-other-navigate] a', function (e) {
     	var $url      = '<?=base_url()?>admin?page=ajax&action=search',
     		$table    = $('[table-other]').attr('data-table'),
     		$search_value = $('[table-other]').attr('data-field-value'),
     		$field    = $('[table-other]').attr('data-field'),
     		$limit    = $('[table-other]').attr('data-limit'),
     		$per_page = $(this).attr('data-page');

     	var $data  = {"id"   : $(this).attr('data-id'), 
	     			  "table": $table,
	     			  "value": $search_value,
	     			  "field": $field,
	     			  "limit": $limit,
	     			  "per_page"   : $per_page,
 			 		  "selected[]" : $array_selected};
     	$.ajax({
     	    type:'POST',
     	    url: $url,
     	    data:$data,
     	    success:function(data){
				$('[table-other] tbody').html(data);  
				$('[table-other]').attr({
 						'data-table': $table,
 						'data-field': $field,
 						'data-field-value': $search_value,
     			  		"per_page" : $per_page

 					});        	        
     	    },
     	    error: function(data){
     	        console.log("error");
     	        console.log(data);
     	    }
     	});
 		e.preventDefault();
	});
	
	$('[data-upload-content]').click(function() {
		var $url          = '<?=base_url()?>admin?page=ajax&action=article&function=update';
     	var $table        = $('[table-other]').attr('data-table');
     	var $id           = $('[table-other]').attr('data-id');
		           
		var $data = {
			"array[]" : $array_selected,
			"table"   : $table,
			"id"      : $id,
		};
		
		if($array_selected == ''){alert('Please check before you delete something !');}

		$.ajax({
			type: "POST",
			url : $url,
			data: $data,		
			success:function($html){	
				$('[table-other-selected] tbody').html($html);

			}	
		 });	

	});

});
</script>

