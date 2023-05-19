<?php include('check.php');define("TITLE", "Fat-Rate");
date_default_timezone_set('Asia/Kolkata');
$time_stamp_for_bill_id = date('YmdHis');;
$genrate_bill_id = strtoupper(substr(md5(rand()), 0, 4)).$time_stamp_for_bill_id;
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
         if(isset($_GET['deactivate_id'])){
            $id = $_GET['deactivate_id'];
            
            $sql = "DELETE from `rate` WHERE `id` = $id";
                $result = mysqli_query($conn, $sql);
                // echo '<pre>';
                // print_r($sql);
                // exit();

                if($result == 1) {
                        echo "<script>alert('Deleted successfully');</script>";
                    
                } else {
                    echo "<script>alert('Sorry try again later')</script>";
                }
                echo "<script>window.location.href='http://localhost/mega_php/supervisor/fat_rate.php'</script>";

         }   
            
if (isset($_POST['save_data'])) 
{
    $rate  = $_POST['rate'];
    $fat  = $_POST['fat']; 
    $created_time  = $_POST['created_time'];

                $sql = "INSERT INTO `rate`(`fat`, `rate`,`created_at`) VALUES  
                ('$fat','$rate','$created_time')";
                $result = mysqli_query($conn, $sql);
                // echo '<pre>';
                // print_r($sql);
                // exit();

                if($result == 1) {
                        echo "<script>alert('Saved successfully');</script>";
                    
                } else {
                    echo "<script>alert('Sorry try again later')</script>";
                }

    

}

            ?>


            <div class="table-data">
                <div class="container-fluid">
                    <form action="#" method="POST">
                           
                            <input type="hidden" name="created_time" value="<?php echo $current_timestamp; ?>">
                    <div class="row mb-3 d-flex justify-content-evenly">
                        <div class="col-auto">
                            <div class="mb-3">
                                <h5 for="exampleFormControlInput1" class="form-label text-primary">Date :<time datetime="1683195805662" class="text-dark"><?php echo date('l') . date(' d/M/Y') ?></time></h5></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-5 d-flex justify-content-around">
                        <div class="col-md-6" style="display: inline-flex;"><label for="inputPassword2"
                                class="me-3 align-self-center text-primary" >Fat</label>
                            <div class="col-sm"><input type="text"  class="form-control" id="fat" name="fat" ></div>
                        </div>
                        <div class="col-md-6" style="display: inline-flex;"><label for="inputPassword2"
                                class="me-3 align-self-center text-primary">Rate</label>
                            <div class="col-sm"><input type="text" name="rate" id="rate" class="form-control"  ></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto" style="display: inline-flex;"><button type="submit "
                                class="btn btn-success" name="save_data">Save</button></div>
                        <!-- <div class="col-auto" style="display: inline-flex;"><button type="submit "
                                class="btn btn-warning">Clear</button></div> -->
                    </div>
                    </form>
                </div>
            </div>

            <div style="width: 100%; " class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Chart of Fat-Rate</h3>
                    </div>
                    <table class="table-responsive table-striped-columns">
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>Fat</th>
                                <th>Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                          

                            // START CODE FOR TABLE OF THE MEMEBER 
                            
                                $sql = "SELECT * FROM `rate` ORDER BY fat";
                                $result = mysqli_query($conn, $sql);
                                $count = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // echo '<pre>';
                                    // print_r();
                                    // exit();
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['fat']; ?></td>
                                        <td>
                                            <p><?php echo $row['rate']; ?></p>
                                        </td>
                                        <td>                                           
                                            <a class="float-start btn btn-danger text-white  " href="http://localhost/mega_php/supervisor/fat_rate.php?deactivate_id=<?php echo $row['id']; ?>">
                                                <i class='bx bx-trash'></i>
                                            </a>
                                        </td>
                                    </tr>

                            <?php $count++;
                                    // exit();
                                }
                            
                            // END CODE FOR TABLE OF THE MEMEBER 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="script.js"></script>
</body>

</html>