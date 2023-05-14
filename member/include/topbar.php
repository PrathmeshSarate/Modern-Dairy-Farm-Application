<?php 
include('../connection.php');
// session_start(); 

// if(!isset($_SESSION['name']))
// {
//     echo '<script> alert("WARNING : Please Login !!!"); window.location.href="../login.php"</script>';
    // header("Location:../login.php");

// }
?>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <h1 class="h3 mb-0 text-gray-800"><?php echo TITLE;?></h1>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">                        

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a title="Douglas McGee" class="nav-link " href="#" id="userDropdown" role="button">
                <span style="margin-right: 10px;"  class="d-none d-lg-inline text-gray-600 small"><?php if(isset($_SESSION['name'])){echo $_SESSION['name'];}?></span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
            </a>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->