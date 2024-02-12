<?php
if(!isset($_SESSION))
{
  session_start();
}

if($_SERVER['HTTP_HOST'] == 'demo.metheosys.com' || $_SERVER['HTTP_HOST'] == 'www.demo.metheosys.com')
{
	define('APP_NAME',"Customer Support System");
	define('APP_URL',"http://demo.metheosys.com/");
	define('APP_domain',"demo.metheosys.com");
	define('ENVIRONMENT',"LIVE");
	################## DB ##########################################
	define('HOST', 'localhost');
	define('USER', 'u504935519_metheosys_user');
	define('PASS', '+[j]cnlh4A'); 
	define('DATABASE', 'u504935519_find_uni');
	################## DB ############################################
}
 
else if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'www.localhost')
{
	define('APP_NAME',"Find University");
	define('APP_URL',"http://localhost/find_university/");
	define('APP_domain',"");
	define('ENVIRONMENT',"LOCAL");
	################## DB ##########################################
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASS', ''); 
	define('DATABASE', 'webdesce_find_uni');
	################## DB ############################################
}
else
{
    echo "Invalid configretion"; exit;
}
date_default_timezone_set("Asia/Kolkata");
define('APP_FULL_NAME',"Find University");
define('LOGO_PATH',"img/logo.png");
define('LOGO_ALT',APP_FULL_NAME);
define('SHORT_LOGO',"dist/img/logo.png");
define('MAIL_PASSWORD', '8%cv3Ia8X843'); 
define('USER_EMAIL', 'admin@'.APP_domain);
define('EMAIL_HOST', 'mail.'.APP_domain);
define('ORDER_PREFIX', '#SG'.date('dmy'));
################## DB ##########################################
define('PERSON', 'tbl_person');
define('REQUEST_RESPONSE', 'tbl_request_response_log');
define('LOGIN_HISTORY', 'tbl_login_history');
define('DATA', 'tbl_university_data');
define('CONFIG', 'tbl_config');
define('EDUCONFIG', 'tbl_education_config');
define('LEADS', 'tbl_user_details');
################## DB ##########################################
define('DEVELOPER_EMAIL', 'lavii15march@gmail.com'); 
define('EXCEPTION_EMAIL', 'exception@'.APP_domain);
//echo "Working"; exit;
?>