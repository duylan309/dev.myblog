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

$(document).ready(function(){	
	
	var getCurrentPage = $('[data-current-page]').attr('data-current-page');
	
	if("undefined" != typeof getCurrentPage){
		$('[current-menu="'+getCurrentPage+'"]').addClass('selected');
		$('[current-menu-sub="'+getCurrentPage+'"]').addClass('selected').closest('.dropdown').addClass('selected').find('ul').addClass('selected');
	}

	$(".lang").click(function(){
	 	var url = $(this).attr("url");  
		var linkset = url+'lang';
		var classChoose = "#loadding";
		var loading = '<img src="'+url+'images/icon/loading.gif" width="15" height="15" >';
		var success = $(classChoose);
		aJax(linkset,success,loading);
	});

	$('.tags').tagEditor({delimiter: ',',
                                   forceLowercase: false, 
                                   removeDuplicates:true});


})