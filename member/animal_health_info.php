<?php include('check.php');define("TITLE", "Animal Health info"); 
session_start(); 

if(!isset($_SESSION['name']))
{
    echo '<script> alert("WARNING : Please Login !!!"); window.location.href="../login.php"</script>';
    // header("Location:../login.php");

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Member | <?php if (TITLE !== "") {
                        echo TITLE;
                    } ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require 'include/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php require 'include/topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php 
                    $sql_ahi = "SELECT * FROM `animal_health_info` ORDER BY `animal_health_info`.`created_at` DESC";
                
                    $result_ahi = mysqli_query($conn, $sql_ahi);
                    while ($row_ahi = mysqli_fetch_assoc($result_ahi) ) {
                        // echo '<pre>';
                        // print_r($row_ahi);
                    
                    ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-4 p-5 bg-danger text-white rounded">
                                <h4 class="py-3"><u><?php echo $row_ahi['d_title']; ?></u> </h4>
                                <span class="badge bg-primary"><?php echo $row_ahi['created_at']; ?></span>
                                <p><?php echo $row_ahi['d_description']; ?></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-4 p-5 bg-success text-white rounded">
                                <h4 class="py-3"><u><?php echo $row_ahi['t_title']; ?></u></h4>
                                <span class="badge bg-primary"><?php echo $row_ahi['created_at']; ?></span>
                                <p><?php echo $row_ahi['t_description']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>



</body>

</html>