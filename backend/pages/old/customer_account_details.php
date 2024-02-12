<?php
include 'includes/check_session.php';
$pageno = 1; 
if(isset($_POST['amount']))
{
	if(isset($_POST['payment_date']) && $_POST['payment_date'] != "")
	{
		$paymentDate = date("Y-m-d", strtotime($_POST['payment_date']));
	}
	else
	{
		$paymentDate =  date("Y-m-d");
	}
	$rectimestamp = date('Y-m-d H:i:s');
	extract($_POST);
	$sql = "INSERT INTO tbl_supplier_payment_details SET supplier_id = ".$supplier_id.", amount = ".$amount.", comment = '".$comment."' , payment_date = '".$paymentDate."', payment_mode = '".$payment_mode."', rectimestamp	 =  '".$rectimestamp."'";
	$result = $mysqli->executeQry($sql);  
	if($result)
	{
		$view = 'index.php?'.$mysqli->encode("stat=supplier_account_details&type=suppliers&supplier_id=".$supplier_id);
		echo "<script>alert('Payment details successfully added.'); window.location.href='".$view."'</script>";
	}
	else
	{
		echo "<script>alert('Unable to add payment details at this time.');</script>";
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
          <div class="col-sm-9">
		  <?php if(!isset($customer_id)) { $customer_id = ""; ?>
			<h1 class="m-0 text-dark">Select Customer</h1></br>
		  <?php } else { ?>
			<?php $customer_row = $mysqli->singleRowAssoc_new("*",PERSON," id = ".$customer_id); ?>
            <h1 class="m-0 text-dark"><?php echo ucwords($customer_row['name'])." (#CF".$customer_id.")"; ?></h1></br>
			<p style="margin-top:-20px;"><span><?php echo ucwords($customer_row['address']); ?></span></br>
			<span><?php echo ucwords($customer_row['city']).",".ucwords($customer_row['state']); ?></span></br>
			<span><?php echo ucwords($customer_row['mobile']); ?></span></br>
			</p>
			
		  <?php } ?>
          </div><!-- /.col -->
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php //echo ucwords($type); ?> </li>
            </ol>
          </div>--><!-- /.col -->
		   <div class="col-md-3">
			  <div class="form-group">
				 
				<select onchange="window.location.href = $(this).find(':selected').data('url');" id="customer_id"  name="customer_id" class="form-control " required>
				<option value="">Select Customer</option>
				<?php
				
				$query = "SELECT name,id FROM ".PERSON." WHERE active = 1 and type = 'CUSTOMER'";
				$result = $mysqli->executeQry($query);
				while($row = $mysqli->fetch_array($result))
				{
					$view = 'index.php?'.$mysqli->encode("stat=customer_account_details&type=customer&customer_id=".$row['id']);
					$a = trim($row['id']);
					echo '<option data-url = "'.$view.'" value="'.trim($row['id']).'"';
					if(is_array($customer_id))
					{			
						foreach($customer_id as $row['id'])
						if($a==$id_select)
						{
							echo 'selected';
						}
					}
					else
					{
						
						if($a==$customer_id)
						{
							echo 'selected';
						}
					}
					echo '>'. trim($row['name']) . '</option>'."\n";
				}    
				
				echo "</select>";
				?>
				
			<?php 
			$total_sale_margin = $mysqli->singleRowAssoc_new("SUM(grand_total) as total_paid,SUM(margin) as total_margin ", ORDERS ," customer_id = ".$customer_id." and order_type = 'SALE'");
			extract($total_sale_margin);
			
			$total_sale_cashback = $mysqli->singleRowAssoc_new("COALESCE(sum(case when type IN ('CASHBACK','SALE_RETURN') then amount else 0 end),0) as total_cashback, COALESCE(sum(case when type='REDEEM' then amount else 0 end),0) as total_redeem ", "tbl_customer_wallet" ," cust_id = ".$customer_id);
			extract($total_sale_cashback);
			?> 
				 
			  </div>
			  <p><b>Total Paid Amount :</b> <span style="text-align:right; float:right;"><?php echo number_format($total_paid,2); ?></span> </p> 
			  <p><b>Total Paid Amount(This Month) :</b> <span style="text-align:right; float:right;"><?php echo number_format($mysqli->calculate_monthly_sale_cust($customer_id),2); ?></span> </p>
			  <p><b>Total Earn Margin :</b> <span style="text-align:right; float:right;" ><?php echo number_format($total_margin,2); ?></span></p>
			  <p  style="cursor:pointer; color:blue;" onclick="customer_wallet_details();" ><b>Total Wallet Balance :</b> <span style="text-align:right; float:right;" ><?php echo number_format(round($total_cashback - $total_redeem),2); ?></span></p>
			  <p><b>Total Redeamed:</b> <span style="text-align:right; float:right;" ><?php echo number_format(round($total_redeem),2); ?></span></p>
			   
			</div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	<?php if(isset($customer_id) && $customer_id != "") { ?>
	 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div style="display:none;" class="card card-info">
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
							
							<div class="col-md-4">
							  <div class="form-group">
								<label>Search By</label>
								<select id="search_by" name="search_by" class="form-control">
								  <option value="">Select One Option</option>
								  <option value="name">Name</option>
								  <option value="mobile">Mobile</option>
								  <option value="email">Email</option>
								  <option value="society">Society</option>
								</select>
							  </div>
							</div>
							
							<div class="col-md-4">
							  <div class="form-group">
								<label>Search Value</label>
								<input type="text"  class="form-control" name="search_value" id="search_value">								
							  </div>
							</div>
							 
						</div>
					</div>
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'customer_account_details'; ?>" />
					<input type='hidden' name='customer_id' value="<?php echo $customer_id; ?>" />						
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
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                
				
				<h3 class="card-title">Customer Details <a style="margin-left:10px;" target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=order&type=order");?>" class="btn btn-warning btn-xs"> Add Sale</a> </h3>
				
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
	<?php } ?>
	</div>
	
	<input type="hidden" name="url" id="url_credit_details" value="<?php echo "index.php?".$mysqli->encode("stat=ajax&wallet_cust_id=".$customer_id); ?>" required>	
	
	<div class="modal" id="modal_total_credit">
  <div style="min-width: 70%;" class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Customer Wallet Transction Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div id = "total_credit_body" class="modal-body">
         
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
	
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