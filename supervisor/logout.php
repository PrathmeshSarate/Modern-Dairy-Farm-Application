<?php 
session_start();

// session_destroy($_SESSION['name']);
// session_destroy($_SESSION['username']);
// session_destroy("userType".$_SESSION['username']);
// session_destroy();
session_unset();

header("Location:../");
?>