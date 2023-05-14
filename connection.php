<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "mega_php";

// $servername = "localhost";
// $username = "mdfa_user";
// $password = "-?R\/{H<E5a}*siv";
// $db_name = "mdfa";

$conn = mysqli_connect($servername, $username, $password, $db_name);
if($conn->connect_error){
	die("Connection failed".$conn->connect_error);
}
echo "";
?>