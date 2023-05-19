<?php
session_start(); 
include("../connection.php");
if(!isset($_SESSION['name']))
{
    // echo '<script> alert("WARNING : Please Login !!!"); window.location.href="../login.php"</script>';
    header("Location:../login.php");
    echo "<script>alert('error')</script>";

}

?>
