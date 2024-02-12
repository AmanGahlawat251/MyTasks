<?php
if(!isset($_SESSION))
{
  session_start();
}
require_once('includes/autoload.php');
require_once('includes/constant.php');


if(ENVIRONMENT == "LOCAL")
{
      ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
}
else
{
      error_reporting(0);
}
//require_once('includes/classes/class.json.php');
$url = $_SERVER['REQUEST_URI'];
$mysqli = new MySqliDriver();
$Qstring = $mysqli->option($url); 
//print_r($Qstring); exit;


extract($Qstring);
register_shutdown_function(array(&$mysqli, 'ShutDown')); 
if(!isset($stat))
{
  $stat = "";  
}
#echo $mysqli->encode('pass@123');
//echo $mysqli->decode($stat);

$Encript_arr = array();
$Encript_arr[] = $mysqli->encode('login');
$Encript_arr[] = $mysqli->encode('person');
$Encript_arr[] = $mysqli->encode('logs');
$Encript_arr[] = $mysqli->encode('profile');
$Encript_arr[] = $mysqli->encode('table_response');
$Encript_arr[] = $mysqli->encode('ajax');
$Encript_arr[] = $mysqli->encode('logout');
$Encript_arr[] = $mysqli->encode('login_history');	
$Encript_arr[] = $mysqli->encode('admin_dashboard');	
$Encript_arr[] = $mysqli->encode('user_details');	
$Encript_arr[] = $mysqli->encode('configuration');	
$Encript_arr[] = $mysqli->encode('education_configuration');	
$Encript_arr[] = $mysqli->encode('404');
$Encript_arr[] = $mysqli->encode('403');


if (!empty($stat)) { 
    if (in_array($stat, $Encript_arr)) 
    {
		$stat = $mysqli->decode($stat);
	  if(isset($_SESSION['dashboard']))
	  {
		$dashboard = $_SESSION['dashboard'];	   
	  }
    }
	 
    switch ($stat) {
		
        case "login":
            include "login.php";
            break;
			
		case "logs":
            include "logs.php";
            break;
			
			
		case "profile":  
            include "profile.php";
            break;
			
		case "person":  
            include "person.php";
            break;
			
		case "configuration":  
            include "configuration.php";
            break;
		
		case "education_configuration":  
            include "education_configuration.php";
            break;
		
		case "ajax":
            include "includes/ajax.php";
            break;
			
		case "logout":
            include "logout.php";
            break;

        
		case "redirect":
            include "redirect.php";
            break;	
					
		case "login_history":
            include "login_history.php";
            break;
		
		case "admin_dashboard":
            include "admin_dashboard.php";
            break;
			
		case "user_details":
            include "user_details.php";
            break;
		
		
		case "table_response":
            include "includes/table_response.php";
            break;
		
		
			case "403":
            include "403.php";
            break;
		
		default:
            include "404.php";		
	}
	
}
else if(!empty($_SESSION['user_type']))
{
	if($_SESSION['user_type'] == 'ADMIN' || $_SESSION['user_type'] == 'SUPERADMIN')
	{
		include 'admin_dashboard.php';
	}
	
	else
	{
		include "404.php";
	}
}
else
{
	include "login.php";
	exit;
}
?>