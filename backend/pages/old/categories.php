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
               
              <!-- form start -->
				<form onsubmit="return false;" id="frm_search" method="post" >
					 
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'view_categories'; ?>" />
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
                
				
				<h3 class="card-title"><?php echo ucwords($type); ?> Details &nbsp; &nbsp;<button data-toggle="modal" data-target = "#modal-add-category" id="btn_add_category" style="margin-top: -5px;" type="button" class="btn btn-warning btn-xs">
                    <i class="fa fa-user-plus icon-lg" aria-hidden="true"  title="Add new category"></i>
                  </button> </h3>
				
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
	
	<!-- Add Person modal Start -->
	<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-add-category">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_add_category" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-user-plus icon-lg" aria-hidden="true" id="" title="Add new category"></i> &nbsp; Add Category</h4>
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
								<label>Category Name<span style="color:red">*</span></label>
								<input type="text"  class="form-control removeChars" data-regex="[^a-zA-Z0-9-.,_ /]" autofocus maxlength="150" name="category_name" id="category_name" required>								
							  </div>
							</div>
							
							 
					<input type='hidden' name='tab' value="<?php echo 'add_category'; ?>" />			  	  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
					<input type="hidden" name="url_state" id="url_state" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
				
             
			</div>
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_add_category')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info"><i class="fa fa-user-plus icon-lg" aria-hidden="true" id="add_person" title="Add new category"></i> &nbsp;Add Category</button>
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
		
		<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-remove-category">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_remove_category" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash icon-lg" aria-hidden="true" id="" title="Add new category"></i> &nbsp; Delete Category</h4>
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
							<input type="hidden" name="del_category_id" id="del_category_id" value="" />							
							 <h3>Are you sure, you want to remove this category ?</h3>
							</div>
					 
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'delete_category'; ?>" />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>			  
				
             
			 
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_remove_category')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash icon-lg" aria-hidden="true" id="add_client" title="Delete client"></i> &nbsp;Delete Category</button>
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
  $(document).ready(function() {    
	 
	
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
  
   

</script>
</body>
</html>