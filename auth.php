<?php
include("connection.php");

if(isset($_POST['submit'])){
    echo '<script>console.log("hi");/script>';
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "select * from consumer where dairyid = '$username' and password = '$password' ";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	if($count){
        echo '<script> alert("Welcome")</script>';
		header("Location:supervisor/dashboard.php");
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION["userType".$username] = "supervisor";
        // echo $_SESSION["userType".$username];
	}
	else{
		$sql = "SELECT  * FROM `member` WHERE `phoneno` = '$username' AND `aadharno` = '$password'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		if($count){
            echo '<script> alert("Welcome")</script>';
			header("Location:member/dashboard.php");
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION["userType".$username] = "member";
            // echo $_SESSION["userType".$username];
		}
		else{
			echo '<script> alert("Login failed")</script>';
		}
	}
}
?>