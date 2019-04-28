
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2018 <a href="http://fahadmasood.com">Fahad Masood</a>.</strong> All rights reserved.
</footer>


<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>



<script src="inc/jquery.download.js"></script>
<script src="inc/simple.fileupload.js"></script>

<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });

</script>



<script type="text/javascript">

  $(document).on("click", "a.myClass1", function () {
    $.fileDownload($(this).prop('href'), {
        preparingMessageHtml: " preparing for download, please wait...",
        failMessageHtml: "There was a problem generating your report, please try again."
    });
    return false; //this is critical
});
  </script>

<script>
  
  $("#upload").on("click",function(){

     $("#myfile").upload("adddocument.php",

      function(success){
         console.log("done",success);
     },

     function(prog,value){

        $("#prog").val(value);

     });

  });

</script>

</body>
</html>
