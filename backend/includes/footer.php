<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a target="_blank" href="<?php echo APP_URL; ?>"><?php echo APP_FULL_NAME; ?></a>.</strong>
    All rights reserved.
     
  </footer>
<input type="hidden" name="loadProductUrl" id="loadProductUrl" value="<?php echo "index.php?".$mysqli->encode("stat=ajax&tab=loadProductUrl"); ?>" required>
<div id="snackbar"></div>
  <!-- Control Sidebar -->
  <!-- <aside class="control-sidebar control-sidebar-dark"> -->
    <!-- Control sidebar content goes here -->
  <!-- </aside> -->
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
 
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
 
<!-- overlayScrollbars -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8" charset="UTF-8"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="dist/js/custom-script.js?<?php echo rand(); ?>"></script>
<script src="dist/js/jquery.sortElements.js?<?php echo rand(); ?>"></script>
<script src="dist/js/jquery.popupwindow.js"></script>
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script type="text/javascript" src="plugins/tablesorter-master/js/jquery.tablesorter.js"></script>
  <script type="text/javascript" src="plugins/tablesorter-master/js/jquery.tablesorter.widgets.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
 
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script src="plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">

  $( "#search_date" ).daterangepicker({
    format: "yyyy-mm-dd",		
      todayBtn: "linked",
	  autoUpdateInput: false,
      clearBtn: true,
      calendarWeeks: true,
      autoclose: true,
      todayHighlight: true,
      //datesDisabled: ['04/06/2017', '04/21/2017'],
      toggleActive: true
  });

  $(document).ready(function() {
    $("#loading").hide();  
	
	$('input[name="search_date"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
  });

  $('input[name="search_date"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
  
	
	setInterval("check_active_login();",60000); 
});
</script>
