<?php
include("connection.php");

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "select * from consumer where dairyid = '$username' and password = '$password' ";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	if($count){
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


<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<script>
	jQuery('#login-form').on('submit',function(e)
	{

		jQuery('#submit').html('Please Wait.....');
		jQuery('#submit').attr('disabled',true);

		jQuery.ajax({
			url:"sendEnquiryEmail.php",
			type:"post",
			data: jQuery('#contactForm').serialize(),
			success: function (data) {
		  //   console.log(data);
		  alert("Message Sent, Thank You!")
			jQuery('#submit').html('Message Sent');
			jQuery('#submit').attr('disabled',false);
			}

		})

		e.preventDefault();

	});

</script>