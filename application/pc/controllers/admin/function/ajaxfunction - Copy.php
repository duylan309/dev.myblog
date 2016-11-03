<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxfunction extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->database();
		$this->load->helper("url");
		$this->load->library('session');
		$this->load->model('admin/function/functionajax');
		
	}
	
	public function changepublish(){
		$value['id']    = getParam($this,'id');
		$value['data']  = getParam($this,'function');
		
		$valueStatus = $this->functionajax->setpublish($value);
		
		echo '<div class="choosevalue" value="'.$valueStatus.'"><img class="iconPublish" src="'.base_url().'images/icon/publish/'.$valueStatus.'.png" title="'.$valueStatus.'"/> </div>';
		//return;
	}
	
	public function changehome(){
		$value['id']    = getParam($this,'id');
		$value['data']  = getParam($this,'function');
		
		$valueStatus = $this->functionajax->sethome($value);
		
		echo '<div class="choosevalue" value="'.$valueStatus.'"><img class="iconPublish" src="'.base_url().'images/icon/publish/'.$valueStatus.'.png" title="'.$valueStatus.'"/> </div>';
		//return;
	}
	
	public function changetitle(){
		$value['id']    = getParam($this,'id');
		$value['data']  = getParam($this,'function');
		$value['title'] = urldecode ($this->uri->rsegment(7));
		$value['lang']  = $this->uri->rsegment(8);
	
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
		
	public function changesort(){
		$value['id']    = getParam($this,'id');
		$value['data']  = getParam($this,'function');
		$value['sort']   = $this->uri->rsegment(7);
		$valueSort = $this->functionajax->setsort($value);
		
		if($valueSort == true){
		 $link = base_url().'admin/'.$value['data'].'/lists/0/null';
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
	
	public function changeprice(){
		$value['id']    = getParam($this,'id');
		$value['data']  = getParam($this,'function');
		$value['price']   = $this->uri->rsegment(7);
		$valuePrice = $this->functionajax->setprice($value);
		
		if($valuePrice == true){
		 $link = base_url().'admin/'.$value['data'].'/lists/0/null';
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
	
	public function changequantity(){
		$value['id']    = getParam($this,'id');
		$value['data']  = getParam($this,'function');
		$value['quantity']   = $this->uri->rsegment(7);
		$valueQuantity = $this->functionajax->setquantity($value);
		
		if($valueQuantity == true){
		 $link = base_url().'admin/'.$value['data'].'/lists/0/null';
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
	
	public function changeCat(){
		$value['id']    = getParam($this,'id');
		$value['data']  = getParam($this,'function');
		$value['cat']   = $this->uri->rsegment(7);
		
		$valueCat = $this->functionajax->setcat($value);
		
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
		
		$folder  =  getParam($this,'id');
		$array = $this->input->post('array');
		$id = explode("/",$array[0]);
		foreach($array as $name):
			if($name):
				$get_delete = explode("/",$name);
				$store_img = 'upload/storage/'.$folder.'/'.$name;
				$store_img_thumb = 'upload/storage/'.$folder.'/'.$get_delete[0]."/thumbnail/".$get_delete[1];
				unlink($store_img);	
				unlink($store_img_thumb);	
			endif;
		endforeach;
		
		$linkRedirect = base_url().'admin/'.$folder.'/gallery/'.$id[0].'/null'
		?>
        <script type="text/javascript">
			location.href="<?=$linkRedirect?>";
	    </script>
        <?php
	}
	public function delItem($setData){
		//$value['id']    = getParam($this,'id');
		$folder  =  getParam($this,'id'); // news
		$database = 'admin/'.$folder;
		$this->load->model($database);
		$array = $this->input->post('array');	
		
		foreach($array as $name):
			if($name):
				$this->$folder->RemoveItem($name);//delete in database
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
		$linkRedirect = base_url().'admin/'.$folder.'/lists/0/null';
		?>
        <script type="text/javascript">
			location.href="<?=$linkRedirect?>";
	    </script>
        <?php
	}		
	
}

?>