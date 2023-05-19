<?php include('check.php');define("TITLE", "Direct Sell");
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
            
            
if (isset($_POST['save_data'])) 
// if(isset($_POST['save_data']))
{
    $data1 = $_POST;
// echo '<pre>';
// print_r($data1);
// exit();    

    $bill_id  = $_POST['bill_id'];
    $supervisor_id  = $_SESSION['username'];
    $liter  = $_POST['liter'];
    $rate  = $_POST['rate'];
    $total  = $_POST['total']; 
    $created_time  = $_POST['created_time'];

                $sql = "INSERT INTO `direct_sell`(`direct_sell_id`, `supervisor_id`, `liter`, `rate`, `total`, `created_at`) VALUES 
                ('$bill_id','$supervisor_id','$liter','$rate','$total','$created_time')";
                $result = mysqli_query($conn, $sql);
                // echo '<pre>';
                // print_r($result);
                // exit();

                if($result == 1) {
                        echo "<script>alert('Saved successfully');</script>";
                    
                } else {
                    echo "<script>alert('Sorry try again later')</script>";
                }

    

}

            ?>
            <script>
                 function calculateTotal() {
                // Get input values
                const input1 = Number(document.getElementById("liter").value);
                const input3 = Number(document.getElementById("rate").value);

                // Calculate total
                const total = (input1  * input3).toFixed(2);;

                // Update total input value
                document.getElementById("total").value = total;
                }
            </script>

            <div class="table-data">
                <div class="container-fluid">
                    <form action="#" method="POST">
                            <input type="hidden" name="bill_id" value="<?php echo $genrate_bill_id; ?>">
                            <input type="hidden" name="created_time" value="<?php echo $current_timestamp; ?>">
                    <div class="row mb-3 d-flex justify-content-evenly">
                        <div class="col-auto">
                            <div class="mb-3">
                                <h5 for="exampleFormControlInput1" class="form-label text-primary">Date : <time
                                        datetime="1683197858119" class="text-dark">Thursday, May 5th, 2023</time></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4 d-flex justify-content-around">
                        <div class="col-md-6" style="display: inline-flex;"><label for="inputPassword2"
                                class="me-3 align-self-center text-primary">Center Code :</label>
                            <div class="col-sm"><input type="tel" class="form-control text-primary" id="inputNo2"
                                    placeholder="2" disabled></div>
                        </div>
                        <div class="col-md-6" style="display: inline-flex;"><label for="inputPassword2"
                                class="me-3 align-self-center text-primary">Liter</label>
                            <div class="col-sm"><input type="number" onkeyup="calculateTotal()" class="form-control" id="liter" name="liter" placeholder="4"></div>
                        </div>
                    </div>
                    <div class="row g-3 mb-5 d-flex justify-content-around">
                        <div class="col-md-6" style="display: inline-flex;"><label for="inputPassword2"
                                class="me-3 align-self-center text-primary" >Rate</label>
                            <div class="col-sm"><input type="text"  class="form-control" id="rate" name="rate" value="66"
                                    readonly></div>
                        </div>
                        <div class="col-md-6" style="display: inline-flex;"><label for="inputPassword2"
                                class="me-3 align-self-center text-primary">Total</label>
                            <div class="col-sm"><input type="text" name="total" class="form-control" id="total" value=""
                                    readonly></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto" style="display: inline-flex;"><button type="submit "
                                class="btn btn-success" name="save_data">Save</button></div>
                        <div class="col-auto" style="display: inline-flex;"><button type="submit "
                                class="btn btn-primary">Print</button></div>
                        <!-- <div class="col-auto" style="display: inline-flex;"><button type="submit "
                                class="btn btn-warning">Clear</button></div> -->
                    </div>
                    </form>
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