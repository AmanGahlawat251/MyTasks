<?php $pageno = 1; 
if($_SESSION['user_type'] == "ATTENDANCE")
{
	echo "<script language='javascript' type='text/javascript'>";
    echo "</script>";
    $URL="index.php?".$mysqli->encode('stat=add_attendance&type=attendance');
	echo "<script>location.href='$URL'</script>";
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <?php include_once("includes/header.php"); ?>
  <title><?php echo APP_FULL_NAME ?> | Dashboard New</title>
  <?php include_once("includes/sidebar.php");
  if(isset($_POST['search_date']) && $_POST['search_date'] != "")
  {
      $arr_date = explode(" - ", $_POST['search_date']);
      $date1 = date("m/d/Y",strtotime($arr_date[0]));
      $date2 = date("m/d/Y",strtotime($arr_date[1]));
      
  }
  else
  {
    $date1 = $date2 = date("m/d/Y");
  }
  $total_purchase = $total_tax_amount_purchase = $cash = $total = $card = $wallet = $total_tax_amount = $margin = "";
  $sql = "SELECT COALESCE(sum(case when order_type='PURCHASE' then grand_total else 0 end),0) as total_purchase, COALESCE(sum(case when order_type='PURCHASE' then total_tax_amount else 0 end),0) as total_tax_amount_purchase, COALESCE(sum(case when order_type='SALE' then grand_total else 0 end),0) as total, COALESCE(sum(case when order_type='SALE' then total_tax_amount else 0 end),0) as total_tax_amount, COALESCE(sum(case when order_type='SALE' then margin else 0 end),0) as margin, COALESCE(sum(case when (payment_mode='Cash' and order_type='SALE')  then grand_total else 0 end),0) as cash , COALESCE(sum(case when (payment_mode='Card' and order_type='SALE') then grand_total else 0 end),0) as card , COALESCE(sum(case when (payment_mode='Wallet' and order_type='SALE') then grand_total else 0 end),0) as wallet FROM `tbl_orders` WHERE rectimestamp >= '".date("Y-m-d",strtotime($date1))." 00:00:00' and rectimestamp <= '".date("Y-m-d",strtotime($date2))." 23:59:59'";
  $result = $mysqli->executeQry($sql);
  $mysqli->num_rows($result); 
  if($mysqli->num_rows($result) > 0 )
  {
    $row = $mysqli->fetch_assoc($result);
    //print_r($row); exit;
    extract($row);
  }
  
  /*
  $total_items_sold = $total_return_products = "";
  $sql = "SELECT COALESCE(count(*),0) as total_items_sold, COALESCE(sum(case when return_item=1 then 1 else 0 end),0) as total_return_products FROM `tbl_order_items` WHERE rectimestamp >= '".date("Y-m-d",strtotime($date1))." 00:00:00' and rectimestamp <= '".date("Y-m-d",strtotime($date2))." 23:59:59' and type = 'SALE'";
  $result = $mysqli->executeQry($sql);
  $mysqli->num_rows($result); 
  if($mysqli->num_rows($result) > 0 )
  {
    $row = $mysqli->fetch_assoc($result);
    extract($row);
  }
  */
  
  $total_items_sold = $total_return_products = $total_allopathic_sale = $total_ayurvedic_sale = $total_home_care_sale = $total_allopathic_pur = $total_ayurvedic_pur = $total_home_care_pur = "";
  $sql = "SELECT COALESCE(sum(case when (i.type='SALE') then 1 else 0 end),0) as total_items_sold, COALESCE(sum(case when (i.type='PURCHASE') then 1 else 0 end),0) as total_items_purchase, COALESCE(sum(case when i.return_item=1 then 1 else 0 end),0) as total_return_products  , COALESCE(sum(case when (i.type='PURCHASE' and (c.category_id = 92 OR c.category_id = 93)) then 1 else 0 end),0) as total_allopathic_pur, COALESCE(sum(case when (i.type='SALE' and (c.category_id = 92 OR c.category_id = 93)) then 1 else 0 end),0) as total_allopathic_sale, COALESCE(sum(case when (i.type='PURCHASE' and c.category_id = 2) then 1 else 0 end),0) as total_ayurvedic_pur, COALESCE(sum(case when (i.type='SALE' and c.category_id = 2) then 1 else 0 end),0) as total_ayurvedic_sale, COALESCE(sum(case when (i.type='PURCHASE' and c.category_id = 14) then 1 else 0 end),0) as total_home_care_pur, COALESCE(sum(case when (i.type='SALE' and c.category_id = 14) then 1 else 0 end),0) as total_home_care_sale FROM `tbl_order_items` i LEFT JOIN tbl_products p ON p.product_id = i.product_id LEFT JOIN  tbl_category c on p.category_id = c.category_id WHERE i.rectimestamp >= '".date("Y-m-d",strtotime($date1))." 00:00:00' and i.rectimestamp <= '".date("Y-m-d",strtotime($date2))." 23:59:59'";
  $result = $mysqli->executeQry($sql);
  $mysqli->num_rows($result); 
  if($mysqli->num_rows($result) > 0 )
  {
    $row = $mysqli->fetch_assoc($result);
    extract($row);
  }
  
  
  /* 
  $sql = "SELECT COALESCE(sum(grand_total),0) as total_purchase FROM `tbl_orders` WHERE order_type = 'PURCHASE'";
  $result = $mysqli->executeQry($sql);
  $mysqli->num_rows($result); 
  if($mysqli->num_rows($result) > 0 )
  {
    $row = $mysqli->fetch_assoc($result);
    extract($row);
  }
  */
  $total_purchase = $mysqli->singleValue_new("tbl_orders"," COALESCE(sum(grand_total),0) as total_purchase"," order_type = 'PURCHASE' and rectimestamp >= '".date("Y-m-d",strtotime($date1))." 00:00:00' and rectimestamp <= '".date("Y-m-d",strtotime($date2))." 23:59:59'");
  $total_paid = $mysqli->singleValue_new("tbl_supplier_payment_details"," SUM(amount) as total_paid"," 1 and rectimestamp >= '".date("Y-m-d",strtotime($date1))." 00:00:00' and rectimestamp <= '".date("Y-m-d",strtotime($date2))." 23:59:59'");
  $total_credit = $total_purchase - $total_paid;
  
  #total stoke MRP Start
  $sql_stoke = "Select * from tbl_inventory where quantity > 0";
  $result_stoke = $mysqli->executeQry($sql_stoke);
  $num_stoke = $mysqli->num_rows($result_stoke); 
  $arr_mrp = array();
  $arr_cost = array();
  if($num_stoke > 0)
  {
    while($row = $mysqli->fetch_assoc($result_stoke))
	{
		extract($row);
		$sql_items = "SELECT * FROM `tbl_order_items` WHERE product_id = ".$product_id." and batch_no = '".$batch_no."' and mrp=".$mrp." and  type = 'PURCHASE' and pack_size IS NOT NULL";
		$result_items = $mysqli->executeQry($sql_items);
		$num_items = $mysqli->num_rows($result_items);
		if($num_items > 0)
		{
			while($row_items = $mysqli->fetch_object($result_items))
			{
				//echo "quantity : ".$quantity; exit;
				//print_r($row_items); exit;
				if($row_items->active > 0)
				{
					$arr_mrp['mrp'][] = ($quantity/$row_items->pack_size) * $row_items->mrp;
					$arr_mrp['purchase_amount'][] = ($quantity/$row_items->pack_size) * $row_items->purchase_amount;
				}
				$arr_mrp['product_id'][] = $product_id;
				$arr_mrp['batch_no'][] = $batch_no;
				$arr_mrp['quantity'][] = $mysqli->showQuantity($row_items->pack_size, $quantity);
			} 
		}
	 }
  }
  #total stoke MRP End
  
  
  
  ?>    
   
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div style="display:none1" class="col-sm-6">
            <!--<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>-->
           <div class="form-group float-right">
            <form name="frm_dash" id="frm_dash" method="post" action ="" >
              <div style="max-width:280px;" class="input-group">                  
                  <input  type="text" class="form-control" value="<?php echo $date1." - ".$date2; ?>" name = "search_date" id = "search_date">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
              </div>
            </form>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         
        
		<div class="row">
          
		  <div class="col-12 col-sm-12 col-md-12">
		  <center style=""><u><h3>Sale Details</h3></u></center></br>
		  </div>
		  
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total Sales</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format($total,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total Tax</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format($total_tax_amount,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total Margin</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format($margin,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Cash</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format($cash,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>E-Wallet</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format($wallet,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Credir/Debit Card</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format($card,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Payment Pending</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format(0,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total Return Products</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number"><?php echo number_format($total_return_products,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total items sold</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number"><?php echo number_format($total_items_sold,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total Allopathic Products</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number"><?php echo number_format($total_allopathic_sale,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total Ayurvedic Products</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number"><?php echo number_format($total_ayurvedic_sale,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total Home Care Products</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number"><?php echo number_format($total_home_care_sale,2); ?></span>
              </div>         
            </div>
          </div>
		  
	</div>
  
	<div class="row">          
		  <div class="col-12 col-sm-12 col-md-12">
		 </br> <center style=""><u><h3>Purchase Details</h3></u></center></br>
		  </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total Purchase</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format($total_purchase,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total Payment to supplier</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format($total_paid,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total Tax</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format($total_tax_amount_purchase,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total items purchase</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number"><?php echo number_format($total_items_purchase,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total Allopathic Products</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number"><?php echo number_format($total_allopathic_pur,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total Ayurvedic Products</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number"> <?php echo number_format($total_ayurvedic_pur,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total Home Care Products</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number"><?php echo number_format($total_home_care_pur,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Return to supplier</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format($card,2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total stoke MRP</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format(array_sum($arr_mrp['mrp']),2); ?></span>
              </div>         
            </div>
          </div> 
		  
		   <div class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total stoke cost</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format(array_sum($arr_mrp['purchase_amount']),2); ?></span>
              </div>         
            </div>
          </div>
		  
		  <div onclick="total_credit_details();" style="cursor:pointer;" class="col-12 col-sm-6 col-md-2">
            <div class="info-box">
              <div class="info-box-content">
				<span style = "font-size: 16px;" class="info-box-text" ><b>Total credit</b></span>
                <span style = "font-size: 15px; font-weight:500;"  class="info-box-number">&#x20B9; <?php echo number_format(round($total_credit),2); ?></span>
              </div>         
            </div>
          </div>
		   
			<input type='hidden' name='tab' value="<?php echo 'total_credit_details'; ?>" />			  			  
			<input type="hidden" name="url" id="url_credit_details" value="<?php echo "index.php?".$mysqli->encode("stat=ajax"); ?>" required>	
			 
		  
	</div>
      
      </div><!-- /.container-fluid -->
    </section>
	
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
</div>

     
  </div>
<!-- /.content-wrapper -->
<?php include_once("includes/footer.php") ; 
  
?>
<script>
$(document).ready(function(){
    $('#search_date').on('apply.daterangepicker', function() {
        $('#frm_dash').submit();
    });
})
</script>
</body>
</html>