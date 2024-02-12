<?php
include 'includes/check_session.php';
$pageno = 1; 
if(isset($_POST['amount']))
{		 
	$rectimestamp = date('Y-m-d H:i:s');
	extract($_POST);
	$sql = "INSERT INTO tbl_order_without_bill SET  amount = ".$amount.", comment = '".$comment."' , rectimestamp	 =  '".$rectimestamp."'";
	$result = $mysqli->executeQry($sql);  
	if($result)
	{
		$view = 'index.php?'.$mysqli->encode("stat=order_without_bill&type=order");
		echo "<script>alert('Order successfully added.'); window.location.href='".$view."'</script>";
	}
	else
	{
		echo "<script>alert('Unable to add order at this time.');</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title><?php echo LOGO_ALT; ?> | <?php echo ucwords($type); ?></title>
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
	
.select2-container--default .select2-selection--single 
{
	height:38px !important;
}
  </style>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
		  
			<h1 class="m-0 text-dark">Orders Without Bills</h1></br>
		   
          </div><!-- /.col -->
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php //echo ucwords($type); ?> </li>
            </ol>
          </div>--><!-- /.col -->
		 
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
            <div style="" class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Search <?php echo ucwords($type); ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
				<form onsubmit="return false;" id="frm_search" method="post" >
					<div class="card-body">
						<div class="row">
							<div class="col-md-4">
							  <div class="form-group">
								<label>Select Date Range</label>
								<div class="input-group">
									<div class="input-group-prepend">
									  <span class="input-group-text">
										<i class="far fa-calendar-alt"></i>
									  </span>
									</div>
									<input type="text" class="form-control float-right" name = "search_date" id = "search_date">
								  </div>
							  </div>
							</div>
							
							 
							 
						</div>
					</div>
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'order_without_bill'; ?>" />					
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=table_response"); ?>" required>			  
					<input type="hidden" name="record_limit" id="record_limit" value="10"> 			
					<input type='hidden' name='download' id='download' value="" />		 
					<input type="hidden" name="page" id="page" value="<?php echo $pageno; ?>">  
				 
				
					<div style="background-color:#fff;" class="card-footer">
				<button  type="submit" id="search" name="search" class="btn btn-primary">Search</button>
				<button  type="reset" onclick="loadTableRecords(<?php echo $pageno; ?>);" class="btn  btn-primary">Reset</button>
					</div>
				</form>
            </div>  
            <!-- /.card -->
			</div>
			
			
			<div class="col-md-12">
			
			
			<div class="card card-info">
              <div class="card-header">
                
				
				<h3 class="card-title">Orders Details <button data-toggle="modal" style="margin-top: -5px;" type="button" class="btn btn-warning btn-xs"  data-target="#modal-add-payment">
                    Add Order
                  </button> </h3>
				
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
	
	
	<!-- Add Supplier Payment modal Start -->
	<div data-keyboard = "false" data-backdrop = "static" class="modal fade modal_close" id="modal-add-payment">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form method="post" action=""   >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-money icon-lg" aria-hidden="true" id="" title="Add Payment"></i> &nbsp; Add Order</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
             													
				<div class="col-md-12">
				  <div class="form-group">
					<label>Amount<span style="color:red">*</span>  <span style="cursor:help" data-toggle="tooltip" data-placement="top" title="Please enter the amount you paid."><i class="fa fa-question-circle" aria-hidden="true"></i></span></label>
					<input type="text"  class="form-control allowNumericAmount" autofocus maxlength="10" name="amount" id="amount" required>								
				  </div>
				</div>
				
				<!--<div class="col-md-12">
				  <div class="form-group">
					<label>Payment Mode<span style="color:red">*</span>  </label>
					<select name="payment_mode" id="payment_mode" class="form-control" required>
						<option value="">Select</option>
						<option value="Cash">Cash</option>
						<option value="Card">Card</option>
						<option value="Cheque">Cheque</option>
						<option value="Wallet">Wallet</option>		
					</select>
				  </div>
				</div>
				
				<div class="col-md-12">
				  <div class="form-group">
					<label>Payment Date</label>
					<input type="date"  class="form-control"  name="payment_date" id="payment_date">								
				  </div>
				</div>-->
				
				<div class="col-md-12">
				  <div class="form-group">
					<label>Comment </label>
					<textarea type="text" rows="3" cols="6"  class="form-control"  maxlength="500" name="comment" id="comment" ></textarea>								
				  </div>
				</div>
						
			</div>
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="window.location.reload();" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="add_payment" type="submit" class="btn btn-info"><i class="fa fa-money icon-lg" aria-hidden="true"  ></i> &nbsp;Submit  </button>
                 
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	<!-- Add Supplier Payment modal End -->
	
	
	<!-- Delete Person modal Start -->
		
		<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-remove-order">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_remove_order_withoutbill" method="post" >
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
            <!-- general form elements -->
                          
              
				
					 
						 												
							<div class="col-md-12">	
							<input type="hidden" name="del_without_order_id" id="del_without_order_id" value="" />							
							 <h3>Are you sure, you want to remove this <?php echo substr(ucwords($type), 0, -1); ?>?</h3>
							</div>
					 
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'delete_without_bill_order'; ?>" />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>	
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_remove_order')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash icon-lg" aria-hidden="true" id="add_client" title="Delete client"></i> &nbsp;Delete <?php echo substr(ucwords($type), 0, -1); ?></button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		</div>
  <!-- Delete Person modal End -->
	 
<!-- /.content-wrapper -->

<?php 
include_once("includes/footer.php") ; 
include_once("includes/dynamic_table.php") ; 
?>
<script src="plugins/jquery-validation/jquery.validate.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript">
$(function() {

  $('input[name="search_date"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="search_date"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
  });

  $('input[name="search_date"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});
</script>
<script type="text/javascript">
  $(document).ready(function() {    
	 
	$("#modal-add-payment").draggable({
		handle: ".modal-header"
	}); 
	/*
	$( "#search_date" ).daterangepicker({
    format: "yyyy-mm-dd",		
      todayBtn: "linked",
	  autoUpdateInput: false,
      clearBtn: true,
      calendarWeeks: true,
      autoclose: true,
      todayHighlight: true,
	  maxDate: new Date(),
      //datesDisabled: ['04/06/2017', '04/21/2017'],
      toggleActive: true
	});
	*/
	$('.select2').select2();
	$('.select2bs4').select2({
      theme: 'bootstrap4'
    });
	
	$("#modal-add-person").on('shown.bs.modal', function(){

        $(this).find('#name').focus();

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
	
	 
	
  });
  
   

</script>
</body>
</html>