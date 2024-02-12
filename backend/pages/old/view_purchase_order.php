<?php
include 'includes/check_session.php';
$pageno = 1; 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title><?php echo ucwords(str_replace("_"," ",$type)); ?>  |  <?php echo LOGO_ALT;  ?></title>
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
            <h1 class="m-0 text-dark"><?php echo ucwords(str_replace("_"," ",$type)); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $dashboard; ?>">Home</a></li>
              <li class="breadcrumb-item active"><?php echo ucwords(str_replace("_"," ",$type)); ?></li>
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
									<input type="text" class="form-control float-right" value="<?php echo date("m/d/Y")." - ".date("m/d/Y"); ?>"  name = "search_date" id = "search_date">
								  </div>
							  </div>  
							</div>
							
							<div class="col-md-4">
							  <div class="form-group">
								<label>Supplier <span class="text-red">*</span>&nbsp;&nbsp;</label>
								<div class="select2-purple">
								<select id="supplier_id" data-placeholder="Select Supplier" data-dropdown-css-class="select2-purple" name="supplier_id" class="form-control select2">
								<option value="">Select Supplier</option>
								<?php
								$query = "SELECT name,id FROM ".PERSON." WHERE active = 1 and type = 'SUPPLIER'";
								$mysqli->DynamicSelectedDropDown($query, 'id', 'name', '');	?>							  
								</select>
								</div>
								 
							  </div>
							</div>
							
							<div class="col-md-4">
							  <div class="form-group">
								
								<button id="search" style="margin-top: 20px; margin-left:25px;" type="submit" class="btn btn-info"><i class="fa fa-search icon-lg" aria-hidden="true"  title="Search"></i> &nbsp;Search</button>
								 
							  </div>
							</div>
							
							 
							 
						</div>
					</div>
					 
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'view_purchase'; ?>" />
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=table_response"); ?>" required>			  
					<input type="hidden" name="record_limit" id="record_limit" value="10"> 			
					<input type='hidden' name='download' id='download' value="" />		 
					<input type="hidden" name="page" id="page" value="<?php echo $pageno; ?>">  
				 	 
				</form>
            </div>  
            <!-- /.card -->
			</div>
			
			<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                
				
				<h3 class="card-title"><?php echo ucwords(str_replace("_"," ",$type)); ?> </h3>
				
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
	
	<!-- Delete Person modal Start -->
		
		<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-remove-po">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_remove_po" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash icon-lg" aria-hidden="true" id="" title="Remove PO"></i> &nbsp; Delete Purchase Order</h4>
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
							<input type="hidden" name="del_po_id" id="del_po_id" value="" />							
							 <h3>Are you sure, you want to remove this Purchase Order ?</h3>
							</div>
					 
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'delete_po'; ?>" />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
				
             
			 
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_remove_po')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash icon-lg" aria-hidden="true" id="delete_PO" title="Delete PO"></i> &nbsp;Delete Purchase Order</button>
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