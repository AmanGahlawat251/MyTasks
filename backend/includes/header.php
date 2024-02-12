<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" /> 
<meta http-equiv="pragma" content="no-cache" />
 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/snackbar.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
   <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="plugins/tablesorter-master/css/theme.default.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  

  
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

.navbar-secondary {
    background-color: #28a745 !important;
}

.table td, .table th {
    padding: 0.4rem;
    vertical-align: middle;
    border-top: 1px solid #dee2e6;
}

.ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 160px;
  width:400px;
  padding: 5px 0;
  margin: 5px 0 0;
  list-style: none;
  height: 250px;
  color:#fff;
  font-size: 14px;
  text-align: left;
  background-color: #ced4da;
  border: 1px solid #17a2b8;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 3px;
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  background-clip: padding-box;
  
  max-height: 250px;
  overflow-y: auto;
  /* prevent horizontal scrollbar */
  overflow-x: hidden;
}

.ui-autocomplete > li > div {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.42857143;
  color: #333333;
  white-space: nowrap;
}

.ui-state-hover,
.ui-state-active,
.ui-state-focus {
  text-decoration: none;
  color: #262626;
  background-color: #f5f5f5;
  cursor: pointer;
}

.ui-helper-hidden-accessible {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

.sort{
    cursor:pointer;
}
.btn-outline-info {
  border-color: none !important;
}


</style> 
<link href="https://fonts.googleapis.com/css2?family=Spicy+Rice&display=swap" rel="stylesheet"> 
</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed accent-info control-sidebar-slide-open text-sm sidebar-collapse">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark  navbar-info">    
    
  <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
	    
       
    </ul>
	
<!--	<form method="post" action="<?php // echo 'index.php?'.$mysqli->encode("stat=global_search_view");?>" class="form-inline ml-5">
      <div style="min-width:400px;" class="input-group input-group-sm">
        <input class="form-control form-control-navbar" id="search_product_id" name="global_search_product_id" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  
    <p style="margin-left:600px; font-size:15px; margin-top:0px; color:#fff;"><b><?php // echo LOCATION; ?></b></p> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">      
      <!-- Notifications Dropdown Menu -->

     

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">
            
            <img style="max-width: 150px;" src="img/profile_pic20220503122947.png" class="img-circle" alt="User Image"> 
            <h5><?php echo $_SESSION['name']; ?> </h5>
            <h6><?php echo $_SESSION['login_id']; ?></h6>
            <h6><?php echo ucwords(str_replace("_"," ", $_SESSION['user_type'])); ?></h6>

          </span>
                              
          <div class="dropdown-divider"></div>
          <div style="padding:15px;" class="dropdown-item">
          <a href="<?php echo 'index.php?'.$mysqli->encode("stat=profile");?>" style="float:left" class="">
            <span class="btn btn-info btn-sm btn-flat"><i class="fas fa-user-circle mr-2"></i> Profile</span>            
          </a>
          <a href="<?php echo 'index.php?'.$mysqli->encode("stat=logout");?>" style="float:right" class="">
            <span class="btn btn-danger  btn-sm btn-flat"><i class="fas fa-sign-out-alt mr-2"></i> Sign out</span>            
          </a>
          <div>
            <p>&nbsp</p>          
            <p>&nbsp</p>          
          
                    
        </div>
      </li>

      
    </ul>
  </nav>
  <!-- /.navbar -->