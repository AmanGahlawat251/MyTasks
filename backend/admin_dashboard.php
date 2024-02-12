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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"  />
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
     img {
            display: block;
            max-width: 100%;
        }
        .preview {
            overflow: hidden;
            width: 160px; 
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }
.preview_banner {
    width: 250px; /* Set an initial width */
    height: 180px; /* Set an initial height */
	margin-left: 20px;
    overflow: hidden; /* Hide content that exceeds the specified dimensions */
}

.preview_banner img {
    max-width: 100%; /* Ensure the image does not exceed the width of the container */
    height: auto; /* Maintain the aspect ratio of the image */
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
                
				
				<h3 class="card-title">University Details&nbsp; &nbsp;<label id="lbl_total"></label> &nbsp; &nbsp;   <button id="btn_add_lead" style="margin-top: 0px;" type="button" class="btn btn-default btn-xs" data-type="" data-toggle="modal" data-target="#modal-add-university">
                    <i class="fas fa-book-medical icon-2x" aria-hidden="true"  title="Add new "> Add Data </i>
                  </button> <button id="btn_add_lead1" style="margin-top: 0px;" type="button" class="btn btn-default btn-xs" data-type="" data-toggle="modal" data-target="#modal-upload-csv">
                    <i class="fas fa-book-medical icon-2x" aria-hidden="true"  title="Add new ">Upload Csv </i>
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
	<div data-keyboard="false" data-backdrop="static" class="modal fade modal_close"  id="modal-add-university">
          <div class="modal-dialog modal-xl">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_add_data" method="post" >
              <div class="modal-header">
                <h4 class="modal-title" id="m-title"><i class="fa fa-book-medical icon-lg" aria-hidden="true" id="" title="Add new"></i> &nbsp; Add </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
        <div class="row">
          <!-- left column -->
          <div class="col-md-12 row">
            <!-- general form elements -->
							<div class="col-md-3">
							  <div class="form-group">
								<label>Education Type<span style="color:red">*</span>  </label>
								<select id="type"   data-dropdown-css-class="select2-purple" name="type" class="form-control select2" required>
								<option value="Bachelors">Bachelors</option>
								<option value="Masters">Masters</option>
															  
								</select>								
							  </div>
							</div>
							
							<div class="col-md-3">
							  <div class="form-group">
								<label>School/University Name<span style="color:red">*</span>  </label>
								<input type="text"  class="form-control"  autofocus  name="uni_name" id="uni_name" required />								
							  </div>
							</div>
							
							
							<div class="col-md-3">
							    <div class="form-group">
								    <label>Last Qualification</label>
								    <input type="text"  class="form-control "  name="qualification" maxlength="100" id="qualification" />
							    </div>							
							</div>							
							
							<div class="col-md-3">
							  <div class="form-group">
								<label>GPA</label>
								<input type="text"  class="form-control removeChars" data-regex="[^0-9+.%]" maxlength="5" name="gpa" id="gpa"  >								
							  </div>
							</div>
							
							<div class="col-md-3">
							  <div class="form-group">
								<label>Cost of living</label>
								<input type="text"  class="form-control removeChars" data-regex="[^0-9+.]" maxlength="15" name="cost_of_living" id="cost_of_living"  >								
							  </div>
							</div>
							
							<div class="col-md-3">
							  <div class="form-group">
								<label>Cost of tution</label>
								<input type="text"  class="form-control removeChars" data-regex="[^0-9+.]" maxlength="10" name="tution_cost" id="tution_cost"  >								
							  </div>
							</div>
							
							<div class="col-md-3">
							  <div class="form-group">
								<label>Application fees</label>
								<input type="text"  class="form-control removeChars" data-regex="[^0-9+.]" maxlength="10" name="fees" id="fees"  >								
							  </div>
							</div>
							
							<div class="col-md-3">
							  <div class="form-group">
								<label>PTE</label>
								<input type="text"  class="form-control removeChars" data-regex="[^0-9]" maxlength="2" name="pte" id="pte"  >								
							  </div>
							</div>
							
							<div class="col-md-3">
							  <div class="form-group">
								<label>IELTS</label>
								<input type="text"  class="form-control removeChars" data-regex="[^0-9+.]" maxlength="3" name="ielts" id="ielts"  >								
							  </div>
							</div>
							
				           <div class="col-md-3">
							  <div class="form-group">
								<label>TOEFL</label>
								<input type="text"  class="form-control removeChars" data-regex="[^0-9.]" maxlength="3" name="toefl" id="toefl"  >								
							  </div>
							</div>
							
							<div class="col-md-3">
							  <div class="form-group">
								<label>DUOLINGO</label>
								<input type="text"  class="form-control removeChars" data-regex="[^0-9+.]" maxlength="4" name="duolingo" id="duolingo"  >								
							  </div>
							</div>
							
							<div class="col-md-3">
							  <div class="form-group">
								<label>University TAT</label>
								<input type="text"  class="form-control" maxlength="10" name="tat" id="tat"  >								
							  </div>
							</div>
							
							<div class="col-md-3">
							  <div class="form-group">
								<label>University Rank</label>
								<input type="text"  class="form-control removeChars" data-regex="[^0-9+]" maxlength="15" name="uni_rank" id="uni_rank"  >								
							  </div>
							</div>
							
							<div class="col-md-3">
							  <div class="form-group">
								<label>Acceptance Rate</label>
								<input type="text"  class="form-control removeChars" data-regex="[^0-9+.%]" maxlength="10" name="acceptance_rate" id="acceptance_rate"  >								
							  </div>
							</div>
							
							<div class="col-md-3">
							  <div class="form-group">
								<label>Any extra test required ?</label>
								<div class="select2-purple">
								<select id="extra_test"   data-dropdown-css-class="select2-purple" name="extra_test" class="form-control select2" >
								<option value="">Select</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
															  
								</select>
								</div>		
							  </div>
							</div>
							<!--<div class="col-sm-3">
								<div class="form-group">
									<label>Logo</label>
									<input class="form-control" type="file" name="logo" id="logo"> 
									 <div id="uploaded_image"></div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Banner</label>
									<input class="form-control" type="file" name="banner" id="banner"> 
								</div>
							</div>-->
				 
					<input type='hidden' name='tab' value="<?php echo 'add_uni_data'; ?>" />
					<input type="hidden" name="url" id="notes_url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>	
                    <input type='hidden' name='edit_id' id="edit_id" value="" />		               
			</div>
			
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_add_person')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
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
		<!-- Add lead modal Start -->
	<div data-keyboard="false" data-backdrop="static" class="modal fade modal_close"  id="modal-upload-csv">
          <div class="modal-dialog modal-xs">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_add_csv" method="post" >
              <div class="modal-header">
                <h4 class="modal-title" id="m-title"><i class="fa fa-book-medical icon-lg" aria-hidden="true" id="" title="Add new"></i> &nbsp; Upload University Data </h4>
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
							   <label for="file_box">Candidate Details File</label>
                                        <div id="file_box">
                                            <div class=" mt-0 mb-1">
                                                <input type="file" class="form-control" id="details" accept=".csv" name="details">
                                                
                                            </div>
                                        </div>
							</div>
							
							
				 
					<input type='hidden' name='tab' value="<?php echo 'bulk_upload'; ?>" />
					<input type="hidden" name="url" id="notes_url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>		               
			</div>
			
			
			
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_add_person')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
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

		
		<div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-remove-data">
          <div class="modal-dialog">			
            <div class="modal-content">
			<form onsubmit="return false;" id="frm_remove_data" method="post" >
              <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-trash icon-lg" aria-hidden="true" id="" title="Add new "></i> &nbsp; Delete </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            
						 												
							<div class="col-md-12">	
							<input type="hidden" name="del_record_id" id="del_record_id" value="" />							
							 <h3>Are you sure, you want to remove this ?</h3>
							</div>
					 
					<!-- /.card-body -->
					<input type='hidden' name='tab' value="<?php echo 'delete_university'; ?>" />			  
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>	
		</div>
	
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" onclick="$('#frm_remove_lead')[0].reset()" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash icon-lg" aria-hidden="true" id="delete_lead" title="Delete Lead"></i> &nbsp;Delete </button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
		</div>
  <!-- Delete Lead modal End -->

   <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Logo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">  
                                    <!--  default image where we will set the src via jquery-->
                                    <img id="image">
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
						<img id='hidden_cropped_image' name='hidden_cropped_image' style='display: none;'> 
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop & Upload</button>
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade" id="modal_banner" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Banner image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">  
                                    <!--  default image where we will set the src via jquery-->
                                    <img id="image_banner">
                                </div>
                                <div class="col-md-4">
                                    <div class="preview_banner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
						<img id='hidden_cropped_banner' name='hidden_cropped_banner' style='display: none;'> 
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop_banner">Crop & Upload</button>
                    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
$(document).ready(function () {

    var bs_modal = $('#modal');
    var image = document.getElementById('image');
    var cropper, reader, file;

    // Use a common class for all image inputs
    $("body").on("change", ".image", function (e) {
        var files = e.target.files;
        var done = function (url) {
            image.src = url;

            // Retrieve the row ID and set it to the hidden field
            var rowId = $(e.target).data("row-id");
            $("#hidden_cropped_image").data("row-id", rowId);

            bs_modal.modal('show');
        };

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    bs_modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function () {
        if (cropper) {
            var canvas = cropper.getCroppedCanvas({
                width: 96,
                height: 45,
            });

            // Set the source of the hidden img tag
            $("#hidden_cropped_image").attr("src", canvas.toDataURL());

            canvas.toBlob(function (blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;

                    // Retrieve the row ID from the data attribute of the hidden img tag
                    var rowId = $("#hidden_cropped_image").data("row-id");

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "<?php echo "index.php?" . $mysqli->encode("stat=ajax"); ?>",
                        data: {
                            'tab': 'upload_logo',
                            'id': rowId,
                            'image': base64data
                        },
                        dataType: "json",
                        success: function (data) {
							bs_modal.modal('hide');
							try {
								if ( data.msg_code != '00' ) {
									Swal.fire( {
										type: 'error',
										title: 'Error',
										text: data.msg
									} )
									
								}else {
								//console.log( 'swal' );
								if (data.msg_code == '00') {
									Swal.fire( {
										type: 'success',
										title: 'Success',
										text: data.msg,
										timer: 2000
									} )
									setTimeout( function () {								 
									window.location.reload()
							}, 1000 );
								}
								}
							} catch (error) {
								console.error('Error handling response:', error);
							}
						}
                    });
                };
            });
        }
    });
});

$(document).ready(function () {

    var bs_modal = $('#modal_banner');
    var image = document.getElementById('image_banner');
    var cropper, reader, file;

    // Use a common class for all image inputs
    $("body").on("change", ".banner", function (e) {
        var files = e.target.files;
        var done = function (url) {
            image.src = url;

            // Retrieve the row ID and set it to the hidden field
            var rowId = $(e.target).data("row-id");
            $("#hidden_cropped_banner").data("row-id", rowId);

            bs_modal.modal('show');
        };

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    bs_modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
             aspectRatio: NaN, // Set to NaN for freestyle cropping
            viewMode: 3,
            preview: '.preview_banner'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    $("#crop_banner").click(function () {
        if (cropper) {
            var canvas = cropper.getCroppedCanvas({
                width: 1400,
                height: 600,
            });

            // Set the source of the hidden img tag
            $("#hidden_cropped_banner").attr("src", canvas.toDataURL());

            canvas.toBlob(function (blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;

                    // Retrieve the row ID from the data attribute of the hidden img tag
                    var rowId = $("#hidden_cropped_banner").data("row-id");
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "<?php echo "index.php?" . $mysqli->encode("stat=ajax"); ?>",
                        data: {
                            'tab': 'upload_banner',
                            'id': rowId,
                            'image': base64data
                        },
                        dataType: "json",
                        success: function (data) {
							bs_modal.modal('hide');
							try {
								if ( data.msg_code != '00' ) {
									Swal.fire( {
										type: 'error',
										title: 'Error',
										text: data.msg
									} )
									
								}else {
								//console.log( 'swal' );
								if (data.msg_code == '00') {
									Swal.fire( {
										type: 'success',
										title: 'Success',
										text: data.msg,
										timer: 2000
									} )
									setTimeout( function () {								 
									window.location.reload()
							}, 1000 );
								}
								}
							} catch (error) {
								console.error('Error handling response:', error);
							}
						}
                    });
                };
            });
        }
    });
});


</script>

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