<script type="text/javascript">
    $(document).ready(function(){
        $("#editImage").addClass("actived");
    })
</script>
<link rel="stylesheet" href="<?=asset_url()?>style/upload/jquery.fileupload-ui.css">
<noscript>
<link rel="stylesheet" href="<?=asset_url()?>style/upload/jquery.fileupload-ui-noscript.css">
</noscript>

<form id="fileupload" method="POST" enctype="multipart/form-data">
    <div class="fileupload-buttonbar">
        <div class="row">
      <div class="col-lg-12">
        <h3 class="page-header text-right">
          <button id="delete" type="submit" value="save" name="save" class="btn buttonAdd"> <i class="fa fa-trash-o"></i> Delete  </button>
          <button type="reset" class="btn btn-warning cancel"> <i class="fa fa-ban"></i>&nbsp;<span>Cancel upload</span> </button>
          <button class="btn start"> <i class="fa fa-upload"></i>&nbsp; <span>Start upload</span> </button>
          <span style="margin-left:0px" class="fileinput-button btn btn-success"><i class="fa fa-plus"></i>&nbsp;<span>Add files...</span>
            <input type="file" name="files[]" multiple>
          </span>
          <button id="save" type="submit" value="save" name="save" class="btn btn-primary start"> <i class="fa fa-save"></i>&nbsp; <span>Save</span> </button>
          <label  class="buttonAdd btn " style="float:left;margin-left:10px"> <a href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=update&id=<?=$id?>&function=Item"> <i class="fa fa-mail-reply"></i>&nbsp;
            <?=$language->BACK?>
            </a> </label>
        </h3>
      </div>
    </div> 
      <div class="span5 fileupload-progress fade"> 
        <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
          <div class="bar" style="width:0%;"></div>
        </div>
        <div class="progress-extended">&nbsp;</div>
      </div>
    </div>
    <div class="fileupload-loading"></div>
    
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
<div id="loadding"></div>

<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td></td>
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
<script id="template-download" type="text/x-tmpl">
{% var number = 0;
for (var i=0, file; file=o.files[i]; i++) { %}

{% if(file.newid){ number = file.newposition; }else{ number = i==0? '0' :i; } %}
 <tr data_id="{%=number%}" id="{%=file.id%}{%=file.newid%}" class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
        <td class="id"><span>{%=file.id%} {%=file.newid%}</span></td>
            <td class="preview">{% if (file.thumbnail_url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}">
                <img src="./{%=file.thumbnail_url%}"></a>
            {% } %}</td>
            
            <td class="linkphoto">
               <input class="form-control input-sm" type="text" value="{%=file.linkphoto%}" name="linkphoto[{%=number%}]" >
            </td>
            <td class="namealt">
               <input class="form-control input-sm" type="text" value="{%=file.alt_image%}" name="alt_image[{%=number%}]" >
            </td>
            
            <td class="content">
               <input class="form-control input-sm" type="text" value="{%=file.content%}" name="content[{%=number%}]" >
                  <a style="color:#da4f49" href="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=editphoto&id={%=file.id%}{%=file.newid%}&function=<?=$id?>&position=<?=isset($POSITIONIMG) ? $POSITIONIMG : ""?>">&nbsp; Edit More</a>
            </td>
            <td class="sort">
               <input class="form-control input-sm" style="width:30px" type="text" value="{%=file.sort%}" name="sort[{%=number%}]" >
            </td>
               <input type="hidden" value="{%=file.id%}{%=file.newid%}" name="id[{%=number%}]">
               <input type="hidden" value="{%=file.name%}" name="nameimage[{%=number%}]">
                    {% } %}
            
        <!--    <td class="check_cat1">///////////////////DELETE//////////////////////-->
            <td class="deletephoto">
                       <!-----<button class="btn btn-danger" data-type="delete" data-url="<?=base_url().ADMINBASE?>admin?page=<?=$page?>&action=loadphoto&id=<?=$id?>&funciton={%=file.id%}&position=<?=isset($POSITIONIMG) ? $POSITIONIMG : ""?>"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}> <i class="icon-trash icon-white"></i><span>Delete</span></button>--->
                            
                      <!-- <div onclick="clickDelete(<?=$this->uri->segment(4)?>,{%=file.id%}{%=file.newid%},'<?=$page?>','<?=base_url()?>')" class="btn deletebtn">  <i class="icon-trash icon-white"></i><span>Delete</span>-</div>-->
                        
                        <input class="checkdel" type="checkbox" name="delete[{%=number%}]" value="1" />
                    </td>
                
    
  
    </tr>
{% } %}
</script> 

</form>
<script type="text/javascript">
$(document).ready(function(){
        $('#save').click(function(e) {
             e.preventDefault();
             $('#fileupload').attr('action', "<?=base_url().ADMINBASE?>?page=<?=$page?>&action=photo&id=<?=$id?>&function=Item&position=<?=isset($POSITIONIMG) ? $POSITIONIMG : ""?>").submit();
        });
        
        $('#delete').click(function(e) {
             e.preventDefault();
             var postUrl = "<?=base_url().ADMINBASE?>?page=<?=$page?>&action=photo&id=<?=$id?>&function=Item&position=<?=isset($POSITIONIMG) ? $POSITIONIMG : ''?>";
             $('#fileupload').attr('action', postUrl).submit();
       
        });

        $('a.backPage').click(function(){
            parent.history.back();
            return false;
        });
        
        $(".deletebtn").on('click',function(){
            var GetId   = $(this).attr('getId');
            $('#'+GetId).css('display','none');
        });
       
    
    })
</script> 

<script type="text/javascript" src="<?=asset_url()?>javascript/upload/vendor/jquery.ui.widget.js"></script> 
<script type="text/javascript" src="<?=asset_url()?>javascript/upload/tmpl.min.js"></script> 
<script type="text/javascript" src="<?=asset_url()?>javascript/upload/load-image.min.js"></script> 
<script type="text/javascript" src="<?=asset_url()?>javascript/upload/jquery.fileupload.js"></script> 
<script type="text/javascript" src="<?=asset_url()?>javascript/upload/jquery.fileupload-fp.js"></script> 
<script type="text/javascript" src="<?=asset_url()?>javascript/upload/jquery.fileupload-ui.js"></script> 

<script type="text/javascript">
$(function () {
    'use strict';

    $('#fileupload').fileupload({
       url: '<?=base_url().ADMINBASE?>?page=<?=$page?>&action=loadphoto&id=<?=$id?>&function=null&position=<?=isset($POSITIONIMG) ? $POSITIONIMG : ""?>',
        
    });

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
        
        $.ajax({
            
            url: $('#fileupload').fileupload('option', 'url'),
            
            dataType: 'json',
            context: $('#fileupload')[0]
             }).done(function () {
                    var myArray = <?=json_encode($listPhoto)?>;
                    if(myArray && myArray.length)
                    $(this).fileupload('option', 'done').call(this, null, {result: myArray});
        });
    }  });
</script>
</div>
