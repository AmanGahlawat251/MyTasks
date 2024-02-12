 <?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	unset($_SESSION['login_id']);
	unset($_SESSION['user_type']);
	unset($_SESSION['dashboard']);
	if(isset($_SESSION['client_id']))
	{
		unset($_SESSION['client_id']);
	}
	if(isset($_SESSION['admin_id']))
	{
		unset($_SESSION['admin_id']);
	}
	$sql_history = "UPDATE tbl_login_history SET signout = NOW() WHERE session_id = '".session_id()."'";
	$res_history = $mysqli->executeQry($sql_history);
	//session_regenerate_id(TRUE);
	session_destroy();	
	//header("location:index.php");	
	echo "<script>window.location.href='index.php';</script>"
?>
