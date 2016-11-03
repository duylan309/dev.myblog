<?php
$data_url['url']           = webKillVN($url);
$data_url['type']          = $setData['getMenuAdmin']->type;
$data_url['menu_id']       = $setData['getMenuAdmin']->id;
$data_url['table_control'] = $setData['page'];
$data_url['child_id']	   = $data["db"]['id'];
$return_url = $this->admindino->AddTable(TABLEURL,$data_url);
