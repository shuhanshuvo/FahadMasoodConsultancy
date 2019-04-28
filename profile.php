<?php  
  include 'inc/header.php';
?>

<?php 
 $userid   = session::get('usrId');
 $userrole = session::get('usrRole');  

 ?>


<style>
    .editpostimg img {
        border-radius: 6px;
        height: 120px;
        margin-top: 20px;
        width: 125px;
}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profile
            <small> Update your profile details ....</small>
        </h1>
    </section>
 
 <?php 

if($_SERVER['REQUEST_METHOD'] == 'POST'){

               $name     = mysqli_real_escape_string($db->link, $_POST['name']);
               $username = mysqli_real_escape_string($db->link, $_POST['username'] );
               $email    = mysqli_real_escape_string($db->link, $_POST['email'] );
               $details  = mysqli_real_escape_string($db->link,$_POST['details'] );
               $country  = mysqli_real_escape_string($db->link,$_POST['country'] );
               $company  = mysqli_real_escape_string($db->link,$_POST['company'] );
              
                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "img/".$unique_image;


 if(empty($name) || empty($username) || empty($email) || empty($details) || empty($country) || empty($company)){
              $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Field must not be empty</div>';
            }
elseif( filter_var($email,FILTER_VALIDATE_EMAIL) === false ){
               $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Invalid email address .</div>";

           }


 else{ 

if(!empty( $file_name) ){ 

      if ($file_size >1048567) {
            $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Image Size should be less then 1MB!</div>';
          } 

      elseif (in_array($file_ext, $permited) === false) {
            $msg = '<div class="alert alert-danger"><strong>Error ! </strong>You can upload only:-'
             .implode(', ', $permited).'</div>';
          } 

      else{  
              move_uploaded_file($file_temp, $uploaded_image);

              $query ="UPDATE users SET
                 name        = '$name',
                 username    = '$username',
                 email       = '$email',
                 details     = '$details',
                 country     = '$country',
                 company     = '$company',
                 image      = '$uploaded_image'

                 WHERE id='$userid'   "; 
           

              $updated_rows = $db->update($query);
              if ($updated_rows) {
                  $msg = '<div class="alert alert-success"><strong>Success ! </strong>Data updated Successfully</div>';
              }else {
                   $msg = '<div class="alert alert-danger"><strong>Error ! </strong>User data not updated.</div>';
              }

        }

      

    }

    else{

            $query ="UPDATE users SET
                 name        = '$name',
                 username    = '$username',
                 email       = '$email',
                 details     = '$details',
                 country     = '$country',
                 company     = '$company'
                
                 WHERE id='$userid'   "; 
           

              $updated_rows = $db->update($query);
              if ($updated_rows) {
                   $msg = '<div class="alert alert-success"><strong>Success ! </strong>Data updated Successfully</div>';
              } else {
                   $msg = '<div class="alert alert-danger"><strong>Error ! </strong>User data not updated.</div>';
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
<?php

     $query = "SELECT * FROM users WHERE id='$userid' AND role='$userrole ' ";
     $getuser = $db->select($query);
     if($getuser){ 
     while($result = $getuser->fetch_assoc() ){ 

 ?>          
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="box-body">
                                   
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="inputEmail3" value="<?php echo $result['name']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="username" class="form-control" id="inputEmail3" value="<?php echo $result['username']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="inputEmail3" value="<?php echo $result['email']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Country</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="country" class="form-control" id="inputEmail3" value="<?php echo $result['country']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Company</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="company" class="form-control" id="inputEmail3" value="<?php echo $result['company']; ?>">
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Upload Image</label>
                                    <div class="col-sm-10">
                                        
                                    <input type="file" id="exampleInputFile" name="image">

                                    <div class="editpostimg">
                                       <img src="<?php echo $result['image']; ?>" alt="">
                                    </div>

                                    </div>
                                </div>

                       

                                <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-2 control-label">Details</label>
                                  <div class="col-sm-10">
                                     <textarea class="form-control" rows="6" cols="8" name="details" placeholder="Add details in 180 character" required ><?php echo strip_tags($result['details']); ?></textarea>
                                  </div>
                                </div>

                            

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                             
                                <input type="submit" name="submit" class="btn btn-info pull-right" value="Update">
                            </div>
                            <!-- /.box-footer -->
                        </form>

                        <?php }  } ?>
                    </div>
                </div>
            </div>

        </div>



    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'inc/footer.php'; ?>
