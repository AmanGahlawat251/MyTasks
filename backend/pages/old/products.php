<?php
include 'includes/check_session.php';
$pageno = 1; 
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
              <li class="breadcrumb-item active"><?php echo ucwords($type); ?> </li>
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
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Search <?php echo ucwords($type); ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
				<form onsubmit="return false;" id="frm_search" method="post" >
					<div class="card-body">
						<div class="row">
							<div class="col-md-2">
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
							
							<div class="col-md-2">
							  <div class="form-group">
								<label>Product Name</label>
								<select id='product_id' style='width:235px; max-width:235px;'  name='product_id' class='form-control product_id' required><option value=''>Select Product</option></select>
							  </div>
							</div>
							
							<div style="margin-left:10px;" class="col-md-2">
							  <div class="form-group">
								<label>Product Company</label>
								<div class="select2-purple">
								<select style="height:38px;" id="company" name="company" data-placeholder="Select Company" data-dropdown-css-class="select2-purple" class="form-control select2" >
									<option value="">Select Company</option>
								  <?php $mysqli->DynamicSelectedDropDown("SELECT id,company_name FROM tbl_pharmacy_companies WHERE active = 1", 'id', 'company_name',''); ?>
								</select>
								</div>
							  </div>
							</div>
							
							<div style="margin-left:10px;" class="col-md-2">
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
							
							<div class="col-md-2">
							  <div style="margin-left:50px; margin-top:30px;" class="form-group">
								<input onchange="loadTableRecords(<?php echo $pageno; ?>);" type="checkbox" class="form-check-input" name="only_qty" value="1" id="exampleCheck1">
									<label class="form-check-label" for="exampleCheck1">Only Available Quantity</label>
							  </div>
							</div>
							
							<div class="col-md-1">
							  <div style="margin-left:10px; margin-top:30px;" class="form-group">
								<input onchange="loadTableRecords(<?php echo $pageno; ?>);" type="checkbox" class="form-check-input" name="create_report" value="1" id="create_report">
									<label class="form-check-label" for="create_report">Create Report</label>
							  </div>
							</div> 
							 
						</div>
					</div>
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'view_products'; ?>" />
					<input type='hidden' name='sub_tab' value="<?php echo $type; ?>" />						
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=table_response"); ?>" required>		
					<input type="hidden" name="ddlurl" id="ddlurl" value="<?php echo "index.php?".$mysqli->encode("stat=ajax&tab=ddl_ajax_po"); ?>" required>
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
                
				
				<h3 class="card-title"><?php echo ucwords($type); ?> Details &nbsp; &nbsp;<button data-toggle="modal" data-target = "#modal-add-product" id="btn_add_person" style="margin-top: -5px;" type="button" class="btn btn-warning btn-xs" data-type="<?php echo $type;?>" data-target="">
                    <i class="fa fa-user-plus icon-lg" aria-hidden="true"  title="Add new <?php echo substr(ucwords($type), 0, -1); ?>"></i>
                  </button>
					&nbsp;&nbsp;<span data-toggle="modal"  data-target="#modal-upload-product"  style="float:right; margin-top:-5px; cursor:pointer;" class="btn btn-success btn-sm">
					   <i class="fa fa-upload"></i> Upload Products
					</span>
					
					
				  </h3>
				  &nbsp;&nbsp;&nbsp;
				  <?php $download_url = APP_URL."download/Inventory.csv"; ?>
					<i class="fa fa-download fa-lg" aria-hidden="true" onclick="window.location.href='<?php echo $download_url; ?>'" style="cursor:pointer;"  data-url="download_students_list" title="Download Report"></i>
				<span id="lbl_total"></span>
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
	
	<!-- Add product modal Start -->
	<div data-keyboard = "false" data-backdrop = "static" class="modal fade modal_close" id="modal-add-product">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_add_product" method="post" >
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
								<label><?php echo substr(ucwords($type), 0, -1); ?> Name<span style="color:red">*</span>  <span style="cursor:help" data-toggle="tooltip" data-placement="top" title="Please enter product  name, special characters are not allowed."><i class="fa fa-question-circle" aria-hidden="true"></i></span></label>
								<input type="text"  class="form-control removeChars" data-regex="[^a-zA-Z0-9-.,_ /]" autofocus maxlength="150" name="product_name" id="product_name" required>								
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Company Name</label>
								<div class="select2-purple">
								<select style="height:38px;" id="company_id" name="company_id" data-placeholder="Select Company" data-dropdown-css-class="select2-purple" class="form-control select2" required>
									<option></option>
								  <?php $mysqli->DynamicSelectedDropDown("SELECT id,company_name,active FROM tbl_pharmacy_companies WHERE active = 1", 'id', 'company_name',''); ?>
								</select>
								</div>
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Product Category</label>
								<div class="select2-purple">
								<select style="height:38px;" id="category_id" name="category_id" data-placeholder="Select Category" data-dropdown-css-class="select2-purple" class="form-control select2" required>
									<option></option>
								  <?php $mysqli->DynamicSelectedDropDown("SELECT category_id,category_name FROM ".CATEGORY." WHERE active = 1", 'category_id', 'category_name',''); ?>
								</select>
								</div>
							  </div>
							</div>
														
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Product Unit</label>
								<div class="select2-purple">
								<select style="height:38px;" id="unit_id" name="unit_id" data-placeholder="Select Category" data-dropdown-css-class="select2-purple" class="form-control select2" required>
									<option></option>
								  <?php $mysqli->DynamicSelectedDropDown("SELECT unit_id,unit_name FROM ".PRODUCT_UNIT." WHERE active = 1", 'unit_id', 'unit_name',''); ?>
								</select>
								</div>
							  </div>
							</div>
							
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Default Discount (In %)<span style="color:red">*</span></label>
								<input type="text"   class="form-control allowOnlyNumeric" value="0" maxlength="2" name="default_discount" id="default_discount" required> 								
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Tax Applicable ?<span style="color:red">*</span></label>
								<div class="select2-purple">
								<select style="height:38px;" id="tax" name="tax" data-placeholder="Select Option" data-dropdown-css-class="select2-purple" class="form-control select2" required>
									<option value="N">No</option>
									<option value="Y" >Yes</option>
								</select>
								</div>
							  </div>
							</div>
							
							<div class="col-md-12">
							  <div class="form-group">
								<label>Low Inventory Alert<span style="color:red">*</span> <span style="cursor:help" data-toggle="tooltip" data-placement="top" title="Please enter that value name on which you want low inventory alert."><i class="fa fa-question-circle" aria-hidden="true"></i></span></label>
								<input type="text"   class="form-control allowOnlyNumeric" value="0" maxlength="2" name="low_inventory_alert" id="low_inventory_alert" required> 								
							  </div>
							</div>
							 					 
					<input type='hidden' name='tab' value="<?php echo 'add_product'; ?>" />			  
					<input type='hidden' name='sub_tab' value="<?php echo $type; ?>" />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>
					<input type='hidden' name='edit_product_id' id="edit_product_id" value="0" />					
			</div>
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_add_product')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info"> &nbsp;Submit</button>
              </div> 
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	<!-- Add product modal End -->
	
	<!-- Delete product modal Start -->
		
		<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-remove-product">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_remove_product" method="post" >
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
							<input type="hidden" name="del_product_id" id="del_product_id" value="" />							
							 <h3>Are you sure, you want to remove this <?php echo substr(ucwords($type), 0, -1); ?>?</h3>
							</div>
					 
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'delete_product'; ?>" />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
				
             
			 
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_remove_product')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash icon-lg" aria-hidden="true" id="remove_product" title="Delete Product"></i> &nbsp;Delete <?php echo substr(ucwords($type), 0, -1); ?></button>
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
  
  
  <!-- Upload product modal Start -->
		
		<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-upload-product">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_upload_product" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-upload icon-lg" aria-hidden="true" id="" title="Upload <?php echo substr(ucwords($type), 0, -1); ?>"></i> &nbsp; Upload <?php echo ucwords($type); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
        <div class="row">
          <!-- left column -->
			<div class="col-md-12">            											
				<div class="col-md-12">	
					<div class="form-group">
                    <label for="exampleInputFile">Upload File</label>
                     <div class="custom-file">
                        <input type="file" class="custom-file-input" name="product_upload" accept=".csv" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
					  <a style="float:right; margin:20px;" href="file_upload/sample_upload_products.csv" target="_blank" >Sample Upload File</a>
                  </div>
				</div>					 
				<!-- /.card-body -->
				<input type='hidden' name='tab' value="<?php echo 'upload_products'; ?>" />			  
				<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>	
			</div>
        </div>
		  <div class="modal-footer justify-content-between">
			<button type="button" onclick="$('#frm_upload_product')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-success"><i class="fa fa-upload icon-lg" aria-hidden="true" id="upload_product" title="Upload Product"></i> &nbsp;Upload </button>
		  </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		</div>
  <!-- Upload product modal End -->
  
  
  
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
	 load_ddl_products('product_id');
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