<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-olive ">
    <!-- Brand Logo -->
    
	<a href="<?php echo 'index.php?'.$mysqli->encode("stat=dashboard_new&type=dashboard_new");?>" class="brand-link">
      <img src="dist/img/cf_ogo.png" alt="MEDS" class="brand-image" style="margin-left:3px !important; width: 40px !important;">
      <span style="font-family: 'Spicy Rice', cursive;" class="brand-text font-weight-light"><?php echo APP_FULL_NAME; ?></span>
    </a>
    
     <?php
     
      if($_SESSION['profile_pic'] != "")
      {
          $profile_pic  = $_SESSION['profile_pic'];
      }
      else
      {
          $profile_pic  = "dist/img/user4-160x160.jpg";
      }
    ?>
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/profile_pic20220503122947.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0);<?php //echo 'index.php?'.$mysqli->encode("stat=profile");?>" class="d-block"><?php echo $_SESSION['name']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column " data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item ">
                <?php $href = 'index.php?'.$mysqli->encode("stat=admin_dashboard");?>
                <a href="<?php echo $href; ?>" class="nav-link <?php if($stat == 'admin_dashboard' || $stat == '') { echo "active"; } ?>">
                  <i class="nav-icon fas fas fa-file-alt"></i>
                  <p>University Data</p>
                </a>
          </li>
		  <li class="nav-item ">
                <?php $href = 'index.php?'.$mysqli->encode("stat=user_details");?>
                <a href="<?php echo $href; ?>" class="nav-link <?php if($stat == 'user_details' || $stat == '') { echo "active"; } ?>">
                  <i class="nav-icon fas fas fa-envelope"></i>
                  <p>Leads</p>
                </a>
          </li>
		 <!-- <li class="nav-item ">
                <?php $href = 'index.php?'.$mysqli->encode("stat=configuration");?>
                <a href="<?php echo $href; ?>" class="nav-link <?php if($stat == 'configuration' || $stat == '') { echo "active"; } ?>">
                  <i class="nav-icon fas fas fa-cog"></i>
                  <p>Config</p>
                </a>
          </li>-->
		  <li class="nav-item ">
                <?php $href = 'index.php?'.$mysqli->encode("stat=education_configuration");?>
                <a href="<?php echo $href; ?>" class="nav-link <?php if($stat == 'education_configuration' || $stat == '') { echo "active"; } ?>">
                  <i class="nav-icon fas fas fa-graduation-cap"></i>
                  <p>Education Config</p>
                </a>
          </li> 
		  <!--<li class="nav-item ">
                <?php $href = 'index.php?'.$mysqli->encode("stat=person");?>
                <a href="<?php echo $href; ?>" class="nav-link <?php if($stat == 'person' || $stat == '') { echo "active"; } ?>">
                  <i class="nav-icon fas fas fa-graduation-cap"></i>
                  <p>Education Config</p>
                </a>
          </li>-->
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div style="display:block;" id="loading">
    <div id="spinner"><img src="img/loader-white.gif" style="width:100px;"/></div>
  </div>