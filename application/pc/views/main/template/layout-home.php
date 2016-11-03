<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <?=$this->load->view('main/template/header.php');?>
  <body>
    <div id="wrapper">
      <div id="page-wrapper">
        <div id="header">
          <?=$this->load->view('main/template/box/menu.php');?>
        </div>
        
        <div id="body">
          <?php if(!empty($template)){$this->load->view($template);}?>
        </div>
        <div id="footer">
          <?=$this->load->view('main/template/footer.php');?>
        </div>
      </div>
    </div>
  </body>
</html>