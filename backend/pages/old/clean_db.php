<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
include 'includes/check_session.php'; 
require_once('includes/autoload.php');
require_once('includes/constant.php');
$mysqli = new MySqliDriver();
#echo $mysqli->encode("stat=logs"); exit;
if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'ADMIN')
{
	$href =  'index.php?'.$mysqli->encode("stat=logout");
	echo "<script>window.location.href='".$href."';</script>";
	exit;
}

$sql_orders_without_items = "DELETE FROM tbl_orders WHERE NOT EXISTS (SELECT order_id FROM tbl_order_items i WHERE tbl_orders.order_id = i.order_id)";
$result = $mysqli->executeQry($sql_orders_without_items);

$sql_orders_items_without_orderID = "DELETE FROM `tbl_order_items` WHERE order_id = 0 and type = 'SALE'";
$res = $mysqli->executeQry($sql_orders_items_without_orderID);
