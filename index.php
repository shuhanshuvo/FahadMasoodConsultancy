<!--
Author: pijush Karmakar
Author URL: https://impijush.com
-->


<?php include 'inc/header.php';?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Welcome to Dashboard</small>
        </h1>
    </section>

    <!-- Main content -->
<section class="content">    
 <div class="box-body">
<?php 

// for client

$cquery = "SELECT * FROM users ORDER BY id DESC";
$result = mysqli_query($db->link,$cquery);
$user_no = $result->num_rows;

// my documents

$userid   = session::get('usrId');
$mquery = "SELECT * FROM document WHERE id = '$userid' ORDER BY doc_id DESC";
$result = mysqli_query($db->link,$mquery);
$mydoc_no = $result->num_rows;

// all documents
$aquery ="SELECT * FROM document ORDER BY doc_id DESC ";
$result = mysqli_query($db->link,$aquery);
$alldoc_no = $result->num_rows;


 ?>
       <div class="row">

        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php if($alldoc_no){  ?>
              <h3><?php echo $alldoc_no; ?></h3>
                <?php } else{  ?>
                <h3>0</h3>
                <?php } ?>

              <p>All Documents</p>
            </div>
            <div class="icon">
              <i class="fa fa-database"></i>
            </div>
            <a href="alldocument.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

      
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php if($mydoc_no){  ?>
              <h3><?php echo $mydoc_no; ?></h3>
                <?php } else{  ?>
                <h3>0</h3>
                <?php } ?>

              <p>My Documents</p>
            </div>
            <div class="icon">
              <i class="fa fa-hdd-o"></i>
            </div>
            <a href="mydocument.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       

     <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <?php if($user_no){  ?>
              <h3><?php echo $user_no; ?></h3>
                <?php } else{  ?>
                <h3>0</h3>
                <?php } ?>

              <p>All Client</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="userlist.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
        <!-- ./col -->
     



      </div>
    </div>  
</section>
        
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'inc/footer.php';?>