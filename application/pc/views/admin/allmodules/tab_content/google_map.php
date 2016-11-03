<div class="paneBlock">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
      <td class="t1">Map</td>
      <td class="t3"><div id="googleMap" style="width:600px;height:380px;"></div></td>
      
    </tr>
    
    <tr>
      <td class="t1"></td>
      <td class="t3">
        <div class="content-tab-1">
          <ul class="jquery-tabs-1 locationMap">
            <li><a class="hcm" href="#" location-value="1"><span class="">Ho Chi Minh</span></a></li>
            <li><a class="hn" href="#" location-value="2"><span class="">Ha Noi</span></a></li>
          </ul>
          <div class="jquery-panes-1">
            <!-- Block 1-->
            <div class="paneBlock-1">
              <table width="100%" cellpadding="0" cellspacing="0">
                
                <tr>
                  <td>Tọa độ X:
                    <input type="text" class="map_x_hcm" name="map_x_hcm" value="<?=$readXML->info->map_x_hcm?>" size="50" /></td>
                  </tr>
                  <tr>
                    <td>Tọa độ Y:
                      <input type="text" class="map_y_hcm" name="map_y_hcm" value="<?=$readXML->info->map_y_hcm?>" size="50" /></td>
                    </tr>
                  </table>
                </div>
                <!-- Block 2-->
                <div class="paneBlock-1">
                  <table width="100%" cellpadding="0" cellspacing="0">
                    
                    <tr>
                      <td>Tọa độ X:
                        <input type="text" class="map_x_hn" name="map_x_hn" value="<?=$readXML->info->map_x_hn?>" size="50" /></td>
                      </tr>
                      <tr>
                        <td>Tọa độ Y:
                          <input type="text" class="map_y_hn" name="map_y_hn" value="<?=$readXML->info->map_y_hn?>" size="50" /></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div></td>
              </table>
            </div>


            
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script> 
<script type="text/javascript">
$(document).ready(function() {
var myCenter_hcm;// Tọa độ của marker
var myCenter_hn;
var zoomValue;
//Tạo tọa độ ban đầu
var tx_hcm = <?=!empty($readXML->info->map_x_hcm) ?  $readXML->info->map_x_hcm : 0?>;
var ty_hcm = <?=!empty($readXML->info->map_y_hcm) ?  $readXML->info->map_y_hcm : 0?>;

var tx_hn = <?=!empty($readXML->info->map_x_hn) ?  $readXML->info->map_x_hn : 0?>;
var ty_hn = <?=!empty($readXML->info->map_y_hn) ?  $readXML->info->map_y_hn : 0?>;

if(tx_hcm==0 && ty_hcm ==0){
  myCenter_hcm  = new google.maps.LatLng(10.789113161930226,106.67731847416599);
  zoomValue = 9;
}else{
  myCenter_hcm  = new google.maps.LatLng(tx_hcm,ty_hcm); 
  zoomValue = 12;
}

if(tx_hn==0 && ty_hn ==0){
  myCenter_hn  = new google.maps.LatLng(10.789113161930226,106.67731847416599);
  zoomValue = 9;
}else{
  myCenter_hn  = new google.maps.LatLng(tx_hn,ty_hn); 
  zoomValue = 12;
}

var marker;
var map;
function initialize(){
  //CÀI ĐẶT BẢN ĐỒ
  var mapProp = {     center   : myCenter_hcm,
              zoom     : zoomValue,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              disableDefaultUI:true, // bỏ thanh công cụ trên google map
               };
  
  map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  var countMap = 0;
  
  if(tx_hcm!=0 && ty_hcm !=0){
    marker  = new google.maps.Marker({
                position:myCenter_hcm,
          animation:google.maps.Animation.BOUNCE, // Tạo animation cho nút marker\
         // icon:'pinkball.png', // Icon hình cho marker
              });

    marker.setMap(map);
  
    countMap=1;
  }
  
  /* onclick tab*/
  
  $('.hcm').click(function(event) {
      myCenter_hcm  = new google.maps.LatLng($('.map_x_hcm').attr('value'),$('.map_y_hcm').attr('value'));
    placeMarker(myCenter_hcm,1);//gọi function Place marker bên dưới
  });
  $('.hn').click(function(event) {
    myCenter_hn  = new google.maps.LatLng($('.map_x_hn').attr('value'),$('.map_y_hn').attr('value'));
    placeMarker(myCenter_hn,2);//gọi function Place marker bên dưới
    
  });
    
  google.maps.event.addListener(map, 'click', function(event) {
    var locationValue = $(".locationMap .current").attr('location-value');
      placeMarker(event.latLng,locationValue);//gọi function Place marker bên dưới
  });
  
  function placeMarker(location,Locate_value) {
   
     if(countMap!=0){
        marker.setMap(null);
     }
    // Center  = new google.maps.LatLng(location.lat,location.lng);
     
     marker = new google.maps.Marker({
            position: location,
            map: map,
            zoom     : zoomValue,
            animation: google.maps.Animation.DROP,
            });
          
    //marker.setPosition(location);
     map.panTo(marker.getPosition());
    countMap=1;
    if(Locate_value==1){
      $('.map_y_hcm').attr('value',location.lng());
      $('.map_x_hcm').attr('value',location.lat());
    }else{
      $('.map_y_hn').attr('value',location.lng());
      $('.map_x_hn').attr('value',location.lat());
    }
  }
}

$("#maptab").click(function() {
  initialize();//
 // google.maps.event.addDomListener(window, 'load', initialize); // load Google Map  

});

$(".locationMap .current").find()

});</script>