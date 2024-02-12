<?php $pageno = 1; if($_POST['global_search_product_id'] == "") echo "<script>window.location.href='index.php';</script>"; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <?php include_once("includes/header.php"); ?>
  <title><?php echo APP_FULL_NAME ?> | Search Result</title>
  <?php include_once("includes/sidebar.php"); ?>    

	 

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Search Result of <u><?php echo $_POST['global_search_product_id']; ?></u></h1>
          </div><!-- /.col -->
          <div style="display:none" class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Search Result </li>
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
          
			<div class="col-12 col-sm-12 col-md-12 col-lg-12">             
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">Purchase History</h3>					
					</div>
					  <!-- /.card-header -->
					  <!-- body start -->
					<div class="table-responsive">
						<div class="card-body">
						<?php $sql = "SELECT I.order_id, I.type,  I.batch_no, I.purchase_amount, I.exp_date, I.quantity, I.mrp FROM ".ORDER_ITEMS." I LEFT JOIN ".PRODUCTS." P ON I.product_id = P.product_id WHERE (P.product_name = '".$mysqli->escape($_POST['global_search_product_id'])."' OR I.batch_no = '".$mysqli->escape($_POST['global_search_product_id'])."') and I.type='PURCHASE' GROUP BY I.order_id  ORDER BY I.order_item_id DESC LIMIT 15";
						$result = $mysqli->executeQry($sql);
						$num = $mysqli->num_rows($result);
						if($num > 0) 
						{						
						?>
							<table id="dynamic_table" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th><nobr>#</nobr></th>
										<th><nobr>View Invoice</nobr></th>
										<th><nobr>Invoice No.</nobr></th>		
										<th><nobr>Supplier Name</nobr></th>
										<th><nobr>Batch</nobr></th>
										<th><nobr>Purchase Amt</nobr></th>
										<th><nobr>MRP</nobr></th>
										<th><nobr>Quantity</nobr></th>
										<th><nobr>Exp Date</nobr></th>										
										<th><nobr>Date</nobr></th>				
									</tr>
								</thead>	
								<tbody id="tbody">
								<?php
								$table = "";
								$i = 1;
								while($rows = $mysqli->fetch_assoc($result))
								{
									extract($rows);
									if($type == 'SALE')
									{
										continue;
									}
									$query = "SELECT * FROM ".ORDERS." WHERE order_id = ".$order_id;
									$res = $mysqli->executeQry($query);
									$num1 = $mysqli->num_rows($res);
									if($num1 > 0)
									{
										$ro = $mysqli->fetch_assoc($res);
										extract($ro);
										$table .= "<tr>";
										$table .= "<td><nobr>".$i."</nobr></td>";
										$table .= "<td><nobr>";
										$po_link = $mysqli->encode('stat=po_details&order_id='.$order_id);
										$table .= "&nbsp;&nbsp;<a target='_blank' href='index.php?".$po_link."' class='btn btn-outline-info btn-xs'><span data-hover='tooltip' data-toggle='tooltip' data-id='".$mysqli->encode($order_id)."'  data-placement='top' title='Click here View' id='del".$order_id."' ><i class='fa fa-eye'></i></span></a>";
                                      
                                      $po_link = $mysqli->encode('stat=add_purchase&type=edit_purchase&order_id='.$order_id);
									$table .= "&nbsp;&nbsp;<a target='_blank' href='index.php?".$po_link."' class='btn btn-outline-info btn-xs'><span data-hover='tooltip' data-toggle='tooltip' data-id='".$mysqli->encode($order_id)."'  data-placement='top' title='Click here edit' id='".$order_id."' ><i class='fa fa-edit'></i></span></a>";
										$table .= "</nobr></td>"; 									
										$table .= "<td><nobr>".$vendor_invoice_no."</nobr></td>";									
										$table .= "<td><nobr>".$mysqli->GetNameByID(PERSON, 'id', 'name', $supplier_id)."</nobr></td>";				
										$table .= "<td><nobr>".$batch_no."</nobr></td>";				
										$table .= "<td><nobr>".$purchase_amount."</nobr></td>";				
										$table .= "<td><nobr>".$mrp."</nobr></td>";				
										$table .= "<td><nobr>".$quantity."</nobr></td>";				
										$table .= "<td><nobr>".$exp_date."</nobr></td>";				
										$table .= "<td><nobr>".$mysqli->formatdate($rectimestamp,"j-M-Y h:i:A")."</nobr></td>";
										$i++;
									}
								}
								echo $table;
								?>
								</tbody>
							</table>
						<?php } else { ?>
						<div class="alert alert-danger" role="alert">Sorry, no record found!</div>
						<?php  } ?>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-12 col-sm-12 col-md-8 col-lg-8">             
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">Sale History</h3>					
					</div>
					  <!-- /.card-header -->
					  <!-- body start -->
					<div class="table-responsive">
						<div class="card-body">
						<?php $sql = "SELECT I.order_id, I.type FROM ".ORDER_ITEMS." I LEFT JOIN ".PRODUCTS." P ON I.product_id = P.product_id WHERE (P.product_name = '".$mysqli->escape($_POST['global_search_product_id'])."' OR I.batch_no = '".$mysqli->escape($_POST['global_search_product_id'])."') and I.type='SALE' GROUP BY I.order_id  ORDER BY I.order_item_id DESC LIMIT 15";
						$result = $mysqli->executeQry($sql);
						$num = $mysqli->num_rows($result);
						if($num > 0) 
						{						
						?>
							<table id="dynamic_table" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th><nobr>#</nobr></th>
										<th><nobr>View</nobr></th>
										<th><nobr>Invoice No.</nobr></th>		
										<th><nobr>Customer Name</nobr></th>
										<th><nobr>Date</nobr></th>				
									</tr>
								</thead>	
								<tbody id="tbody">
								<?php
								$table = "";
								$i = 1;
								while($rows = $mysqli->fetch_assoc($result))
								{
									extract($rows);
									if($type == 'PURCHASE')
									{
										continue;
									}
									$query = "SELECT * FROM ".ORDERS." WHERE order_id = ".$order_id;
									$res = $mysqli->executeQry($query);
									$num1 = $mysqli->num_rows($res);
									if($num1 > 0)
									{
										$ro = $mysqli->fetch_assoc($res);
										extract($ro);
										$table .= "<tr>";
										$table .= "<td><nobr>".$i."</nobr></td>";
										$table .= "<td><nobr>";
										$po_link = $mysqli->encode('stat=order_details&order_id='.$order_id);
										$table .= "&nbsp;&nbsp;<a target='_blank' href='index.php?".$po_link."' class='btn btn-outline-info btn-xs'><span data-hover='tooltip' data-toggle='tooltip' data-id='".$mysqli->encode($order_id)."'  data-placement='top' title='Click here View' id='del".$order_id."' ><i class='fa fa-eye'></i></span></a>";
										$table .= "</nobr></td>"; 									
										$table .= "<td><nobr>".$invoice_number."</nobr></td>";									
										$table .= "<td><nobr>".$mysqli->GetNameByID(PERSON, 'id', 'name', $customer_id)."</nobr></td>";				
										$table .= "<td><nobr>".$mysqli->formatdate($rectimestamp,"j-M-Y h:i:A")."</nobr></td>";
										$i++;
									}
								}
								echo $table;
								?>
								</tbody>
							</table>
						<?php } else { ?>
						<div class="alert alert-danger" role="alert">Sorry, no record found!</div>
						<?php  } ?>
						</div>
					</div>
				</div>
			</div>
			
						<div class="col-12 col-sm-12 col-md-4 col-lg-4">             
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">Inventory Details</h3>					
					</div>
					  <!-- /.card-header -->
					  <!-- body start -->
					<div class="table-responsive">
						<div class="card-body">
						<?php $sql = "SELECT I.id, I.batch_no, I.quantity, P.unit_id FROM ".INVENTORY." I LEFT JOIN ".PRODUCTS." P ON I.product_id = P.product_id WHERE P.product_name = '".$mysqli->escape($_POST['global_search_product_id'])."' OR I.batch_no = '".$mysqli->escape($_POST['global_search_product_id'])."'  ORDER BY I.id DESC LIMIT 15";
						$result = $mysqli->executeQry($sql);
						$num = $mysqli->num_rows($result);
						if($num > 0) 
						{						
						?>
							<table id="dynamic_table" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th><nobr>#</nobr></th>
										<th><nobr>Batch No</nobr></th>
										<th><nobr>Quantity</nobr></th>				
									</tr>
								</thead>	
								<tbody id="tbody">
								<?php
								$table = "";
								$i = 1;
								while($rows = $mysqli->fetch_assoc($result))
								{
									extract($rows);	
									$pack_size = $mysqli->GetNameByID(PRODUCT_UNIT, 'unit_id', 'unit_value', $unit_id);
									$inventory = round($quantity/$pack_size,1); 								 
									$table .= "<tr>";
									$table .= "<td><nobr>".$i."</nobr></td>";		
									$table .= "<td><nobr>".$batch_no."</nobr></td>";									
									$table .= "<td><nobr>".$inventory."</nobr></td>";				
									$i++;
								}
								echo $table;
								?>
								</tbody>
							</table>
						<?php } else { ?>
						<div class="alert alert-danger" role="alert">Sorry, no record found!</div>
						<?php  } ?>
						</div>
					</div>
				</div>
			</div>
			

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          
           
        </div>
           
          

		
		
		
           
        
        
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
     
  </div>
<!-- /.content-wrapper -->
<?php include_once("includes/footer.php") ; 
?>
</body>
</html>