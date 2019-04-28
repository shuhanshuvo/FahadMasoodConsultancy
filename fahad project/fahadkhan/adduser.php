<?php  
  include 'inc/header.php';
?>
  <?php  if(!session::get('usrRole')=='0'){  
   echo "<script>window.location='index.php';</script>";
 }
?>


</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add New Client
            <small> set client name, email, pass ....</small>
        </h1>
    </section>
 
        <?php 
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
              
               $username    = $fm->validation($_POST['username'] );
               $password    = $fm->validation(md5($_POST['password'] ) );
               $email        = $fm->validation($_POST['email'] );
               $role        = $fm->validation($_POST['role'] );

               
               $username     = mysqli_real_escape_string($db->link, $username);
               $password     = mysqli_real_escape_string($db->link, $password);
               $email         = mysqli_real_escape_string($db->link, $email);
               $role         = mysqli_real_escape_string($db->link, $role);
               


if( empty($username) ||   empty($password) || empty($role) || empty($email)  ){
  $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Field must not be empty</div>';
}

else{  
             $emailquery = "SELECT * FROM users WHERE email='$email' limit 1";
             $Chkemail = $db->select($emailquery);
            if( $Chkemail!=false){
               $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Email Already Exist !</div>';
            }

              else{
                       $query = "INSERT INTO users(username,password,role,email) VALUES ('$username','$password','$role','$email') ";
                       $userinsert = $db->insert($query);
                       if($userinsert){
                          $msg = '<div class="alert alert-success"><strong>Success ! </strong>User Created Successfully</div>';
                       }
                       else{
                           $msg = '<div class="alert alert-danger"><strong>Error ! </strong>User not Created</div>';
                       }
                    }
         }
  }

?>  


 <?php 
                                   
     if( isset( $msg ) ){
          echo $msg;
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
       
                        <form class="form-horizontal" action="" method="POST" >
                            <div class="box-body">
                                   
                                

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="Enter username...">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Enter email...">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control" id="inputEmail3" placeholder="Enter password...">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">User Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="role">
                                            <option>Select User type</option>
                                            <option value="0">Admin</option>
                                            <option value="1">Client</option>
                                            
                                       </select>
                                    </div>
                                </div>

                    

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                             
                                <input type="submit" name="submit" class="btn btn-info pull-right" value="Create">
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
