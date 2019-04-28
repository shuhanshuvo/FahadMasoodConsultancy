
<?php  
  include 'inc/header.php';
  $id = session::get('usrId');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        My Documents
      </h1>
    </section>

      <?php 
               if (isset($_GET['deldoc'])) {

                       $deldoc = $_GET['deldoc'];
                       $query ="SELECT * FROM document WHERE doc_id='$deldoc' ";
                       
                        $getdata = $db->select($query);
                        if($getdata){
                          while($delfile = $getdata->fetch_assoc() ){
                                $delLink = $delfile['path'];
                                unlink($delLink);
                          }
                        }

                       $delquery = "DELETE FROM document WHERE doc_id = '$deldoc' ";
                       $deldata = $db->delete($delquery);


                  if($deldata){
                      $msg = "<div class='alert alert-success'><strong>Success ! </strong>Document deleted.</div>";
                    }
                  else{
                      $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Document not deleted</div>";
                    }
 
               }

       ?>

             
         <?php 
                if( isset($msg) ){
                  echo $msg;
                 }

          ?>
   
    <!-- Main content -->
    <section class="content">
       <div class="row">
         <div class="col-xs-12">
            <div class="box">
            <div class="box-body table-responsive">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                   <th>Serial No</th>
                   <th>Document Name</th>
                   <th>Document</th>
                   <th>Action</th>
                </tr>

                </thead>

                <tbody>

                  <?php 
                       
                       $query = "SELECT * FROM document WHERE id = '$id' ORDER BY doc_id DESC";
                       $alldoc = $db->select($query);
                       if($alldoc){
                          $i=0;
                          while($result = $alldoc->fetch_assoc() ){
                             $i++;
                 ?>

                <tr>

                    <td><?php echo $i; ?></td>
                    <td><?php echo $result['doc_name']; ?></td>
                    <td><?php echo basename($result['path']); ?></td>
                  
                   <td>
                        <a onclick=" return confirm('Are You Sure To Delete'); " href="?deldoc=<?php echo $result['doc_id']; ?>" class="btn btn-danger"> Delete</a>
                   </td>

                </tr>

                <?php } } else{  ?>
                    <tr>
                        <td colspan="4"> <h4 class="text-center">Data is not available. </h4> </td>
                    </tr>
                <?php } ?>

                </tbody>

                <tfoot>
                <tr>
                   <th>Serial No</th>
                   <th>Document Name</th>
                   <th>Document</th>
                    <th>Action</th>
                  
                </tr>
                </tfoot>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
         </div>
       </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php include 'inc/footer.php';?>