<form method="post" class="form-horizontal" action="<?=base_url().ADMINBASE?>?page=<?=$page?>&action=lists&id=0&function=null" id="searchSubmit">
  <input type="hidden" name="function" value="on" />
  <input class="inputSortValue" type="hidden" value="<?=$session['sort']==0 ? 1 : 0 ?>" name="fSort" />
  <input class="inputSortTable" type="hidden" value="<?=$session['sortTable']?>" name="fsortTable" />
  
  <!-- Page Heading -->
  <?=$this->load->view('admin/allmodules/table/header.php')?>
  
  <div class="row">
    <div class="col-sm-12">
      <div>
        <table class="table table-bordered table-hover">
          <?=$this->load->view('admin/allmodules/table/thead_simple.php')?>


          <tbody>
            <!--- SEARCH -->
            <?=$this->load->view('admin/allmodules/table/tbody_search_bar_simple.php')?>
            <?=$this->load->view('admin/allmodules/table/tbody_content_simple.php')?>
          </tbody>
      
        </table>
        <div class="row">
          <div class="col-sm-12 text-left">
            <?php echo $links; ?>
          </div>
        </div>
    </div>
  </div>
</form>
<div class="loadding"></div>
