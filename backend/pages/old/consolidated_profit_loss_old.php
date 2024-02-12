<?php
include 'includes/check_session.php';
$pageno = 1; 


$rec = explode("-",$mysqli->RecTimeStamp("Y-m-d"));
$m = $rec[1];
$y = $rec[0];

function select($val1,$val2)
{
	if($val1 == $val2)
	{
		echo "selected";
	}
}
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
							
										
										<div  class="col-md-3">
										  <div class="form-group">
											<label>Select Date Range</label>
											<div class="input-group">
												<div class="input-group-prepend">
												  <span class="input-group-text">
													<i class="far fa-calendar-alt"></i>
												  </span>
												</div>
												<input type="text" class="form-control float-right" value="<?php // echo date("m/d/Y")." - ".date("m/d/Y"); ?>" name = "search_date" id = "search_date">
											  </div>
										  </div>
										</div>
										
										
										<div class="col-lg-3">
                                            <div class="form-group">
											
                                                <label>Month</label>
                                               <select class="form-control" name="month" required>
													<option value="">Select Month</option>
													<option <?php select($m,1); ?> value="1">January</option>
													<option <?php select($m,2); ?> value="2">February</option>
													<option <?php select($m,3); ?> value="3">March</option>
													<option <?php select($m,4); ?> value="4">April</option>
													<option <?php select($m,5); ?> value="5">May</option>
													<option <?php select($m,6); ?> value="6">June</option>
													<option <?php select($m,7); ?> value="7">July </option>
													<option <?php select($m,8); ?> value="8">August</option>
													<option <?php select($m,9); ?> value="9">September</option>
													<option <?php select($m,10); ?> value="10">October</option>
													<option <?php select($m,11); ?> value="11">November</option>
													<option <?php select($m,12); ?> value="12">December</option>
												</select>
                                            </div>
                                        </div> 
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Year </label>
                                                <select class="form-control" name="year" required>
													<option value="">Select Year</option>
													 <?php
														$firstYear = (int)date('Y') - 05;
														$lastYear = $firstYear + 05;
														for($i=$lastYear;$i>=$firstYear;$i--)
														{
															if($y == $i)
															{
																$sel = "selected";
															}
															else
																$sel = "";
															echo '<option '.$sel.' value='.$i.'>'.$i.'</option>';
														}

													 ?>
												</select>
                                            </div>
                                         </div>
							
							
							
										<div class="col-md-3">
										  <div class="form-group">
											
											<button id="search" style="margin-top: 20px; margin-left:25px;" type="submit" class="btn btn-info"><i class="fa fa-search icon-lg" aria-hidden="true"  title="Search"></i> &nbsp;Search</button>
											 
										  </div>
										</div>
							
							 
							 
						</div>
					</div>
					 
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'consolidated_profit_loss'; ?>" />
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=table_response"); ?>" required>			  
					<input type="hidden" name="record_limit" id="record_limit" value="50"> 			
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