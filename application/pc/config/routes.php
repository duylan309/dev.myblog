<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//MAIN 
$route['']							                 = 'main/index/home/';
$route['([a-zA-Z0-9-]+)']					         = 'main/index/$1/';
$route['([a-z-]+)/([a-zA-Z-]+)']  			         = 'main/index/$1/$2';
$route['([a-zA-Z0-9-%&]+)_(:num)']  	             = 'main/index/$1/$2';
$route['([a-z-]+)/([a-zA-Z0-9-%&]+)_(:num)']  	     = 'main/index/$1/$2/$3';
$route['([a-z-]+)/([a-zA-Z0-9-%&]+)_(:num)_(:num)']  = 'main/index/$1/$2/$3/$4';
$route['ajax/(:num)'] 					   			 = 'main/index/ajax/$1';

$route['search']        = $route['tim-kiem']         = 'main/index/search/1/';
$route['changelanguage']     				         = 'main/index/ajax/language/';

//ADMIN
$route['admin']			                    	     = 'admin/index/admin/0/';
$route['admin/adlogin']			          	         = 'admin/index/adlogin/0/';
$route['admin/adlogin/check']	              	     = 'admin/index/adlogin/check/';
$route['admin/adlogin/out']		                     = 'admin/index/adlogin/out/';

$route['admin/(:any)/(:any)/(:any)/(:any)']	         = 'admin/index/$1/$2/$3/$4';

$route['default_controller'] = 'main';
$route['404_override'] = 'main/error_404';
