<script type="text/javascript" src="<?=asset_url()?>javascript/jquery-ui.js"></script>
<section id="Menu_food" class="AboutContent">
  <div class="banner-page"> <img src="<?=base_url()?>images/banner.jpg" alt="tuktuk restaurant" /> </div>
  <div class="content-page limitWidth">
    <form class="form booking" method="post" action="<?=base_url().$seoname['booking']?>?action=send#Contact">
      <table class="table_booking" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2" width="100%" class="title"><?=$lang=="en" ? "Book a table" : "Đặt bàn"?></td>
        </tr>
        <tr>
          <td colspan="2" width="100%" class=""><div id="GalleryMenu">
              <ul class="jquery-tabs">
                <li style="width: 200px;" class="lo_1"> <a href="#"> TukTuk 1 </a> </li>
                <li style="width: 200px;" class="lo_2"> <a href="#"> TukTuk 2 </a> </li>
              </ul>
            </div></td>
        </tr>
          </tr>
        
        <tr>
          <td colspan="2" width="100%" class="content"><br />
          <div class="paneBlock location_1">
             <?php if($lang=="en"):?>
             - Online Booking is available for booking up to 8 persons. <br />
		     - For larger bookings or bookings need set menu,<br />
&nbsp;&nbsp;please call (08) 3521 8513 or email to info@tuktukthaibistro.com 
             <?php else:?>
             - Đặt bàn trực tuyến áp dụng cho nhóm khách với số lượng tối đa là 8 người. <br />
		     - Với các nhóm khách lớn hơn 8 người, hoặc nhóm khách muốn đặt trước thực đơn,<br />
 &nbsp;&nbsp;xin vui lòng gọi trực tiếp đến (08) 3521 8513 hoặc gửi email vào
             <?php endif;?>	
            
            </div>
            
            <!-- Block 2-->
            
            <div class="paneBlock location_2">
			 <?php if($lang=="en"):?>
             - Online Booking is available for booking up to 8 persons. <br />
		     - For larger bookings or bookings need set menu,<br />
&nbsp;&nbsp;please call (08) 3823 1188 or email to info@tuktukthaibistro.com 
             <?php else:?>
             - Đặt bàn trực tuyến áp dụng cho nhóm khách với số lượng tối đa là 8 người. <br />
		     - Với các nhóm khách lớn hơn 8 người, hoặc nhóm khách muốn đặt trước thực đơn,<br />
 &nbsp;&nbsp;xin vui lòng gọi trực tiếp đến (08) 3823 1188 hoặc gửi email vào
             <?php endif;?>	</div></td>
        </tr>
        <!-- <tr>
          <td><select name="location">
              <option value="0">Tuktuk 1</option>
              <option value="1">Tuktuk 2</option>
            </select></td>
          <td><div class="tt_1"></div>
              <div class="tt_2"></div>
          </td>-->
        
          </tr>
        
        <div class="formError"> <?php echo form_error('email'); ?><?php echo form_error('fullname'); ?><?php echo form_error('subject'); ?></div>
        <tr class="pc-td">
          <td width="50%"><?=$lang=="en" ? "Name" : "Tên"?>
            :</td>
          <td width="50%"><?=$lang=="en" ? "Party size" : "Số lượng"?>
            :</td>
        </tr>
        <tr>
          <td width="">
          <div class="mobile-td"><?=$lang=="en" ? "Name" : "Tên"?></div>
          <input type="text" required="required" placeholder="" value="<?php echo set_value('fullname'); ?>" name="fullname"></td>
          <td width="">
           <div class="mobile-td"><?=$lang=="en" ? "Party size" : "Số lượng"?></div>
          <input type="text" required="required" placeholder="" value="<?php echo set_value('size'); ?>" name="size"></td>
        </tr>
        <tr class="pc-td">
          <td width="50%"><?=$lang=="en" ? "Phone" :"Số điện thoại"?>
            :</td>
          <td width="50%"><?=$lang=="en" ? "Date" :"Ngày"?>
            : (dd/mm/yyyy)</td>
        </tr>
        <tr>
          <td width="">
          <div class="mobile-td"><?=$lang=="en" ? "Phone" :"Số điện thoại"?></div>
          <input type="text" required="required" placeholder="" value="<?php echo set_value('phone'); ?>" name="phone"></td>
          <td width="">
          <div class="mobile-td"><?=$lang=="en" ? "Date" :"Ngày"?></div>
          <input type="text" required="required" id="dp1" placeholder="" value="<?php echo set_value('date'); ?>" name="date"></td>
        </tr>
        <tr class="pc-td">
          <td width="50%"><?=$lang=="en" ? "Address" : "Địa Chỉ"?>
            :</td>
          <td width="50%"><?=$lang=="en" ? "Time" : "Thời gian"?>
            :</td>
        </tr>
        <tr>
          <td width=""><div class="mobile-td"><?=$lang=="en" ? "Address" : "Địa Chỉ"?></div><input type="text" placeholder="" value="<?php echo set_value('address'); ?>" name="address"></td>
          <td width=""><div class="mobile-td"><?=$lang=="en" ? "Time" : "Thời gian"?></div><input type="text" required="required" placeholder="" value="<?php echo set_value('time'); ?>" name="time"></td>
        </tr>
        <tr>
          <td colspan="2" align="right"><div class="boxButton">
              <input class="sendCom" type="submit" value="<?=$language->SEND?>"  name="send_btn_con" />
            </div></td>
        </tr>
      </table>
      <input type="hidden" class="location_value" name="location" value="<?=getParam($this,'location')?>" />
    </form>
  </div>
  <div class="clearfix"></div>
</section>
<script type="text/javascript">
$(function() {
		
		$("#dp1" ).datepicker({dateFormat: "dd-mm-yy",changeYear: true,changeMonth: true,yearRange: "2015:2016"});
		
		
	
	
}); 

$(document).ready(function() {
	
	var locationId = location.search.split('location=')[1];
	
	if(locationId == null){
		locationId  = 0;
	}
	
	if(locationId == 0){
	  $('.lo_1').addClass('highlight');
	  $('.location_2').removeClass('show');
	  $('.location_1').addClass('show');
	}else{
	  $('.lo_2').addClass('highlight');
	  $('.location_1').removeClass('show');
	  $('.location_2').addClass('show');	
	}
	
	$(".lo_1").click(function() {
	  $('.location_value').attr('value',0);
	  $('.jquery-tabs li').removeClass('highlight');	
	  $(this).addClass('highlight');
	  $('.location_2').removeClass('show');
	  $('.location_1').addClass('show');
	});
	
	$(".lo_2").click(function() {
	  $('.location_value').attr('value',1);
	  $('.jquery-tabs li').removeClass('highlight');		
	  $(this).addClass('highlight');	
	  $('.location_1').removeClass('show');
	  $('.location_2').addClass('show');
	});
});

</script>
<style>
.radio_location input[type="radio"]{width:50px;margin:0;padding:0;width:25px}
.radio_location{width:200px}
#GalleryMenu li{float:left}
.highlight{background:#007c84 !important;}
.highlight a{color:#111 !important}
#GalleryMenu{margin-top:30px}
.location_1,.location_2{display:none}
.show{display:block}
</style>
