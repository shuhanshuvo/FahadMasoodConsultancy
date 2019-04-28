<!--
Author: pijush Karmakar
Author URL: https://impijush.com
-->



<?php  
include 'lib/session.php';
session::chkSession();
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
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Fahad Masood</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="dist/css/AdminLTE.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    </head>
    <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
    <!-- the fixed layout is not compatible with sidebar-mini -->

    <body class="hold-transition skin-green fixed sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="index.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>F</b>M</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Fahad</b>Masood</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

        <?php 
           if( isset($_GET['action']) && $_GET['action']=='logout' ){
               session::destroy();
               echo "<script>window.open('login.php','_self')</script>";
           }
        ?>

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo session::get('image'); ?>" class="user-image" >
                                    <span class="hidden-xs">Hello ! <?php echo session::get('username')?></span>
                                    
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo session::get('image'); ?>" class="img-circle" >

                                        <p>
                                           <?php echo session::get('name'); ?>
                                            <small><?php echo session::get('details'); ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="?action=logout" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            
                        </ul>
                    </div>
                </nav>
            </header>

 <!-- =============================================== -->

 

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo session::get('image'); ?>" class="img-circle">
            </div>

            <div class="pull-left info">
                <p><?php echo session::get('username'); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

             <li class="treeview">
                <a href="index.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="treeview">
                <a href="adddocument.php">
                    <i class="fa fa-file-pdf-o"></i> <span>Add Document</span>
                </a>
            </li>

            <li class="treeview">
                <a href="mydocument.php">
                    <i class="glyphicon glyphicon-book"></i> <span>My Documents</span>
                </a>
            </li>

            <li class="treeview">
                <a href="alldocument.php">
                    <i class="fa fa-book"></i> <span>All Documents</span>
                </a>
            </li>

<?php if(session::get('usrRole')=='0'){ ?>

            <li class="treeview">
                <a href="adduser.php">
                    <i class="fa fa-user-plus"></i> <span>Add Client</span>
                </a>
            </li>

 <?php } ?>

            <li class="treeview">
                <a href="userlist.php">
                    <i class="fa fa-group"></i> <span>Client List</span>
                </a>
            </li>

            <li class="treeview">
                <a href="profile.php">
                    <i class="fa fa-user"></i> <span>My Profile</span>
                </a>
            </li>

            <li class="treeview">
                <a href="changepassword.php?usrId=<?php echo session::get('usrId'); ?>">
                    <i class="glyphicon glyphicon-edit"></i> <span>Change Password</span>
                </a>
            </li>

            <li class="treeview">
                <a href="?action=logout">
                    <i class="glyphicon glyphicon-log-out"></i> <span>Sign Out</span>
                </a>
            </li>



        </ul>
    </section>
    <!-- /.sidebar -->
</aside>