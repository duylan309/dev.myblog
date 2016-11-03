<script type="text/javascript">
  $(document).ready(function(){
 // ADD BUTTON

    var laCurrent    = '<?=$lang?>';

    $('#addTabButton').on('click',function() {
      var tab_title_vn = $('[data-tab-title-vn]').val();

      if(tab_title_vn == ""){
        $('[data-tab-title-vn]').addClass('require');
        return false;
      }

      var tab_url      = urlFriendly(tab_title_vn);

      tab_url          = tab_url.toLowerCase();

       // CLONE CONTENT TO NEW TAB
      $("#template_tab_header li a span").html(tab_title_vn);
      $("#template_tab_header li").clone().appendTo(".header_tab_control");
      $('#template_tab_content [data-new-tab-content]').clone().appendTo(".tab-content-control");


      // SET ID FOR TAB EFFECTIVE
      $('.listContent .header_tab_control li:last-child a').attr({'href':'#'+tab_url,'data-id':tab_url});
      $('.listContent .tab-content-control > div:last-child ').attr('id',tab_url);

      // GET CONTENT FROM POPUP FORM
      $('#'+tab_url+' #vn_new_tab_added input').attr('value',tab_title_vn);
      $('#'+tab_url+' [data-url]').attr('value',tab_url);

      // SET TAB SELECTION
      $('#'+tab_url+' [data-title] li:nth-child(1) a').attr('href','#vn_title_'+tab_url);
      $('#'+tab_url+' [data-title] .tab-pane:nth-child(1)').attr('id','vn_title_'+tab_url);

      $('#'+tab_url+' [data-content] li:nth-child(1) a').attr('href','#vn_content_'+tab_url);
      $('#'+tab_url+' [data-content] .tab-pane:nth-child(1)').attr('id','vn_content_'+tab_url);

      
      // SET ACTIVE TAB
      $('.header_tab_control li').removeClass('active');
      $('.header_tab_control a').tab();
      $('.header_tab_control a:last').tab('show');

      // CALLBACK TO TINYMCE
      setTextEditor('#'+tab_url+' textarea');
      $('#addTabContent').modal('hide');
      

      $('[data-tab-title-vn]').removeClass('require').val('');

    });

    // DELETE 
    $('.header_tab_control').on('click','a .fa-times',function() {
      if(!confirm("Are you sure ?")){
            return false ;
      }else{
        var getIdFromA = $(this).parent('a').attr('data-id');
        $("#"+getIdFromA).remove();
        $(this).closest('li').remove();
      }
    });


    var el = document.getElementById('info')
    Sortable.create(el, {
      handle: '.fa-arrows',
      animation: 150,
    });

    // FUNCTION 
    function urlFriendly(str){
        var str_replace = str.replace(/[^A-Z0-9]/gi, "");
        return str_replace;
    }

  });  
</script>