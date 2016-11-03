<div id="image" class="tab-pane fade m-t-15 col-sm-6">

  <div class="form-group">
      <label class="col-sm-4">Alt Image</label>
      <div class="col-sm-8">
        <input class="form-control" type="text" name="db-alt_image" value="<?=isset($result->alt_image) ? $result->alt_image : ""?>" />
      </div>
  </div>

  <?php if(isset($result) && isset($image_link) && is_file($image_link)):?>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-4">
          <img  src="<?=base_url().$image_link?>" width="200"/>
          <div class="checkbox">
            <label>
              <input name="action-del_image" value="1" type="checkbox"> Delete Image
            </label>
          </div>
        </div>
    </div>    
  <?php endif;?>

  <div class="form-group">
      <label class="col-sm-4"><?=$language->IMAGE?></label>
      <div class="col-sm-8">
        <?php $data = array( 'name' => 'file_images', 'id' => 'file_images');
              echo form_upload($data);?>
      </div>
  </div>


    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-4">
          <img id="imagePreview" src="<?=isset($result->image_other) && count($result->image_other) && !empty($result->image_other) ? base_url().'upload/images/'.$result->image_other : base_url().'/images/default-image-thumb.jpg'?>"/>
          <span class="alert fade"></span>
        </div>
    </div>    


  <div class="form-group">
      <label class="col-sm-4"><?=$lang=="en" ? "Image Slide" : "Hình ảnh slideshow"?></label>
      <div class="col-sm-8 form-image-upload">
          <input type="hidden" name="db-image-banner" value="">
          <input data-image-ajax multiple id="ImageBrowse" type="file" name="image_upload" value="" size="30"/>
         <br>
          <div data-form-image="<?=base_url().ADMINBASE.'?page='.URLIMAGEUPLOAD?>&id=<?=isset($result->id) ? $result->id : 0?>"
               id="addPhotoUpload" class="btn btn-success"><?=$lang=="en" ? 'Upload' : 'Đăng ảnh'?></div>
      </div>
      
  </div>

</div> 

<input type="hidden" class="image-other" name="db-image_other" value="<?=isset($result->image_other) ? $result->image_other : ''?>">

<script type="text/javascript">
  $(document).ready(function() {
   

    $("#ImageBrowse").on("change", function()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
     
            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
     
                reader.onloadend = function(){ // set image data as background of div
                    $("#imagePreview").attr("src", this.result);
                }
            }
        });

   


    $(window).load(function () {
        $('.form-image-upload').prepend('<form data-submit-image method="post" enctype="multipart/form-data">').append('</form>')
    
        $('[data-submit-image]').on('submit',(function(e) {
            var formId = this.id;
          console.log(formId);
            e.preventDefault();
            var file = document.getElementById("ImageBrowse").files[0]; //fetch file
            var formData = new FormData();
            formData.append('image_upload', file); //append file to formData object
  
            $.ajax({
                type:'POST',
                url: $('#addPhotoUpload').attr('data-form-image'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    var result = data.split(',');

                    $('.image-other').attr('value',result[0]);
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


        $('#addPhotoUpload').click(function() {
         $('[data-submit-image]').submit();
        });
    });

  });

</script>




