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
<!-- <!DOCTYPE html>
<html>
<head>
    <style>
        body {
            /* background-color: #eee; */
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .loader {
            border: 8px solid #F9F9F9; /* Light gray border */
            border-top: 8px solid #3C91E6; /* Gray border */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite; /* Animation properties */
            opacity: 1;
            transition: opacity 1s ease-in-out; /* Transition properties */
        }

        @keyframes spin {
            0% { transform: rotate(0deg); } /* Initial position */
            100% { transform: rotate(360deg); } /* Full rotation */
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var loader = document.querySelector(".loader");
            loader.classList.add("show");

            setTimeout(function() {
                loader.style.opacity = "0"; // Set the opacity to 0 after 10 seconds
                setTimeout(function() {
                    loader.style.display = "none"; // Hide the loader after the transition
                }, 1000); // Hide loader after the transition duration (1 second)
            }, 3000); // Start hiding loader after 10 seconds
        });
    </script>
</head>
<body>
    <div class="loader"></div>
</body>
</html> -->
