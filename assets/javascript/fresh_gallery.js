$(function() {
	var mode = 'small';
	/* this is the index of the last clicked picture */
	var current = 0;
						   
	thumbsDim($(".thumbsContainer"));
	makeScrollable($('.thumbsWrapper'),$(".thumbsContainer"),0);
	
	function thumbsDim($elem){
		var finalW = 0;
		$elem.find('.animate_cat').each(function(i){
			var $item 		= $(this);			
			finalW+=$item.width()+5;		
		//plus 5 -> 4 margins + 1 to avoid rounded calculations
		});
		
		
		$elem.css('width',finalW+'px').css('visibility','visible');
		
	}
	
	function makeScrollable($wrapper, $container, contPadding){
		//Get menu width
		var divWidth = $wrapper.width();
	
		//Remove scrollbars
		$wrapper.css({
			overflow: 'hidden'
		});
	
		//Find last image container
		var lastLi = $container.find('.animate_cat:last-child');
		$wrapper.scrollLeft(0);
		//When user move mouse over menu
		$wrapper.unbind('mousemove').bind('mousemove',function(e){
	
			//As images are loaded ul width increases,
			//so we recalculate it each time
			var ulWidth = lastLi[0].offsetLeft + lastLi.outerWidth() + contPadding;
	
			var left = (e.pageX - $wrapper.offset().left) * (ulWidth-divWidth) / divWidth;
			$wrapper.scrollLeft(left);
		});
	}
})