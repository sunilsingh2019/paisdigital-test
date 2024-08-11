<?php
include "../config.php";
include "../encrypt-decrypt.php";

$username = mysqli_real_escape_string($conn,$_REQUEST['username']);
$password = mysqli_real_escape_string($conn,$_REQUEST['password']);
$firstname = mysqli_real_escape_string($conn,$_REQUEST['firstname']);
$lastname = mysqli_real_escape_string($conn,$_REQUEST['lastname']);
$mobile = mysqli_real_escape_string($conn,$_REQUEST['mobile']);
$employer = mysqli_real_escape_string($conn,$_REQUEST['employer']);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$last_login= date('Y-m-d H:i:s');

// encrypt the username
$username_encrypted = encrypt_decrypt('encrypt', $username);
$salesperson_distribution_link= $siteURL.'?s_id='.$username_encrypted;

//database query to check if the entry already exists
$query = "select * from users where username='".$username."'";
$result = mysqli_query($conn,$query);

if ($result->num_rows > 0) { 
    //var_dump($result->num_rows);die();
    header("Location: login.php?invalid=1");
	
}else {
            $query = "INSERT INTO users (username,password,firstname, lastname, user_level,user_status,salesperson_distribution_link,user_last_login,mobile,employer ) VALUES ('".$username."','".$hashed_password."', '".$firstname."', '".$lastname."', '2', '1', '".$salesperson_distribution_link."', '".$last_login."','".$mobile."','".$employer."')";
            //var_dump($query);die();
            if( $conn->query($query)){
                $_SESSION['msg']="Add Salesperson Successfull";
                header("Location: add-salesperson.php");
            }
            else{
                
                header("Location: add-salesperson.php?invalid=1");
            }
	    }

?>