<?php 
include 'inc/header.php';
include 'lib/User.php';
Session:: checkSession();
 ?>



<div class="user-table">
	<div class="container">

	<?php 

   

    // $id = Session::get('id');

    // if(isset($_GET['id']) ){
    //        $userid = (int)$_GET['id'];
    //  }

    $user = new User();

     if( $_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']) ){
       $upload_doc = $user->UploadDocument($_POST,$_FILES);

   }



	 ?>
		 <div class="panel panel-default">
				<div class="panel-heading">
					<h3>Add Document </h3>
				</div>
                
                <div class="panel-body" style="width:550px; margin: 0 auto;">
             
              <?php 
                 if(isset($upload_doc) ){
                 	echo $upload_doc;
                 }
              ?>

            
                

                <form action="" method="POST" enctype= multipart/form-data>

                	    

                       <div class="form-group">
		                    <label for="doc_name">Document Name</label>
	                        <input type="text" class="form-control" placeholder="Enter document name" name="doc_name" id="doc_name">
	                    </div>

	                    
                	   <div class="form-group">
		                    <label for="path">Upload Document</label>
	                        <input type="file" id="myfile" class="form-control"  name="path" id="path">
	                    </div>

                       <progress class="progress" id="prog" value="0" min="0" max="100">
                          <div class="progress">
                            
                          </div>
                      </progress>

	                    <button type="submit" id="upload" class="btn btn-primary" name="submit">Upload</button>
	                   
	                    
                </form>

                </div>
	            

         </div>
	</div>
</div>



<?php 
include 'inc/footer.php';
 ?>

