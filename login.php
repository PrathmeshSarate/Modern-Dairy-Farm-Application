<?php
include("connection.php");

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM `supervisor` WHERE `supervisor_id`= '$username'  AND `password`= '$password'
    -- select * from supervisor where supervisor_id = '$username' and password = '$password' 
    ";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    // echo "<pre>";
    // print_r($row);
    // exit;
	$count = mysqli_num_rows($result);
	if($count>=1){
        echo '<script> alert("Welcome")</script>';
		header("Location:supervisor/dashboard.php");
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $row['name'];
        $_SESSION["userType".$username] = "supervisor";
        // echo $_SESSION["userType".$username];
	}
	else{
		$sql = "SELECT  * FROM `member` WHERE `member_id` = '$username' AND `phone` = '$password'";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);
		if($count>=1){
            echo '<script> alert("Welcome")</script>';
			header("Location:member/dashboard.php");
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $row['name'];
            $_SESSION["userType".$username] = "member";
            // echo $_SESSION["userType".$username];
		}
		else{
            $sql = "SELECT  * FROM `owner` WHERE `username` = '$username' AND `password` = '$password'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if($count>=1){
                echo '<script> alert("Welcome")</script>';
                header("Location:owner/dashboard.php");
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['name'] = $row['name'];
                $_SESSION["userType".$username] = "owner";
                // echo $_SESSION["userType".$username];
            }
            else{
                echo '<script> alert("Login failed")</script>';
            }
        }
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/loginStyle.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div id="login-form-wrap">
        <h2>Login</h2>
        <form action="#" method="post" id="login-form">
            <p>
                <input type="text" id="username" name="username" placeholder="User ID" required><i class="validation"><span></span><span></span></i>
            </p>
            <p>
                <input type="password" id="password" name="password" placeholder="Password" required><i class="validation"><span></span><span></span></i>
            </p>
            <p>
                <input type="submit" name="submit" id="submit" value="Login">
            </p>
        </form>
    </div>
    <!-- <div class="container d-flex ">
        <div class="loader "></div>
    </div> -->
    <!--login-form-wrap-->

</body>

</html>