<?php include 'includes/check_session.php'; ?>    
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PO Details | <?php echo LOGO_ALT; ?> </title>
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
            <h1 class="m-0 text-dark">PO Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $dashboard; ?>">Home</a></li>
              <li class="breadcrumb-item active">PO Details </li>
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
		  echo $mysqli->view_po_order_details($id);
		  ?>
			
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