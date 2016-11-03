// JavaScript Document
$(document).ready(function() {
  function setHeightmain(){
	var rightMain = ($(window).width() - 144)/4;
	var heightLimit = $(window).height() - 168;
	var imgSize = $('.titleHome').width();
    $('#mainRight').css('width',$(window).width() - 144);
	$('#mainRight').css('min-width',700);
	$('#mainLeft').css('height',heightLimit);
	$('#mainRight').css('height',heightLimit);
	$('.jspContainer').css('height',heightLimit);
	$('.bLockAnimateTop').css('width',$(window).width() - 144);
	$('.animateBanner').css('width',$(window).width() - 144);
	//$('.WorkDetailRight').css('width',$(window).width() - 350);
  }
 
 
  function setHeightmain_first(){
	setHeightmain();
  }
  
  function setHeightWorkDetail(){
	var rightMain = ($(window).width() - 144)/4;
	var heightLimit = $('html').height() - 168;
	var imgSize = $('.titleHome').width();
    $('#mainRight').css('width',$(window).width() - 144);
	$('#mainRight').css('min-width',700);
	$('#mainLeft').css('height',heightLimit);
	$('#mainRight').css('height',heightLimit);
  }
  
    function setHeightWorkDetail_first(){
		setHeightWorkDetail();
	}
  
   function setHeight(){
	var rightMain = ($(window).width() - 144)/4;
	var heightLimit = $(window).height() - 168;
	var imgSize = $('.titleHome').width();
   	$('.boxColumn').css('width', rightMain-14);
	$('.boxColumn').css('height', heightLimit);
	$('.jspPane').css('width', rightMain-14);
	$('.jspContainer').css('width', rightMain-14);
	$('.boxContentHome').css('width', rightMain-24);
	$('.jspTrack').css('height', heightLimit);
	$('.imgHome img').css('width', rightMain-24);
	$('.boxContentHome').css('min-width', 200);
  }
 
 
    function setHeight_first(){
	var rightMain = ($(window).width() - 144)/4;
	var heightLimit = $(window).height() - 168;
	var imgSize = $('.titleHome').width();
   	$('.boxColumn').css('width', rightMain-14);
	$('.boxColumn').css('height', heightLimit);
	$('.jspPane').css('width', rightMain-14);
    $('.boxContentHome').css('min-width', 200);
	$('.jspContainer').css('width', rightMain-14);
	$('.boxContentHome').css('width', rightMain-14);
	$('.jspTrack').css('height', heightLimit);
	$('.imgHome img').css('width', rightMain-14);
  }
  
  
 });