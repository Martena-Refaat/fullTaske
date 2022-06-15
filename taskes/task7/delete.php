<?php 
require 'dbconnection.php';

 $id = $_GET['id'];
 $sql = "delete from data where id = $id"; 
 $op = mysqli_query($con, $sql);

 if($op){
    $message =  "Record Deleted";
 }else{
    $message =  'Error Try Again' . mysqli_error($con);
 }
    require 'close.php';
    $_SESSION['message'] = $message;
    header("Location: index.php");
?>