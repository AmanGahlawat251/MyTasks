<?php
include 'includes/check_session.php';
$pageno = 1; 

if(isset($_POST['btn_add_requisition']))
{	 
	/* echo "<pre>";
	print_r($_POST);
	exit; */
	extract($_POST);
	$i = 0;
	$rand = "TEMP".rand();
	$rectimestamp = date("Y-m-d H:i:s");
	$arr_total = array();
	$arr_total_tax = array();
	
	foreach($chk_medicines as $check)
	{
		$qty = $txt_qty[$i];
		$comment = $txt_comment[$i];
		//$sql = "UPDATE ".ORDER_BOOK." SET supplier_id = ".$ddl_supplier.", quantity = ".$qty." ,  comment = '".$comment."' updateon = '".$rectimestamp."' WHERE id  = ".$check." LIMIT 1";
		$sql = "INSERT INTO ".ORDER_BOOK." SET supplier_id = ".$ddl_supplier.", quantity = ".$qty." ,  comment = '".$comment."' updateon = '".$rectimestamp."', order_item_id  = ".$check.", product_id = ".$txt_product[$i];
		$result = $mysqli->executeQry($sql);
		
		$sqlQry = "SELECT purchase_rate , product_id FROM tbl_order_items WHERE product_id = ".$txt_product[$i]." and type = 'PURCHASE' ORDER BY order_item_id DESC LIMIT 1";
		$res = $mysqli->executeQry($sqlQry);
		$objRes = $mysqli->fetch_object($res);
		$total_amount = $objRes->purchase_rate * $txt_qty[$i];
		$tax = ($total_amount * 12)/100;
		$arr_total[] = $total_amount;
		$arr_total_tax[] = $tax;
		$cc = "INSERT INTO tbl_po_entry SET product_id = ".$objRes->product_id." ,  po_id = '".$rand."' , rate = ".$objRes->purchase_rate.", quantity = ".$txt_qty[$i].", tax = ".$tax." , total_amount = ".$total_amount.", rectimestamp = '".$rectimestamp."'" ;
		$res_cc = $mysqli->executeQry($cc);
		$i++;
	} 
	$gtotal = array_sum($arr_total) + array_sum($arr_total_tax);
	$po_sql = "INSERT INTO tbl_po SET supplier_id = ".$ddl_supplier.", gtotal = ".$gtotal.", rectimestamp = '".$rectimestamp."'";
	$res_po = $mysqli->executeQry($po_sql);
	$po = $mysqli->insert_id(); 
	$update_po_item = "UPDATE tbl_po_entry SET po_id = ".$po." WHERE po_id = '".$rand."'";
	$res_update_po_item = $mysqli->executeQry($update_po_item);
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
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo ucwords($type); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Order Book </li>
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
          <div style="display:none1;" class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Search </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
				<form onsubmit="return false;" id="frm_search" method="post" >
					<div class="card-body">
						<div class="row">
							<div style="display:none;" class="col-md-4">
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
							<label>Product <span class="text-red">*</span>&nbsp;&nbsp;</label>
							<select id="product_id11"  name="product_id" class="form-control" required>
							<option value="">Select Product</option>
							</select>													 
						  </div>
						</div>
							
							<div style="display:none;" class="col-md-4">
							  <div class="form-group">
								<label>Product Category</label>
								<div class="select2-purple">
								<select style="height:38px;" id="category" name="category" data-placeholder="Select Category" data-dropdown-css-class="select2-purple" class="form-control select2" >
									<option value="">Select Category</option>
								  <?php $mysqli->DynamicSelectedDropDown("SELECT category_id,category_name FROM ".CATEGORY." WHERE active = 1", 'category_id', 'category_name',''); ?>
								</select>
								</div>
							  </div>
							</div>
							 
						</div>
					</div>
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'view_order_book_new'; ?>" />
					<input type='hidden' name='sub_tab' value="<?php echo $type; ?>" />						
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=table_response"); ?>" required>			  
					<input type="hidden" name="record_limit" id="record_limit" value="50"> 			
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
			<form action="" id="frm_add_supplier" method="post">
            <div class="card card-info">
              <div class="card-header">
                
				
				<h3 class="card-title">
				
				<select style="width:300px; float:left;" name="ddl_supplier" class="form-control" required ><option value = "" >Select One Supplier</option><?php $mysqli->DynamicSelectedDropDown("SELECT id, name FROM ".PERSON." WHERE type = 'SUPPLIER'",'id','name','');?></select> &nbsp;&nbsp;
					 <input style="margin-left:30px; float:left;" type="submit" name = "btn_add_requisition" value = "Submit" class = "btn btn-success" />
				
				<button style="margin-top:5px;" data-toggle="modal" data-target = "#modal-add-order-book" id="btn_add_person" style="margin-top: -5px;" type="button" class="btn btn-warning btn-xs" data-type="<?php echo $type;?>" data-target="">
                    Add Product
                  </button>
					 
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
			</form>
            <!-- /.card -->
			</div>
		</div>
	</div>
	</section>
	</div>
	
	<!-- Add to orderbook modal Start -->
	<div data-keyboard = "false" data-backdrop = "static" class="modal fade modal_close" id="modal-add-order-book">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_add_to_order_book" method="post" >
              <div class="modal-header">
                <h4 class="modal-title">&nbsp; Add Products to Order Book</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
        <div class="row">
          <!-- left column -->
          
             
               
						 													
							<div class="col-md-12">
							  <div class="form-group">
								<label>Select Product<span style="color:red">*</span> </label>
								<select id='product_id'   name='product_id' class='form-control product_id' required><option value=''>Select Product</option></select>						
							  </div>
							</div>
							
							<!--<div class="col-md-12">
							  <div class="form-group">
								<label>Supplier<span style="color:red">*</span> </label>
								<select style="" name="ddl_supplier" class="form-control" ><option value = "" >Select One Supplier</option><?php // $mysqli->DynamicSelectedDropDown("SELECT id, name FROM ".PERSON." WHERE type = 'SUPPLIER'",'id','name','');?></select> 						
							  </div>
							</div>-->
							
							 <div class="col-md-12">
							  <div class="form-group">
								<label>Quantity</label>
								<input type="number" class="form-control" name= "quantity" value="" />						
							  </div>
							</div>				
							 
							
							 
							 					 
					<input type='hidden' name='tab' value="<?php echo 'add_order_book'; ?>" />			  
					<input type='hidden' name='sub_tab' value="<?php echo $type; ?>" />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
					<input type="hidden" name="ddlurl" id="ddlurl" value="<?php echo "index.php?".$mysqli->encode("stat=ajax&tab=ddl_ajax_po"); ?>" required>
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_add_product')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info"><i class="fa fa-user-plus icon-lg" aria-hidden="true" id="add_product" title="Add new <?php echo substr(ucwords($type), 0, -1); ?>"></i> &nbsp;Add to Order Book</button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	<!-- Add to orderbook modal End -->
	
	
	<div data-keyboard = "false" data-backdrop = "static" class="modal fade modal_close" id="modal-add-order-book-qty">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_add_to_order_book_qty" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"> &nbsp; Add Products Quantity</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
        <div class="row">
          <!-- left column -->
          
							
							 <div class="col-md-12">
							  <div class="form-group">
								<label>Quantity</label>
								<input type="number" class="form-control" id="txt_prod_quantity" name= "quantity" value="" />						
							  </div>
							</div>

							<div class="col-md-12">
							  <div class="form-group">
								<label>Comment</label>
								<input type="text" class="form-control" id="txt_comment1" name= "comment" value="" />						
							  </div>
							</div>
							 
							
							 
							 					 
					<input type='hidden' name='tab' value="<?php echo 'add_order_book_quantity'; ?>" />		
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>	
					<input type='hidden' id="medicine_id" name='product_id'  />			  
					
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_add_product')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Add Quantity</button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
	
	
	
	<!-- Delete product modal Start -->
		
		<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-remove-product-orderbook">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_remove_product_orderbook" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash icon-lg" aria-hidden="true" id="" title="Add new <?php echo substr(ucwords($type), 0, -1); ?>"></i> &nbsp; Delete Item</h4>
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
							<input type="hidden" name="del_orderbook_id" id="del_orderbook_id" value="" />							
							 <h3>Are you sure, you want to remove this item ?</h3>
							</div>
					 
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'delete_product_orderbook'; ?>" />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
				
             
			 
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#modal-remove-product-orderbook')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash icon-lg" aria-hidden="true" id="remove_product" title="Delete Product"></i> &nbsp;Delete Now</button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		</div>
  <!-- Delete product modal End -->
  
  
   
  <!-- Active/Inactive product modal Start -->
		
		<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-active-product">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_active_product" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-thumbs-up icon-lg" aria-hidden="true" id="" title="Add new <?php echo substr(ucwords($type), 0, -1); ?>"></i> &nbsp; <span class="product_status" ></span> <?php echo substr(ucwords($type), 0, -1); ?></h4>
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
							<input type="hidden" name="act_product_id" id="act_product_id" value="" />							
							 <h3>Are you sure, you want to <span class="product_status" ></span> this <?php echo substr(ucwords($type), 0, -1); ?>?</h3>
							</div>
					 
					<input type='hidden' name='tab' value="change_product_status" />			  
					<input type='hidden' name='change_product_status' id='change_product_status' value=""  />			  
					<input type='hidden' name='product_status_txt' id='product_status_txt' value=""  />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
			 
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_remove_product')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info"><i class="fa fa-thumbs-up icon-lg" aria-hidden="true"  title="Change <?php echo substr(ucwords($type), 0, -1); ?> Status"></i> &nbsp;<span class= "product_status" ></span> <?php echo substr(ucwords($type), 0, -1); ?></button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		</div>
  <!-- Active/Inactive Person modal End -->
  
  
 
  
  
<!-- /.content-wrapper -->

<?php 
include_once("includes/footer.php") ; 
include_once("includes/dynamic_table.php") ; 
?>
<script src="plugins/jquery-validation/jquery.validate.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {    
	
	$('.select2').select2();
	$('.select2bs4').select2({
      theme: 'bootstrap4'
    });
	
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
  
 function load_ddl_products(id)
{
	var url = $('#ddlurl').val();
	$("#"+id).select2({
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
}

$(document).ready(function () {
	load_ddl_products('product_id11');
	load_ddl_products('product_id');
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
	
	$("#product_id11").select2({
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

$( document ).on( 'change', '.txtQty, .txt_comment', function ( event ) {
	//alert($(this).val() + $(this).data('product_id'));
	
	var type = $(this).data('type');
	console.log(type);
	console.log($(this).val());
	if(type == 'comment')
	{
		$('#txt_prod_quantity').val($(this).data('qty'));
		$('#txt_comment1').val($(this).val());
	}
	else
	{
		$('#txt_comment1').val($(this).data('comment'));
		$('#txt_prod_quantity').val($(this).val());
	}
	
	$('#medicine_id').val($(this).data('product_id'));
	$('#frm_add_to_order_book_qty').submit();
});

</script>
</body>
</html>