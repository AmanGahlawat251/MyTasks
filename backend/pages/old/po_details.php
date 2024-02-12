<?php include 'includes/check_session.php'; ?>    
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Purchase Details | <?php echo LOGO_ALT; ?> </title>
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
            <h1 class="m-0 text-dark">Purchase Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $dashboard; ?>">Home</a></li>
              <li class="breadcrumb-item active">Purchase Details </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
     
	 <section class="content">
      <div class="container-fluid">
        <div class="row">
		<div id = "div_po" class="col-12">
          <!-- left column -->
          <?php 
		  echo $mysqli->view_purchase_details($order_id);
		  ?>
			
		</div>
		</div>
	</div>
	</section>
	 
	<?php if(0) { ?> 
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
                    <small class="float-right">Date: <span id = "spn_date"><?php echo $mysqli->formatdate($obj_order->rectimestamp,"j-M-Y h:i:A"); ?></span></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  To
                  <address>
                    <strong><?php echo APP_FULL_NAME ?></strong><br>
                    <?php echo ADDRESS; ?></br>
                    <?php echo USER_EMAIL; ?>
                  </address>
                </div>
				<div class="col-sm-1 invoice-col"></div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  From
                  <address>
                    <strong><span id = "supplier_name"><?php echo $obj_supplier->name ?></span></strong><br>
                   <span id = "supplier_address"><?php echo $obj_supplier->address.", ".$obj_supplier->city.", ".$obj_supplier->state;?></span></br>
                    <span id = "supplier_email"><?php echo $obj_supplier->email ?></span>
                  </address>
                </div>
				 
                <!-- /.col -->
                <div class="col-sm-2 invoice-col">
                  <b>PO No. : <span id = "po_no"><?php echo $obj_order->invoice_number; ?></span></b><br>
                </div>
				<div class="col-sm-3 invoice-col">
                  <b>Vendor Invoice No. : <span id = "po_no"><?php echo $obj_order->vendor_invoice_no; ?></span></b><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th style="width:10%;">Sn.</th>					  
                      <th style="width:45%;">Product</th>
					  <th style="width:45%;">Quantity</th>
					</tr>
                    </thead>
                    <tbody id="po_row">
						<?php
						$order_items = $mysqli->getResultsArray(ORDER_ITEMS, 'product_id,quantity' ," order_id = ".$order_id);
						$i = 1;
						foreach($order_items as $item)
						{
							echo "<tr><td>".$i."</id><td>".$mysqli->GetNameByID(PRODUCTS, 'product_id', 'product_name', $item['product_id'])."</td><td>".$item['quantity']."</td></tr>";
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
              <div class="row no-print">
                <div class="col-12">
                  <a href="javaScript:void(0);"  onclick="printDiv('div_po');"  class="btn btn-default btn_print_div"><i class="fas fa-print"></i> Print</a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div>
			
		</div>
	</div>
	</section>
	<?php } ?>
	</div>
	 
	
	
	 
<!-- /.content-wrapper -->
<?php 
include_once("includes/footer.php") ; 
?>
<script src="plugins/select2/js/select2.full.min.js"></script>

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