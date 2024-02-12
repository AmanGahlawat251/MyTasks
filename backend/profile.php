<?php
$pagecode = "PO-004";
include 'includes/check_session.php'; 
if(isset($_POST['btnimgupload']))
{
	
	$name = $_POST['name_emp'];
	
	
	$sql = "UPDATE ".PERSON." SET name = '".$name."' ".$profile." WHERE id = ".$_SESSION['user_id']." LIMIT 1"; 
	$res = $mysqli->executeQry($sql);
	if($res)
	{
		$_SESSION['name'] = $name;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo LOGO_ALT; ?> | Profile</title>
  <?php include_once("includes/header.php"); ?>   
  <?php include_once("includes/sidebar.php"); ?>    
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $dashboard; ?>">Home</a></li>
              <li class="breadcrumb-item active">Profile </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	<?php 
		$user_profile = false;
		if(!isset($id))
		{
			$id = $_SESSION['user_id'];
			$user_profile = true;
		}
		if(!isset($sub_type))
		{
			$sub_type = "";
		}
		
		$obj_user = $mysqli->singleRowObject(PERSON," id = ".$id);
	
	?>
	 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div id="payment_card" class="card card-info ">
              <div class="card-header">
                <h3 class="card-title">Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
				<form action="" enctype='multipart/form-data' method="post" >
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div style="overflow-x: hidden !important;" class="table-responsive" >
												<table class="table" >
												
													<tr><th>Name</th><td><center><b>:</b></center></td><td><?php echo ucwords($obj_user->name); ?></td></tr>
													<tr><th>Email</th><td><center><b>:</b></center></td><td><?php echo $obj_user->email ; ?></td></tr>
													<tr><th>Contact</th><td><center><b>:</b></center></td><td><?php echo ucwords($obj_user->mobile) ; ?></td></tr> 
													<tr><th>User Type </th><td><center><b>:</b></center></td><td><?php echo str_replace("_"," ",ucwords($obj_user->type)) ; ?></td></tr> 
													<tr><th>Address </th><td><center><b>:</b></center></td><td><?php echo ucwords($obj_user->address) ; ?></td></tr> 
													<tr><th>City </th><td><center><b>:</b></center></td><td><?php echo ucwords($obj_user->city) ; ?></td></tr> 
													<tr><th>State </th><td><center><b>:</b></center></td><td><?php echo ucwords($obj_user->state) ; ?></td></tr> 
												
												
												</table>
											</div>
										</div>
									</div>
								</div>	 
							<?php if(str_replace("_"," ",ucwords($obj_user->type) != 'CUSTOMER')) { ?>
								<div style="background-color: #fff;" class="card-footer">
									 
									<a style="color:#fff;" href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#modal-change-password">Change Password</a>
									
								</div>
							<?php } ?>
							</form>
				
				
            </div>  
            <!-- /.card -->
			</div>

			<?php if(str_replace("_"," ",ucwords($obj_user->type) == 'CUSTOMER')) { ?>

				 

        
          	<div class="col-md-12">
				<form onsubmit="return false;" id="frm_search" method="post" >
					<input type='hidden' name='tab' value="<?php echo 'view_sales'; ?>" />
					<input type='hidden' name='customer_id' value="<?php echo $obj_user->id ?>" />
					<input type='hidden' name='sub_tab' value="<?php echo $type; ?>" />						
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=table_response"); ?>" required>
					<input type="hidden" name="url" id="notes_url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>				  
					<input type="hidden" name="record_limit" id="record_limit" value="10"> 			
					<input type='hidden' name='download' id='download' value="" />		 
					<input type="hidden" name="page" id="page" value="<?php echo $pageno; ?>">  
				</form>
            </div>
			
			<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info collapsed-card" >
              <div class="card-header">
                
				
				<h3 class="card-title">Sale Details &nbsp; &nbsp;<label id="lbl_total"></label> </h3>
				
				<div class="card-tools">
					Reloading in (Seconds): <span style="color:#fff;font-weight:bold" id='timee'></span> &nbsp;&nbsp;
					<a href="javascript:void(0)">
						<i class="fa fa-pause icon-lg" aria-hidden="true" id="timercontroller" onclick="stoptimer()" title="Pause"></i>
					</a>                  
                  <button style="margin-left:25px;" type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- body start -->
				<div id="dynamic_div" style="display: none;" class="table-responsive card-body">
					 				
					
				</div>	
					
            </div>
            <!-- /.card -->
			</div>
			
			
			<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info collapsed-card">
              <div class="card-header">
                
				
				<h3 class="card-title">Call Details &nbsp; &nbsp;<label id="lbl_total_2"></label> </h3>
				
				<div class="card-tools">
                   
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
				
              </div>
              <!-- /.card-header -->
            
	<!-- Delete Lead modal Start -->
		
		<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-remove-lead">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_remove_lead" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash icon-lg" aria-hidden="true" id="" title="Add new <?php echo substr(ucwords($type), 0, -1); ?>"></i> &nbsp; Delete <?php echo substr(ucwords($type), 0, -1); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            
						 												
							<div class="col-md-12">	
							<input type="hidden" name="del_lead_id" id="del_lead_id" value="" />							
							 <h3>Are you sure, you want to remove this <?php echo substr(ucwords($type), 0, -1); ?>?</h3>
							</div>
					 
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'delete_lead'; ?>" />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>	
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_remove_lead')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash icon-lg" aria-hidden="true" id="delete_lead" title="Delete Lead"></i> &nbsp;Delete <?php echo substr(ucwords($type), 0, -1); ?></button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		</div>
  <!-- Delete Lead modal End -->

  <!-- Assign sale modal Start -->
		
  <div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-assign-sale">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_assign_sale" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-user icon-lg" aria-hidden="true" id="" title="Assign Sale"></i> &nbsp; Assign Sale</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
        <div class="row">
          <!-- left column -->
        
          <div class="col-md-12">
                <div class="form-group">
                <label>Support Person</label>
                <div class="select2-purple">
                <select id="case_assign_to" data-placeholder="Select Support Person" data-dropdown-css-class="select2-purple" name="case_assign_to" class="form-control select2" required>
                <option></option>
                <?php
                $query = "SELECT id,name FROM ".PERSON." WHERE active = 1 and type = 'SUPPORT_EMPLOYEE' and availability = 'Available' ORDER BY name ASC";
                $mysqli->DynamicSelectedDropDown($query, 'id', 'name', '');	?>							  
                </select>
                </div>		
                </div>
                <!-- /.card-body -->
                <input type='hidden' name='tab' value="<?php echo 'assign_sale'; ?>" />			  
                <input type='hidden' name='sale_id' id ="assign_sale_id" value="" />			  
                <input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>	
		    </div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_assign_sale')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info"><i class="fa fa-user icon-lg" aria-hidden="true" id="assign_sale" title="Assign Sale"></i> &nbsp;Assign Sale</button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		</div>
  <!-- Assign sale modal End -->


  <!-- Add Notes modal Start -->
		
  <div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-add-notes">
          <div style="min-width: 60%" class="modal-dialog">			
            <div class="modal-content">
			
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-sticky-note icon-lg" aria-hidden="true" id="" title="Add Notes"></i> &nbsp; Add Notes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form onsubmit="return false;" id="frm_add_notes" method="post" >
                  <div class="modal-body">
                      
                    <div class="row">
                      <!-- left column -->
                    
                      <div id="notes_list" class="col-md-12">
                          <center><img src="img/load.gif" /></center>
                      </div>
                      <div class="col-md-12">
                      <textarea name="note" onkeyup="countTextAreaChar(this, 1000,'charNum_note')" class="form-control" id="note_details" rows="3" required></textarea>
                      <div id="charNum_note">0/1000</div>
                      </div>
                                        
                      <!-- /.card-body -->
                      <input type='hidden' name='tab' value="<?php echo 'add_notes'; ?>" />			  
                      <input type='hidden' name='source' id='source' value="" />			  
                      <input type='hidden' name='note_source_id' id ="note_source_id" value="" />		  	  
                      <input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>	
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" onclick="$('#frm_assign_lead')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-info"><i class="fa fa-sticky-note icon-lg" aria-hidden="true"  title="Add Note"></i> &nbsp;Add Note</button>
                    </div>
                  </div>
                </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		</div>
  <!-- Add Notes modal End -->
	 

			<?php } ?>
			
			<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-change-password">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" onsubmit="return false;" id="frm_change_password" method="post">
            <div class="modal-body">
			<div style="margin-top:20px;" class = "col-md-12" />
				 <div class="control-group">
					<label>Your Current Password <span style="color:red">*</span></label>
					<input type="password"class="form-control" name="current_password" id="current_password"   required>
				</div>
			</div>
			
			<div style="margin-top:20px;" class = "col-md-12" >
				<div class="control-group">
					<label>Enter New Password <span style="color:red">*</span></label>
					<input type="password" class="form-control" minlength = "8" name="password" id="change_password"  required>
				</div>
				<div style="margin-top:10px; margin-left:10px;" class="checkbox">
					<input  onchange = "showpassword();" type="checkbox" value=""> Show Password
				</div>
			</div>
			
			<div style="margin-top:20px;" class = "col-md-12" >
				<div class="control-group">
					<label>Confirm New Password <span style="color:red">*</span></label>
					<input type="password"class="form-control" minlength = "8" name="confirm_password" id="confirm_change_password"   required>
				</div>
			</div>
			
			
			
            </div>
			<input type="hidden"   name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax&tab=change_password"); ?>" required>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Change Password</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->	
					
             
		</div>
	</div>
	</section>
	</div>
	 
	
	
	 
<!-- /.content-wrapper -->
<?php 
include_once("includes/footer.php") ; 
include_once("includes/dynamic_table.php") ; 
?>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

<script>
$(document).ready(function () {
	$("#modal-change-password").on('shown.bs.modal', function(){

        $(this).find('#current_password').focus();

    });
	
	$('.select2').select2();
	$('.select2bs4').select2({
      theme: 'bootstrap4'
    });
	
	$(document).on("click", '[data-toggle="lightbox"]', function(event) {
	  event.preventDefault();
	  $(this).ekkoLightbox();
	});
	
});
</script>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
	  $('#btnimgupload').show();
    }
  };
</script>


</body>
</html>