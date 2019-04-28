<?php 
  
 include_once 'Session.php';
 include 'Database.php';

  class User {

    private $db;
  	public function __construct(){
  		  $this->db = new Database();
  	}
 
   //  ---------   User Registration ---------------  //

   public function UserRegistration($data){

   	       $name      =    $data['name'];
   	       $username  =    $data['username'];
   	       $email     =    $data['email'];
   	       $password  =    $data['password'];
   	       $chkEmail  =    $this->emailCheck($email);


			     if(  $name=="" || $username=="" || $email=="" || $password==""){
			          $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be empty</div>";

			          return $msg;
			     }

			     if( strlen($username)<3 ){
			         $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Username is too short</div>";

			          return $msg;
			     }
			     elseif( preg_match('/[^a-z0-9_-]+/i', $username) ){
                       $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Username must only contain alphanumerical,dashes & underscores .</div>";

			          return $msg;
			     }
			     if( filter_var($email,FILTER_VALIDATE_EMAIL) === false ){
			     	   $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Invalid email address .</div>";

			          return $msg;
			     }
			     if($chkEmail == true){
			     	$msg = "<div class='alert alert-danger'><strong>Error ! </strong>This email address already Exist.</div>";

			          return $msg;
			     }
           if(strlen($password) < 6 ){
                 $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Password is too Short .</div>";
                   
                     return $msg;
             }

           $password = md5($data['password']);

      // --------------  for insert ------------------ // 
           
			     $sql = "INSERT INTO users(name,username,email,password) VALUES(:name, :username, :email, :password)";
			     $query = $this->db->pdo->prepare($sql);

                 $query->bindValue(':name',$name);
                 $query->bindValue(':username',$username);
                 $query->bindValue(':email',$email);
                 $query->bindValue(':password',$password);

                 $result = $query->execute();

                 if($result){
                 	$msg = "<div class='alert alert-success'><strong>Success ! </strong> Thank you,You have been Registered. </div>";

			          return $msg;
                 }
                 else{
                 	$msg = "<div class='alert alert-danger'><strong>Error ! </strong>Sorry ! there has been problem to inserting your details. </div>";

			          return $msg;
                 }




   }

 //  -------------  if two or more Email has same name then follow this.....  ---------------  //

   public function emailCheck($email){
               $sql = "SELECT email FROM users WHERE email = :email";
               $query =    $this->db->pdo->prepare($sql);
               $query->bindValue(':email',$email);
               $query->execute();
               if($query->rowCount() > 0 ){
               	   return true;
               }
               else{
               	   return false;
               }

   }


 //  -----------------   User Log In     ------------------  //


   public function getLogInUser($email,$password){
               $sql = "SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1";
               $query =    $this->db->pdo->prepare($sql);
               $query->bindValue(':email',$email);
               $query->bindValue(':password',$password);
               $query->execute();
               $result = $query->fetch(PDO::FETCH_OBJ);
               return $result;
    }


   public function UserLogIn($data){

	           $email = $data['email'];
	   	       $password = md5($data['password']);
	   	       $chkEmail = $this->emailCheck($email);


			     if(  $email=="" || $password=="" ){
			          $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be empty</div>";

			          return $msg;
			     }   
			     if( filter_var($email,FILTER_VALIDATE_EMAIL) === false ){
			     	   $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Invalid email address .</div>";

			          return $msg;
			     }
			     if($chkEmail == false){
			     	$msg = "<div class='alert alert-danger'><strong>Error ! </strong>This email address not Exist.</div>";

			          return $msg;
			     }   

			     $result = $this->getLogInUser($email, $password); 
			     if($result){

                     Session::init();
                     Session::set('login', true);
                     Session::set('id', $result->id);
                     Session::set('name', $result->name);
                     Session::set('username', $result->username);
                     Session::set('loginmsg', "<div class='alert alert-success'><strong>Success ! </strong>You are Logged In.</div>" );
                     header('Location: index.php');
			     }
			     else{
			     	 $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Data not found .</div>";

			          return $msg;
			     }


    }

  //  -----------------   User Log In     ------------------  //

    public function getDocData(){

           $sql = " SELECT u.*,d.* FROM 
              users as u, document as d
              WHERE u.id = d.id ORDER BY d.doc_id DESC ";

               $query = $this->db->pdo->prepare($sql);
               $query->execute();
               $result = $query->fetchAll();
               return $result;
    }

    public function getUserById($id){

             $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
               $query = $this->db->pdo->prepare($sql);
               $query->bindValue(':id', $id);
               $query->execute();
               $result = $query->fetch(PDO::FETCH_OBJ);
               return $result;
    }

    public function getDocByUser($id){

         $sql = "SELECT * FROM document WHERE id = '$id' ORDER BY doc_id DESC";

                $query = $this->db->pdo->prepare($sql);
               $query->execute();
               $result = $query->fetchAll();
               return $result;

             
    }

 


   //  -----------------   Update User    ------------------  //


    public function UpdateUser( $id,$data) {
           $name = $data['name'];
           $username = $data['username'];
           $email = $data['email'];
           $company = $data['company'];

           if(  $name=="" || $username=="" || $email=="" || $company=="" ){
                $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be empty</div>";

                return $msg;
           }

       

           $sql = "UPDATE users SET 
            name     = :name,
            username = :username,
            email    = :email,
            company  = :company

            WHERE id = :id";
          
           $query =    $this->db->pdo->prepare($sql);

                 $query->bindValue(':name',$name);
                 $query->bindValue(':username',$username);
                 $query->bindValue(':email',$email);
                 $query->bindValue(':company',$company);
                 $query->bindValue(':id', $id);

                 $result = $query->execute();

                 if($result){
                  $msg = "<div class='alert alert-success'><strong>Success ! </strong> Data Updated Successfully .</div>";

                     return $msg;
                 }
                 else{
                  $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Sorry ! User data not Updated Successfully . </div>";
                   
                     return $msg;
                 }

    }

  //  -----------------   Update Password     ------------------  //


  private function CheckPassword($id,$old_pass){
        $password = md5($old_pass);
         $sql = "SELECT password FROM users WHERE id = :id AND password = :password";
               $query =    $this->db->pdo->prepare($sql);
               $query->bindValue(':id',$id);
               $query->bindValue(':password',$password);
               $query->execute();
               if($query->rowCount() > 0 ){
                   return true;
               }
               else{
                   return false;
               }

  }

    public function UpdatePassword( $id,$data){
             $old_pass = $data['old_pass'];
             $new_pass = $data['password'];
             $chk_pass = $this->CheckPassword($id,$old_pass);

             if($old_pass == "" || $new_pass == ""){
                  $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Field must not be empty .</div>";
                   
                     return $msg;
             }

             if($chk_pass == false){
                  $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Old Password  not Exist .</div>";
                   
                     return $msg;
             }

             if(strlen($new_pass) < 6 ){
                 $msg = "<div class='alert alert-danger'><strong>Error ! </strong> Password is too Short .</div>";
                   
                     return $msg;
             }
            
            $password = md5($new_pass);

            $sql = "UPDATE users SET 
            password    = :password
            WHERE id = :id";
          
           $query =    $this->db->pdo->prepare($sql);

                 $query->bindValue(':password',$password);
                 $query->bindValue(':id', $id);

                 $result = $query->execute();

                 if($result){
                  $msg = "<div class='alert alert-success'><strong>Success ! </strong> Password Updated Successfully .</div>";

                     return $msg;
                 }
                 else{
                  $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Sorry ! Password not Updated Successfully . </div>";
                   
                     return $msg;
                 }


    }

//  ----------------- Upload files -------------- 

     public function UploadDocument($data,$file){

       
       $id = Session::get('id');
        $doc_name     = $data['doc_name'];
        $file_name    = $file['path']['name'];
        // $file_size    = basename( $file['path']['size'] ) ;
        $file_temp    = $file['path']['tmp_name'];
        
        $uploaded_file = "documents/".basename($file_name);
        

        if(  $doc_name=="" || $file_name=="" ){

                $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Field must not be empty</div>";

                return $msg;
           }
           
        if ($_FILES["path"]["size"] > 5097152) {
           $msg = '<div class="alert alert-danger"><strong>Sorry ! </strong>File Size should be less then 5MB!</div>';
             return $msg;
        }    
           
        
        if (file_exists($uploaded_file)) {
             $msg = '<div class="alert alert-danger"><strong>Sorry ! </strong> file already exists. </div>';
             return $msg;
        }
        
         

        else{

            
             move_uploaded_file($file_temp, $uploaded_file);

             $sql = "INSERT INTO document(doc_name,path,id) VALUES(:doc_name,:uploaded_file,:id) ";

               $query = $this->db->pdo->prepare($sql);

                 
                 $query->bindValue(':doc_name',$doc_name);
                 $query->bindValue(':uploaded_file',$uploaded_file);
                 $query->bindValue(':id',$id);

                 $result = $query->execute();

                 if($result){
                  $msg = "<div class='alert alert-success'><strong>Success ! </strong> File Uploaded Successfully. </div>";

                return $msg;
                 }
                 else{
                  $msg = "<div class='alert alert-danger'><strong>Error ! </strong>Sorry ! there has been problem to upload. </div>";

                  return $msg;
                 }

        }  



           
     }














}

 ?>