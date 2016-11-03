<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* SET JAVASCRIPT FOLDER */

// DATABASE
// CAR
define('FOLDERCONTROLCAR', 'car');
define('TABLECARID', 35);
define('TABLECAR', 'car');
define('XMLCAR', 'car');
define('IMAGECAR', 'car');

// CARCATEGORY
define('FOLDERCONTROLCARCATEGORY', 'car_class');
define('TABLECARIDCATEGORY', 33);
define('TABLECARCATEGORY', 'car_class');
define('XMLCARCATEGORY', 'car_class');
define('IMAGECARCATEGORY', 'car_class');

//CARSTYLE
define('FOLDERCONTROLCARSTYLE', 'car_style');
define('TABLECARIDSTYLE', 34);
define('XMLCARSTYLE', 'car_style');
define('IMAGECARSTYLE', 'car_style');
define('TABLECARSTYLE', 'car_style');

//CARSTYLE
define('FOLDERCONTROLCARVALUE', 'car_value');
define('TABLECARIDVALUE', 36);
define('XMLCARVALUE', 'car_value');
define('IMAGECARVALUE', 'car_value');
define('TABLECARVALUE', 'car_value');

//CAR COMPARASION
define('FOLDERCONTROLCOMPARISON', 'car_comparison');

//CAR CONSULTANT
define('FOLDERCONTROLCARCONSULTANT', 'car_consultant');

//CAR PRICING
define('FOLDERCONTROLCARPRICING', 'car_pricing');

//CAR PRICING
define('FOLDERCONTROLCONTACT', 'ListContact');
define('TABLECONTACT', 'contact_inbox');
define('TABLECONTACTIDVALUE', 4);

// SETTING
define('TABLEUSER', 'adminuser');
define('TABLEMENU', 'menu');
define('TABLEURL', 'url');
define('TABLEBLOG', 'blog');
define('TABLEBLOGCAT', 'blog_cat');

// DEFINE LINK IMAGE
define('SOURCEFOLDER','http://b.thue.today/upload/');
define('IMAGEBLOG',SOURCEFOLDER.'blog/');

// DEFINE FOLDER XML
define('SOURCEXML','xmldata/');
define('XMLBLOG','/blog/');


define('ADMINBASE', 'admin');
define("STORAGE","storage/");
define("IMAGE","upload/");
define('URLIMAGEUPLOAD', 'uploadphoto');	


define("XML","xmldata/");
define("XML_VN","xmldata/vn/");
define("XML_EN","xmldata/en/");
define("EXTENSION",".html");



/* End of file constants.php */
/* Location: ./application/config/constants.php */