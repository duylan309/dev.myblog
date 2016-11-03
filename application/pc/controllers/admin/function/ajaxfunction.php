<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxfunction extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->helper("url");
		$this->load->library('session');
		$this->load->model(array('admin/function/functionajax','admin/admindino'));
		
	}
	
	public function checkNewMess(){
		$this->admindino->checkNewMess();
	}
	
	public function deletephoto(){
		$data['database']      = $this->uri->rsegment(7);  
		$data['album_id']      = $this->uri->rsegment(5);
		$data['photo_id']	  = $this->uri->rsegment(6);
		
		$this->admindino->deletephotogallery($data['database'],$data['album_id'],$data['photo_id']);
	} 
	
	public function changepublish(){
		$value['id']    = getParam($this,'id');
		$value['data']  = getParam($this,'function');
		//var_dump($value);
		$valueStatus = $this->functionajax->setpublish($value);
		$icon = $valueStatus==0?'<button class="btn btn-primary btn-danger btn-xs">Hide</button>&nbsp;':'<button class="btn btn-primary btn-success btn-xs">Show</button>&nbsp;';
		
		echo '<div class="choosevalue" value="'.$valueStatus.'">'.$icon.'</div>';
		
	}
	
	public function checkUrl(){
		$value['id']        = getParam($this,'id');
		$value['data']      = getParam($this,'name');
		$value['title_url'] = urldecode(getParam($this,'title'));
		
		$valueUrl           = $this->functionajax->checkurl($value); 
		
		$return_table_url   = $this->functionajax->check_table_url(array('url'=>$value['title_url'],'data'=>TABLEURL));

		if($valueUrl==0 && $return_table_url==0){
			echo $str = '<p class="text-success">This Url is good.</p>';
			?>
            <script type="text/javascript">
			$(document).ready(function() {
                $('.btn-success').css('display','block');
            });
			</script>
            
            <?php
		}else{
			$str = '<p class="text-danger">URL Already Exist. You have to choose another URL.</p>';
			echo $str;
			?>
            <script type="text/javascript">
			$(document).ready(function() {
                $('.btn-success').css('display','none');
            });
			</script>
            
            <?php
		}
		
	}
	
	public function changehome(){
		$value['id']    = $this->uri->rsegment(5);
		$value['data']  = $this->uri->rsegment(6);
		
		$valueStatus = $this->functionajax->sethome($value);
		$icon = $valueStatus==0?'<i class="fa fa-times-circle"></i>&nbsp;':'<i class="fa fa-check-circle"></i>&nbsp;';
		
		echo '<div class="choosevalue" value="'.$valueStatus.'">'.$icon.'</div>';
	//	echo '<div class="choosevalue" value="'.$valueStatus.'"><img class="iconPublish" src="'.base_url().'images/icon/publish/'.$valueStatus.'.png" title="'.$valueStatus.'"/> </div>';
		//return;
	}
	
	public function modulename(){
		$value['id']    = $this->uri->rsegment(5);
		$value['data']  = $this->uri->rsegment(6);
		$value['title'] = urldecode ($this->uri->rsegment(7));
		
		$valueTitle = $this->functionajax->setmodulename($value);
		
		if($valueTitle == true){
		?>
        <script type="text/javascript">
			alert("Updated !")
		</script>
        <?php
		}else{
		?>
        <script type="text/javascript">
			alert("Error !")
		</script>    
        <?php
			
		}
		}
	
	public function changetitle(){
		$value['id']    = getParam($this,'id');
		$value['data']  = getParam($this,'name');
		$value['title'] = getParam($this,'title');
		$value['lang']  = getParam($this,'lang');
	
		$valueTitle = $this->functionajax->settitle($value);
		
		if($valueTitle == true){
		?>
        <script type="text/javascript">
			alert("Updated !")
		</script>
        <?php
		}else{
		?>
        <script type="text/javascript">
			alert("Error !")
		</script>    
        <?php
			
		}
		}
		
	public function changesort($setData){
		$value['id']     = getParam($this,'id');
		$value['data']   = getParam($this,'name');
		$value['sort']   = getParam($this,'title');
		$value['cat']    = getParam($this,'cat');
		$valueSort       = $this->functionajax->setsort($value);
		
		if($valueSort == true){
		 $link = base_url().ADMINBASE.'?page='.$value['data'].'&action=lists&id=0&function=null';
		 ?>
         <script type="text/javascript">
			location.href="<?=$link?>";
	     </script>
        <?php
		}else{
		?>
        <script type="text/javascript">
		alert("Error !")
		</script>    
        <?php
			
		}
	}
		
	public function changeCat($setData){
		$value['id']    = $this->uri->rsegment(5);
		$value['data']  = $this->uri->rsegment(6);
		$value['cat']   = $this->uri->rsegment(7);
		
		$valueCat = $this->functionajax->setcat($value);
		$link = base_url().ADMINBASE.'?page='.$value['data'].'&action=lists&id=0&fuction=null';
		if($valueCat == true){
		?>
        <script type="text/javascript">
		alert("Updated !")
			location.href="<?=$link?>";
		</script>
        <?php
		}else{
		?>
        <script type="text/javascript">
		alert("Error !")
		</script>    
        <?php
			
		}
	}
	
	
	public function changeMenu(){
		$value['id']    = $this->uri->rsegment(5);
		$value['data']  = $this->uri->rsegment(6);
		$value['menu']   = $this->uri->rsegment(7);
		
		$valueCat = $this->functionajax->setmenu($value);
		
		if($valueCat == true){
		?>
        <script type="text/javascript">
		alert("Updated !")
		</script>
        <?php
		}else{
		?>
        <script type="text/javascript">
		alert("Error !")
		</script>    
        <?php
			
		}
	}
	

	public function changeLanguage(){
		
		$langCurrent = $this->session->userdata('language');
		if($langCurrent=="en")
			$this->session->set_userdata('language','vn');	
		else
			$this->session->set_userdata('language','en');	
		
		$url = $this->uri->rsegment(7);
		?>
        <script type="text/javascript">
		location.href="<?=$url?>";
		</script>
        <?php
		
		return ;
	}
	
	public function removeImage($setData){
		
		$folder  =  $this->uri->rsegment(6);
		$array   = $this->input->post('array');
		$id      = explode("/",$array[0]);
		foreach($array as $name):
			if($name):
				$get_delete = explode("/",$name);
				$store_img = 'upload/storage/'.$folder.'/'.$name;
				$store_img_thumb = 'upload/storage/'.$folder.'/'.$get_delete[0]."/thumbnail/".$get_delete[1];
				unlink($store_img);	
				unlink($store_img_thumb);	
			endif;
		endforeach;
		
		
		$linkRedirect = base_url().ADMINBASE.'?page='.$folder.'&action=gallery/&id='.$id[0].'&function=null';
		?>
        <script type="text/javascript">
		location.href="<?=$linkRedirect?>";
		</script>
        <?php
	}
	
	public function addImage($setData){
		$folder     = $this->uri->rsegment(6);
		$database   = $this->uri->rsegment(7);
		$member_id  = $this->uri->rsegment(8);
		$array      = $this->input->post('array');
		$album_id   = $this->uri->rsegment(5);

		$resultAdd  = $this->functionajax->addImageGallery($array,$database != 'null' ? $database : $folder,$album_id,$member_id);
	}
	
	public function delItem($setData){
		$folder  =  getParam($this,'page_menu'); // news
		//var_dump($folder);
		$database = 'admin/'.$folder;
		$array = $this->input->post('array');	
		foreach($array as $name):
			if($name):
				$this->admindino->DeleteItem(strtolower($folder),$name);//delete in database
				$this->load->helper("file");
				$this->load->helper("url");
				
				if(is_file('xmldata/en/'.$folder.'/'.$name.'.xml'))
				unlink('xmldata/en/'.$folder.'/'.$name.'.xml');
				
				if(is_file('xmldata/vn/'.$folder.'/'.$name.'.xml'))
				unlink('xmldata/vn/'.$folder.'/'.$name.'.xml');
				
				$lnk =  'upload/storage/'.$folder.'/'.$name.'/';
				if(delete_files($lnk, TRUE))
					rmdir($lnk);
				
			endif;
		endforeach;
		
		$folder = str_replace('_inbox','',$folder);
		$linkRedirect = base_url().ADMINBASE.'?page='.$folder.'&action=lists&id=0&function=null';
		?>
        <script type="text/javascript">
			location.href="<?=$linkRedirect?>";
	    </script>
        <?php
		
	}		
	
	public function searchFunction($data){
		$table = $this->input->post('table');
		$search_name  = $this->input->post('field');
		$search_value = $this->input->post('value');
		$limit = $this->input->post('limit');

		$selected = $this->input->post('selected');

		$where['id !='] = $this->input->post('id');

		$whereLike[$search_name]   = $search_value;
		$count_all_results         = $this->admindino->countSearch($table,$whereLike,$where);

		# config page
		$config 				   = array();
		$config["base_url"]        = base_url().ADMINBASE."?page=ajax&action=search";
		$config["per_page"]        = 20;
        $config["uri_segment"]     = 5;
		$config["total_rows"]      = $count_all_results;
		$config["typeMain"] 	   = 'admin';
		$config['cur_page'] 	   = getParam($this,'per_page');

		//config for bootstrap pagination class integration
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['first_link']      = false;
        $config['last_link']       = false;
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link']	   = false;
        $config['prev_tag_open']   = '<li class="prev">';
        $config['prev_tag_close']  = '</li>';
        $config['next_link'] 	   = false;
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="active"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';

        $this->pagination->initialize($config);	 
        
        $sortValue       		   = 'DESC';
		$sort 					   = 'id';

		$page  					   = getParam($this,'per_page') ? getParam($this,'per_page') : 0;
		$results                   = $this->admindino->ListItems($table,$config["per_page"], $page ,$whereLike,$where,$sort,$sortValue);//Get result from search
		$links                     = $this->pagination->create_links();

		if($results):
			foreach($results as $row){
				$image = $row->image ? '<img class="img-responsive img-thumbnail" src="'.base_url().'upload/'.$table.'/'.$row->image.'"  />' : '<i class="fa fa-image"></i>' ;
				$title = $data["lang"] == "en" ? $row->title_en : $row->title_vn;
				$checked = in_array($row->id, $selected) ? 'checked="checked"' : '';
				echo '  <tr id="'.$row->id.'">
							<td class="th-inner" data-delete width="10">
								<input  data-check
										type="checkbox"
										class="checkdel"
										'.$checked.'
										value="'.$row->id.'"
										name="check_other[]">
							</td>
							<td data-action class="col-sm-1">'.$row->id.'</td>
							<td data-title class="col3"><span data-image>'.$image.'</span>'.$title.'</td>
						</tr>';
			}
		else:
			echo '<tr id="0>">
						<td class="th-inner" data-delete width="10">
						</td>
						<td data-action class="col-sm-1">
						</td>
						<td data-title class="col3">
						</td>
					</tr>';
		endif;	

		echo '<tr class="page-navigate" data-page-other-navigate><td colspan="3">'.$links.'</td></tr>';

	}
	

	public function articleAction($data){
		$table     = $this->input->post('table');
		$array     = $this->input->post('array');
		$id        = $this->input->post('id');
		$str_array = implode(',',$array);

		$data_update['str'] = $str_array;

		$result = $this->admindino->UpdateTable($table,$data_update,$id);

		if($result == TRUE){
			
			$array = array();
			$where['status']     = 1;
			$where['id !=']      = $id;

			if($data_update['str']!=NULL && count($data_update['str'])):
				$array = explode(',',$data_update['str']);
				$results_chosen = $this->admindino->loadTableWhereIn($table,NULL,$where,$array);
			endif;

			if($results_chosen):
				foreach($results_chosen as $chosen){
					$image = $chosen->image ? '<img class="img-responsive img-thumbnail" src="'.base_url().'upload/'.$table.'/'.$chosen->image.'"  />' : '<i class="fa fa-image"></i>' ;
					$title = $data["lang"] == "en" ? $chosen->title_en : $chosen->title_vn;
					$checked = in_array($chosen->id, $array) ? 'checked="checked"' : '';
					echo '  <tr id="'.$chosen->id.'">
								<td data-action class="col-sm-1">'.$chosen->id.'</td>
								<td data-title class="col3"><span data-image>'.$image.'</span>'.$title.'</td>
							</tr>';
				}
			else:
				echo '<tr id="0>">
							<td data-action class="col-sm-1">
							</td>
							<td data-title class="col3">
							</td>
						</tr>';
			endif;	

			echo '<tr><td colspan="2"><div class="popup-alert updated"><div class="content-alert"> <i class="fa fa-check"></i> Updated!</div></div></td></tr>';
		
		}else{
		
			echo '<tr><td colspan="2"><div class="popup-alert updated"><div class="content-alert"> <i class="fa fa-times"></i> Error!</div></div></td></tr>';
		
		}
			

	}
	
}

?>