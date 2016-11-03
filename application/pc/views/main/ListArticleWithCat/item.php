<?php if(isset($item->image_other) && !is_array($item->image_other) && !empty($item->image_other)):?>
<div banner-home class="fullscreen b-cover c-center" style="background:url(<?=SOURCEFOLDER?>images/<?=$item->image_other?>) no-repeat">
  <div class="container">
    <div class="banner">
        <div class="banner-title">
        </div>
    </div>
  </div>
</div>
<?php else:?>
<div banner-home class="fullscreen b-cover c-center" style="background:url(<?=base_url()?>images/banner-home.jpg) no-repeat">
  <div class="container">
    <div class="banner">
        <div class="banner-title">
        </div>
    </div>
  </div>
</div>
<?php endif;?>
<div class="container">
  <div class="col-sm-8">
    <div class="blog-item">
        
        <h1><?=$lang=="en" ? $item->title_en : $item->title_vn?></h1>
        
        <div class="header-blog-detail">
          <div class="author">
              
              <div class="row">
                
                <div class="col-sm-1 col-xs-1">
                  <div class="author-img">
                    <img  alt="<?=$item->user_alt_image?>" 
                          class="img-responsive img-admin-thumb" 
                          src="<?=SOURCEFOLDER.'user/'.$item->user_image?>">
                  </div>
                </div>

                <div class="col-sm-3 col-xs-9">
                  <h3 class="bg-color2"><?=$item->user_name?></h3>
                  <p class="bg-color1"><?=$item->user_title?></p>
                </div>
                
                <div class="col-sm-7 col-xs-12">
                  <ul class="nav navbar-nav navbar-right social-network share-function">
                    <?php $data_share['current_link'] = base_url().$item->title_url.'.'.$item->id.EXTENSION;?>
                    <?=$this->load->view('main/modules/share.php',$data_share)?>
                  </ul>
                </div>

              </div>

            </div>
          </div>

        <div class="decription">
          <?=isset($readXml['description']) && !is_array($readXml['description']) ? $readXml['description'] : ''?>
        </div>
        <div class="comments">
          <div class="fb-comments-top text-color1"><?=$lang=="en" ? "Comments" : "Bình luận"?></div>
          <div class="fb-comments" data-width="100%" data-href="<?=base_url().$item->title_url.'_'.$item->id.EXTENSION?>" data-numposts="5"></div>
          <div class="fb-comments-bottom"></div>
        </div>
    </div>
  </div>
  <div class="col-sm-4">
    <?php if(isset($results_tags) && is_array($results_tags)):?>
    <div class="article-column">
    <header><?=$lang=="en" ? "Ralated post" : "Bài viết liên quan"?></header>  
    <?php foreach($results_tags as $tag):?>
    <div class="article-right">
      <div class="row">
        <div class="col-sm-4 col-xs-4">
          <div class="img">
            <a title="<?=$lang=="en" ? $tag->title_en : $tag->title_vn?>" href="<?=base_url().$tag->title_url.'_'.$tag->id.EXTENSION?>">
            <img  class="img-responsive"
                  alt-image="<?=$tag->alt_image?>"
                  src="<?=IMAGEBLOG.$tag->image?>">
            </a>      
          </div>
        </div>
        <div class="col-sm-8 col-xs-8">
          <div class="author">
            <h4 class="title">
              <a title="<?=$lang=="en" ? $tag->title_en : $tag->title_vn?>" href="<?=base_url().$tag->title_url.'_'.$tag->id.EXTENSION?>">
                <?=$lang=="en" ? $tag->title_en : $tag->title_vn?>
              </a>
            </h4>
          </div>  
        </div>
      </div>
    </div>
    <?php endforeach;?>  
    </div>
    <?php endif;?>  

    <?php if(isset($results_selected) && is_array($results_selected)):?>
    <div class="article-column">
      <header><?=$lang=="en" ? "Featured post" : "Bài viết nổi bật"?></header>  
    <?php foreach($results_selected as $selected):?>
    <div class="article-right">
      <div class="row">
        <div class="col-sm-4 col-xs-4">
          <div class="img">
            <a title="<?=$lang=="en" ? $selected->title_en : $selected->title_vn?>" href="<?=base_url().$selected->title_url.'_'.$selected->id.EXTENSION?>">
              <img  class="img-responsive"
                    alt-image="<?=$selected->alt_image?>"
                    src="<?=IMAGEBLOG.$selected->image?>">
            </a>        
          </div>
        </div>
        <div class="col-sm-8 col-xs-8">
            <h4 class="title">
              <a title="<?=$lang=="en" ? $selected->title_en : $selected->title_vn?>" href="<?=base_url().$selected->title_url.'_'.$selected->id.EXTENSION?>"> 
                <?=$lang=="en" ? $selected->title_en : $selected->title_vn?>
              </a>  
            </h4>
        </div>
      </div>
    </div>
    <?php endforeach;?>  
    </div>
    <?php endif;?>  

  </div>  
</div>

