<?php 
$data_url['url']            = $url;
$where_url['type']          = $setData['getMenuAdmin']->type;
$where_url['menu_id']       = $setData['getMenuAdmin']->id;
$where_url['table_control'] = $setData['page'];
$where_url['child_id']	    = $data["db"]['id'];

$return_url = $this->admindino->UpdateTableWhere(TABLEURL,$data_url,$where_url);