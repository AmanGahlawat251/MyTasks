<?php 
include 'includes/check_session.php';
$pageno = 1; 
$obj_company = $mysqli->singleRowObject(CLIENTS, ' client_id = '.$company_id);
if(isset($_SESSION['client_type']) && $_SESSION['client_type'] == 'USER_CLIENT')
{
	
	echo "<script>alert('You do not have permission to access this page.');window.location.href='index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Users</title>
  <?php include_once("includes/header.php"); ?>   
  <?php include_once("includes/sidebar.php"); ?>    
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
 
  <style>
  input.error {
    border: 1px dotted #dc3545 !important;
}
select.error {
    border: 1px dotted #dc3545 !important;
}
label.error{
    width: 100%;
    color: #dc3545 !important;
    font-style: italic;
    margin-bottom: 5px;
	font-size: 14px;
	font-family: times;
}

#auth_contact, #auth_email{
    width: 100%;
    color: #dc3545 !important;
    font-style: italic;
    margin-bottom: 5px;
	font-size: 14px;
	font-family: times;
}

.load_txt {    
    background-color: #ffffff;
    background-image: url("img/load.gif");
    background-size: 25px 25px;
    background-position:right center;
    background-repeat: no-repeat;
	}
  </style>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $obj_company->company_name."'s"; ?> Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users </li>
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
          <div style="display:none;" class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Search Clients</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
				<form onsubmit="return false;" id="frm_search" method="post" >
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'view_clients_users'; ?>" />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=table_response"); ?>" required>			  
					<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $mysqli->encode($obj_company->client_id); ?>" required>			  
							  
					<input type="hidden" name="record_limit" id="record_limit" value="10"> 			
					<input type='hidden' name='download' id='download' value="" />		 
					<input type="hidden" name="page" id="page" value="<?php echo $pageno; ?>">  
				 
				
					<div class="card-footer">
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
                
				
				<h3 class="card-title">User List &nbsp; &nbsp;
					<?php
					
					//$client_user_num = $mysqli->fetchRows(CLIENTS, 'client_id', 'parent_id = '.$_SESSION['client_id']);
					$client_user_num = $mysqli->fetchRows(CLIENTS, 'client_id', 'parent_id = '.$company_id);
					
					//$setting_rows = $mysqli->singleRowAssoc_new('payment_type,bulk_order_balance,add_user,add_user_limit,user_order_email_notification', CLIENTS_SETTING, ' client_id = '.$_SESSION['client_id']);
					$setting_rows = $mysqli->singleRowAssoc_new('payment_type,bulk_order_balance,add_user,add_user_limit,user_order_email_notification', CLIENTS_SETTING, ' client_id = '.$company_id);
					
					if((isset($setting_rows['add_user'])) && ($setting_rows['add_user'] == 'Y') && (isset($setting_rows['add_user_limit'])) && ($setting_rows['add_user_limit'] > $client_user_num))
					{ ?>
						<button style="margin-top: -5px;" type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-add-client">
						<i class="fa fa-user-plus icon-lg" aria-hidden="true" id="" title="Add new user"></i>
						</button>
					<?php } ?>
					</h3>
				
				<div class="card-tools">
					Reloading in (Seconds): <span style="color:#fff;font-weight:bold" id='timee'></span> &nbsp;&nbsp;
					<a href="javascript:void(0)">
						<i class="fa fa-pause icon-lg" aria-hidden="true" id="timercontroller" onclick="stoptimer()" title="Pause"></i>
					</a>                  
                  
                </div>
              </div>
              <!-- /.card-header -->
              <!-- body start -->
				<div id="dynamic_div" class="table-responsive">
					<div class="card-body">
						
					</div>					
					
				</div>	
					
            </div>
            <!-- /.card -->
			</div>
		</div>
	</div>
	</section>
	</div>
	<!-- Add Client modal Start -->
	<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-add-client">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_add_client" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-user-plus icon-lg" aria-hidden="true" id="" title="Add new user"></i> &nbsp; Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">              
              <!-- /.card-header -->
              <!-- form start -->
				
					<div class="card-body">
						<div class="row">													
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Name<span style="color:red">*</span> <span style="cursor:help" data-toggle="tooltip" data-placement="top" title="Please enter your name, special characters are not allowed."><i class="fa fa-question-circle" aria-hidden="true"></i></span></label>
								<input type="text"  class="form-control removeChars" maxlength="100" data-regex="[^a-zA-Z0-9-.,_ /]" name="contact_name" id="contact_name" required>							
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Email<span style="color:red">*</span></label>
								<input type="email"  class="form-control validateEmail chk_email_exist removeChars" data-regex="[^a-zA-Z0-9-.,_@ /]"  name="email" maxlength="100" id="email" required>	<label style="margin-top:15px; display:none;" id="auth_email"></label>								
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Country Code<span style="color:red">*</span></label>
								
								 <select id="country_code" style="max-width:120px'"  data-placeholder="Select Option" name="country_code" class="form-control select2bs4" required>
								 <option value="">Country Code</option>
									<?php
									$mysqli->DynamicDropDown('tbl_country_calling_codes', 'country_code', 'country_code', 'country' );	?>							  
									</select>
							  </div>						
							  </div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Contact Number<span style="color:red">*</span></label>
								<input type="text"  class="form-control allowOnlyNumeric chk_contact_exist" maxlength="10" name="contact" id="contact" required><label style="margin-top:15px; display:none;" id="auth_contact"></label>							
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Password <span style="color:red">*</span></label> <button type="button"  onclick="generate();" class="btn btn-link"><span aria-hidden="true">Generate Password</span></button>
								<input type="text" style="background-color:#f2ecec;"   maxlength="25" class="form-control password readonly" name="password" id="password" required>	
								<span style="display:none; color:blue;" id="clipboard">Password copied to clipboard.</span>
							  </div>
							</div>
						
						<!-- /.card-body -->
					<input type="hidden"   name="url_auth" id="email_auth" value="<?php echo "index.php?".$mysqli->encode("stat=ajax&tab=verify_email"); ?>" required>
					<input type="hidden"   name="url_auth" id="contact_auth" value="<?php echo "index.php?".$mysqli->encode("stat=ajax&tab=verify_contact"); ?>" required>
						
						<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $mysqli->encode($obj_company->client_id); ?>" required>	
						<input type="hidden" name="company_name" id="company_name" value="<?php echo $obj_company->company_name; ?>" required>	
							 
						</div>
					</div>
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'add_client_user'; ?>" />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
				
            </div>
            <!-- /.card -->
			</div>
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_add_client')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info"><i class="fa fa-user-plus icon-lg" aria-hidden="true" id="add_client" title="Add new client"></i> &nbsp;Add User</button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	<!-- Add Client modal End -->
	
	<!-- Delete Client modal Start -->
		
		<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-remove-client">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_remove_client" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash icon-lg" aria-hidden="true" id="" title="Add new client"></i> &nbsp; Delete User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">              
              <!-- /.card-header -->
              <!-- form start -->
				
					<div class="card-body">
						<div class="row">													
							<div class="col-md-12">	
							<input type="hidden" name="del_client_id" id="del_client_id" value="" />							
							 <h3>Are you sure, you want to remove this user?</h3>
							</div>
					</div>
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'delete_client'; ?>" />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
				
            </div>
            <!-- /.card -->
			</div>
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_remove_client')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash icon-lg" aria-hidden="true" id="add_client" title="Delete client"></i> &nbsp;Delete User</button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		</div>
  <!-- Delete Client modal End -->
  
  <!-- Active/Inactive Client modal Start -->
		
		<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-active-client">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_active_client" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash icon-lg" aria-hidden="true" id="" title="Add new client"></i> &nbsp; <span class="client_status" ></span> User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">              
              <!-- /.card-header -->
              <!-- form start -->
				
					<div class="card-body">
						<div class="row">													
							<div class="col-md-12">	
							<input type="hidden" name="act_client_id" id="act_client_id" value="" />							
							 <h3>Are you sure, you want to <span class="client_status" ></span> this user?</h3>
							</div>
					</div>
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'change_client_status'; ?>" />			  
					<input type='hidden' name='change_client_status' id='change_client_status' value=""  />	
										
					<input type='hidden' name='client_status_txt' id='client_status_txt' value=""  />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
				
            </div>
            <!-- /.card -->
			</div>
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_remove_client')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info"><i class="fa fa-thumbs-up icon-lg" aria-hidden="true"  title="Change Client Status"></i> &nbsp;<span class= "client_status" ></span> User</button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		</div>
  <!-- Active/Inactive Client modal End -->
<!-- /.content-wrapper -->

<?php 
include_once("includes/footer.php") ; 
include_once("includes/dynamic_table.php") ; 
?>
<script src="plugins/jquery-validation/jquery.validate.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {    
	
	$('.select2bs4').select2({
      theme: 'bootstrap4'
    });
	
	$('[data-toggle="tooltip"]').tooltip({
		container: 'body'
	});
	
	$(".readonly").on('keydown paste', function(e){
        if(e.keyCode != 8)
		{
			e.preventDefault();
		}
		
    });
	
	$('[data-toggle="tooltip"]').tooltip({
		container: 'body'
	});
	
	$("#frm_add_client").validate({
        rules: {			
            contact_name: {
				required: true,
				minlength:2,
				normalizer: function(value) {        
					return $.trim(value);
				}
			},
			company_name: {
				required: true,
				minlength:2,
				normalizer: function(value) {        
					return $.trim(value);
				}
			},
            email: {
                required: true,
                email: true
            },
            country_code: {
                required: true
            },
			contact: {
                required: true,
				minlength: 10,
                number: true
            } ,         
            password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            }
        },
        messages: {
            company_name: { 
				required: "Company name is required.",
				minlength: "Please enter at least 2 characters."
			},
			contact_name: { 
				required: "Your name is required.",
				minlength: "Please enter at least 2 characters."
			},
            email: "Please enter a valid email address.",
            country_code: "Please select a country code.",
            contact: {
                required: "Please enter your phone number.",
				minlength: "Invalid mobile number, mobile number should be 10 digit.",
                number: "Please enter only numeric value."
            },            
            password: {
                required: "Please click on Generate Password above",
                minlength: "Your password must be at least 6 characters long"
            }
        }
    });
  });

</script>
</body>
</html>