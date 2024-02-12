<?php
include 'includes/check_session.php';
$pageno = 1; 
if(isset($_POST['amount']))
{
	if($_POST['payment_id'] == 0)
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
		$sql = "INSERT INTO tbl_supplier_payment_details SET supplier_id = ".$supplier_id.", amount = ".$amount.", comment = '".$comment."' , payment_date = '".$paymentDate."', payment_mode = '".$payment_mode."', invoice_no = '".$invoice_no."' ,  rectimestamp	 =  '".$rectimestamp."'";
		
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
	else if($_POST['payment_id'] > 0)
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
		$sql = "UPDATE tbl_supplier_payment_details SET amount = ".$amount.", comment = '".$comment."' , payment_date = '".$paymentDate."', payment_mode = '".$payment_mode."', update_on = '".$rectimestamp."' , invoice_no = '".$invoice_no."' WHERE id = ".$payment_id."   LIMIT 1";
		$result = $mysqli->executeQry($sql);  
		if($result)
		{
			$view = 'index.php?'.$mysqli->encode("stat=supplier_account_details&type=suppliers&supplier_id=".$supplier_id);
			echo "<script>alert('Payment details successfully updated.'); window.location.href='".$view."'</script>";
		}
		else
		{
			echo "<script>alert('Unable to updated payment details at this time.');</script>";
		}
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
		  <?php if(!isset($supplier_id)) { $supplier_id = ""; ?>
			<h1 class="m-0 text-dark">Select Supplier</h1></br>
		  <?php } else { ?>
			<?php $supplier_row = $mysqli->singleRowAssoc_new("*",PERSON," id = ".$supplier_id); ?>
            <h1 class="m-0 text-dark"><?php echo ucwords($supplier_row['name']); ?></h1></br>
			<p style="margin-top:-20px;"><span><?php echo ucwords($supplier_row['address']); ?></span></br>
			<span><?php echo ucwords($supplier_row['city']).",".ucwords($supplier_row['state']); ?></span></br>
			<span><?php echo ucwords($supplier_row['mobile']); ?></span></br>
			<?php if($supplier_row['drug_license'] != "")
			{ ?>
			<span>Drug License: <?php echo ucwords($supplier_row['drug_license']); ?></span></br>
			<?php } ?>
			<?php if($supplier_row['gtin'] != "")
			{ ?>
			<span>Gtin: <?php echo ucwords($supplier_row['gtin']); ?></span></br>
			<?php } ?>
			<?php if($supplier_row['bank_ac_num'] != "")
			{ ?>
			<span>AccountNo: <?php echo ucwords($supplier_row['bank_ac_num']); ?></span></br>
			<?php } ?>
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
				 
				<select onchange="window.location.href = $(this).find(':selected').data('url');" id="supplier_id"  name="supplier_id" class="form-control " required>
				<option value="">Select Supplier</option>
				<?php
				
				$query = "SELECT name,id FROM ".PERSON." WHERE active = 1 and type = 'SUPPLIER'";
				$result = $mysqli->executeQry($query);
				while($row = $mysqli->fetch_array($result))
				{
					$view = 'index.php?'.$mysqli->encode("stat=supplier_account_details&type=suppliers&supplier_id=".$row['id']);
					$a = trim($row['id']);
					echo '<option data-url = "'.$view.'" value="'.trim($row['id']).'"';
					if(is_array($supplier_id))
					{			
						foreach($supplier_id as $row['id'])
						if($a==$id_select)
						{
							echo 'selected';
						}
					}
					else
					{
						
						if($a==$supplier_id)
						{
							echo 'selected';
						}
					}
					echo '>'. trim($row['name']) . '</option>'."\n";
				}    
				
				echo "</select>";
				?>
			</div>	
			<?php 
			if($supplier_id != "") {
			$total_purchase = $mysqli->singleValue_new(ORDERS,"SUM(grand_total) as total_purchase"," supplier_id = ".$supplier_id." and order_type = 'PURCHASE'");
			$total_paid = $mysqli->singleValue_new("tbl_supplier_payment_details","SUM(amount) as total_paid"," supplier_id = ".$supplier_id);
			?> 
				 
			  
			  <p><b>Total Purchase :</b> <span style="text-align:right; float:right;"><?php echo number_format($total_purchase,2); ?></span> </p>
			  <p><b>Total Paid :</b> <span style="text-align:right; float:right;" ><?php echo number_format($total_paid,2); ?></span></p>
			  <p style="border-top:1px solid #000; border-bottom:1px solid #000;"><b>Total Balance :</b> <span style="text-align:right; float:right;" ><?php echo number_format(($total_purchase - $total_paid),2); ?></span></p>
			<?php } ?>
			</div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	<?php if(isset($supplier_id) && $supplier_id != "") { ?>
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
					<input type='hidden' name='tab' value="<?php echo 'supplier_account_details'; ?>" />
					<input type='hidden' name='supplier_id' value="<?php echo $supplier_id; ?>" />						
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
			
			
			
			<div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                
				
				<h3 class="card-title">Purchase Details <a style="margin-left:10px;" target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=add_purchase&type=add_purchase");?>" class="btn btn-warning btn-xs"> Add Purchase</a> </h3>
				
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
			
			<div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header"> 
				<h3 class="card-title">Payment Details &nbsp; &nbsp;<button data-toggle="modal" style="margin-top: -5px;" type="button" class="btn btn-warning btn-xs"  data-target="#modal-add-payment">
                    Add Payment
                  </button> </h3> 
              </div>
              <!-- /.card-header -->
              <!-- body start -->
				<div  class="table-responsive"> 
					<div class="card-body">
						<?php
						$sql = "select * from tbl_supplier_payment_details where 1 and supplier_id = ".$supplier_id." order by id DESC ";
						$result = $mysqli->executeQry($sql); 	
						$table = "";
						if($mysqli->num_rows($result) > 0)
						{
							$table .= '<table  class="table table-bordered table-striped">
							<thead><tr>
							<th><nobr>#</nobr></th>
							<th><nobr>Action</nobr></th>
							<th><nobr>Amount</nobr></th>		
							<th><nobr>Payment Mode</nobr></th>		
							<th><nobr>Comment</nobr></th>
							<th><nobr>Invoice No</nobr></th>
							<th><nobr>Date</nobr></th>
							</tr>
							</thead>	
							<tbody id="tbody">';
							$i  = 1;
							$total_amount = array();
							while($rows = $mysqli->fetch_assoc($result))
							{
								$data = "";
								foreach($rows as $key => $value)
								{
									if($key == "mobile")
									{
										$key = "contact";
									}
									
									if($key == "state")
									{
										$key = "ddl_state";
									}
									
									$data .= "data-".$key."='".$value."' ";											
								}
								
								extract($rows);
								
								$edit = "&nbsp;&nbsp;<span style='cursor:pointer;' class='btn btn-outline-info btn-xs' data-hover='tooltip' ".$data." onclick='supplier_payment_update_popup(this.id);' data-id='".$mysqli->encode($id)."'  data-placement='top' title='Click here edit' id='".$id."' ><i class='fa  fa-edit'></i></span>";
								
								$table .= "<tr>";
								$table .= "<td><nobr>".$i."</nobr></td>";
								$table .= "<td><nobr>".$edit."</nobr></td>";
								$table .= "<td><nobr>".number_format($amount,2)."</nobr></td>";
								$table .= "<td><nobr>".ucwords($payment_mode)."</nobr></td>";
								$table .= "<td><nobr>".$comment."</nobr></td>";
								$table .= "<td><nobr>".$invoice_no."</nobr></td>";
								$table .= "<td><nobr>".$mysqli->formatdate($payment_date,"j-M-Y")."</nobr></td>";
								$i++;
								$total_amount[] = $amount;
							}
							$table .= '</tbody></table>';	
							$table .= "</br><b>Total Payment : ".number_format(round(array_sum($total_amount)),2)."</b>";
							
						}
						else
						{
							$table = '<div class="alert alert-danger"><strong>!!</strong> No record found.</div>';
						}
						
						echo $table;
						 
						?>
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
	
	
	<!-- Add Supplier Payment modal Start -->
	<div data-keyboard = "false" data-backdrop = "static" class="modal fade modal_close" id="modal-add-payment">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form method="post" action=""   >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-money icon-lg" aria-hidden="true" id="" title="Add Payment"></i> &nbsp; Add Payment</h4>
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
				
				<div class="col-md-12">
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
					<label>Invoice No<span style="color:red">*</span>  <span style="cursor:help" data-toggle="tooltip" data-placement="top" title="Please enter invoice no."></label>
					<input type="text"  class="form-control"  maxlength="25" name="invoice_no" id="invoice_no" >								
				  </div>
				</div>
				
				<div class="col-md-12">
				  <div class="form-group">
					<label>Payment Date</label>
					<input type="date"  class="form-control"  name="payment_date" id="payment_date">								
				  </div>
				</div>
				
				<div class="col-md-12">
				  <div class="form-group">
					<label>Comment </label>
					<textarea type="text" rows="3" cols="6"  class="form-control"  maxlength="500" name="comment" id="comment" ></textarea>								
				  </div>
				</div>
							 		  
				<input type='hidden' name='supplier_id' id="supplier_id" value="<?php echo $supplier_id; ?>" />
				<input type='hidden' name='payment_id' id="payment_id" value="0" />
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