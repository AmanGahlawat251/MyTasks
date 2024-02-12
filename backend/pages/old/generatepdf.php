<?php include 'includes/check_session.php';

$file_url = $mysqli->generate_orderPdf($order_id);

if($file_url != "")
{
	echo "<script>window.location.href='".$file_url."';</script>";
}
else
{
	echo "<script>alert('Unable to generate bill at this time.');window.location.href='".$_SERVER['HTTP_REFERER']."';</script>";
}
		  
?>