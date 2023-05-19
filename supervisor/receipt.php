<?php include('check.php');
define("TITLE", "Receipt");
date_default_timezone_set('Asia/Kolkata');
$time_stamp_for_bill_id = date('YmdHis');;
$genrate_bill_id = strtoupper(substr(md5(rand()), 0, 4)) . $time_stamp_for_bill_id;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">
    <title>Supervisor |
        <?php if (TITLE !== "") {
            echo TITLE;
        } ?>
    </title>
</head>

<body>
    <?php require 'include/sidebar.php'; ?>
    <!-- CONTENT -->
    <section id="content">
        <?php require 'include/topbar.php'; ?>

        <div class="loader"></div>
        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>
                        <?php if (TITLE !== "") {
                            echo TITLE;
                        } ?>
                    </h1>
                </div>
                <ul class="breadcrumb">
                    <a href="#">Supervisor</a>
                    <span class="text-primary ps-2 pe-2">></span>
                    <a class="active" href="#">
                        <?php if (TITLE !== "") {
                            echo TITLE;
                        } ?>
                    </a>
                </ul>
            </div>

            <?php
            if (isset($_GET['deactivate_id'])) {
                $id = $_GET['deactivate_id'];

                $sql = "DELETE from `rate` WHERE `id` = $id";
                $result = mysqli_query($conn, $sql);
                // echo '<pre>';
                // print_r($sql);
                // exit();

                if ($result == 1) {
                    echo "<script>alert('Deleted successfully');</script>";
                } else {
                    echo "<script>alert('Sorry try again later')</script>";
                }
                echo "<script>window.location.href='http://localhost/mega_php/supervisor/fat_rate.php'</script>";
            }

            if (isset($_POST['monthBtn'])) {
                $selectedDate  = $_POST['selectedDate'];
                $endDate  = $_POST['endDate'];
                // $created_time  = $_POST['created_time'];

                $sql = "INSERT INTO `rate`(`fat`, `rate`,`created_at`) VALUES  
                ('$fat','$rate','$created_time')";
                $result = mysqli_query($conn, $sql);
                // echo '<pre>';
                // print_r($sql);
                // exit();

                if ($result == 1) {
                    echo "<script>alert('Saved successfully');</script>";
                } else {
                    echo "<script>alert('Sorry try again later')</script>";
                }
            }

            ?>


            <div class="table-data">
                <div class="container-fluid">
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" id="dayTab" data-bs-toggle="tab" href="#day">Day</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="monthTab" data-bs-toggle="tab" href="#month">Month</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="day">
                            <form id="dayForm" action="print.php" method="POST">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="selectedDate">Select Date:</label>
                                        <input type="date" name="selectedDate" class="form-control-sm mx-2 my-4" id="selectedDate" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="dayBtn" class="btn btn-primary">Generate Receipt</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="month">
                            <form id="monthForm" action="print.php" method="POST">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="startDate">Start Date:</label>
                                        <input type="date" class=" form-control-sm mx-2 my-4" id="startDate" name="startDate" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="endDate">End Date:</label>
                                        <input type="date" class="form-control-sm mx-2 my-4" id="endDate" name="endDate" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" name="monthBtn" class="btn btn-primary">Generate Receipt</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="script.js"></script>
</body>

</html>