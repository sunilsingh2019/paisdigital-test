<?php
include "../config.php";

session_start();

$user_id = mysqli_real_escape_string($conn,$_REQUEST['user_id']);

$query_login = "update users set user_status =0 where user_id=".$user_id;
mysqli_query($conn,$query_login);		
$_SESSION['msg']= "Salesperson Deleted Successfull";
header("Location: add-salesperson.php");