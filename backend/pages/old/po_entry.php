<?php include 'includes/check_session.php'; ?>    
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Purchase Order Entry | <?php echo LOGO_ALT; ?> </title>
  <style>.tooltip-inner {
   width: 350px;
}
.select2-container--default .select2-selection--single 
{
	height:38px !important;
}
</style>
  <?php include_once("includes/header.php"); ?>   
  <?php include_once("includes/sidebar.php"); ?>    
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Purchase Order Entry</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $dashboard; ?>">Home</a></li>
              <li class="breadcrumb-item active">Purchase Order Entry </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
     
	 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <?php 
		  $obj_order = $mysqli->singleRowObject(ORDERS, " order_id = ".$order_id);
		  $obj_supplier = $mysqli->singleRowObject(PERSON, " id = ".$obj_order->supplier_id);
		  ?>
			<div  id = "div_po" class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <img src="<?php echo SHORT_LOGO; ?>" /> <?php echo APP_FULL_NAME ; ?>
                    <small class="float-right">PO No.: <span id = "spn_date"><?php echo $obj_order->invoice_number; ?></span></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              

              <!-- Table row -->
			  <form onsubmit="return false;" id="frm_po_entry" method="post">
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-bordered">
                    <thead>
                    <tr style='text-align:center;'>
                      <th style="width:2%;">Sn.</th>					  
                      <th style="width:15%;">Product</th>
					  <th style="width:6%;">Quantity</th>
					  <th style="width:6%;">CGST(%)</th>
					  <th style="width:6%;">SGST(%)</th>
					  <th style="width:6%;">UTGST(%)</th>
					  <th style="width:6%;">IGST(%)</th>
					  <th style="width:6%;">Sale Amt.</th>
					  <th style="width:6%;">Pur. Amt.</th>
					  <th style="width:6%;">M.R.P.</th>
					  <th style="width:12%;">Batch Number</th>
					  <th style="width:7%;">Exp. Date</th>
					  <th style="width:7%;">Mfg. Date</th>
					  
					</tr>
                    </thead>
                    <tbody id="po_row">
						<?php
						$order_items = $mysqli->getResultsArray(ORDER_ITEMS, 'product_id,quantity,order_item_id' ," order_id = ".$order_id);
						$i = 1;
						foreach($order_items as $item)
						{
							echo "<tr><td>".$i."</id><td>".$mysqli->GetNameByID(PRODUCTS, 'product_id', 'product_name', $item['product_id'])."
							<input type='hidden' name='order_item_id[]' class='form-control allowOnlyNumeric' value='".$item['order_item_id']."' required /><input type='hidden' name='product_id[]' class='form-control allowOnlyNumeric' value='".$item['product_id']."' required /></td>
							<td><input type='text' name='quantity[]' class='form-control allowOnlyNumeric' value='".$item['quantity']."' required /></td>							 
							<td><input type='text' maxlength='5' name='cgst_percent[]' class='form-control allowNumericFloat' value='0' required />
							</td>
							<td><input type='text' maxlength='5' name='sgst_percent[]' class='form-control allowNumericFloat' value='0' required /></td>
							<td><input type='text' maxlength='5' name='utgst_percent[]' class='form-control allowNumericFloat' value='0' required /></td>
							<td><input type='text' maxlength='5' name='igst_percent[]' class='form-control allowNumericFloat' value='0' required /></td>
							<td><input type='text' maxlength='7' name='sale_amount[]' class='form-control allowNumericFloat' value='' required /></td>
							<td><input type='text' maxlength='7' name='purchase_amount[]' class='form-control allowNumericFloat' value='' required /></td>
							<td><input type='text' maxlength='7' name='mrp[]' class='form-control allowNumericFloat' value='' required /></td>
							<td><input type='text' maxlength='15' name='batch_no[]' class='form-control allowAlphaNumeric' value='' required /></td>
							<td><input type='text' maxlength='7' name='exp_date[]' data-inputmask-alias='datetime' data-inputmask-inputformat='mm/yyyy' data-mask='' im-insert='false' class='form-control  datemask' value='' required /></td>
							<td><input type='text' maxlength='7' data-inputmask-alias='datetime' data-inputmask-inputformat='mm/yyyy' data-mask='' im-insert='false' name='manufacture_date[]' class='form-control  datemask' value='' required /></td>
							</tr>";
							$i++;
						}
						?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <!-- this row will not appear when printing -->
               <div class="row">
                <!-- accepted payments column -->
				<input type="hidden" value = "<?php echo $order_id; ?>" name="order_id" id="order_id" required />
				<input type='hidden' name='tab' value="<?php echo 'po_entry'; ?>" />	
				<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>
                <div class="col-2">
					<div class="form-group">
						<label for="vendor_invoice_no">Vendor Invoice Number</label>
						<input type="text" class="form-control allowAlphaNumeric" name="vendor_invoice_no" id="vendor_invoice_no" required />
					</div>
                </div>
				
				<div class="col-2">
					<div class="form-group">
						<label for="total_amount">Invoice Subtotal</label>
						<input type="text" class="form-control allowNumericFloat po_input" id = "total_amount" name="total_amount" value='0' required />
					</div>
                </div>
				
				 <div class="col-2">
					<div class="form-group">
						<label for="cgst_percent">CGST (%)</label>
						<input type='text' maxlength='8' name = 'order_cgst_percent' id = 'cgst_percent' class='form-control allowNumericFloat po_input' value='0' required />
					</div>
                </div>
				
				<div class="col-2">
					<div class="form-group">
						<label for="sgst_percent">SGST (%)</label>
						<input type='text' maxlength='8' name = 'order_sgst_percent' id = 'sgst_percent' class='form-control allowNumericFloat po_input' value='0' required />
					</div>
                </div>
				
				<div class="col-2">
					<div class="form-group">
						<label for="utgst_percent">UTGST (%)</label>
						<input type='text' maxlength='8' name = 'order_utgst_percent' id = 'utgst_percent' class='form-control allowNumericFloat po_input' value='0' required />
					</div>
                </div>
				
				<div class="col-2">
					<div class="form-group">
						<label for="igst_percent">IGST (%)</label>
						<input type='text' maxlength='8' name = 'order_igst_percent' id = 'igst_percent' class='form-control allowNumericFloat po_input' value='0' required />
					</div>
                </div>
				
				<div class="col-2">
					<div class="form-group">
						<label for="tax_amount">Total Tax <span id="spn_total_tax"></span> Amount (+)</label>
						<input type='text' maxlength='8' name = 'tax_amount' id = 'tax_amount' class='form-control allowNumericFloat po_input' value='0' readonly required />
					</div>
                </div>
				
				<div class="col-2">
					<div class="form-group">
						<label for="discount_amount">Discount Amount (-) </label>
						<input type='text' maxlength='8' name = 'discount_amount' id = 'discount_amount' class='form-control allowNumericFloat po_input' value='0' required />
					</div>
                </div>
				
				<div class="col-2">
					<div class="form-group">
						<label for="discount_amount">Delivery Charge (+) </label>
						<input type='text' maxlength='8' name = 'delivery_charge' id = 'delivery_charge' class='form-control allowNumericFloat po_input' value='0' required />
					</div>
                </div>
				
				<div class="col-2">
					<div class="form-group">
						<label for="grand_total">Grand Total</label>
						<input type='text' maxlength='8' name = 'grand_total' id = 'grand_total' class='form-control allowNumericFloat po_input' value='0' readonly required />
					</div>
                </div>
                <!-- /.col -->
                
                <!-- /.col -->
              </div>
			  
			   <div class="row no-print">
                <div class="col-12">
                  <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Send to inventory
                  </button>
                   
                </div>
              </div>
			  </form>
            </div>
            <!-- /.invoice -->
          </div>
			
		</div>
	</div>
	</section>
	</div>
	 
	
	
	 
<!-- /.content-wrapper -->
<?php 
include_once("includes/footer.php") ; 
?>
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<script>

function load_order_items()
{
	
}



$(document).ready(function () {
	$('.select2').select2();
	$('.select2bs4').select2({
      theme: 'bootstrap4'
    });
	$('[data-toggle="tooltip"]').tooltip({
		container: 'body'
	});  
	$('.datemask').inputmask('mm/yyyy', { 'placeholder': 'mm/yyyy' })
});

function user_alert(opt)
{
	if(opt == 1)
	{
		$('#modal-active-client').modal('show');
	}
}
</script>



</body>
</html>