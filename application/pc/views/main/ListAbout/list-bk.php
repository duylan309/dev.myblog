    <section id="About">
      <?php if($results):?>
      <?php foreach($results as $item):?>
      <?php $readXml = $this->dinosaur_lib->loadXml($lang,'/'.$result_menu['menu']->title_url.'/',$item->id);?>
      <div class="sectionAbout <?=$item->type==1 ? "background" : ""?>" <?=$item->type==1 ? 'style="background: url('.base_url().'upload/'.$result_menu['menu']->title_url.'/'.$item->image.') no-repeat center bottom; -webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;"':''?>>
        <?php if($item->type == 1):?>
        <div class="bg-img">
        <div class="overlayBlack"></div>
        </div>
        <?php endif;?>
        <div class="Center">
          <table width="100%" cellpadding="0" cellspacing="0">
            <?php $title_hl = $lang=="en" ? $item->hl_title_en:$item->hl_title_vn?>
            <?php $title_hr = $lang=="en" ? $item->hr_title_en:$item->hr_title_vn?>
            <?php if($title_hl != "" || $title_hr != ""):?>
            <tr class="htitle">
              <td width="50%" class="col1"><?=$title_hl?></td>
              <td width="50%" class="col2"><?=$title_hr?></td>
            </tr>
            <?php endif;?>
           
            <tr>
              <td width="50%" class="col1"><?=$readXml['content'] != '' ? $readXml['content'] : ''?></td>
              <td width="50%" class="col2"><?=count($readXml['description']) != 0? $readXml['description'] : '' ?></td>
            </tr>
          </table>
        </div>
      </div>
      <?php endforeach;?>
      <?php endif;?>
    </section>
    <?php if($result_menu['menu']->id == 12):?>
    <?=$this->load->view('main/ListGallery/list.php');?>
    <?php endif;?>