<?php  include 'lib/session.php';
       session::chkLogin();
 ?>
<?php 
  include 'config/config.php';
  include 'lib/Database.php';
  include 'helpers/format.php';

 ?>

 <?php 
    $db =  new Database();
    $fm =  new format();
 ?>

  <?php 
        if ($_SERVER['REQUEST_METHOD']=='POST') {

           $email = $fm->validation($_POST['email'] );
           $password = $fm->validation(md5($_POST['password'] ) );
            
             $email = mysqli_real_escape_string($db->link, $email);
             $password = mysqli_real_escape_string($db->link, $password);

             $query = "SELECT * FROM users WHERE email='$email' AND password='$password' ";
             $result = $db->select($query);
             if($result != false){
              // $value = mysqli_fetch_array($result);
                    $value = $result->fetch_assoc() ;

                     session::set('login', true);
                     session::set('name', $value['name'] );
                     session::set('username', $value['username'] );
                     session::set('image', $value['image'] );
                     session::set('details', $value['details'] );
                     session::set('usrId', $value['id'] );
                     session::set('usrRole', $value['role'] );
                     echo "<script>window.open('index.php','_self')</script>";              
             }

             else{

                $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Username or Password not match !!!</div>";
             }

        }
  ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LogIn</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

</head>


<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="login.php"><b>LogIn</b></a>

        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            
     
<?php 

if (isset($msg)) {
    echo $msg;
}


 ?>

    </span>
            <form action="" method="POST">

                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="email" name="email" required="">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <input type="submit" name="login" class="btn btn-primary btn-block btn-flat" value="Sign In">

        </form>

           <div class="social-auth-links text-center">
                <p>---</p>
                <a href="#">Fahad Masood</a>
            </div> 

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->


    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
