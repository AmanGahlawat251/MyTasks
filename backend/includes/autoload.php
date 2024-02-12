<?php
if($_SERVER['HTTP_HOST'] == 'crmdiam.com' || $_SERVER['HTTP_HOST'] == 'www.crmdiam.com')
{
    define("ABSOLUTE_ROOT_PATH", $_SERVER['DOCUMENT_ROOT'].'/backend/');
}
else
{
    define("ABSOLUTE_ROOT_PATH", $_SERVER['DOCUMENT_ROOT'].'/find_university/backend/');
}

/*
function __autoload($class_name) {
	$file =  'includes/classes/'.$class_name . '.php';
    //   echo  $file;
   //exit;
    if(file_exists($file))
    require_once($file);
	else
	die('File Not Found');
}
*/
spl_autoload_register(function ($class_name) {
	$file =  ABSOLUTE_ROOT_PATH.'includes/classes/'.$class_name . '.php';
    if(file_exists($file))
    require_once($file);
	//else
	//die($file.' File Not Found');
});

spl_autoload_register(function (){
    $filename = ABSOLUTE_ROOT_PATH.'plugins/dompdf/autoload.inc.php';
        if(!file_exists($filename))
        {
            return "file : $filename is not Exist on the Given Path";
        }
    require_once ABSOLUTE_ROOT_PATH.'plugins/dompdf/autoload.inc.php';
});
?>