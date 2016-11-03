<script type="text/javascript">
	$(document).ready(function(){
		$("#editImage").addClass("actived");
	})
</script>
<link rel="stylesheet" href="<?=asset_url()?>style/upload/bootstrap.min.css">
<link rel="stylesheet" href="<?=asset_url()?>style/upload/jquery.fileupload-ui.css">
<noscript>
<link rel="stylesheet" href="<?=asset_url()?>style/upload/jquery.fileupload-ui-noscript.css">
</noscript>

<div class="mainMiddle"> 
  <!-- The file upload form used as target for the file upload widget -->
  <form id="fileupload" method="POST" enctype="multipart/form-data">
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="fileupload-buttonbar subhead">
      <div class="buttonControl"> 
        <button id="delete" type="submit" value="save" name="save" class="btn buttonAdd"> <i class="fa fa-trash-o"></i>
  Delete  </button>
        <!-- The fileinput-button span is used to style the file input field as button -->
        <button type="reset" class="btn btn-warning cancel"> <i class="fa fa-ban"></i>&nbsp;<span>Cancel upload</span> </button>
        <button type="submit" class="btn btn-primary start"> <i class="fa fa-upload"></i>&nbsp; <span>Start upload</span> </button>
        <span style="margin-left:0px" class="fileinput-button btn btn-success"><i class="fa fa-plus"></i>&nbsp;<span>Add files...</span>
        <input type="file" name="files[]" multiple>
        </span>
        <button id="save" type="submit" value="save" name="save" class="btn btn-primary start"> <i class="fa fa-save"></i>&nbsp; <span>Save</span> </button>
       
       
        <label  class="buttonAdd btn " style="float:left;margin-left:10px"> <a class="" href="<?=base_url().'admin/ModuleCreate/lists/0/null'?>"> <i class="fa fa-mail-reply"></i>&nbsp;
          <?=$language->BACK?>
          </a> </label>
        <div class="clear"></div>
      </div>
      <!-- The global progress information -->
      <div class="span5 fileupload-progress fade"> 
        <!-- The global progress bar -->
        <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
          <div class="bar" style="width:0%;"></div>
        </div>
        <!-- The extended global progress information -->
        <div class="progress-extended">&nbsp;</div>
      </div>
    </div>
    <!-- The loading indicator is shown during file processing -->
    <div class="fileupload-loading"></div>
    
    <!-- The table listing the files available for upload/download -->
    <table style="width:100%;margin-top:20px;position:relative" role="presentation" class="table table-striped">
      <tr>
        <th>Id</th>
        <th>Image</th>
        <th>Link</th>
        <th>Alt Image</th>
        <th>Description</th>
        <th style="width:60">Sort</th>
        <th>Delete&nbsp; </th>
      </tr>
      <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery">
      </tbody>
    </table>
  </form><div id="loadding"></div>
</div>


<!-- The template to display files available for upload --> 
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary">
                    <i class="icon-upload icon-white"></i>
                    <span>Start</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span>Cancel</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script> 
<!-- The template to display files available for download --> 
<script id="template-download" type="text/x-tmpl">
{% var number = 0;
for (var i=0, file; file=o.files[i]; i++) { %}

{% if(file.newid){ number = file.newposition; }else{ number = i==0? '0' :i; } %}
 <tr data_id="{%=number%}" class="template-download fade">
	    {% if (file.error) { %}
            <td></td>
			<td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
		<td class="id"><span>{%=file.id%} {%=file.newid%}</span></td>
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}">
				<img src="../../../../{%=file.thumbnail_url%}"></a>
            {% } %}</td>
			
         	<td class="linkphoto">
               <input type="text" value="{%=file.linkphoto%}" name="linkphoto[{%=number%}]" >
            </td>
			<td class="namealt">
               <input type="text" value="{%=file.alt_image%}" name="alt_image[{%=number%}]" >
            </td>
			
			<td class="content">
               <input type="text" value="{%=file.content%}" name="content[{%=number%}]" >
				  <a style="color:#da4f49" href="<?=base_url()?>admin/<?=$page?>/editphoto/{%=file.id%}{%=file.newid%}/<?=$this->uri->segment(4)?>">&nbsp; Edit More</a>
            </td>
			<td class="sort">
			   <input style="width:30px" type="text" value="{%=file.sort%}" name="sort[{%=number%}]" >
            </td>
			   <input type="hidden" value="{%=file.id%}{%=file.newid%}" name="id[{%=number%}]">
           <input type="hidden" value="{%=file.name%}" name="nameimage[{%=number%}]">
			        {% } %}
			
		<!--	<td class="check_cat1">///////////////////DELETE//////////////////////-->
			<td class="delete">
                       <!-- <button class="btn btn-danger" data-type="DELETE" data-url="<?=base_url()?>admin/<?=$page?>/loadphoto/<?=$this->uri->segment(4)?>/photo?file={%=file.name%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}> <i class="icon-trash icon-white"></i><span>Delete</span> </button>-->
                       <input class="checkdel" type="checkbox" name="delete[{%=number%}]" value="1" />
                    </td>
                
		<!--	<input class="checkdel" type="checkbox" name="checkdel[]" value="<?=$result->id."/"?>{%=file.name%}" />--></td>		
  
    </tr>
{% } %}
</script> 
<script type="text/javascript">
$(document).ready(function(){
		$('#save').click(function(e) {
             e.preventDefault();
    	     $('#fileupload').attr('action', "<?=base_url()?>admin/<?=$page?>/photo/<?=$this->uri->segment(4)?>/Item").submit();
        });
		$('#delete').click(function(e) {
			 e.preventDefault();
    	     $('#fileupload').attr('action', "<?=base_url()?>admin/<?=$page?>/photo/<?=$this->uri->segment(4)?>/Item").submit();
        });
		$('a.backPage').click(function(){
			parent.history.back();
			return false;
		});
})
</script> 
<script type="text/javascript" src="<?=asset_url()?>javascript/upload/vendor/jquery.ui.widget.js"></script> 
<script type="text/javascript" src="<?=asset_url()?>javascript/upload/tmpl.min.js"></script> 
<script src="<?=asset_url()?>javascript/upload/jquery.fileupload.js"></script> 
<script src="<?=asset_url()?>javascript/upload/jquery.fileupload-fp.js"></script> 
<script src="<?=asset_url()?>javascript/upload/jquery.fileupload-ui.js"></script> 
<script type="text/javascript">
$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
		//paramName: <?=mktime().'photo'?>,
        url: '<?=base_url()?>admin/<?=$page?>/loadphoto/<?=$this->uri->segment(4)?>/null',
		
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

    if (window.location.hostname === 'blueimp.github.com') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            maxFileSize: 5000000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            process: [
                {
                    action: 'load',
                    fileTypes: /^image\/(gif|jpeg|png)$/,
                    maxFileSize: 20000000 // 20MB
                },
                {
                    action: 'resize',
                    maxWidth: 1440,
                    maxHeight: 900
                },
                {
                    action: 'save'
                }
            ]
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<span class="alert alert-error"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
		//$(this).fileupload('option', 'done').call(this, null, {result: myArray});
		//document.write(JSON.stringify(context));
        // Load existing files:
		//console.dir($('#fileupload')[0]);
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
			
			dataType: 'json',
            context: $('#fileupload')[0]
       		 }).done(function () {
					//document.write(JSON.stringify(result));
					var myArray = <?=json_encode($listPhoto)?>;
					//if (result && result.length) { $(this).fileupload('option', 'done').call(this, null, {result: result});}
					if(myArray && myArray.length)
					$(this).fileupload('option', 'done').call(this, null, {result: myArray});
        });
    }  });
</script>
</div>
