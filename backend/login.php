<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_FULL_NAME; ?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <style>
  body {
     background: #136a8a !important;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #267871, #136a8a) !important;  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #267871, #136a8a) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}


}
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
	



  </style>
  <style>
		#loading {
			position:fixed; top:0; left:0; background:rgba(0,0,0,0.6); z-index:5; width:100%; height:100%; display:none ;
			z-index:9999999999;
		}

		#loading.hide {
			opacity: 0;
		}

		#spinner {
			position: absolute;
			width: 100px;
			height: 100px;
			top: 50%;
			left: 50%;
			margin-top: -50px;
			margin-left: -50px;
		   // background-color: transparent;
			//-webkit-transition: all 1000s linear;
		}
		body {
 /* display: none; */

}
.reshow {display: block !important;}

.swal2-popup{
	z-index:9999999999;
}

</style> 
<!--<script src="https://www.google.com/recaptcha/api.js?render=_reCAPTCHA_site_key"></script>-->

</head>
<body class="hold-transition login-page">
 <div style="display:block;" id="loading">
    <div id="spinner"><img src="img/loader-white.gif" style="width:100px;"/></div>
  </div>
<div style="width: 425px !important;" class="login-box">
  <!--<div class="login-logo">
    <a href="index.php"><img src="<?php //echo LOGO_PATH; ?>" style="width:90%;" alt="<?php //echo APP_FULL_NAME; ?>" class=""></a>
  </div>-->
  <!-- /.login-logo -->
  <div style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" class="card">
    <div class="card-body login-card-body">
		<center><h2 style="color:#28a745;"><b><?php echo APP_FULL_NAME; ?></b></h2>
		
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" onsubmit="return false;" autocomplete="off" id="frm" method="post">
        <div class="mb-3">
          <input type="text" class="form-control removeChars" data-regex="[^a-zA-Z0-9-.,_@ /]" name="userName" placeholder="Enter Your Email or Mobile" autofocus required>
          <!--<div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>-->
        </div>
        <div class="mb-3">
          <input type="password"  class="form-control showpassword_txt" name="password" id="password" placeholder="Password" required> 
        </div>
		<!---<div class="mb-3">
          
				<div class="form-group">
				  <div style="border-right: 1 !important;" class="input-group">
					<div class="input-group-prepend">
					  <span style="border-left: 1px solid #ccc !important;" class="input-group-text"><img src="includes/captcha.php"></span>
					</div>
					<input style="border-right: 1px solid #ccc !important;" type="text" class="form-control" maxlength="6" name="captcha" placeholder="Verification Code" required="">
				  </div>
				  
				</div>
			 
        </div>-->
        <!--<div style="overflow:hidden;" class="input-group mb-3">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">							
				<div  class="g-recaptcha" data-sitekey="<?php // echo SITE_KEY ; ?>"></div>
			</div>         
        </div>-->
			<input type="hidden"   name="g-recaptcha-response" id="g-recaptcha-response" value="1" required>
			<input type="hidden"   name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax&tab=login"); ?>" required>
			<input type="hidden"   name="token" id="token" value="<?php echo $mysqli->generateCSRF('GENERATE'); ?>" required>
			
        <div class="row">          
			
          <!-- /.col -->
          <div style="margin-top:15px;" class="col-12">
            <button type="submit" name="btn_submit" class="btn btn-success btn-block">Sign In</button>
          </div>

          <div style="margin-top:10px; font-size: 14px;" class="col-12">
            
             &nbsp;&nbsp;&nbsp; <a href="javascript:void(0);" onclick="$('#inputEmail').focus();" data-toggle="modal" data-target="#modal-forget">Forgot Password?</a>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

        <!-- Modal -->

    <div data-keyboard = "false" data-backdrop = "static" class="modal fade" id="modal-forget">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Forget Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" onsubmit="return false;" id="frm_forgot_password" method="post">
            <div class="modal-body">
             <div class="control-group">
				<input type="email" class="form-control nospace" name="email" id="inputEmail"  placeholder="Enter your registered Email address" autofocus required>
			</div>
            </div>
			<input type="hidden"   name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=ajax&tab=forgot_password"); ?>" required>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

</div>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="dist/js/custom-script.js"></script>
<script src="plugins/jquery-validation/jquery.validate.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#loading").hide(); 
	
	        
	$('.modal').on('hidden.bs.modal', function (e) {
		window.location.reload();
	})
	
	$("#modal-forget").on('shown.bs.modal', function(){

        $(this).find('#inputEmail').focus();

    });
	
	$("#modal-add-client").on('shown.bs.modal', function(){

        $(this).find('#company_name').focus();

    });
	
	$('.select2bs4').select2({
      theme: 'bootstrap4'
    });
	
	
	$(".readonly").on('keydown paste', function(e){
        if(e.keyCode != 8 && e.keyCode != 9)
		{
			e.preventDefault();
		}
		
    });
	
	
	$('[data-toggle="tooltip"]').tooltip({
		container: 'body'
	});
	
	$('#frm').validate({
        rules: {
			userName: {
                required: true
            },
			 password: {
                required: true
            }
		},
		messages: {
			userName: "User email is required.",
			password: { 
                required: "Password is required."
            }
		}
	 });
	
	$("#frm_add_client").validate({
        rules: {			
            contact_name: {
				required: true,
				minlength:2,
				normalizer: function(value) {        
					return $.trim(value);
				}
			},
			company_name: {
				required: true,
				minlength:2,
				normalizer: function(value) {        
					return $.trim(value);
				}
			},
            email: {
                required: true,
                email: true
            },
            country_code: {
                required: true
            },
			contact: {
                required: true,
				minlength: 10,
                number: true
            } ,         
            password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            }
        },
        messages: {
            company_name: { 
				required: "Company name is required.",
				minlength: "Please enter at least 2 characters."
			},
			contact_name: { 
				required: "Your name is required.",
				minlength: "Please enter at least 2 characters."
			},
            email: "Please enter a valid email address.",
            country_code: "Please select a country code.",
            contact: {
                required: "Please enter your phone number.",
				minlength: "Invalid mobile number, mobile number should be 10 digits.",
                number: "Please enter only numeric value."
            },            
            password: {
                required: "Please click on Generate Password above",
                minlength: "Your password must be at least 6 characters long"
            }
        }
    });
	
  });


</script>

</body>
</html>
 