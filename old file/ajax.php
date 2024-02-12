<?php
ini_set('opcache.enable', 0);
session_start();
require_once('backend/includes/constant.php');
require_once('backend/includes/autoload.php');
extract($_POST);
$mysqli = new MySqliDriver();
$tab  = $_POST['tab'];

$log = array();
$record_id = '';
$logid = $mysqli->Resquest_Response_log("", strtoupper($tab), '', json_encode($_POST), ''); 
function check_user_session()
{
    if($_SESSION['login_id']=='' || empty($_SESSION['login_id']))
    {
        return false;    
    }
    return true;   
}

if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')
{
    echo "<script language='javascript' type='text/javascript'>";
    echo "alert('Request not identified as ajax request');";
    echo "</script>";
    $URL="index.php";
    echo "<script>location.href='$URL'</script>";
}


if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script language='javascript' type='text/javascript'>";
    echo "alert('Bad Request method');";
    echo "</script>";
    $URL="index.php";
    echo "<script>location.href='$URL'</script>";
}
if($tab == 'verify_phone_number')
{

	$exist_check = $mysqli->singleRowAssoc_new('*',USERS, " phone_no = '".$_POST['phone_number']."' and user_type='VISITOR'");
	//print_r($_POST);exit;
	if($exist_check){
		$response['msg_code'] = "00";
		$response['msg'] = "successfull";
		$response['name'] = $exist_check['first_name'].' '.$exist_check['last_name'];
		$response['email'] = $exist_check['email'];
		$response['gender'] = $exist_check['gender'];
		$response['address'] = $exist_check['address'];
		$response['visitor_id'] = $exist_check['id'];
	}
	else
	{
		$response['name'] = '';
		$response['email'] = '';
		$response['gender'] = '';
		$response['address'] = '';
		$response['msg_code'] = "07";
		$response['msg'] = "Email Does Not Exists.";
	}
	echo json_encode($response);
}
 else if($tab == 'verify_visitor_details')
{
	$nameParts = explode(" ", $name);
	$firstName = $nameParts[0];
	$lastName = $nameParts[1];
	$details_check = $mysqli->singleRowAssoc_new('*',USERS, "phone_no = '".$mobile."' AND user_type = 'VISITOR'");
	//print_r($details_check);exit;
	if(!empty($details_check)){
		$sql = "UPDATE ".USERS." SET   email = '".$email."', gender = '".$gender."', address = '".$address."' where phone_no = '".$mobile."' AND user_type = 'VISITOR'";
		$res = $mysqli->executeQry($sql);
		$response['msg_code'] = "00";
		$response['msg'] = "Records Updated.";
	}
	else
	{	
		 $sql = "INSERT INTO ".USERS." SET   email = '".$email."', gender = '".$gender."', first_name = '".$firstName."', last_name = '".$lastName."', phone_no = '".$mobile."', address = '".$address."', is_active = '0', user_type = 'VISITOR', created_on = '".date('Y-m-d')."'";
		$res = $mysqli->executeQry($sql);
		$last_id = $mysqli->insert_id();
		//print_r($last_id);exit;
		$response['msg_code'] = "07";
		$response['msg'] = "Success.";
		$response['visitor_id'] = $last_id;
	}
	//print_r($details_check);exit;
	echo json_encode($response);
} else if($tab == 'meeting_details')
{
	
	 $sql = "INSERT INTO ".VISITORS." SET   visitor_id = '".$visitor_id."', meeting_with = '".$meeting_with."', purpose = '".$purpose."', meeting_date_time = '".date('Y-m-d H:i:s')."'"; 
		$res = $mysqli->executeQry($sql);
		$last_id = $mysqli->insert_id();
	 if($res){
		$response['msg_code'] = "00";
		$response['msg'] = "Success.";
		$response['last_id'] = $last_id;
	}
	else
	{
		$response['msg_code'] = "07";
		$response['msg'] = "Unable to submit details at this time.";
		
	} 
	//print_r($details_check);exit;
	echo json_encode($response);
} else if($tab == 'image_capture')
{
	//print_r($_POST);
	$folderPath = "images/visitors/";
  
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
  //print_r($img);exit;
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
	  $sql = "UPDATE ".VISITORS." SET   image = '".$fileName."' where id = '".$last_id."'";
		$res = $mysqli->executeQry($sql);
	 if($res){
		 $sql_1 = "SELECT t1.first_name,t1.last_name,t2.purpose,t2.visitor_id,t2.meeting_with,t2.image,t2.meeting_date_time,t1.address,t1.phone_no from ".VISITORS." as t2 LEFT JOIN ".USERS." as t1 ON t2.visitor_id = t1.id where t2.id = '".$last_id."' ORDER BY t2.id DESC LIMIT 0,1";
		$res_1 = $mysqli->executeQry($sql_1); 
		 $rows = $mysqli->fetch_assoc($res_1);
		 $meeting_with_user = $mysqli->singleRowAssoc_new('id,first_name,last_name,email',USERS, "id = '".$rows['meeting_with']."'");
		//print_r($rows);exit;

		$href_approve = APP_URL.'backend/index.php?' . $mysqli->encode("stat=approved&tab=approve&visit_id=" . $last_id . "");
		$href_reject = APP_URL.'backend/index.php?' . $mysqli->encode("stat=approved&tab=reject&visit_id=" . $last_id . "");
		$body = '<p>Hello '.ucfirst($meeting_with_user['first_name']).' '.ucfirst($meeting_with_user['last_name']).',</p>';
		$body .= '<p>'.ucfirst($rows['first_name']).' '.ucfirst($rows['last_name']).' is here to see you. Please accept if you wish to meet them now or reject in case you are busy.</p>';
		
		$body .= '<p>Name : '.ucfirst($rows['first_name']).' '.ucfirst($rows['last_name']).' </b></p>';
		
		$body .= '<p>Phone Number: '.$rows['phone_no'].' </b></p>';
		
		$body .= '<p>Purpose Of Visit: '.$rows['purpose'].' </b></p>';

		$body .= '<p>Location: '.$rows['address'].' </b></p>';
		
		$body .= '<p style="300px;"><span style="cursor:pointer; text-decoration: none; background-color: #1F7F4C; border:12px solid #1F7F4C; color: #ffffff;" ><a style="text-decoration: none; color: #ffffff;" href="' . $href_approve . '" target="_blank">Approve &#10003;</a></span>&nbsp &nbsp <span  style="cursor:pointer; text-decoration: none; background-color: #d43f3a; border:12px solid #d43f3a; color: #ffffff;" ><a style="text-decoration: none; color: #ffffff;" href="' . $href_reject . '" target="_blank">Reject &#128473;</a></span></p>
		';    
		
		$body .= '<p>Regards,<br/>Sagacious Visitor Management System</p>';
		$subject='Sagacious VMS';
		$fromEmail = FROM_EMAIL;
		$fromName = "Sagacious Visitor Management System";
		$toEmail = $meeting_with_user['email'];
		$isMail = $mysqli->sendEmailNotifocation($subject, $body, '', $fromEmail, $fromName, $toEmail,  $toName = '', $bcc_manager = '');
		//print_r($isMail);exit;
		if($isMail){
		
				
				if($last_id){
				$record_id = $last_id;
				}
		$response['msg_code'] = "00";
		$response['msg'] = "identity saved";

		$dateTimeString = $rows['meeting_date_time'];
		list($date, $time) = explode(' ', $dateTimeString);
		$response['visitor_name'] = ucfirst($rows['first_name']).' '.ucfirst($rows['last_name']);
		$response['meet_with'] = ucfirst($meeting_with_user['first_name']).' '.ucfirst($meeting_with_user['last_name']);
		$response['purpose'] = $rows['purpose'];
		$response['vistor_image'] =  APP_URL.'images/visitors/'.$rows['image'];
		$response['visitor_location'] = $rows['address'];
		$response['meeting_date'] = $mysqli->formatdate($dateTimeString,'j M,Y h:i A');
		}else{
		$response['msg_code'] = "09";
		$response['msg'] = "email not sent.";
		}
	}
	else
	{
		$response['msg_code'] = "07";
		$response['msg'] = "Unable to save image at this time.";
		
	} 
	//print_r($details_check);exit;
	echo json_encode($response);
} 
 else if($tab == 'identity_capture')
{
	  //print_r($_POST);exit;
	  $body='';
	  $sql = "UPDATE ".VISITORS." SET   government_identity_type = '".$government_identity_type."', government_identity = '".$government_identity."'  where id = '".$last_id."'";
		$res = $mysqli->executeQry($sql);
		$log['query'] = $sql;
	 if($res){
		 $sql_1 = "SELECT t1.first_name,t1.last_name,t2.purpose,t2.visitor_id,t2.meeting_with,t2.image,t2.meeting_date_time,t1.address,t1.phone_no from ".VISITORS." as t2 LEFT JOIN ".USERS." as t1 ON t2.visitor_id = t1.id where t2.id = '".$last_id."' ORDER BY t2.id DESC LIMIT 0,1";
		$res_1 = $mysqli->executeQry($sql_1); 
		 $rows = $mysqli->fetch_assoc($res_1);
		 $meeting_with_user = $mysqli->singleRowAssoc_new('id,first_name,last_name,email',USERS, "id = '".$rows['meeting_with']."'");
		//print_r($rows);exit;

		$href_approve = APP_URL.'backend/index.php?' . $mysqli->encode("stat=approved&tab=approve&visit_id=" . $last_id . "");
		$href_reject = APP_URL.'backend/index.php?' . $mysqli->encode("stat=approved&tab=reject&visit_id=" . $last_id . "");
		$body = '<p>Hello '.ucfirst($meeting_with_user['first_name']).' '.ucfirst($meeting_with_user['last_name']).',</p>';
		$body .= '<p>'.ucfirst($rows['first_name']).' '.ucfirst($rows['last_name']).' is here to see you. Please accept if you wish to meet them now or reject in case you are busy.</p>';
		
		$body .= '<p>Name : '.ucfirst($rows['first_name']).' '.ucfirst($rows['last_name']).' </b></p>';
		
		$body .= '<p>Phone Number: '.$rows['phone_no'].' </b></p>';
		
		$body .= '<p>Purpose Of Visit: '.$rows['purpose'].' </b></p>';

		$body .= '<p>Location: '.$rows['address'].' </b></p>';
		
		$body .= '<p style="300px;"><span style="cursor:pointer; text-decoration: none; background-color: #1F7F4C; border:12px solid #1F7F4C; color: #ffffff;" ><a style="text-decoration: none; color: #ffffff;" href="' . $href_approve . '" target="_blank">Approve &#10003;</a></span>&nbsp &nbsp <span  style="cursor:pointer; text-decoration: none; background-color: #d43f3a; border:12px solid #d43f3a; color: #ffffff;" ><a style="text-decoration: none; color: #ffffff;" href="' . $href_reject . '" target="_blank">Reject &#128473;</a></span></p>
		';    
		
		$body .= '<p>Regards,<br/>Sagacious Visitor Management System</p>';
		$subject='Sagacious VMS';
		$fromEmail = FROM_EMAIL;
		$fromName = "Sagacious Visitor Management System";
		$toEmail = $meeting_with_user['email'];
		$isMail = $mysqli->sendEmailNotifocation($subject, $body, '', $fromEmail, $fromName, $toEmail,  $toName = '', $bcc_manager = '');
		//print_r($isMail);exit;
		if($isMail){
		
				
				if($last_id){
				$record_id = $last_id;
				}
		$response['msg_code'] = "00";
		$response['msg'] = "identity saved";

		$dateTimeString = $rows['meeting_date_time'];
		list($date, $time) = explode(' ', $dateTimeString);
		$response['visitor_name'] = ucfirst($rows['first_name']).' '.ucfirst($rows['last_name']);
		$response['meet_with'] = ucfirst($meeting_with_user['first_name']).' '.ucfirst($meeting_with_user['last_name']);
		$response['purpose'] = $rows['purpose'];
		$response['vistor_image'] =  APP_URL.'images/visitors/'.$rows['image'];
		$response['visitor_location'] = $rows['address'];
		$response['meeting_date'] = $mysqli->formatdate($dateTimeString,'j M,Y h:i A');
		}else{
		$response['msg_code'] = "09";
		$response['msg'] = "email not sent.";
		}
	}
	else
	{
		$response['msg_code'] = "07";
		$response['msg'] = "Unable to save identity at this time.";
		
	} 
	$logid = $mysqli->Resquest_Response_log($logid, '', $response, '', $record_id,$log);
	echo json_encode($response);
	
} 

else
{
	echo "Invalid option";
}
exit;
?>