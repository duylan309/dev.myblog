<form data-form-validate class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=home_content&action=update&id=0&function=Save" method="post" id="submitForm" enctype="multipart/form-data">
  <?=$this->load->view('admin/allmodules/table/header_with_action.php')?>
   

   <div class="listContent p-10">
    
    <ul class="nav nav-tabs">
      <li class="active">
        <a href="#content" data-toggle="tab">Content</a>
      </li>
      
    </ul>

    <div class="tab-content m-t-30">
        <?=$this->load->view('admin/allmodules/tab_content/short_text.php')?>

        <?=$this->load->view('admin/allmodules/tab_content/long_text.php')?>
    </div>
  </div>
</form>
