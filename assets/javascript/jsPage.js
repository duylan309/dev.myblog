function ajax_(url_,data_,success,loading){
	$.ajax({
		type:"POST",
		url:url_,
		data:data_,		
		beforeSend: function (){
			$(success).html(loading);
		},	
		success:function(html){	
			$(success).html(html);
		},
	});	
}

$(document).ready(function(){	
		
	//$('#header .container-fluid').scrollToFixed();
	

	// MENU
	$('#price').priceFormat({
			    prefix: '',
			    thousandsSeparator: ',',
			    suffix: ' VND',
			    centsLimit: 0
			});

	var getCurrentPage = $('[data-current-page]').attr('data-current-page');
	
	if("undefined" != typeof getCurrentPage){
		$('[current-menu="'+getCurrentPage+'"]').addClass('selected');
		$('[current-menu-sub="'+getCurrentPage+'"]').addClass('selected').closest('.dropdown').addClass('selected').find('ul').addClass('selected');
	}

	$('[current-menu-sub]').closest('.dropdown').attr('data-sub','1');

	

		$('body').mouseup(function(e){
			var clickedOn = $(e.target);
				if (!clickedOn.parents().andSelf().is('#ClassCar,.btn_class_cars')){
					$('.btn_class_cars').addClass('collapsed');
					$('.class_cars_lists').removeClass('in');
				}	
			        

	    });



	$(".lang").click(function(){
	 	var url = $(this).attr("url");  
		var linkset = url+'lang';
		var classChoose = "#loadding";
		var loading = '<img src="'+url+'images/icon/loading.gif" width="15" height="15" >';
		var success = $(classChoose);
		aJax(linkset,success,loading);
	});

})

function aJax(linkset,success,loading){
	$.ajax({
		type: "POST",
		url: linkset,			  
		data: '',
		beforeSend: function (){
			$(success).html(loading);
		},	
		success:function(html){	
			$(success).html(html);
		},
	});
}
