<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3">
      <img id="imagePreviewMeta" src="<?=isset($readXML_en->info->image_facebook) && count($readXML_en->info->image_facebook) && !empty($readXML_en->info->image_facebook) ? base_url().'upload/images/'.$readXML_en->info->image_facebook : base_url().'/images/default-image-thumb.jpg'?>"/>
      <span class="alert fade"></span>
    </div>
</div>    


<div class="form-group">
    <label class="col-sm-3"><?=$lang=="en" ? "Image Facebook" : "Hình ảnh facebook"?></label>
    <div class="col-sm-9 form-image-upload">
        <input  data-image-ajax
                multiple
                id="ImageBrowseMeta"
                type="file"
                name="image_upload"
                value=""
                size="30"/>
       <br>
        <div data-form-image="<?=base_url().ADMINBASE.'?page='.URLIMAGEUPLOAD?>&facebook=1&id=<?=isset($result->id) ? $result->id : 0?>"
             id="addPhotoUploadMeta" class="btn btn-success"><?=$lang=="en" ? 'Upload' : 'Đăng ảnh'?></div>
    </div>
    
</div>

<input  type="hidden" 
        class="image-other-meta" 
        name="seo-image_facebook_en" 
        value="<?=isset($readXML_en) ? $readXML_en->info->image_facebook_en : ""?>">

<input  type="hidden" 
        class="image-other-meta" 
        name="seo-image_facebook_vn" 
        value="<?=isset($readXML_vn) ? $readXML_vn->meta->image_facebook_vn : ""?>">        

<script type="text/javascript">
  $(document).ready(function() {
   

    $("#ImageBrowseMeta").on("change", function()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
     
            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
     
                reader.onloadend = function(){ // set image data as background of div
                    $("#imagePreviewMeta").attr("src", this.result);
                }
            }
        });

   


    $(window).load(function () {
        $('.form-image-upload').prepend('<form data-submit-image-meta method="post" enctype="multipart/form-data">').append('</form>')
    
        $('[data-submit-image-meta]').on('submit',(function(e) {
            var formId = this.id;
          console.log(formId);
            e.preventDefault();
            var file = document.getElementById("ImageBrowseMeta").files[0]; //fetch file
            var formData = new FormData();
            formData.append('image_upload', file); //append file to formData object
  
            $.ajax({
                type:'POST',
                url: $('#addPhotoUploadMeta').attr('data-form-image'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    var result = data.split(',');

                    $('.image-other-meta').attr('value',result[0]);
                    $('.alert').addClass('in').html(result[1]);

                    $("input[type='submit'],button[type='submit']")
                      .removeAttr('disabled', 'disabled')
                      .find('span').html('<?=$lang=="en" ? "Save" : "Lưu"?>');
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                }
            });
        }));


        $('#addPhotoUploadMeta').click(function() {
         $('[data-submit-image-meta]').submit();
        });
    });

  });

</script>




