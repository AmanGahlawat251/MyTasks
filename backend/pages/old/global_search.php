<?php
if(!isset($_SESSION))
{
  session_start();
}
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require_once('includes/autoload.php');
require_once('includes/constant.php');
$mysqli = new MySqliDriver();
$search = $_GET['term'];
$query = "SELECT product_name FROM ".PRODUCTS." WHERE active = 1 and  product_name like '%".$search."%'";
$result = $mysqli->executeQry($query);	
$total = $mysqli->num_rows($result);
if($total > 0)
{
	while($row = $mysqli->fetch_object($result))
	{
		$data[] = $row->product_name;
	}
	echo json_encode($data);
}
else
{
	$query = "SELECT DISTINCT batch_no FROM ".ORDER_ITEMS." WHERE   batch_no like '%".$search."%'";
	$result = $mysqli->executeQry($query);	
	$total = $mysqli->num_rows($result);
	if($total > 0)
	{
		while($row = $mysqli->fetch_object($result))
		{
			$data[] = $row->batch_no;
		}
		echo json_encode($data);
	}
}
?>