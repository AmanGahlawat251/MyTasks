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
   <link rel="stylesheet" href="dist/css/croppie.css">
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
					
					<input type='hidden' name='tab' value="<?php echo 'view_university_data'; ?>" />					
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=table_response"); ?>" required>			  
					<input type="hidden" name="record_limit" id="record_limit" value="10"> 			
					<input type='hidden' name='download' id='download' value="" />		 
					<input type="hidden" name="page" id="page" value="<?php echo $pageno; ?>">  
				 
				
					
				</form>
           
			<div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                
				
				<h3 class="card-title">University Details&nbsp; &nbsp;<label id="lbl_total"></label> &nbsp; &nbsp;   <button id="btn_add_lead" style="margin-top: 0px;" type="button" class="btn btn-default btn-xs" data-type="" data-toggle="modal" data-target="#uploadimageModal1">
                    <i class="fas fa-book-medical icon-2x" aria-hidden="true"  title="Add new "> Add Data </i>
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
	<!-- Add Person modal End -->
	<div id="uploadimageModal1"  class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Upload & Crop Image</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="file" name="upload_image" id="upload_image" />                  
                    <div id="uploaded_image"></div>
                        </div>
                    </div>
                    <!--<div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>-->
                </div>
            </div>
        </div>
	<!-- Delete Lead modal Start -->
        <div id="uploadimageModal" class="modal modal-dialog modal-lg" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Upload & Crop Image</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-9 text-center">
                                <div id="image_demo" style="width:650px; height: 450px; margin-top:0px"></div>
                            </div>
                            <div class="col-md-3" style="padding-top:0px;"> 
                                <p>Preview</p>
                                <img class="img-responsive" id="prev-img" src="" alt="Preview" />                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 ">
                                <button class="btn btn-success crop_image">Crop & Upload Image</button>
                                <!-- <button class="js-main-image" >result</button>-->
                            </div>
                        </div>
                    </div>
                    <!--<div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>-->
                </div>
            </div>
        </div>
<!-- /.content-wrapper -->

<?php 
include_once("includes/footer.php") ; 
include_once("includes/dynamic_table.php") ; 
?>
<script src="plugins/jquery-validation/jquery.validate.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="dist/js/croppie.js"></script>
<script>
    $(document).ready(function () {

        $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 500,
                height: 300,
                type: 'square' //circle
            },
            boundary: {
                width: 600,
                height: 400
            }
        });

        $('#upload_image').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (event) {
                result = event.target.result;
                arrTarget = result.split(';');
                tipo = arrTarget[0];
                if (tipo == 'data:image/jpeg' || tipo == 'data:image/png') {
                    //alert('valid image');
                    $('#uploadimageModal').modal('show');
                } else {
                    // Setup the clear functionality
                    var control = $("#upload_image");
                    control.replaceWith(control.val('').clone(true));
                    alert('Accept only .jpg or .png image types');
                }
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('.crop_image').click(function (event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                $.ajax({
                    url: "upload.php",
                    type: "POST",
                    data: {"image": response},
                    success: function (data)
                    {
                        $('#uploadimageModal').modal('hide');
                        $('#uploaded_image').html(data);
                    }
                });
            })
        });

        $image_crop.on('update.croppie', function (ev, data) {
            //console.log('jquery update', ev, data);
            $image_crop.croppie('result', {
                type: 'rawcanvas',
                circle: false,
                // size: { width: 300, height: 300 },
                format: 'png'
            }).then(function (canvas) {
                $('#prev-img').attr('src', canvas.toDataURL());
                //console.log(canvas.toDataURL());
            });
        });

        $('.js-main-image').on('click', function (ev) {
            $image_crop.croppie('result', {
                type: 'rawcanvas',
                circle: false,
                // size: { width: 300, height: 300 },
                format: 'png'
            }).then(function (canvas) {
                $('#prev-img').attr('src', canvas.toDataURL());
                //console.log(canvas.toDataURL());
            });
        });

    });
</script>

</body>
</html>