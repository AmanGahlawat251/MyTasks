<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>404 Page not found</title>
  <?php include_once("includes/header.php"); ?>
  <?php include_once("includes/sidebar.php"); ?>    


  <div style="" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Not Authorised Resource</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">404 Error</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">           
              <div class="card">
                <div class="card-content">
                <div class="error-content">
       <center> 
         <img style="width:50%;" src="https://www.joomlart.com/content/uploads/sites/4/2017/10/1508825193396.jpg" />
        
          
         <p style="font-size:30px; margin-top:30px;">
           
            
            <a class="btn btn-primary" style="color:#fff;" href="<?php echo $_SESSION['dashboard']; ?>"><i class="fas fa-home"></i> Home</a>       </p></center>

          
        </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  
  </div>
<!-- /.content-wrapper -->
<?php include_once("includes/footer.php") ; ?>
</body>
</html>  