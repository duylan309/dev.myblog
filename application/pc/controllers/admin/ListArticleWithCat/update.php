<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {
	public function __construct()
	{
		parent::__construct();	
		$this->load->model(array('admin/admindino'));
	}

	public function ItemAction($setData){
		// IF UPDATE
		if(isset($setData["id"]) && $setData["id"] != 0){
			$id = $setData['id'];
			$data['result'] = $this->admindino->GetValueFrom($setData['page'],'id',$id,'*');	
			
			//IMAGE
			$image = './upload/'.$setData['page'].'/'.$data['result']->image;
			$data['image_link'] = $image;
			
			$where['status']     = 1;
			$where['id !=']      = $id;
			
			$array = array();

			if($data['result']->str!=NULL):
				$array = explode(',',$data['result']->str);
				$data['results_chosen'] = $this->admindino->loadTableWhereIn($setData['page'],NULL,$where,$array);
			endif;

			$where_all["id !="]     = $setData["id"];
			$where_all["status !="] = 1;
			$get_data = $this->_loadPageResults($setData);

			$data['links'] = $get_data['links'];
			$data['results_all'] = $get_data['results_all'];

			require(FCPATH . APPPATH . 'controllers/admin/allmodules/load_update_content.php');
		}

		// Load user post
		$data['results_admin'] = $this->admindino->loadTable('adminuser');
		$data['results_cat'] = $this->admindino->loadTable($setData['page'].'_cat',NULL,NULL,NULL);	

		require(FCPATH . APPPATH . 'controllers/admin/allmodules/load_general_files.php');
		$data['template'] = "admin/ListArticleWithCat/item_detail.php";		
		$this->load->view('admin/template/adminLayout',$data);
	}
		
	public function saveData($setData){
		$post = $this->input->post();
		// var_dump($post['image_upload']);
		$url  = strtolower(webtitleUrl(webKillVN($post['db-title_url'])));
		$data_url['status'] = 1; // 1 = article; 2 = cat

		$alert = '';
		if($post){

			foreach ($post as $key => $value):
				$getKey = explode("-", $key);
				if($getKey[1] == "title_url"):
					$data[$getKey[0]][$getKey[1]] = strtolower(webtitleUrl(webKillVN($value)));
				else:			
					$data[$getKey[0]][$getKey[1]] = stripslashes($value);
				endif;
			endforeach;	
		
			require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/image_control.php');
			
			if($data["db"]["id"] == NULL){ // INSERT TABLE
				
				$data["db"]["date"] = date('y-m-d');
				$data["db"]['id'] = $this->admindino->AddTable($setData['page'],$data["db"]);

				if($data["db"]['id'] == TRUE){
					require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/add_url_table.php');
					require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/xml_control.php');
					$alert = '&alert=added';
					
				}else{
					die();
				}

				redirect(base_url().ADMINBASE.'?page='.$setData["page"].'&action=lists&id=0&function=null'.$alert);

			}else{ // UPDATE TABLE
				$result = $this->admindino->UpdateTable($setData['page'],$data["db"],$data["db"]["id"]);
				
				if($result == TRUE){

					require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/update_url_table.php');
					require(FCPATH . APPPATH . 'controllers/admin/allmodules/function/xml_control.php');
					$alert = '&alert=updated';
					
				}else{
					die();
				}
				redirect(base_url().ADMINBASE.'?page='.$setData["page"].'&action=lists&id=0&function=null'.$alert);

			}		

		}else{
			die();
		}			
	}	
	
	public function getCat($table){
			$this->load->model('admin/'.$table);
			$article_cat = $this->$table->getTitleId();
			return $article_cat->result();
	}
	
	private function deleteOldImage($database,$id,$path){
		$result = $this->admindino->GetValueFrom($database,'id',$id,'image');
		$fileOldImage = $path.$result->image;
		if(is_file($fileOldImage)){
		
			unlink($fileOldImage);
		
		}

		return TRUE;
	}

	private function _loadPageResults($setData){
		$where['id !='] = $setData['id']; 
		$count_all_results         = $this->admindino->countSearch($setData['page'],NULL,NULL);

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
		$setData['results_all']    = $this->admindino->ListItems($setData["page"],$config["per_page"], $page ,NULL,$where,$sort,$sortValue);//Get result from search
		$setData['links']          = $this->pagination->create_links();
		return $setData;
	}

}

