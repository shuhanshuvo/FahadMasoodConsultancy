<?php 

$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/../lib/Session.php';
Session::init();

 ?>


<?php

  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Fahad Masood</title>
        <link rel="stylesheet" href="inc/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
</head>

<?php 
    if(isset($_GET['action']) && $_GET['action']=='logout' ){
    	Session::destroy();
        echo "<script>window.open('login.php','_self')</script>";
    }

     
 ?>


<body>

<header>
	<div class="container navbar-fixed-top">
	    <nav class="navbar navbar-default ">
			      <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
					    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							        <span class="sr-only">Toggle navigation</span>
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
							        <span class="icon-bar"></span>
				        </button>
			      <a class="navbar-brand" href="Index.php">Fahad Masood</a>
			    </div>

			    
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav pull-right">
				        <?php 

                         $id = Session::get('id');
                         $userlogin = Session::get('login');
                         if($userlogin === true){
				        ?>

				        	<?php 

							    $path = $_SERVER['SCRIPT_FILENAME'];
							    $currentPage = basename($path,'.php');

							 ?>

				         <li
                        <?php if($currentPage =='index'){ echo 'class="active"'; } ?>
				         ><a href="index.php">Home</a></li>

				         <li
                          <?php if($currentPage =='upload'){ echo 'class="active"'; } ?>
				         ><a href="upload.php">Add Document</a></li>

				         <li
                         <?php if($currentPage =='documents'){ echo 'class="active"'; } ?>
				         ><a href="documents.php?id= <?php echo $id; ?>">My Documents</a></li>

				         <li
				          <?php if($currentPage =='profile'){ echo 'class="active"'; } ?>
				          ><a href="profile.php?id= <?php echo $id; ?>">Profile</a></li>

				         <li
				          <?php if($currentPage =='changepass'){ echo 'class="active"'; } ?>
				          > <a href="changepass.php?id= <?php echo $id; ?>" >Change Password</a></li>

				        

				          <li><a href="?action=logout">Logout</a></li> 

				          <?php } else{ ?>

				          <?php 

							    $path = $_SERVER['SCRIPT_FILENAME'];
							    $currentPage = basename($path,'.php');

						 ?>	

				         <li
				          <?php if($currentPage =='login'){ echo 'class="active"'; } ?>
				          ><a href="login.php" >LogIn</a></li> 

				         <li
				          <?php if($currentPage =='register'){ echo 'class="active"'; } ?>
				          ><a href="register.php">Register</a></li>   
				          <?php } ?>        
				      </ul>
			    
			    </div><!-- /.navbar-collapse -->
        </nav>
    </div>
</header>