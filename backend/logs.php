<?php 
//https://thepatentsearchfirm.com/SGIP_AI/index.php?7Qf+gGu5jhDJ
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

/* $sql = "SELECT purchase_item_id FROM tbl_order_items WHERE type = 'SALE' and purchase_rate IS NOT NULL";
$result = $mysqli->executeQry($sql);
$rows_count = $mysqli->num_rows($result);	
if($rows_count > 0)
{
	while($rows = $mysqli->fetch_assoc($result))
	{
		extract($rows);
		$qq = "SELECT purchase_rate FROM tbl_order_items WHERE order_item_id = ".$purchase_item_id;
		$res = $mysqli->executeQry($qq);
		$ro =  $mysqli->fetch_assoc($res);
		$purchase_rate = $ro['purchase_rate'];
		$qry11 = "UPDATE tbl_order_items SET purchase_rate = ".$purchase_rate." WHERE purchase_item_id = ".$purchase_item_id;
		$res11 = $mysqli->executeQry($qry11);
		
	}
} */ 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo LOGO_ALT; ?> | Logs</title>
  <?php include_once("includes/header.php"); ?>   
  <?php include_once("includes/sidebar.php"); ?>    
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Logs</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $dashboard; ?>">Home</a></li>
              <li class="breadcrumb-item active">Logs </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Search Log</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
				<form onsubmit="" id="frm_search" method="post" >
					<div class="card-body">
						<div class="row">														
							
							<?php  if($_SESSION['user_type'] != 'CLIENT') { ?>
							<div class="col-md-4">
							  <div class="form-group">
								<label>Log Type</label>
								<select  id="request_type" name="request_type" class="form-control select2bs4" >
								  <option value="">Select One Log Type</option>								  
								  <?php 								  
								  $sql = "SELECT DISTINCT request_type FROM ".REQUEST_RESPONSE." WHERE 1";
								  $mysqli->DynamicSelectedDropDown($sql,'request_type','request_type',$_POST['request_type']); ?>
								</select>
							  </div>
							</div>
							<?php } ?>
							
							<div class="col-md-4">
							  <div class="form-group">
								<label>Select Value</label>
								<input type="text"  class="form-control" name="search_value" placeholder = "Login Email / Order Id" id="search_value" VALUE="<?php if(isset($_POST['search_value']) && $_POST['search_value'] != '' ) echo $_POST['search_value']; ?>" >								
							  </div>
							</div>
							
							<div class="col-md-4">
							  <div class="form-group">
								<label>Limit</label>
								<select name ="limit" class="form-control" />
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5" selected>5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								
								</select>								
							  </div>
							</div>
							 
							 
						</div>
					</div>
					
				
					<div style="background-color:#fff;" class="card-footer">
				<button  type="submit" id="search" name="search" class="btn btn-primary">Search</button>
				<button  type="reset" onclick="loadTableRecords(<?php echo $pageno; ?>);" class="btn  btn-primary">Reset</button>
					</div>
				</form>
            </div>  
            <!-- /.card -->
			</div>
			
			<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
				<h3 class="card-title">Logs </h3>
              </div>
              <!-- /.card-header -->
              <!-- body start -->
				
			<div class="card-body">
				
					<?php 
					$rows_count = 0;
					$limit = '';
					if(isset($_POST['request_type']))
					{
						$con_array = array();
						$con = '';
						if(isset($_POST['request_type']) && $_POST['request_type'] != '' )
						{
							$con_array[] = " request_type = '".trim($_POST['request_type'])."'";
						}
						if(isset($_POST['search_value']) && $_POST['search_value'] != '' )
						{
							$con_array[] = " (record_id = '".trim($_POST['search_value'])."' OR user_name = '".trim($_POST['search_value'])."')";
						}
						if(isset($_POST['limit']) && $_POST['limit'] != '' )
						{
							$limit = " limit ".$_POST['limit'];
						}
						
						if(count($con_array) > 0)
						{
							$con = implode('AND ', $con_array);
						}
						
						$sql = "SELECT * FROM ".REQUEST_RESPONSE." WHERE ".$con." ORDER BY date_time_request DESC ".$limit;	
						$result = $mysqli->executeQry($sql);
						$rows_count = $mysqli->num_rows($result);						
					}
					if($rows_count > 0)
					{
						echo '<div id="accordion">';
						$i = 1;
						while($obj_rows = $mysqli->fetch_object($result))
						{
					?>
					<div class="card card-primary">
						<div class="card-header">
						  <h4 class="card-title">
							<a style="font-size:13px;" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo $i; ?>" class="collapsed" aria-expanded="false">
							<?php echo "<b>".$i.".</b>"; ?>&nbsp;  <b><u>Order/User ID :</u></b> <?php if($obj_rows->record_id != '' ) echo  $obj_rows->record_id; else echo $obj_rows->user_name; ?> || <b><u>Request Type :</u></b> <?php echo $obj_rows->request_type; ?> || <b><u>Request Date :</u></b> <?php echo $mysqli->formatdate($obj_rows->date_time_request, 'j-M-Y h:i:A'); ?> ||  <b><u>Response Date :</u></b> <?php echo $mysqli->formatdate($obj_rows->date_time_response, 'j-M-Y h:i:A'); ?> || <b><u>Duretion :</u></b> <?php echo number_format(($obj_rows->timetaken/1000) , 2)." Seconds"; ?>
							</a>
						  </h4>
						</div>
						<div id="collapseOne<?php echo $i; ?>" class="panel-collapse in collapse" style="">
						  <div  class="card-body">
							<div style="color:#fff;" class="alert alert-info alert-dismissible">
							  <h5><i class="icon fas fa-info"></i> Request</h5>
							  <?php 
								$request_array = json_decode($obj_rows->request,true);
								echo "<pre style='color:#fff;'>";
								print_r($request_array);
								echo "</pre>";
							  ?>
							</div>
							
							<div style="color:#fff;" class="alert alert-success alert-dismissible">
							  <h5><i class="icon fas fa-check"></i> Response</h5>
							  <?php 
								$response_array = json_decode($obj_rows->response,true);
								echo "<pre style='color:#fff;'>";
								print_r($response_array);
								echo "</pre>";
							  ?>
							</div>
							
							<?php if($obj_rows->log != '') { ?>
							
								<div style="color:#fff;" class="alert alert-success alert-dismissible">
								  <h5><i class="fas fa-text-width"></i> Log</h5>
								  <?php 
									$log_array = json_decode($obj_rows->log,true);
									echo "<pre style='color:#fff;'>";
									print_r($log_array);
									echo "</pre>";
								  ?>
								</div>
							<?php } ?>
							
						  </div>
						</div>
					</div>
					<?php $i++; } echo '</div>'; 
					} else { ?>
					
					<div class="alert alert-danger alert-dismissible">No record found</div>				
					<?php } ?>
					
                
				
			</div>					
			
					
            </div>
            <!-- /.card -->
			</div>
		</div>
	</div>
	</section>
    </div>
<?php 
include_once("includes/footer.php") ; 
?>  
 
</body>
</html>                                                        