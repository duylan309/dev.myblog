<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <?=$this->load->view('main/template/header.php');?>
  <body>

  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/<?=$lang=="en" ? "en_US" : "vi_VN"?>/sdk.js#xfbml=1&version=v2.8&appId=619269798227483";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

    <div id="wrapper">
      <div id="page-wrapper">
        <div id="header" class="bg-color1">
          <div class="container no-padding">
            <?=$this->load->view('main/template/box/menu.php');?>
          </div>
        </div>
        <!-- <div id="embed-assessment-51983">Loading <a href="https://www.onlineassessmenttool.com/test-for-you/assessment-51983">Test for you</a></div>
        <script type="text/javascript">
          var QuizWorks = window.QuizWorks || [];
          QuizWorks.push(
            [document.getElementById("embed-assessment-51983"), "assessment", "51983", {
              autostart: false,
              width: "100%",
              height: "640px" 
            }]
          );
        </script>
        <script type="text/javascript" async defer src="https://d134jvmqfdbkyi.cloudfront.net/script/embed.js"></script>-->
        <div id="body">
          <?=$this->load->view('main/template/box/banner_page.php')?>
          <?php if(!empty($template)){$this->load->view($template);}?>
        </div>

        <div id="footer" class="text-right bg-color1">
          <?=$this->load->view('main/template/footer.php');?>
        </div>
      </div>
    </div>
  </body>
</html>