<?php 
$pagecode = "PO-009";
include 'includes/check_session.php';
$pageno = 1; 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title><?php echo LOGO_ALT; ?> </title>
  <?php include_once("includes/header.php"); ?>   
  <?php include_once("includes/sidebar.php"); ?>    
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
.text-right {
    text-align: right !important;
}

.text-center {
    text-align: center !important;
}

.text-left {
    text-align: left !important;
}
  </style>
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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

         <form onsubmit="return false;" id="frm_search" method="post" >
					
					<input type='hidden' name='tab' value="<?php echo 'view_config'; ?>" />					
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=table_response"); ?>" required>			  
					<input type="hidden" name="record_limit" id="record_limit" value="10"> 			
					<input type='hidden' name='download' id='download' value="" />		 
					<input type="hidden" name="page" id="page" value="<?php echo $pageno; ?>">  
				 
				
					
				</form>
           
			<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                
				
				<h3 class="card-title">Configurations&nbsp; &nbsp;<label id="lbl_total"></label> &nbsp; &nbsp;   <button id="btn_add_lead" style="margin-top: 0px;" type="button" class="btn btn-default btn-xs" data-type="" data-toggle="modal" data-target="#modal-add-config">
                    <i class="fas fa-book-medical icon-2x" aria-hidden="true"  title="Add new "> Add Config </i>
                  </button>  </h3>
				
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
	
	<!-- Add lead modal Start -->
	<div data-keyboard = "false" data-backdrop = "static" class="modal fade modal_close" id="modal-add-config">
          <div class="modal-dialog modal-xs">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_add_config" method="post" >
              <div class="modal-header">
                <h5 class="modal-title" id="m-title"><i class="fa fa-book-medical icon-lg" aria-hidden="true" id="" title="Add new"></i> &nbsp; Add Config</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
        <div class="row">
          <!-- left column -->
          <div class="col-md-12 row">
            <!-- general form elements -->
							<div class="col-md-12">
							  <div class="form-group">
								<label>Last Education Percentage<span style="color:red">*</span>  </label>
								<input type="text"  class="form-control removeChars" data-regex="[^0-9.]"  autofocus  name="education_percentage" id="education_percentage" required />								
							  </div>
							</div>
							<div class="col-md-12">
							  <div class="form-group">
								<label>University Fees (in thousand)<span style="color:red">*</span>  </label>
								<input type="text"  class="form-control removeChars" data-regex="[^0-9]"  autofocus  name="uni_fees" id="uni_fees" required />								
							  </div>
							</div>
							<div class="col-md-12">
							  <div class="form-group">
								<label>Living Expense (in thousand)<span style="color:red">*</span>  </label>
								<input type="text"  class="form-control removeChars" data-regex="[^0-9]"  autofocus  name="expense" id="expense" required />								
							  </div>
							</div>
							
							
							
					<input type='hidden' name='tab' value="<?php echo 'add_config'; ?>" />
					<input type="hidden" name="url" id="notes_url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>	
                    <input type='hidden' name='edit_id' id="edit_id" value="" />		               
			</div>
			
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_add_data')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="submit" type="submit" class="btn btn-info">Submit </button>
                <button id="update" type="submit" style="display:none;" class="btn btn-info">Update </button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	<!-- Add Person modal End -->
	

  
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
	$('.select2').select2({
      theme: 'bootstrap4',
      placeholder: "Select if any",
      allowClear: true
    });
	$('.select2bs4').select2({
      theme: 'bootstrap4',
      placeholder: ">Select if any",
      allowClear: true
    });
	
	
	$('[data-toggle="tooltip"]').tooltip({
		container: 'body'
	});
	
	 
	
  });
  
   

</script>
</body>
</html>