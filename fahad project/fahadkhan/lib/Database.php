<?php
Class Database{
	public $host   = DB_HOST;
	public $user   = DB_USER;
	public $pass   = DB_PASS;
	public $dbname = DB_NAME;
	
	
	public $link;
	public $error;
	
	public function __construct(){
		$this->connectDB();
	}
	
	private function connectDB(){
	$this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
	if(!$this->link){
		$this->error ="Connection fail".$this->link->connect_error;
		return false;
	}
 }     
 
	
	// Select or Read data
	
	public function select($query){
		$result = $this->link->query($query) or die($this->link->error.__LINE__);
		if($result->num_rows > 0){
			return $result;
		} else {
			return false;
		}
	}
	
	// Insert data
	public function insert($query){
	$insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
	if($insert_row){
		return $insert_row;
	} else {
		return false;
	}
  }
  
    // Update data
  	public function update($query){
	$update_row = $this->link->query($query) or die($this->link->error.__LINE__);
	if($update_row){
		return $update_row;
	} else {
		return false;
	}
  }
  
  // Delete data
   public function delete($query){
	$delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
	if($delete_row){
		return $delete_row;
	} else {
		return false;
	}
  }

 
   //  -----------------                        ------------------  //
                          // Update Password //
   //  -----------------                        ------------------  //

  private function CheckPassword($usrId,$old_pass){
        $password = md5($old_pass);
         $query = "SELECT password FROM users WHERE id = '$usrId'  AND password = '$password' ";

              $updated_row  = $this->link->query($query); 
              if($updated_row->num_rows > 0){
                return true;
              } else {
                return false;
              } 

             
  }

    public function UpdatePassword( $usrId,$data){
             $old_pass = $data['old_pass'];
             $new_pass = $data['password'];
             $chk_pass = $this->CheckPassword($usrId,$old_pass) ;

             if($old_pass == "" || $new_pass == ""){
                  $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Field must not be empty</div>';
                  return $msg;
                                      
             }

             elseif($chk_pass == false ){
                 $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Old password not exist !</div>';
                return $msg;
             }
             elseif(strlen($new_pass) < 6 ){
             	 $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Password is too short</div>';
             	 return $msg;
             }
           

      else{ 
            
            $password = md5($new_pass);

            $query = " UPDATE users SET 
            password    = '$password'
            WHERE id = '$usrId'    ";
          
            $updated_row  = $this->update($query);

                 if($updated_row){
                   $msg = '<div class="alert alert-success"><strong>Success ! </strong>password updated Successfully</div>';
                   return $msg;
                 }
                 else{
                  $msg = '<div class="alert alert-danger"><strong>Error ! </strong>Password not updated</div>';
                  return $msg;
                 }
         }
             

    }




 
}

