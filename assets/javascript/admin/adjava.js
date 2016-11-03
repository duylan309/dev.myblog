// JavaScript Document
var myWindow;
	
function openWin(url) {
	myWindow = window.open(url, "Popup", "location=1,scrollbars=1,width=800, height=400,left = 490,top = 262");
	myWindow.focus();
}
	
function closeWin() {
	myWindow.close();
}

function RefreshParent() {
    if (window.opener != null && !window.opener.closed) {
        window.opener.location.reload();
    }
}
window.onbeforeunload = RefreshParent;
function aJax(linkset,success,loading){
		$.ajax({
			  type: "POST",
			  //contentType:attr( "enctype", "multipart/form-data" ),
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

function aJaxPrepend(linkset,success,loading,loadClass){
		$.ajax({
			  type: "POST",
			  //contentType:attr( "enctype", "multipart/form-data" ),
			  url: linkset,			  
			  data: '',
			  beforeSend: function (){
					$(loadClass).html(loading);
				},	
				success:function(html){
					$(loadClass).html('');	
					$(success).prepend(html);
				},
			  });
}

function changePublish(id,database,currentLink){
	//alert(1);
			var x=document.getElementById(id);
			var name = database;
			var linkset = currentLink+'admin?page=ajax&action=publish&id='+id+'&function='+name;
			var classChoose = "#"+id+" "+".iconSetup";
			var loading = '<img src="'+currentLink+'images/icon/loading.gif" width="15" height="15" >';
			var success = $(classChoose);
			aJax(linkset,success,loading);
}

function clickDelete(album_id,photo_id,database,currentLink){
			var linkset = currentLink+'admin?page=ajax&action=deletephoto&album_id='+album_id+'&photo_id='+photo_id+'&database='+database;
			var classChoose = "#loadding";
			var loading = '<img src="'+currentLink+'images/icon/loading.gif" width="15" height="15" >';
			var success = $(classChoose);
			aJax(linkset,success,loading);
}

function changeHome(id,database,currentLink){
			var x=document.getElementById(id);
			var name = database;
			var linkset = currentLink+'admin?page=ajax&action=home&id='+id+'&name='+name;
			var classChoose = "#"+id+" "+".iconHome";
			var loading = '<img src="'+currentLink+'images/icon/loading.gif" width="15" height="15" >';
			var success = $(classChoose);
			aJax(linkset,success,loading);
}

function changeCat(id,database,currentLink){
			var x=document.getElementById(id).getElementsByClassName("changcat")[0];
			var title =x.value;
			var name = database;
			var linkset = currentLink+'admin?page=ajax&function=cat&id='+id+'&name='+name+'&title='+title;
			var loading = '<img src="'+currentLink+'images/icon/loading.gif" width="15" height="15" >';
			var success = $('.loadding');
			aJax(linkset,success,loading);
}

function changeMenuCat(id,database,currentLink){
			var x=document.getElementById(id).getElementsByClassName("changcat")[0];
			var title =x.value;
			var name = database;
			var linkset = currentLink+'admin?page=ajax&action=menucat&id='+id+'&name='+name+'&title='+title;
			var loading = '<img src="'+currentLink+'images/icon/loading.gif" width="15" height="15" >';
			var success = $('.loadding');
			aJax(linkset,success,loading);
}


function changeMenu(id,database,currentLink){
			var x=document.getElementById(id).getElementsByClassName("changemenu")[0];
			var title =x.value;
			var name = database;
			var linkset = currentLink+'admin?page=ajax&action=menu&id='+id+'&name='+name+'&title='+title;
			var loading = '<img src="'+currentLink+'images/icon/loading.gif" width="15" height="15" >';
			var success = $('.loadding');
			aJax(linkset,success,loading);
}

function changeTitle(id,lang,database,currentLink){
			var x=document.getElementById(id).getElementsByClassName("changetitle")[0];
			var title =x.value;
			var name = database;
			var linkset = currentLink+'admin?page=ajax&action=title&id='+id+'&name='+name+'&title='+title+'&lang='+lang;
			var loading = '<img src="'+currentLink+'images/icon/loading.gif" width="15" height="15" >';
			var success = $('.loadding');
			aJax(linkset,success,loading);
}

function checkUrl(id,database,currentLink){
			var x=document.getElementById('titleUrl');
			var y=document.getElementById('menuType');
			var type_menu = y.options[y.selectedIndex].value;
			var title =x.value;
			var name = database;
			var linkset = currentLink+'admin?page=ajax&action=checkurl&id='+id+'&name='+name+'&title='+title;
			var loading = '<img src="'+currentLink+'images/icon/loading.gif" width="15" height="15" >';
			var success = $('.checkURL');
			if(type_menu != 9)
			aJax(linkset,success,loading);
}
	
function changeSort(id,database,currentLink,cat,menu){
			var x=document.getElementById(id).getElementsByClassName("changesort")[0];
			var title =x.value;
			var page  = x.getAttribute('page');
			var name = database;
			var linkset = currentLink+'admin?page=ajax&action=sort&id='+id+'&name='+name+'&title='+title+'&cat='+cat+'&menu='+menu;
			var loading = '<img src="'+currentLink+'images/icon/loading.gif" width="15" height="15" >';
			var success = $('.loadding');
			aJax(linkset,success,loading);
}

function changeLanguage(base){
			var linkset = base+'admin?page=ajax&action=language&id=0&function=0';
			var loading = '<img src="'+base+'images/icon/loading.gif" width="15" height="15" >';
			var success = $('.langChange');
			aJax(linkset,success,loading);
			
}

function checkPassword(){
			
			var x=document.getElementsByClassName("confirmpassadmin")[0];
			var confirmpass =x.value;
			
			var y=document.getElementsByClassName("newpassadmin")[0];
			var newpass =y.value;
						
			var success = $('.resultCheckpass');
					
			var button =	$('.subhead')
			var countupper = countUpperCaseChars(newpass);
			
			
			if(newpass===confirmpass){
				if(newpass.length < 6){
					success.html('Your password must be longer than 6 character !');
				}else{
					if(countupper < 1){
						success.html('Your password must have at least 1 Uppercase !');
					}else{
						success.html('Your password is good');
						button.append('<label class="btn buttonAdd btn-success" class="btn buttonAdd"><i class="fa fa-save"></i>&nbsp; <input class="funSave" type="submit" value="save" name="save" /></label>');
					}
				}
			}else{
				$("#summitButton").css('display','none');
				success.html('Please check your password again ! It is not the same .');	
			}
			
}

function countUpperCaseChars(str) {
  var count=0,len=str.length;
  for(var i=0;i<len;i++) {
    if(/[A-Z]/.test(str.charAt(i))) count++;
  }
  return count;
}

$(document).ready(function(){
		$('.delclass').click(function() {
			var page = $(this).data( "role" );
			var url = $(this).data( "lastValue" );  
			var linkset = url+'admin?page=ajax&action=delItem&page_menu='+page+'&id=0&function=0';
			var loading = '<img src="'+url+'images/icon/loading.gif" width="15" height="15" >';
			var success = $('.langChange');
			var value_arr = [];
			var checkdel= $('.checkdel').serializeArray();
			 jQuery.each(checkdel, function(i, checkdel){
			 value_arr.push(checkdel.value)	;
			});
           
		  	var parameters = {
			  "array[]": value_arr,
			};
					
			
			if(value_arr == ''){alert('Please check before you delete something !');}
			$.ajax({
						type:"POST",
						url: linkset,
						data:parameters,		
						beforeSend: function (){
							$(success).html(loading);
						},	
						success:function(html){	
							$(success).html(html);
						}	
					 });			
	    });
		
		$('#checkboxes input:checked').each(function() {
		    selected.push($(this).attr('name'));
		});

	
		
		$("#check_all").change(function () {
		    $("input.checkdel").prop('checked', $(this).prop("checked"));
		});
		
		$(".cpass").click( function () {
				$(".changepass").slideToggle();
		});	
		
		if($('.cpass').attr("checked")=="checked")
			$(".changepass").slideDown();
		else
			$(".changepass").slideUp();			
	
			
		$("#uncheck_all").click(function(){
			$("input.checkdel").attr("checked",false);
		})
		
			
	})
	
	
