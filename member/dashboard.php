<?php include('check.php');define("TITLE", "Dashboard"); 
// include('../connection.php');
session_start();
$member_id =$_SESSION['username'];

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

                    <!-- Page Heading -->

<?php
            date_default_timezone_set('Asia/Kolkata');
            $current_timestamp = date('Y-m-d H:i:s');

            // $sql_q_for_total_member = "SELECT COUNT(member_id) as count_m FROM member where member_id = '$member_id'";
            $sql_q_cow_liter_month = "SELECT SUM(`liter` * 1) as cow_liter_month FROM milk_collection WHERE member_id='$member_id' AND animal_category='cow' AND created_date BETWEEN '2023-05-01 00:00:01' AND '2023-05-30 21:59:59'";

            $sql_q_buffalo_liter_month = "SELECT SUM(`liter` * 1) as buffalo_liter_month FROM milk_collection WHERE member_id='$member_id' AND animal_category='buffalo' AND created_date BETWEEN '2023-05-01 00:00:01' AND '2023-05-30 21:59:59'";

            $sql_q_cow_liter_day = "SELECT sum(`liter` * 1) as cow_liter_day FROM `milk_collection` WHERE `member_id`='$member_id' AND `created_date`= '$current_timestamp' AND `animal_category`='cow'";

            $sql_q_buffalo_liter_day = "SELECT sum(`liter` * 1) as buffalo_liter_day FROM `milk_collection` WHERE `member_id`='$member_id' AND `created_date`= '$current_timestamp' AND `animal_category`='buffalo'";
            

            $result_cow_liter_month = mysqli_query($conn, $sql_q_cow_liter_month);
            $row_cow_liter_month = mysqli_fetch_assoc($result_cow_liter_month);
            $cow_liter_month= $row_cow_liter_month['cow_liter_month'];

            $result_buffalo_liter_month = mysqli_query($conn, $sql_q_buffalo_liter_month);
            $row_buffalo_liter_month = mysqli_fetch_assoc($result_buffalo_liter_month);
            $buffalo_liter_month= $row_buffalo_liter_month['buffalo_liter_month'];
                

            $result_cow_liter_day = mysqli_query($conn, $sql_q_cow_liter_day);
            $row_cow_liter_day = mysqli_fetch_assoc($result_cow_liter_day);
            $cow_liter_day= $row_cow_liter_day['cow_liter_day'];
            // echo '<pre>';
            // print_r($cow_liter_month);
            // exit();

            $result_buffalo_liter_day = mysqli_query($conn, $sql_q_buffalo_liter_day);
            $row_buffalo_liter_day = mysqli_fetch_assoc($result_buffalo_liter_day);
            $buffalo_liter_day= $row_buffalo_liter_day['buffalo_liter_day'];


?>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cow Milk supplying</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $cow_liter_month; ?> Liter's</div>
                                        </div>
                                        <div class="col-auto"><span class="badge text-white bg-primary p-2">Month</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Buffalo Milk supplying</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if($buffalo_liter_month!=""){ echo $buffalo_liter_month;}{ echo "-";} ?> Liter's</div>
                                        </div>
                                        <div class="col-auto"><span class="badge text-white bg-primary p-2">Month</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cow Milk supplying</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if($buffalo_liter_month!=""){ echo $cow_liter_day;}{ echo "-";}  ?> Liter's</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto"><span class="badge text-white bg-dark p-2">Day</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Buffalo Milk supplying</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if($buffalo_liter_month!=""){ echo $buffalo_liter_day;}{ echo "-";}  ?> Liter's</div>
                                        </div>
                                        <div class="col-auto"><span class="badge text-white bg-dark p-2">Day</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 bg-primary d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-white">Cow </h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header bg-success py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-white">Buffalo</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart2"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>