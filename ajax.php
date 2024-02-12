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
/* function check_user_session()
{
    if($_SESSION['login_id']=='' || empty($_SESSION['login_id']))
    {
        return false;    
    }
    return true;   
}
 */
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
 if($tab == 'submit_user_deatils')
{
	$html='';
	
	  $sql = "INSERT INTO tbl_user_details SET   name = '".$username."', email = '".$email."', phone = '".$phone."', education_type = '".$education_type."', last_qualification = '".$phone."', board = '".$board."', gpa = '".$gpa."', tution_fees_min_value = '".$tution_fees_min_value."', tution_fees_max_value = '".$tution_fees_max_value."', expenses_min_value = '".$expenses_min_value."', expenses_max_value = '".$expenses_max_value."', exam_type = '".$exam_type."', listening_score = '".$listening_score."', reading_score = '".$reading_score."', speaking_sore = '".$speaking_sore."', writing_score = '".$writing_score."', overall_score = '".$overall_score."'"; 
		$res = $mysqli->executeQry($sql);
		$last_id = $mysqli->insert_id();
	 if($res){
		$min_gpa = $gpa - 5;
		$max_gpa = $gpa + 5;
		
		//$con = "education_type ='".$education_type."' AND qualification = '".$last_qualification."' AND ".$exam_type." = '".$overall_score."' AND gpa >= '".$min_gpa."' AND gpa <= '".$max_gpa."' AND cost_of_tution >= ".$tution_fees_min_value." AND cost_of_tution <= ".$tution_fees_max_value." AND cost_of_living >= ".$expenses_min_value." AND cost_of_living <= ".$expenses_max_value."";
		$con = "(education_type = '".$education_type."' ) AND ($exam_type = '".$overall_score."' OR $exam_type = 0 OR $exam_type = '') AND (qualification = '".$last_qualification."' OR qualification = '') AND  (gpa >= '".$min_gpa."' AND gpa <= '".$max_gpa."' OR gpa = 0 OR gpa = '') AND (cost_of_tution >= ".$tution_fees_min_value." AND cost_of_tution <= ".$tution_fees_max_value." OR cost_of_tution = 0 OR cost_of_tution = '') AND (cost_of_living >= ".$expenses_min_value." AND cost_of_living <= ".$expenses_max_value." OR cost_of_living = 0 OR cost_of_living = '')";
		$sql_load = "SELECT * FROM ". DATA . " WHERE ". $con ." ORDER BY university_rank ASC"; 
		$result = $mysqli->executeQry($sql_load);
		
		$sql123 = "select count(id) as count_rows from " . DATA . " where  " . $con;
		$result123 = $mysqli->executeQry($sql123);
		$num_arr = $mysqli->fetch_array($result123);
		$num = $num_arr['count_rows']; 
		if($num > 0){
		$html = '<div class="row">';
		while ($rows = $mysqli->fetch_assoc($result)){
          extract($rows);
		if($uni_tat > 0){
			$tat = $uni_tat;
		}else{
			$tat = 'N/A';
		}
		if($acceptance_rate > 0){
			$rate = $acceptance_rate.'%';
		}else{
			$rate = 'N/A';
		}
		$html .='<div class="col-md-4">
                  <div class="dc-docpostholder">
                    <a href="#">
                      <figure class="dc-docpostimg">
                        <img loading="lazy" width="" height="" class="dc-image-res" src="images/Massachusetts.jpg" alt="Flores Emily">
                      </figure>
                    </a>
                    <div class="dc-docpostcontent">
                      <a class="top_rank_uni_card_uni_logo_wrapper__vruFJ" href="#">
                        <span style="box-sizing:border-box;display:inline-block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:relative;max-width:100%">
                          <span style="box-sizing:border-box;display:block;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;max-width:100%">
                            <img style="display:block;max-width:100%;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0" alt="" aria-hidden="true" src="data:image/svg+xml,%3csvg%20
																														xmlns=%27http://www.w3.org/2000/svg%27%20version=%271.1%27%20width=%2792%27%20height=%2737%27/%3e">
                          </span>
                          <img alt="University Logo" src="images/Harvard-University-Logo-c73cc2ce-21d3-47d5-9871-ab0f257abf96.png" decoding="async" data-nimg="intrinsic" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: medium; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%;" srcset="images/Harvard-University-Logo-c73cc2ce-21d3-47d5-9871-ab0f257abf96.png">
                          <noscript>
                            <img alt="University Logo" srcSet="images/Harvard-University-Logo-c73cc2ce-21d3-47d5-9871-ab0f257abf96.png" decoding="async" data-nimg="intrinsic" style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%" loading="lazy" />
                          </noscript>
                        </span>
                      </a>
                      <div class="top_rank_uni_card_uni_rank__icLc_" style="position: absolute;right: 20px;top: 10px;font-size: 16px;font-weight: 500;color: #219653;">Rank:
                        <!-- -->#
                        <!-- --> '.$university_rank.'
                        <!-- -->
                      </div>
                      <div class="dc-title">
                        <div class="dc-doc-specilities-tag">
                          <a class="top_rank_uni_card_uni_name__yRzcW" href="#"> '.$name.'</a>
                          <ul class="dc-docinfo">
                            <li>
                              <em>
                                <i class="fa fa-hourglass-half" style="color: #f1c40f;"></i> University TAT : '.$tat.' </em>
                            </li>
                          </ul>
                          <ul class="dc-docinfo">
                            <li>
                              <em>
                                <i class="fa fa-check-circle" style="color: #f1c40f;"></i> Acceptance Rate : '.$rate.' </em>
                            </li>
                          </ul>
                          <ul class="dc-docinfo">
                            <li>
                              <em>
                                <i class="fa fa-file-text" style="color: #f1c40f;"></i> Extra Test Required : '. $extra_test.' </em>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>';

		}

		$response['msg_code'] = "00";
		$response['msg'] = "Success.";
		$response['last_id'] = $last_id;
		$response['html'] = $html;
		$_SESSION['show_all']= '1';
		}else{
		$response['msg_code'] = "001";
		$response['msg'] = "Success.";		
		}
	}
	else
	{
		$response['msg_code'] = "07";
		$response['msg'] = "Unable to submit details at this time.";
		
	} 
	//print_r($details_check);exit;
	echo json_encode($response);
}
else
{
	echo "Invalid option";
}
exit;
?>