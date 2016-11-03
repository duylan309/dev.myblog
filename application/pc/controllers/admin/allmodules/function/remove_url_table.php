<?php 
$where_url['url']           = $result->title_url;
$where_url['type']          = $setData['getMenuAdmin']->type;
$where_url['menu_id']       = $setData['getMenuAdmin']->id;
$where_url['table_control'] = $setData['page'];
$where_url['child_id']	    = $result->id;

$return_url = $this->admindino->DeleteTableWhere(TABLEURL,$where_url);