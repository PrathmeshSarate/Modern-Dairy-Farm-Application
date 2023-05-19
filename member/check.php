<?php
session_start(); 
include("../connection.php");
$member_id = $_SESSION['username'];
if(!isset($_SESSION['name']))
{
    // echo '<script> alert("WARNING : Please Login !!!"); window.location.href="../login.php"</script>';
    header("Location:../login.php");
    echo "<script>alert('error')</script>";

}

?>
