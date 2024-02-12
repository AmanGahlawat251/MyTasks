<?php include 'includes/check_session.php'; 

?>    
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Sale <?php echo LOGO_ALT; ?></title>
  <style>.tooltip-inner {
   width: 350px;
}
.select2-container--default .select2-selection--single 
{
	height:38px !important;
}

.bootstrap-switch-success, .bootstrap-switch-danger, .bootstrap-switch-null
{
	height: 39px !important;
}
.disabled_row {
    pointer-events: none;
    opacity: 0.4;
}

.disabled_row23 {
    opacity: 0.4;
}
</style>
  <?php include_once("includes/header.php"); ?>   
  <?php include_once("includes/sidebar.php"); $type = "customers"; ?>    
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit  Sale</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $dashboard; ?>">Home</a></li>
              <li class="breadcrumb-item active">Edit  Sale</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
     <form onsubmit="return false;" id="frm_new_sale" method="post" >
	 <section class="content">
      <div class="container-fluid">
        <?php $obj_order = $mysqli->singleRowObject(ORDERS, " order_id = ".$order_id); ?>
		<div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
			
            <div id="payment_card" class="card card-info ">
              <div class="card-header">
                <h3 class="card-title">Edit  Sale</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
				
					<div class="card-body">
						<div class="row">
							
							<div class="col-md-2">
							  <div class="form-group">
							  <label>Mobile Number <span class="text-red">*</span>&nbsp;&nbsp;</label>
								<input type="text" data-source="mobile" onblur="get_sale_customer(this.id)"  class="form-control allowOnlyNumeric mob_cust" maxlength="10" name="mobile" id="mobile" required />							
							  </div>
							</div>
							
							<div class="col-md-2">
							  <div class="form-group">
								<label>Customer <span class="text-red">*</span>&nbsp;&nbsp;</label>
								<div class="select2-purple">
								<select id="customer_id" data-source="customer" data-placeholder="Select Customer" data-dropdown-css-class="select2-purple" onchange="get_sale_customer(this.id)" name="customer_id" class="form-control select2 mob_cust" required>
								<option value="">Select Customer</option>
								<?php
								$query = "SELECT name,id FROM ".PERSON." WHERE active = 1 ";
								$mysqli->DynamicSelectedDropDown($query, 'id', 'name', '');	?>							  
								</select>
								</div>
								 
							  </div>
							</div>
							
							<div class="col-md-1">
							  <div class="form-group">
								<label>&nbsp; </label>
								 <button id="btn_add_person" style="max-width:100px;" type="button" class="btn btn-success btn-xs form-control" data-type="<?php echo $type;?>" data-target="">
									<i class="fa fa-user-plus icon-lg" aria-hidden="true"  title="Add new <?php echo substr(ucwords($type), 0, -1); ?>">&nbsp;</i> Add New
								 </button>						 
							  </div>
							</div><div class="col-md-3">
							  <div class="form-group">
								<label>Address </label>
								 <input type="text" data-regex = "[^a-zA-Z0-9-., /]" maxlength="200"   class="form-control removeChars" name="address" id="address" />							 
							  </div>
							</div>
							
							
							<div class="col-md-2">
							  <div class="form-group">
							  <label>Doctor Name </label>
								<input type="text" data-regex = "[^a-zA-Z0-9-., /]" maxlength="150"  class="form-control removeChars"  name="doctor" id="doctor" required />							
							  </div>
							</div>
							
							<div class="col-md-1">
							  <div class="form-group">
							  <label>Pay. Mode </label>
								<select name="payment_mode" id="payment_mode" class="form-control" required>
									<option value = "" >Select</option>
									<option value="Cash" >Cash</option>
									<option value="Card" >Card</option>
									<option value="Wallet" >Wallet</option>		
								</select>								
							  </div>
							</div>    
							
							<div id="delivery_method"  class="col-md-1">
							  <div class="form-group">
								<label>Delivery <span class="text-red">*</span>&nbsp;&nbsp;</label></br>
								 <input  type="checkbox" class="form-control make-switch" name="home_delivery" id = "home_delivery"  data-bootstrap-switch data-off-color="danger" value="true" data-on-text="Home" data-off-text="Self" data-on-color="success" />							 
							  </div>
							</div>
						</div>
						
							
						<div id="product_row" class="row disabled_row">	
							
							<div class="col-md-12"><hr></div>
							
							<div class="col-md-2">
							  <div class="form-group">
								<label>Product <span class="text-red">*</span>&nbsp;&nbsp;</label>
								
								<select id="product_id"  name="product_id" class="form-control addprod" required>
								<option value="">Select Product</option>
								</select>								
								 </br>
								<b><span style="margin-left: 15px;" id = "spn_unit" ></span></b>
								 </br>
							  </div>
							</div>
							
							<div class="col-md-1">
							  <div class="form-group">
							  <label>Stock </label>
								<input type="text"  class="form-control allowOnlyNumeric addprod" maxlength="4" id="stock" readonly >							
							  </div>
							</div> 
							
							<div class="col-md-1">
							  <div class="form-group">
							  <label>Batch No </label>
								<div class="select2-purple">
									<select id="batch" data-placeholder="Select Batch" data-dropdown-css-class="select2-purple"  class="form-control select2 addprod" required>						  
									</select>
								</div>
							  </div>
							</div>
							
							<div class="col-md-1">
							  <div class="form-group">
							  <label>Exp. Date </label>
								<input type="text"  data-regex = "[^a-zA-Z0-9/]" maxlength="100"  class="form-control removeChars addprod" id="exp" readonly >							
							  </div>
							</div>
							
							<div class="col-md-1">
							  <div class="form-group">
							  <label>M.R.P. </label>
								<input type="text"  class="form-control allowNumericFloat addprod" maxlength="8"  id="mrp" readonly >							 
							  </div>
							</div>
							
							<div class="col-md-1">
							  <div class="form-group">
							  <label>Sale Price </label>
								<input type="text"  class="form-control allowNumericFloat addprod" maxlength="8"  id="sale_price" >							 
							  </div>
							</div>
							
							<div class="col-md-1">
							  <div class="form-group">
							  <label>Pack Size </label>
								<input type="text"  class="form-control allowOnlyNumeric addprod" maxlength="3" name="pack_size"  id="pack_size" readonly >							 
							  </div>
							</div>
							
							<div class="col-md-1">
							  <div class="form-group">
							  <label>Quantity </label>
								<input type="text"  class="form-control allowOnlyNumeric addprod" maxlength="2" value="0" id="sale_quantity"  >							 
							  </div>
							</div>
							
							<div class="col-md-1">
							  <div class="form-group">
							  <label>Loose Qty </label>
								<input type="text"  class="form-control allowOnlyNumeric addprod" maxlength="2" value="0" id="loose_quantity" >							 
							  </div>
							</div>
							
							<div class="col-md-1">
							  <div class="form-group">
							  <label>Discount(%) </label>
								<input type="text"  class="form-control allowOnlyNumeric addprod" maxlength="2" value="0" id="discount" >							 
							  </div>
							</div>
							
							<div class="col-md-1">
							  <div class="form-group">
							  <label>&nbsp; </label>
								<input type="button" onclick = "add_temp_products();" class="btn btn-success btn-xs form-control" value="Add"  />							 
							  </div>
							</div>
							
							
							
						</div>
					
								  
					
								 
				<input type='hidden' name='tab' value="<?php echo 'submit_edit_order'; ?>" />					 
				<input type='hidden' name='temp_order_id' id='temp_order_id' value="" />					 
				<input type='hidden' name='edit_order_id' id='edit_order_id' value="<?php echo $order_id; ?>" />					 
				<input type='hidden' id='edit_customer_id' value="<?php echo $obj_order->customer_id; ?>" />					 
				<input type='hidden' id='edit_paymode' value="<?php echo $obj_order->payment_mode; ?>" />					 
				<input type="hidden" name="url" id="url_submit_order" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
				
				
				 <input type='hidden' class="addprod" id='prod_product_id' value="" />	
				
				  
				</div> 
					<!-- /.card-body -->
				<div style="background-color:#fff; margin-top:-40px;" id="card-footer" class="card-footer disabled_row">	
					<input type="date" placeholder="Date of order" class="" id="rectimestamp" name="rectimestamp" style="border: 1px solid #ccc; min-height: 37px; border-radius: 5px; min-width: 230px !important; color:#000;" />
					
					<select id="deliver_by" name="deliver_by" style="border: 1px solid #ccc; min-height: 37px; height: 37px; border-radius: 5px; min-width: 150px !important; color:#000;" disabled>
							<option value="">Select Delivery Boy</option>
							<?php
							$query = "SELECT name,id FROM ".PERSON." WHERE active = 1 and (type='EMPLOYEE' OR type='ATTENDANCE' OR type='DELIVERY_BOY' )";
							$mysqli->DynamicSelectedDropDown($query, 'id', 'name', '');	?>							  
							</select>
					 
					&nbsp; &nbsp;&nbsp; &nbsp;
					<button type="submit" name="btn_submit" class="btn btn-primary btn_submit_order">Submit Order</button>
					<button type="submit" class="btn btn-danger">Cancel Order</button>
					<button type="button" onclick="window.location.reload();" class="btn btn-danger">Reset</button>
					
					<label style="margin-left:20px; font-size:18px;">Total Margin: <span id="spn_margin">00.00</span></label>
					
					<label id="lbl_return_amt" style="margin-left:20px; display:none; font-size:18px; border-left: 2px solid #ccc; padding-left: 25px;">Amount to be return: <span style="font-size:22px; margin-left:5px; " id="spn_return_amt">00.00</span></label>
					
					<input style="float:right; max-width: 250px;" id="customer_paid_amt" type="text" class="form-control allowNumericAmount" placeholder="Customer Paid Amount" >
				</div>
					 
				
            </div>  
            <!-- /.card -->
			
			<input type="hidden" name="ddlurl" id="ddlurl" value="<?php echo "index.php?".$mysqli->encode("stat=ajax&tab=ddl_ajax_order"); ?>" required>
			
			<input type='hidden' class="addprod" id='order_item_id' value="" />					 
			<input type='hidden' class="" id='txt_margin' value="" />					 
			<input type='hidden' class="addprod" id='prod_product_id' value="" />	
			<input type='hidden' class="" id='txt_customer_email' value="" />	
			<input type='hidden' class="" id='txt_customer_phone' value="" />	
			
			</div>
			
			<div id="div_order_show" style="display:none1;" class="col-12">
				<?php echo $mysqli->view_sale_details($order_id,""); ?>
			</div>
			
		</div>
	</div>
	</section>
	</form>
	</div>
	 
	
	<!-- Add Person modal Start -->
	<div data-keyboard = "false" data-backdrop = "static" class="modal fade modal_close" id="modal-add-person">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_add_person_order" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-user-plus icon-lg" aria-hidden="true" id="" title="Add new <?php echo ucwords($type); ?>"></i> &nbsp; Add <?php echo substr(ucwords($type), 0, -1); ?></h4>
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
								<label><?php echo substr(ucwords($type), 0, -1); ?> Name<span style="color:red">*</span>  <span style="cursor:help" data-toggle="tooltip" data-placement="top" title="Please enter your name, special characters are not allowed."><i class="fa fa-question-circle" aria-hidden="true"></i></span></label>
								<input type="text"  class="form-control removeChars" data-regex="[^a-zA-Z0-9-.,_ /]" autofocus maxlength="150" name="name" id="name" required>								
							  </div>
							</div>
							
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Email<span style="color:red">*</span></label>
								<input type="email"  class="form-control validateEmail chk_email_exist removeChars" data-regex="[^a-zA-Z0-9-.,_@ /]"  name="email" maxlength="100" id="email" >	<label style="margin-top:15px; display:none;" id="auth_email"></label>							
							  </div>
							</div>							
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Contact Number<span style="color:red">*</span></label>
								<input type="text"  class="form-control chk_contact_exist" maxlength="18" name="mobile" id="contact" required><label style="margin-top:15px; display:none;" id="auth_contact"></label>								
							  </div>
							</div>
							
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Address<span style="color:red">*</span></label>
								<input type="text"  class="form-control" class="form-control removeChars" data-regex="[^a-zA-Z0-9-.,_ /]" maxlength="200" name="address" id="cust_address" required><label style="margin-top:15px; display:none;" ></label>								
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Society<span style="color:red">*</span></label>
								<input type="text"  class="form-control" class="form-control removeChars" data-regex="[^a-zA-Z0-9-.,_ /]" maxlength="300" value="River Heights" name="society" id="society" required><label style="margin-top:15px; display:none;" ></label>								
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>State</label>
								<div class="select2-purple">
								<select style="height:38px;" id="ddl_state" name="state" data-placeholder="Select State" data-dropdown-css-class="select2-purple" class="form-control select2" required>
									<option></option>
								  <?php $mysqli->DynamicSelectedDropDown("SELECT state_id,state_name FROM tbl_states WHERE country_id = '101'", 'state_id', 'state_name',''); ?>
								</select>
								</div>
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>City</label>
								<div class="select2-purple">
								<select style="height:38px;" id="city" data-placeholder="Select City" data-dropdown-css-class="select2-purple" name="city" class="form-control select2" required>
								</select>
								</div>
							  </div>
							</div>
							
							<div id="div_gtin" class="col-md-12">
							  <div class="form-group">
								<label>Gtin Number</label>
								<input type="text"  class="form-control removeChars" data-regex="[^a-zA-Z0-9-.,_ /]"  maxlength="30" name="gtin" id="gtin" >								
							  </div>
							</div>
							
							<div id="div_pan" class="col-md-12">
							  <div class="form-group">
								<label>Pan Number</label>
								<input type="text"  class="form-control removeChars" data-regex="[^a-zA-Z0-9-.,_ /]"  maxlength="15" name="pan" id="pan" >								
							  </div>
							</div>
							
							<div id="div_aahar" class="col-md-12">
							  <div class="form-group">
								<label>Aadhar Number</label>
								<input type="text"  class="form-control removeChars" data-regex="[^a-zA-Z0-9-.,_ /]"  maxlength="20" name="aadhar_no" id="aadhar_no" >								
							  </div>
							</div>
							 			 
							
							<div id="div_password" class="col-md-12">
							  <div class="form-group">
								<label>Password <span style="color:red">*</span></label> <button type="button"  onclick="generate();" class="btn btn-link"><span aria-hidden="true">Generate Password</span></button>
								<input type="text" style="background-color:#f2ecec;"   maxlength="25" class="form-control password readonly" name="password" id="password" readonly required>	
								<span style="display:none; color:blue;" id="clipboard">Password copied to clipboard.</span>
							  </div>
							</div> 
							 
					<input type="hidden"   name="contact_auth" id="contact_auth" value="<?php echo "index.php?".$mysqli->encode("stat=ajax&tab=verify_contact"); ?>" required>
					<input type="hidden"   name="email_auth" id="email_auth" value="<?php echo "index.php?".$mysqli->encode("stat=ajax&tab=verify_email"); ?>" required>
					<input type='hidden' id='tab' name='tab' value="<?php echo 'add_person'; ?>" />			  
					<input type='hidden' name='sub_tab' value="<?php echo $type; ?>" />			  
					<!--<input type="hidden" name="url" id="url" value="<?php // echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>	-->		  
					<input type="hidden" name="url_state" id="url_state" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>
					<input type="hidden" name="not_reload" id="not_reload" value="Y" required>
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>					  
				
             
			</div>
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_add_person')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info"><i class="fa fa-user-plus icon-lg" aria-hidden="true" id="add_person" title="Add new <?php echo substr(ucwords($type), 0, -1); ?>"></i> &nbsp;Add <?php echo substr(ucwords($type), 0, -1); ?></button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	<!-- Add Person modal End -->

	<!-- Delete Person modal Start -->
		
		<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-add-orderbook">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_add_orderboook" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus-circle icon-2x" aria-hidden="true" id="" title="Add to Orderbook"></i>&nbsp;Add to Orderbook</h4>
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
							<input type="hidden" name="product_id" id="orderbook_product_id" value="" />							
							<input type="hidden" name="ddl_supplier" id="ddl_supplier" value="0" />							
							 <h4>This product's quantity is very low in your inventroy.Do you want to add this product to orderbook?</h4>
							</div>
					 
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'add_order_book'; ?>" />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
				
             
			 
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_add_orderboook')[0].reset()" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="submit" id="btn_add_to_orderbook" name="btn_add_to_orderbook" class="btn btn-danger"> &nbsp;Yes</button>
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
?>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script>
//$('#product_row :input').attr('disabled', true);
//$('#product_row :select').attr('disabled', true);

$(document).ready(function () {
	$(window).keydown(function(event){
		if(event.keyCode == 13) {
		  event.preventDefault();
		  return false;
		}
  	});
	
	$('.select2').select2();
	$('.select2bs4').select2({
      theme: 'bootstrap4'
    });
	$('[data-toggle="tooltip"]').tooltip({
		container: 'body'
	});

	$("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
	var edit_customer_id = $('#edit_customer_id').val();
	var edit_paymode = $('#edit_paymode').val();
	$('#customer_id').val(edit_customer_id).trigger('change');	
	$('#payment_mode').val(edit_paymode);	
});


$(document).ready(function () {
	var url = $('#ddlurl').val();
	$("#product_id").select2({
	  ajax: { 
	   url: url,
	   type: "post",
	   dataType: 'json',
	   delay: 250,
	   data: function (params) {
		return {
		  searchTerm: params.term ,
		  page: params.page
		};
	   },
		processResults: function (data, params) {
			params.page = params.page || 1;

			return {
				results: data.results,
				pagination: {
					more: (params.page * 5) < data.count_filtered
				}
			};
		},
	   cache: true,
	   
	  }
	});
	
	$('#product_id').on('select2:select', function (e) {
		var data = e.params.data;
		//console.log(data);
		$('#stock').val(data.quantity);
		$('#batch').val(data.batch_no);
		$('#exp').val(data.exp_date);
		$('#mrp').val(data.mrp);
		$('#sale_price').val(data.sale_amount);
		$('#pack_size').val(data.unit_value);
		$('#discount').val(data.default_discount);
		$('#spn_unit').text(data.unit_name);
		$('#order_item_id').val(data.order_item_id);
		$('#prod_product_id').val(data.product_id);
		get_batch_ddl(data.product_id,data.mrp);
		if(data.unit_value > 1 )
		{		
		   $('#loose_quantity').removeAttr('disabled');
		}
		else
		{
		   $('#loose_quantity').attr('disabled', 'disabled');
		}
		if(data.quantity > 0)
		{
			$('#sale_quantity').removeAttr('disabled');
			if(data.quantity == 1)
			{
				add_to_orderbook(data.product_id);
			}
		}
		else
		{
			$('#sale_quantity').attr('disabled', 'disabled');
			add_to_orderbook(data.product_id);
		}	
	});
	
});


function get_batch_ddl(product_id,mrp)
{
	request_url = $( '#url_state' ).val();
	$.ajax
		({
			type: "POST",
			url: request_url,
			data: "tab=get_batch_ddl&prod_id="+product_id+"&mrp="+mrp,
			beforeSend: function () {
				$( "#loading" ).show();
			},
			success: function ( data ) {
				$( "#loading" ).hide();
				var obj = $.parseJSON( data );
				var msg_code = obj.msg_code;
				var res_data = obj.data;
				if ( msg_code == '00' ) {
					$( '#batch' ).empty().append(res_data);
					$('#batch').select2();
				}
			}
		});
	
}


function user_alert(opt)
{
	if(opt == 1)
	{
		$('#modal-active-client').modal('show');
	}
}

$(document).keypress(function(e) {
  if ($("#modal-add-orderbook").hasClass('in') && (e.keycode == 13 || e.which == 13)) {
    alert("Enter is pressed");
  }
});
</script>



 

</body>
</html>