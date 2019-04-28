
<?php  
  include 'inc/header.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Client
        <small>client List</small>
      </h1>
    </section>

      <?php 
               if (isset($_GET['deluser'])) {
                       $deluser = $_GET['deluser'];
                       $delquery = "DELETE FROM users WHERE id='$deluser' ";
                       $deldata = $db->delete($delquery);
                  if($deldata){
                      $msg = "<div class='alert alert-success'><strong>Success ! </strong>Client deleted.</div>";
                    }
                  else{
                      $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Client not deleted</div>";
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
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Details</th>
                  <th>Image</th>
                  <th>Country</th>
                  <th>Company</th>
                   <?php  if(session::get('usrRole')=='0'){  ?> 
                  <th>Action</th>
                <?php } ?>
                </tr>
                </thead>

                <tbody>

                  <?php 
                       $query = "SELECT * FROM users ORDER BY id DESC";
                       $allUser = $db->select($query);
                       if($allUser){
                          $i=0;
                          while($result = $allUser->fetch_assoc() ){
                             $i++;
                 ?>

                <tr>

                    <td><?php echo $i; ?></td>
                    <td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['username']; ?></td>
                    <td><?php echo $result['email']; ?></td>
                    <td><?php echo $fm->textShorten($result['details'],300 ); ?></td>
                    <td><img src="<?php echo $result['image']; ?>"  height="60" width="60"></td>
                    <td><?php echo $result['country']; ?></td>
                    <td><?php echo $result['company']; ?></td>
                  
                  

                    <?php  if(session::get('usrRole')=='0'){  ?> 

                   <td>
                        <a onclick=" return confirm('Are You Sure To Delete'); " href="?deluser=<?php echo $result['id']; ?>" class="btn btn-danger"> Delete</a>
                   </td>

                   <?php } ?>
                </tr>

                <?php } } else{ ?>
                   <tr>
                        <td colspan="8"> <h4 class="text-center">Data is not available. </h4> </td>
                    </tr>
                <?php } ?>

                </tbody>

                <tfoot>
                <tr>
                  <th>Serial No</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Details</th>
                  <th>Image</th>
                  <th>Country</th>
                  <th>Company</th>
                   <?php  if(session::get('usrRole')=='0'){  ?> 
                  <th>Action</th>
                <?php } ?>
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