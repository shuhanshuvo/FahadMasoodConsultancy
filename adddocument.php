<?php  
  include 'inc/header.php';
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Document
            <small> add your documents ....</small>
        </h1>
    </section>
 
 <style>
   
/*  -------------  for progress bar --------- */


progress::-webkit-progress-bar {
    background-color: #f5f5f5;
}

progress::-moz-progress-bar { 
  background-color: #f5f5f5;  
}

progress::-webkit-progress-value {
  background-color: #337ab7;
}

.progress{
  width: 100%;
}


 </style>


<?php 

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){

               $doc_name = mysqli_real_escape_string($db->link, $_POST['doc_name']);
               $userid = mysqli_real_escape_string($db->link,$_POST['userid'] );

                
                $file_name = $_FILES['path']['name'];
                // $file_size = $_FILES['path']['size'];
                $file_temp = $_FILES['path']['tmp_name'];
                $uploaded_file = "documents/".basename($file_name);


if($doc_name=="" || $file_name=="" ){
      $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be empty</div>";
}

elseif(file_exists($uploaded_file)) {
             $msg = "<div class='alert alert-danger'><strong>Sorry ! </strong> file already exists</div>";
        }   

elseif($_FILES["path"]["size"] >10485760) {
     $msg = "<div class='alert alert-danger'><strong>Error ! </strong>File Size Should be less than 10MB!</div>";
    } 

else{
        move_uploaded_file($file_temp, $uploaded_file);

        $query = "INSERT INTO document(doc_name,path,id)
                  VALUES('$doc_name','$uploaded_file','$userid')";

        $inserted_rows = $db->insert($query);
        if ($inserted_rows) {
             $msg = "<div class='alert alert-success'><strong>Success ! </strong> File Uploaded Successfully. </div>";

        }else {
              $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Sorry ! there has been problem to upload. </div>";
        }

    }


 }

?>


 <?php 
     if(isset($msg) ){
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
      
                        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                            <div class="box-body">
                                   
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Document Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="doc_name" class="form-control" id="inputEmail3" >
                                    </div>
                                </div>

                               

                               <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Upload File</label>
                                    <div class="col-sm-10">
                                        
                                    <input type="file" id="myfile" name="path">
                                    <input type="hidden" name="userid" value="<?php echo session::get('usrId'); ?>" />

                                    </div>
                                </div>
                                
                                
                              
                              <div class="form-group">
                                  <label for="inputEmail3" class="col-sm-2 control-label"></label>
                                  <div class="col-sm-10">
                                  <progress class="progress" id="prog" value="0" min="0" max="100">
                                    <div class="progress">
                                  
                                    </div>
                               </progress>
                             </div>
                             </div>

                       
                            

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                             
                                <button type="submit" id="upload" name="submit" class="btn btn-info pull-right">Upload </button>
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
