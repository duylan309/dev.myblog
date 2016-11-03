// JavaScript Document

(function($) {
  $.fn.fullBg = function(){
    var bgImg = $(this);		
    
    function resizeImgWin() {
		
      var imgwidth  = bgImg.width();
	  var imgheight = bgImg.height();
			
      var winwidth  = $(window).innerWidth();
      var winheight = $(window).innerHeight();
		
	
      var widthratio = winwidth / imgwidth;
      var heightratio = winheight / imgheight;
			
      var widthdiff = heightratio * imgwidth;
      var heightdiff= widthratio * imgheight;
	  	
      if(heightdiff>winheight) {
        bgImg.css({
          width: winwidth+'px',
          height: heightdiff+'px',
	    });
      } else {
        bgImg.css({
          width: widthdiff+'px',
          height: winheight+'px',
		 
        });		
      }
    } 
	resizeImgWin();
	    
	$(window).resize(function() {
      resizeImgWin();
    }); 
  };
})(jQuery)