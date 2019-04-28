<?php 
include 'inc/header.php';
include 'lib/User.php';
Session:: checkSession();
$user = new User();



 ?>



<div class="user-table">
	<div class="container">

  <?php 
     if(isset($_GET['id']) ){
       $userid = (int)$_GET['id'];
     }

 ?>

		 <div class="panel panel-default">
				
				<div class="panel-heading">
					<h3> Documents <span class="pull-right"><a class="btn btn-primary" href="upload.php">Add Documents</a></span></h3>
				</div>
                
                <div class="panel-body table-responsive">
                	
	                    <table class="table table-striped">

	                    	<tr>
	                    		<th width="21%">Serial</th>
	                    		<th width="21%">Document Name</th>
	                    		<th width="10%">Document</th>
	                    	</tr>

                         <?php 
                               
                                
                               $user = new User();
                               $user_doc = $user->getDocByUser($userid);
                               
                               if($user_doc){
                               	$i=0;
                               	foreach ($user_doc as $sdata) {
                               	$i++;
                               	
	                     ?>

	                    	<tr>
	                    	    <td><?php echo $i; ?></td>
	                    	    <td><?php echo $sdata['doc_name'] ; ?></td>
	                    	    <td><?php echo basename($sdata['path']) ;?></td>		

	                    	</tr>	
	                    	</tr>

	                    	<?php 
		                                 }

		                               } 

		                           
		                               
		                               else{
		                               	 ?>

		                       	<tr>
                                    <td colspan="5"> <h4 class="text-center">Data is not available </h4> </td>
		                      	</tr>

	                    	

                           <?php } ?>

	                    </table>  	
	                
                </div>
	            

         </div>
	</div>
</div>



<?php 
include 'inc/footer.php';
 ?>

