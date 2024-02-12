<?php
if (!isset($tab)) {
	$tab = $_POST['tab'];
}
$log = array();
//echo $tab;
//print_r($_POST); exit;
$record_id = '';
$logid = $mysqli->Resquest_Response_log("", strtoupper($tab), '', json_encode($_POST), '');
extract($_POST);
if (!isset($_SESSION)) {
	session_start();
}

$mysqli->autocommit(TRUE);

if ($tab != 'login' && $tab != 'sign_up' &&  $tab != 'forgot_password' &&  $tab != 'verify_payment' &&  $tab != 'verify_email' && $tab != 'view_access_ip' &&  $tab != 'verify_contact') {
	require_once('check_session.php');
}


if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
	echo "<script language='javascript' type='text/javascript'>";
	echo "alert('Request not identified as ajax request');";
	echo "</script>";
	$URL = "index.php";
	echo "<script>location.href='$URL'</script>";
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
	echo "<script language='javascript' type='text/javascript'>";
	echo "alert('Bad Request method');";
	echo "</script>";
	$URL = "index.php";
	echo "<script>location.href='$URL'</script>";
}



$response = array();
if ($tab == 'login') {
	$token_check = $mysqli->generateCSRF('');
	$RecTimeStamp = $mysqli->RecTimeStamp("Y-m-d H:i:s");
	if (!$token_check) {
		$response['msg_code'] = "007";
		$response['msg'] = "Invalid security token.";
	} else {
		$obj_login = new login();
		//if ($mysqli->validate_recaptcha($_POST['g-recaptcha-response'])) {

			$response = $obj_login->userLogin($userName, $password, '');
		
		$record_id = $userName;
	}
}else if ($tab == 'add_educonfig') {


			$login_id = $_SESSION['user_id'];
			$sql = "INSERT INTO " . EDUCONFIG . " SET persue = '" . $mysqli->escape($name) . "'";
			$log['sql'] = $sql;
			$res = $mysqli->executeQry($sql);
			$last_id = $mysqli->insert_id();
			if ($res > 0) {
				$response['msg_code'] = "00";
				$response['msg'] = "config successfully added.";
			
			} else {
				$response['msg'] = "05";
				$response['msg'] = "Unable to add config at this time.";
			}
}else if ($tab == 'add_config') {

		if (isset($edit_id) && $edit_id !='') {
			
			 $sql = "UPDATE " . CONFIG . " SET last_education_percentage = '" . $education_percentage . "',  university_fees = '" . $uni_fees . "', living_expenses = '" . $expense . "' WHERE id = " . $edit_id;
			$res = $mysqli->executeQry($sql);
			if ($res > 0) {
				$response['msg_code'] = "00";
				$response['msg'] = "Successfully updated";                            
			} else {
				$response['msg_code'] = "05";
				$response['msg'] = "unable to update  at this time, contact to webmaster.";
			}
			
		} else {

			$login_id = $_SESSION['user_id'];
			$sql = "INSERT INTO " . CONFIG . " SET last_education_percentage = '" . $education_percentage . "',  university_fees = '" . $uni_fees . "', living_expenses = '" . $expense . "'";
			$log['sql'] = $sql;
			$res = $mysqli->executeQry($sql);
			$last_id = $mysqli->insert_id();
			if ($res > 0) {
				$response['msg_code'] = "00";
				$response['msg'] = "config successfully added.";
			
			} else {
				$response['msg'] = "05";
				$response['msg'] = "Unable to add config at this time.";
			}
		}
} else if ($tab == 'add_uni_data') {
	$login_id = $_SESSION['user_id'];
	
		/* $uploadsDir = "file_upload/logo/";
		$allowedFileType = array('jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG');
		
		if (!empty($_FILES['logo']['name'])) {
			// Get file upload details
			$fileName = $_FILES['logo']['name'];
			$tempLocation = $_FILES['logo']['tmp_name'];
			$file_name = time() . $fileName;
			$fileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

			// Check if file already exists, then unlink it
			 $existingFilePath = $uploadsDir . '/' . $file_name;
				if (file_exists($existingFilePath)) {
				unlink($existingFilePath);
			} 

			if (in_array($fileType, $allowedFileType)) {
				if (move_uploaded_file($tempLocation, $uploadsDir . '/' . $file_name)) {
					$logo = $file_name;
				} else {
					$response['msg_code'] = "033";
					$response['msg'] = "Unable to upload the attachment at this time.";
				}
			} else {
				$response['msg_code'] = "034";
				$response['msg'] = "File format not supported.";
			}
		} else {
			$response['msg_code'] = "035";
			$response['msg'] = "No file selected for upload.";
		}
print_r($logo);exit; */
	
	if (isset($edit_id) && $edit_id !='') {
			
			 $sql = "UPDATE " . DATA . " SET education_type = '".$type."', name = '" . $uni_name . "',  qualification = '" . $qualification . "', gpa = '" . $gpa . "' , cost_of_living = '" . $cost_of_living . "', cost_of_tution= '" . $tution_cost . "', application_fee= '" . $fees . "', pte= '" . $pte . "' , ielts= '" . $ielts . "' , toefl = '" . $toefl . "', duolingo = '" . $duolingo . "', uni_tat = '" . $tat . "', university_rank = '" . $uni_rank . "', acceptance_rate = '" . $acceptance_rate . "', extra_test = '" . $extra_test . "', updated_on = '" . date('Y-m-d H:i:s') . "' WHERE id = " . $edit_id;
			$res = $mysqli->executeQry($sql);
			if ($res > 0) {
				$response['msg_code'] = "00";
				$response['msg'] = "Successfully updated";                            
			} else {
				$response['msg_code'] = "05";
				$response['msg'] = "unable to update  at this time, contact to webmaster.";
			}
		} else {

			$sql = "INSERT INTO " . DATA . " SET education_type = '".$type."', name = '" . $uni_name . "',  qualification = '" . $qualification . "', gpa = '" . $gpa . "' , cost_of_living = '" . $cost_of_living . "', cost_of_tution= '" . $tution_cost . "', application_fee= '" . $fees . "', pte= '" . $pte . "' , ielts= '" . $ielts . "' , toefl = '" . $toefl . "', duolingo = '" . $duolingo . "', uni_tat = '" . $tat . "', university_rank = '" . $uni_rank . "', acceptance_rate = '" . $acceptance_rate . "', extra_test = '" . $extra_test . "', created_by = '" . $login_id . "' ";
			$log['sql'] = $sql;
			$res = $mysqli->executeQry($sql);
			$last_id = $mysqli->insert_id();
			if ($res > 0) {
				$response['msg_code'] = "00";
				$response['msg'] = "Data successfully added.";
			
			} else {
				$response['msg'] = "05";
				$response['msg'] = "Unable to add at this time.";
			}
		}
}else if ($tab == 'upload_logo') {
	$login_id = $_SESSION['user_id'];
	 $base64data = $_POST['image'];
	$uploadsDir = "file_upload/logo/";
	 $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64data));
	 $filename = 'uni_logo_' . $id . '_' . time() . '.png';
		
	if (file_put_contents($uploadsDir . $filename, $imageData)) {
			 $sql = "UPDATE " . DATA . " SET logo = '".$filename."' where id='".$id."'";
			$res = $mysqli->executeQry($sql);
			if ($res > 0) {
				$response['msg_code'] = "00";
				$response['msg'] = "Logo successfully updated";                            
			} else {
				$response['msg_code'] = "05";
				$response['msg'] = "unable to update  at this time, contact to webmaster.";
			}
	}else {
        // There was an error saving the image
       $response['msg_code'] = "05";
		$response['msg'] = "unable to upload logo  at this time, contact to webmaster.";
    }
		 
}else if ($tab == 'upload_banner') {
	$login_id = $_SESSION['user_id'];
	 $base64data = $_POST['image'];
	$uploadsDir = "file_upload/banners/";
	 $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64data));
	 $filename = 'uni_banner_' . $id . '_' . time() . '.png';
		
	if (file_put_contents($uploadsDir . $filename, $imageData)) {
			 $sql = "UPDATE " . DATA . " SET banner = '".$filename."' where id='".$id."'";
			$res = $mysqli->executeQry($sql);
			if ($res > 0) {
				$response['msg_code'] = "00";
				$response['msg'] = "Banner successfully updated";                            
			} else {
				$response['msg_code'] = "05";
				$response['msg'] = "unable to update banner at this time, contact to webmaster.";
			}
	}else {
        // There was an error saving the image
       $response['msg_code'] = "05";
		$response['msg'] = "unable to upload banner  at this time, contact to webmaster.";
    }
		 
}else if($tab == 'bulk_upload'){
		$login_id = $_SESSION['user_id'];
		$upload_dir = "uploads/university_csv/";
		$target_csv_file = $upload_dir . date('ymdhis') . basename($_FILES["details"]["name"]);
		$uploadOk = 1;
		$csvFileType = strtolower(pathinfo($target_csv_file, PATHINFO_EXTENSION));

		if ($csvFileType != 'csv') {
		$response['msg_code'] = "05";
		$response['msg'] = "Sorry, only csv files are allowed.";
		$uploadOk = 0;
		}

		if (file_exists($target_csv_file)) {
		$response['msg_code'] = "05";
		$response['msg'] = "File already exists.";
		$uploadOk = 0;
		}

		if ($uploadOk == 0) {
		$response['msg_code'] = "05";
		$response['msg'] = "Unable to upload CV at this time. Please try again later.";
		} elseif (!move_uploaded_file($_FILES["details"]["tmp_name"], $target_csv_file)) {
		$response['msg_code'] = "05";
		$response['msg'] = "Sorry, there was an error uploading your file.";
		} else {
	 if (($handle = fopen($target_csv_file, "r")) !== FALSE) {
			fgetcsv($handle, 1000, ",");
                // Iterate through each row of the CSV file
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    // Assuming the CSV has three columns: column1, column2, and column3
                    $uni_name = $mysqli->escape($data[0]);
                    $tat = $mysqli->escape($data[1]);
                    $uni_rank = $mysqli->escape($data[2]);
                    $acceptance_rate = $mysqli->escape($data[3]);
                    $qualification = $mysqli->escape($data[4]);
                    $gpa = $mysqli->escape($data[5]);
                    $cost_of_living = $mysqli->escape($data[6]);
                    $tution_cost = $mysqli->escape($data[7]);
                    $fees = $mysqli->escape($data[8]);
                    $pte = $mysqli->escape($data[9]);
                    $ielts = $mysqli->escape($data[10]);
                    $toefl = $mysqli->escape($data[11]);
                    $duolingo = $mysqli->escape($data[12]);
                    $type = $mysqli->escape($data[13]);
					
					 $sql = "INSERT INTO " . DATA . " SET education_type = '".$type."', name = '" . $uni_name . "',  qualification = '" . $qualification . "', gpa = '" . $gpa . "' , cost_of_living = '" . $cost_of_living . "', cost_of_tution= '" . $tution_cost . "', application_fee= '" . $fees . "', pte= '" . $pte . "' , ielts= '" . $ielts . "' , toefl = '" . $toefl . "', duolingo = '" . $duolingo . "', uni_tat = '" . $tat . "', university_rank = '" . $uni_rank . "', acceptance_rate = '" . $acceptance_rate . "', extra_test = 'NO', created_by = '" . $login_id . "' ";
					$log['sql'] = $sql;
					$res = $mysqli->executeQry($sql);
					$last_id = $mysqli->insert_id();
					if ($res > 0) {
						$response['msg_code'] = "00";
						$response['msg'] = "Data successfully added.";
					
					} else {
						$response['msg'] = "05";
						$response['msg'] = "Unable to add at this time.";
					}
                }

                fclose($handle);
            } else {
                $response['msg_code'] = "00";
				$response['msg'] = "unable to open csv file";
            }
		}
} else if ($tab == 'delete_university') {
	$sql = "DELETE FROM " . DATA . " WHERE id = " . $del_record_id . " LIMIT 1";
	$res = $mysqli->executeQry($sql);
	if ($res > 0) {
		$response['msg_code'] = "00";
		$response['msg'] = "Removed successfully.";
	} else {
		$response['msg_code'] = "05";
		$response['msg'] = "unable to remove at this time, contact to webmaster.";
	}

	$record_id = $del_record_id;
} 
 else {
	$response['msg_code'] = "102";
	$response['msg'] = "Option not found";
}
$mysqli->autocommit(true);
$logid = $mysqli->Resquest_Response_log($logid, '', $response, '', $record_id, $log);
echo json_encode($response);
$log = array();
exit;
