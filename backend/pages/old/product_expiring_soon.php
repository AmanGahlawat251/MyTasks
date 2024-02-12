<?php
include 'includes/check_session.php';
$pageno = 1; 

/*
echo $month = date('m') + 3;
echo "<br>";
echo $year = date('y'); exit;

//echo $effectiveDate = strtotime("+3 months", strtotime(date("01/m/y"))); 

// 06/72 76185000 
echo date("d/m/y");
echo "<br>";
echo $effectiveDate = strtotime("+3 months", strtotime(date("d/m/y")));
echo "<br>";
echo $effectiveDate11 = strtotime("+0 months", strtotime('01/04/11')); 

if($effectiveDate11 <= $effectiveDate)
{
	echo "Expired";
}

exit;
*/

if(isset($_POST['btn_add_requisition']))
{
	$rand = rand();
	$rectimestamp = date("Y-m-d H:i:s");
	extract($_POST);
	//$ddl_supplier = $_POST['ddl_supplier'];
	$arr_total = array();
	foreach($chk_return as $chk)
	{
		$arr = explode("@@@", $chk);	
		$sql_return_item = "INSERT INTO tbl_purchase_return_item SET purchase_return_id = ".$rand.", purchase_item_id = ".$arr[0].", product_id = ".$arr[1].", qty = '".$arr[2]."', batch_no = '".$arr[4]."', rectimestamp = '".$rectimestamp."', purchase_amount = ".$arr[5];
		$result_return_item = $mysqli->executeQry($sql_return_item);
		
		$sql_order_item_update = "UPDATE tbl_order_items SET active = 0, return_item = 1 WHERE order_item_id = ".$arr[0];
		$result_order_item_update = $mysqli->executeQry($sql_order_item_update);
		
		$sql_inventory = "SELECT mrp,batch_no,product_id FROM tbl_order_items WHERE order_item_id = ".$arr[0];
		$result_sql_inventory = $mysqli->executeQry($sql_inventory);
		if($mysqli->num_rows($result_sql_inventory) > 0)
		{
			$row_inventory = $mysqli->fetch_assoc($result_sql_inventory);
			$sql_inven = "UPDATE tbl_inventory SET quantity = 0 WHERE product_id = ".$row_inventory['product_id']." and mrp = ".$row_inventory['mrp']." and batch_no = '".$row_inventory['batch_no']."'";
			//$result_inven = $mysqli->executeQry($sql_inven);
		}
		
		$total_amount = $arr[5] * $arr[2];
		$arr_total[] = $total_amount;
	}
	$ddl_supplier = $arr[3];
	//$batch_no = $arr[4];
	$sql_Preturn = "INSERT INTO  tbl_purchase_return SET supplier_id = ".$ddl_supplier.", gTotal = ".array_sum($arr_total)." , rectimestamp = '".$rectimestamp."'";
	$result_Preturn = $mysqli->executeQry($sql_Preturn);
	$Preturn_id = $mysqli->insert_id(); 
	
	$sql_update = "UPDATE tbl_purchase_return_item SET purchase_return_id = ".$Preturn_id." WHERE purchase_return_id = ".$rand ;
	$result_update = $mysqli->executeQry($sql_update);
}

$srt = "SELECT exp_date,order_item_id FROM  tbl_order_items WHERE type = 'PURCHASE' and (exp_unix IS NULL OR exp_unix < 0)";
//$srt = "SELECT exp_date,order_item_id FROM  tbl_order_items WHERE type = 'PURCHASE' ";
$result_stoke = $mysqli->executeQry($srt);
while($row = $mysqli->fetch_assoc($result_stoke))
{
	extract($row);
	if(strpos(trim($exp_date),"/"))
	{
		$arr_arr= explode("/",trim($exp_date));
	}
	else
	{
		$arr_arr= explode("-",trim($exp_date));
	}
	if(count($arr_arr) == 2)
	{
		$exp_date = $arr_arr[1]."-".$arr_arr[0]."-01";
	}
	else
	{
		$exp_date = $arr_arr[2]."-".$arr_arr[1]."-".$arr_arr[0];
	}		
	
	$datw = date('y-m-d',strtotime($exp_date)); 
	$srt1 = "UPDATE  tbl_order_items SET exp_unix = ".strtotime($datw)." WHERE order_item_id = ".$order_item_id." LIMIT 1"; 
	$result_stoke1 = $mysqli->executeQry($srt1);

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
            <h1 class="m-0 text-dark">Product Expiring Soon</h1></br>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	 
	 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div  class="col-md-12">
            <!-- general form elements -->
            <div style="display:none1;" class="card card-info">
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
							<label>Product <span class="text-red">*</span>&nbsp;&nbsp;</label>
							<select id="product_id"  name="product_id" class="form-control" >
							<option value="">Select Product</option>
							</select>													 
						  </div>
						</div>
						
						<div class="col-md-4">
						  <div class="form-group">
							<label>Supplier <span class="text-red">*</span>&nbsp;&nbsp;</label>
							<select   name="ddl_supplier" class="form-control"  ><option value = "" >Select One Supplier</option><?php $mysqli->DynamicSelectedDropDown("SELECT id, name FROM ".PERSON." WHERE type = 'SUPPLIER'",'id','name','');?>
							</select> 													 
						  </div>
						</div>
							
					</div>
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'product_expiring_soon'; ?>" />					
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=table_response"); ?>" required>			  
					<input type="hidden" name="ajax_url" id="ajax_url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
					<input type="hidden" name="record_limit" id="record_limit" value="100"> 			
					<input type='hidden' name='download' id='download' value="" />		 
					<input type="hidden" name="page" id="page" value="<?php echo $pageno; ?>">  
				 
				<input type="hidden" name="ddlurl" id="ddlurl" value="<?php echo "index.php?".$mysqli->encode("stat=ajax&tab=ddl_ajax_po"); ?>" required>
					<div style="background-color:#fff;" class="card-footer">
				<button  type="submit" id="search" name="search" class="btn btn-primary">Search</button>
				<button  type="reset" onclick="window.location.reload();" class="btn  btn-primary">Reset</button>
					</div>
				</form>  
            </div>  
            <!-- /.card -->
			</div>
			
			<div class="col-md-12">
            <!-- general form elements -->
			<form action="" id="frm_add_supplier" method="post">
              <div class="card card-info">
              <div class="card-header">
                <?php
				$filename = "ProductExpirySoon.csv";
				$file = "download/".$filename;
				$enc_file = $mysqli->encode($filename);
				?>
				
				<h3 class="card-title">Expiring Product Details &nbsp;&nbsp;<a style="float:right;" href="<?php echo APP_URL ?>download_new.php?filename=<?php echo $enc_file; ?>"><i class="fa fa-download icon-2x"></i></a> </h3>
				
				 
					 <input style="margin-left: 15px;margin-top: -3px;float:left;" type="submit" name = "btn_add_requisition" value = "Purchase Return" class = "btn btn-primary btn-xs" />
				
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
			</form>
            <!-- /.card -->
			</div>
		</div>
	</div>
	</section>
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

<script>

$(document).ready(function () {
	$('.select2').select2();
	$('.select2bs4').select2({
      theme: 'bootstrap4'
    });
	$('[data-toggle="tooltip"]').tooltip({
		container: 'body'
	});  
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
					more: (params.page * 20) < data.count_filtered
				}
			};
		},
	   cache: true
	  }
	});
	
});
</script>
</body>
</html>