<?php  
  include 'inc/header.php';
  
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Password
        </h1>
    </section>
 
<?php 

   if(isset($_GET['usrId']) ){
           $usrId = (int)$_GET['usrId'];
           $Session_id = session::get('usrId');

           if($usrId != $Session_id){
                echo "<script>window.open('index.php','_self')</script>";
              }
     }

     $db = new Database(); 

     if( $_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updatepass']) ){
       $updatePass = $db->UpdatePassword( $usrId,$_POST);

   }
 
   
 ?> 

  <?php 
                                   
     if( isset( $updatePass ) ){
               echo $updatePass;
        }

 ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">

                        <!-- /.box-header -->
                        <!-- form start -->
         
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="box-body">

                                   
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="old_pass" class="form-control" id="inputEmail3" placeholder="Enter old Password...">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control" id="inputEmail3" placeholder="Enter New Password...">
                                         <input type="hidden" name="usrId" value="<?php echo session::get('usrId'); ?>">
                                    </div>
                                </div>

                             

                            

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                             
                                <input type="submit" name="updatepass" class="btn btn-info pull-right" value="Update">
                            </div>
                            <!-- /.box-footer -->
                        </form>

                        
                    </div>
                </div>
            </div>

        </div>



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'inc/footer.php'; ?>
