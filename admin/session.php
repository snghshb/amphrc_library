<?php
error_reporting(0);
include('config.php');
session_start();

$user_check = $_SESSION['login_user'];

$ses_sql = mysqli_query($conn,"select admin_id, firstName, lastName from amphrc_library.admin where emailAddress = '$user_check' ");
   
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
  
$name = $row['firstName']." ".$row['lastName'];

$admin_id = $row['admin_id'];

define('ADMIN_ID', $admin_id);
//echo ADMIN_ID;
$login_session = $name;
define('FNAME', $row['firstName']);
if(!isset($_SESSION['login_user'])){
      header("location: home.php");
   }
?>