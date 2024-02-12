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
                  Accounts
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" >
                <li class="nav-item">
                  <a target="_blank" href="<?php echo $href;?>" class="nav-link <?php if($stat == 'add_expenses' )  { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Expenses </p>
                  </a>
                </li> 
                <?php if($_SESSION['user_type'] == "SUPER_ADMIN")
                { ?>
                <li  class="nav-item">
                  <a target="_blank" href="<?php echo $href;?>" class="nav-link <?php if($stat == 'add_expenses') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Expenses</p>
                  </a>
                </li>
                <?php } ?>
              </ul>
          </li>
         
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link <?php if($type == 'customers') { echo "active"; } ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Customers
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=person&type=customers");?>" class="nav-link <?php if($stat == 'person') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Customer Details</p>
                  </a>
                </li>               
              </ul>
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
                    <p>New Order</p>
                  </a>
                </li>               
              </ul>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=order_without_bill&type=order");?>"" class="nav-link <?php if($stat == 'order') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Orders Without Bill</p>
                  </a>
                </li>               
              </ul>
              
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=order_history&type=order_history");?>"" class="nav-link <?php if($stat == 'order_history') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Order History</p>
                  </a>
                </li>               
              </ul>
          </li>
          
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link <?php if($stat == 'add_purchase_order' || $stat == 'add_purchase' || $stat == 'view_purchase_order' ) { echo "active"; } ?>">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Purchase
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=add_purchase&type=add_purchase");?>"" class="nav-link <?php if($stat == 'add_purchase') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Purchare</p>
                  </a>
                </li>               
              </ul>              
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=view_purchase_order&type=view_purchase");?>"" class="nav-link <?php if($stat == 'view_purchase_order') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Purchase</p>
                  </a>
                </li>               
              </ul>
               <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=view_po_order&type=view_po");?>"" class="nav-link <?php if($stat == 'view_po_order') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View PO</p>
                  </a>
                </li>               
              </ul>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=purchase_return&type=purchase_return");?>"" class="nav-link <?php if($stat == 'purchase_return') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Purchase Return</p>
                  </a>
                </li>               
              </ul>
              <!--<ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Purchase Entry</p>
                  </a>
                </li>               
              </ul>-->
          </li>
          
          
          <li class="nav-item has-treeview">
              <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=order_book&type=Shortage Book");?>"" class="nav-link <?php if($stat == 'order_book') { echo "active"; } ?>">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Shortage Book
                </p>
              </a>
          </li>
          
          <li style="display:none1;" class="nav-item has-treeview">
              
              <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=order_book_rh&type=Order Book RH");?>"" class="nav-link <?php if($stat == 'order_book_rh') { echo "active"; } ?>">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Order Book
                </p>
              </a>
          </li>
          
          <li class="nav-item has-treeview active">
              <a href="#" class="nav-link <?php if($stat == 'products' || $stat == 'categories' || $stat == 'product_unit') { echo "active"; } ?>">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Products
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=products&type=products");?>" class="nav-link <?php if($stat == 'products') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Details</p>
                  </a>
                </li>               
              </ul>

              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=categories&type=categories");?>" class="nav-link <?php if($stat == 'categories') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Categories</p>
                  </a>
                </li>               
              </ul>
              
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=product_unit&type=product_unit");?>" class="nav-link <?php if($stat == 'product_unit') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Units</p>
                  </a>
                </li>               
              </ul>
              
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=product_company&type=Product Companies");?>" class="nav-link <?php if($stat == 'product_company') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Companies</p>
                  </a>
                </li>               
              </ul>
          </li>
          
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link <?php if($type == 'suppliers') { echo "active"; } ?>">
                <i class="nav-icon fas fa-truck"></i>
                <p>
                  Suppliers
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=person&type=suppliers");?>" class="nav-link <?php if($type == 'suppliers') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Supplier Details</p>
                  </a>
                </li>               
              </ul>             
          </li>
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
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Reports
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li style="display: none;" class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=order_book&type=Order Book");?>"" class="nav-link <?php if($stat == 'order_book') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Order Book</p>
                  </a>
                </li>               
              </ul>              
              
              <ul class="nav nav-treeview" style="display: none1;">
                <li style="display: none1;" class="nav-item">
                   <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=itemwise_sale_report&type=Itemwise Sale Report");?>"" class="nav-link <?php if($stat == 'itemwise_sale_report') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Item Wise Sale Report</p>
                  </a>
                </li>               
              </ul>
              <ul class="nav nav-treeview" >
                <li  class="nav-item">
                   <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=payment_report&type=Payment Report");?>"" class="nav-link <?php if($stat == 'payment_report') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Payment Report</p>
                  </a>
                </li>               
              </ul>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=customer_sale_report&type=Customer Sale Report");?>"" class="nav-link <?php if($stat == 'customer_sale_report') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Customer Wise Sale Report</p>
                  </a>
                </li>               
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=product_expiring_soon&type=Product Expiring Soon");?>"" class="nav-link <?php if($stat == 'product_expiring_soon') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Product Expiring Soon</p>
                  </a>
                </li>               
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=consolidated_sales_report&type=Consolidated Sales Report");?>"" class="nav-link <?php if($stat == 'consolidated_sales_report') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Consolidated Sales Report</p>
                  </a>
                </li>               
              </ul>
              
              <ul class="nav nav-treeview">
                <li  class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=consolidated_purchase_report&type=Consolidated Purchase Report");?>"" class="nav-link <?php if($stat == 'consolidated_purchase_report') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Consolidated Purchase</p>
                  </a>
                </li>               
              </ul>
              <ul class="nav nav-treeview">
                <li  class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=consolidated_profit_loss&type=Consolidated Sale Purchase");?>"" class="nav-link <?php if($stat == 'consolidated_profit_loss') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <!--<p>Consol. Profit Loss</p>-->
                    <p>Consol. Sale/Purchase</p>
                  </a>
                </li>               
              </ul>
              
              <ul class="nav nav-treeview">
                <li  class="nav-item">
                  <a target="_blank" href="<?php echo 'index.php?'.$mysqli->encode("stat=consolidated_sale_purchase_gst_report&type=Consolidated Sale Purchase Tax");?>"" class="nav-link <?php if($stat == 'consolidated_profit_loss') { echo "active"; } ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <!--<p>Consol. Profit Loss</p>-->
                    <p>Consol. Sale/Purchase Tax</p>
                  </a>
                </li>               
              </ul>
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