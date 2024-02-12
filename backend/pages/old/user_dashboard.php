<?php $pageno = 1;  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <?php include_once("includes/header.php"); ?>
  <title><?php echo APP_FULL_NAME ?> | Dashboard</title>
  <?php include_once("includes/sidebar.php");
  $date = date("Y-m-d");
  $cash = $total = $card = $wallet = "";
  //$sql = "SELECT COALESCE(sum(grand_total),0) as total, COALESCE(sum(case when payment_mode='Cash' then grand_total else 0 end),0) as cash , COALESCE(sum(case when payment_mode='Card' then grand_total else 0 end),0) as card , COALESCE(sum(case when payment_mode='Wallet' then grand_total else 0 end),0) as wallet FROM `tbl_orders` WHERE rectimestamp >= '".$date." 00:00:00' and rectimestamp <= '".$date." 23:59:59' and order_type = 'SALE' and order_by = '".$_SESSION['login_id']."'";
  $sql = "SELECT COALESCE(sum(grand_total),0) as total, COALESCE(sum(case when payment_mode='Cash' then grand_total else 0 end),0) as cash , COALESCE(sum(case when payment_mode='Card' then grand_total else 0 end),0) as card , COALESCE(sum(case when payment_mode='Customer_Wallet' then grand_total else 0 end),0) as customer_wallet , COALESCE(sum(case when payment_mode='Wallet' then grand_total else 0 end),0) as wallet FROM `tbl_orders` WHERE rectimestamp >= '".$date." 00:00:00' and rectimestamp <= '".$date." 23:59:59' and order_type = 'SALE'";
  $result = $mysqli->executeQry($sql);
  $mysqli->num_rows($result); 
  if($mysqli->num_rows($result) > 0 )
  {
    $row = $mysqli->fetch_assoc($result);
    //print_r($row); exit;
    extract($row);
  }
  ?>    

	

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php if(isset($_SESSION['name'])) { echo ucwords($_SESSION['name'])."'s"; } ?> Dashboard</h1>
          </div><!-- /.col -->
          <div style="display:none" class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         
        
		<div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                 <span class="info-box-text">Total Sales</span>
                <span class="info-box-number">&#x20B9; <?php echo number_format($total,2); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-money-bill"></i></span>

              <div class="row">
                 <div class="col-6">     
                  <span class="info-box-text">Cash</span>
                <span class="info-box-number">&#x20B9; <?php echo number_format($cash,2); ?></span>
                 </div> 
                 <div style="display:none1;" class="col-6">     
                  <span class="info-box-text">Customer Wallet</span>
                  <span class="info-box-number">&#x20B9; <?php echo number_format($customer_wallet,2); ?></span>
                 </div> 
                  
               </div> 
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
 
          
          
           <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">E-Wallet</span>
                <span class="info-box-number">&#x20B9; <?php echo number_format($wallet,2); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-credit-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Credir/Debit Card</span>
                <span class="info-box-number">&#x20B9; <?php echo number_format($card,2) ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
          
          
          <?php
            $total_purchase = $mysqli->singleValue_new("tbl_orders"," COALESCE(sum(grand_total),0) as total_purchase"," order_type = 'PURCHASE'");
            $total_paid = $mysqli->singleValue_new("tbl_supplier_payment_details"," SUM(amount) as total_paid"," 1 ");
            $total_credit = $total_purchase - $total_paid;
           ?>
           
           <div onclick="total_credit_details();" style="cursor:pointer;" class="col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total credit</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format(round($total_credit),2); ?></span>
              </div>         
            </div>
          </div>
          
          
        </div>
		  
		
		<div class="row">           
          <!-- /.col -->
          <div class="col-12 col-sm-12 col-lg-3 col-md-3">
            <div onclick="window.location.href='<?php echo 'index.php?'.$mysqli->encode("stat=order&type=order");?>'" style="cursor:pointer;" class="col-md-12"> 
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>New Orders</h3> 
                  <p>Place a sale</p>
                </div>
                <div class="icon">
                  <i class="fas fa-shopping-cart"></i>
                </div> 
              </div>
            </div>
            <div onclick="window.location.href='<?php echo 'index.php?'.$mysqli->encode("stat=add_purchase&type=add_purchase");?>'" style="cursor:pointer;" class="col-md-12"> 
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>New Purchase</h3> 
                  <p>Add product to your inventory</p>
                </div>
                <div class="icon">
                  <i class="fas ion-stats-bars"></i>
                </div> 
              </div>
            </div>
            
            <div onclick="window.location.href='<?php echo 'index.php?'.$mysqli->encode("stat=person&type=customers");?>'" style="cursor:pointer;" class="col-md-12"> 
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo $mysqli->fetchRows(PERSON, "id", "type = 'CUSTOMER'"); ?> Customers</h3> 
                  <p>View Customers</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-plus"></i>
                </div> 
              </div>
            </div>
            
            <div onclick="window.location.href='<?php echo 'index.php?'.$mysqli->encode("stat=person&type=suppliers");?>'" style="cursor:pointer;" class="col-md-12"> 
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3><?php echo $mysqli->fetchRows(PERSON, "id", "type = 'SUPPLIER'"); ?> Suppliers</h3> 
                  <p>View Suppliers</p>
                </div>
                <div class="icon">
                  <i class="fas fa-truck"></i>
                </div> 
              </div>
            </div>
          </div>
          <!-- /.col -->
         
			<div class="col-12 col-sm-12 col-md-9 col-lg-9">
            <!-- general form elements -->
                <form onsubmit="return false;" id="frm_search" method="post" >
					<!-- /.card-body -->
                    <input type="hidden" class="form-control float-right" name = "search_date" id = "search_date">
					<input type='hidden' name='tab' value="<?php echo 'recent_orders_user'; ?>" />
					<input type="hidden" name="url" id="url" value="<?php echo "index.php?".$mysqli->encode("stat=table_response"); ?>" required>		  
					<input type="hidden" name="record_limit" id="record_limit" value="10"> 			
					<input type='hidden' name='download' id='download' value="" />		 
					<input type="hidden" name="page" id="page" value="<?php echo $pageno; ?>">  
				</form>
            <div class="card card-info">
              <div class="card-header">
				<h3 class="card-title">Recent Orders</h3>
				
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
		

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          
           
        </div>
           
          
            <input type='hidden' name='tab' value="<?php echo 'total_credit_details'; ?>" />			  			  
			<input type="hidden" name="url" id="url_credit_details" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>	
		
			<div class="modal" id="modal_total_credit">
  <div style="min-width: 70%;" class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Total Credit</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div id = "total_credit_body" class="modal-body">
         
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>

		
		
		
           
        
        
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
     
  </div>
<!-- /.content-wrapper -->
<?php include_once("includes/footer.php") ; 
include_once("includes/dynamic_table.php") ; 
?>
</body>
</html>