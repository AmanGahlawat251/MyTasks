<?php
if(!isset($_SESSION))
{
  session_start();
}
include_once('includes/autoload.php');
include_once('includes/constant.php');
$mysqli = new MySqliDriver();
$session_id = session_id();
$login_id = $_SESSION['login_id'];

$sql = "SELECT * from tbl_login_history where session_id = '".$session_id."' and login_id = '".$login_id."'";
$result = $mysqli->executeQry($sql);
if($mysqli->num_rows($result) > 0)
{
	if($mysqli->executeQry("UPDATE tbl_login_history SET last_activity = NOW() WHERE session_id = '".$session_id."' and login_id = '".$login_id."'"))
	{
		echo "Updated";
	}		
}
else
{
	$current_datetime =  date('Y-m-d H:i:s');
	$beforeFiveMinutecurrent_datetime = date('Y-m-d H:i:s' ,strtotime('-2 minutes', strtotime($current_datetime)));
	$sql = "SELECT * from tbl_login_history where last_activity < '".$beforeFiveMinutecurrent_datetime."' and ( signout = '0000-00-00 00:00:00' OR signout IS NULL OR signout = '' ) "; 
	$result = $mysqli->executeQry($sql);
	if($mysqli->num_rows($result) > 0)
	{
		while($row = $mysqli->fetch_object($result))
		{
			$mysqli->executeQry("UPDATE tbl_login_history SET signout = '".$current_datetime."' WHERE session_id = '".$row->session_id."' and login_id = '".$row->login_id."'");
			//$mysqli->executeQry("UPDATE tbl_clients SET online = 0 WHERE email = '".$row->login_id."'");
		}
	}
}
?> 