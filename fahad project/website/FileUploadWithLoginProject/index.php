<?php 
include 'inc/header.php';
include 'lib/User.php';
$user = new User();
Session:: checkSession();


 ?>

<?php 

    $logIn = Session::get("login");
    if( $logIn == false ){
         // header('location:login.php');
    	  echo "<script>window.open('login.php','_self')</script>";
    }

 ?>


<div class="user-table">
	<div class="container">

	<?php 
        $loginmsg = Session::get("loginmsg");
		        if(isset($loginmsg) ){
                     echo $loginmsg;
		        }
		   Session::set('loginmsg', NULL);    

	 ?>

		 <div class="panel panel-default">
				
				<div class="panel-heading">
					<h3>ALL DOCUMENT <span class="pull-right">Welcome! <strong>
						<?php 
                             $username = Session::get("username");
                             if(isset($username)){
                             	echo $username;
                             }

						 ?>
					</strong></span></h3>
				</div>
                
                <div class="panel-body table-responsive">
                	
	                    <table class="table table-striped">

	                    	<tr>
	                    		<th width="10%">Serial</th>
	                    		<th width="21%">UserName</th>
	                    		<th width="21%">Document Name</th>
	                    		<th width="21%">Document</th>
	                    		<th width="10%">User Details</th>
	                    		<th width="21%">Download Document</th>
	                    	</tr>

                         <?php 
                               $user = new User();
                               $doc_data = $user->getDocData();
                               
                               if($doc_data){
                               	$i=0;
                               	  foreach ($doc_data as $sdata) {
                               	$i++;
                               	
	                     ?>

	                    	<tr>
	                    	    <td><?php echo $i; ?></td>
	                    	    <td><?php echo $sdata['name'] ; ?></td>
	                    	    <td><?php echo $sdata['doc_name'] ;?></td>	
	                    	    <td><?php echo basename($sdata['path']) ;  ?> </td>	
	                    	    <td>
	                    	    	<a class="btn btn-success" href="profile.php?id=<?php echo $sdata['id']; ?>">View</a>
	                    	    </td>	

	                    	    <td>
	                    	    

	                    	    	<a class="myClass1 btn btn-success" href="<?php echo $sdata['path'] ; ?>">Download </a>

	                    	    </td>

	                    	</tr>	
	                    	</tr>
	                    	<?php 
		                                 }
		                               } 
		                               
		                               else{
		                               	 ?>

		                       	<tr>
                                    <td colspan="5"> <h3> data not found .</h3> </td>
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

