<?php include('check.php');define("TITLE", "Supervisor");
// $genrate_supervisor_id = strtoupper(substr(md5(rand()), 0, 5));
$sql = "SELECT supervisor_id FROM `supervisor` ORDER BY supervisor_id DESC LIMIT 1";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $genrate_supervisor_id = $row['supervisor_id']+1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">

    <title>Owner | <?php if (TITLE !== "") {
                            echo TITLE;
                        } ?>
    </title>
</head>

<body>
    <?php
    require 'include/sidebar.php';
    ?>
    <!-- CONTENT -->
    <section id="content">
        <?php
        require 'include/topbar.php';
        ?>
        
        <div class="loader"></div>
        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1><?php if (TITLE !== "") {
                            echo TITLE;
                        } ?></h1>
                </div>
                <ul class="breadcrumb">
                    <a href="#">Owner</a>
                    <span class="text-primary ps-2 pe-2">></span>
                    <a class="active" href="#"><?php if (TITLE !== "") {
                                                    echo TITLE;
                                                } ?></a>
                </ul>
                <!-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download'></i>
					<span class="text">Download REPORT</span>
				</a> -->
            </div>


            <?php

            // START CODE FOR ADD OR UPDATE THE MEMEBER 
            if (isset($_POST['addMemberBtn'])) {
                $supervisor_id = $_POST['supervisor_id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $password = $_POST['password'];


                $sql = "INSERT INTO `supervisor`(`supervisor_id`,`name`, `email`, `phone`,`password`) VALUES ('$supervisor_id','$name', '$email', '$phone',  '$password') ON DUPLICATE KEY UPDATE name='$name', email='$email',phone='$phone',password='$password'";
                $result = mysqli_query($conn, $sql);
                // echo '<pre>';
                // print_r($sql);
                // exit();

                if ($result == 1) {
                    if (isset($_GET['edit_id']) && $_GET['edit_id']) {
                        echo "<script>alert('Updated successfully.'); 
                              var myurl = 'http://localhost/mega_php/owner/supervisor.php';
                              window.location.href = myurl+'?refresh_page=true';</script>";
                    } else {
                        date_default_timezone_set('Asia/Kolkata');
                        
                        $sms_date = formatMarathiDate(date('D d-M-Y'));;
                        $sms_time = formatMarathiTime(date('h:i:s'));
                        
                        // exit;
                        $message="श्री. दत्त सह. दूध व्याव. व कृषिपूरक सेवा संस्था,\nमर्या. , वाकरे, ता. करवीर, जि. कोल्हापूर \n\n\n";
                        $message.="*पर्यवेक्षक नोंदणी यशस्वी झाली, \nनोंदणीचे तपशील खाली दिले आहेत*\n";
                        $message.="\nदिनांक :- $sms_date";
                        $message.="\nवेळ :- $sms_time";
                        $message.="\n(supervisor ID)सभासद क्रमांक :- $supervisor_id";
                        $message.="\nनाव :- $name";
                        $message.="\n(Password)संकेतशब्द :- $password";
                        $message.="\n\n\nही माहिती संवेदनशील आहे, \nकोणाशीही उघड करू नका.";
                        // echo $message;
                        // exit;

                    $message = [
                        "secret" => "3c5a0dce577d10bc469436abfaeb0d3fc15e4da9", 
                        "mode" => "devices",
                        "device" => "0d1fd17c-2361-2ccf-8671-940376678248",
                        "sim" => 1,
                        "priority" => 1,
                        "phone" => $phone,
                        "message" => $message
                    ];

                    $cURL = curl_init("https://www.cloud.smschef.com/api/send/sms");
                    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
                    $response = curl_exec($cURL);
                    curl_close($cURL);

                    $result = json_decode($response, true);
                    // echo '<pre>';
                    // print_r($result);
                    // exit;

                    // do something with response
                    if($result['status']==200){
                        echo "<script>alert('SMS sent successfully');</script>";
                    }
                        echo "<script>alert('Supervisor added successfully.'); var myurl = 'http://localhost/mega_php/owner/supervisor.php';
                            window.location.href = myurl+'?refresh_page=true';</script>";
                    }
                } else {
                    echo "<script>alert('Sorry try again later')</script>";
                }
            }
            // END CODE FOR ADD OR UPDATE THE MEMEBER 


            // START CODE FOR FETCH DETAILS OF supervisor TO FILL FORM 
            $edit_id_data = array();

            if (isset($_GET['edit_id']) && $_GET['edit_id']) {
                $supervisor_id = $_GET['edit_id'];
                $sql = "SELECT  * FROM `supervisor` WHERE `supervisor_id` = '$supervisor_id'";
                $result = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result);
                $edit_id_data = $row;
            }

            // END CODE FOR FETCH DETAILS OF supervisor TO FILL FORM 


            // START CODE FOR DEACTIVATE supervisor ID 

            if (isset($_GET['deactivate_id']) && $_GET['deactivate_id']) {
                $supervisor_id = $_GET['deactivate_id'];
                $sql = "UPDATE `supervisor` SET  `deactivated_at`='$current_timestamp',`is_active`='0' WHERE `supervisor_id` = '$supervisor_id'";
                $result = mysqli_query($conn, $sql);

                if ($result == 1) {
                    echo "<script>alert('Supervisor ID Deactivated.'); 
        var myurl = 'http://localhost/mega_php/owner/supervisor.php';
        window.location.href = myurl+'?refresh_page=true';</script>";
                } else {
                    echo "<script>alert('Sorry try again later.'); 
        var myurl = 'http://localhost/mega_php/owner/supervisor.php';
        window.location.href = myurl+'?refresh_page=true';</script>";
                }
            }
            // END CODE FOR DEACTIVATE supervisor ID 



            ?>


            <div style="text-align:left" class="table-data col-md-5">
                <div class="container-fluid">
                    <form  action="#" method="post">

                        <div class="row g-3 mb-3">
                            <div class="col-md-5" style="display: inline-flex;">
                                <label for="exampleFormControlInput1" class="form-label text-primary">Supervisor ID / Username : <span class="text-danger"><?php if (isset($_GET['edit_id']) && $_GET['edit_id']) {
                                                                                                                                                echo $edit_id_data['supervisor_id'];
                                                                                                                                            } else {
                                                                                                                                                echo $genrate_supervisor_id;
                                                                                                                                            } ?></span>
                                </label>
                                <input type="hidden" class="form-control" name="supervisor_id" id="supervisor_id" value="<?php if (isset($_GET['edit_id']) && $_GET['edit_id']) {
                                                                                                                        echo $edit_id_data['supervisor_id'];
                                                                                                                    } else {
                                                                                                                        echo $genrate_supervisor_id;
                                                                                                                    } ?>">

                            </div>
                            <div class="col-md-6 align-items-center" style="display: inline-flex;">
                                <label for="exampleFormControlInput1" class="form-label text-primary me-3 ">Name</label>
                                <div class="col-sm">
                                    <input type="text" class="form-control" name="name" id="name" value="<?php if (isset($_GET['edit_id']) && $_GET['edit_id']) {
                                                                                                                echo $edit_id_data['name'];
                                                                                                            } ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label text-primary">Email address</label>
                            <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="abcxyz@gmail.com" value="<?php if (isset($_GET['edit_id']) && $_GET['edit_id']) {
                                                                                                                                                            echo $edit_id_data['email'];
                                                                                                                                                        } ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label text-primary">Phone No.</label>
                            <input type="tel" class="form-control " name="phone" id="phone" placeholder="+91 01234 56789" value="<?php if (isset($_GET['edit_id']) && $_GET['edit_id']) {
                                                                                                                                        echo $edit_id_data['phone'];
                                                                                                                                    } ?>" required>
                        </div>                       
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label text-primary">Password</label>
                            <input type="text" class="form-control " name="password" id="password" placeholder="*********" value="<?php if (isset($_GET['edit_id']) && $_GET['edit_id']) {
                                                                                                                                        echo $edit_id_data['password'];
                                                                                                                                    } ?>" required>
                        </div>
                        <button type="submit" name="addMemberBtn" class="btn btn-success"><?php if (isset($_GET['edit_id']) && $_GET['edit_id']) {
                                                                                                echo "Update";
                                                                                            } else {
                                                                                                echo "Save";
                                                                                            } ?></button>
                    </form>
                </div>
            </div>

            <div style="width: 100%; " class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>List of supervisor's</h3>
                    </div>
                    <table class="table-responsive table-striped-columns">
                        <thead>
                            <tr>
                                <th>Sr.no</th>
                                <th>supervisor ID</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $load_data = true; // VARIBLE FOR LOAD DATA AUTO AT START

                            // START CODE FOR TABLE OF THE MEMEBER 
                            if ((isset($_GET["refresh_page"]) && $_GET["refresh_page"] == "true") || $load_data = "true") {
                                $sql = "SELECT * FROM `supervisor` WHERE `is_active` = '1' ORDER BY created_at DESC";
                                $result = mysqli_query($conn, $sql);
                                $count = $result->num_rows;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // echo '<pre>';
                                    // print_r();
                                    // exit();
                            ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['supervisor_id']; ?></td>
                                        <td>
                                            <p><?php echo $row['name']; ?></p>
                                        </td>
                                        <td>
                                            <a class="float-start btn btn-primary text-white" href="http://localhost/mega_php/owner/supervisor.php?edit_id=<?php echo $row['supervisor_id']; ?>">
                                                <i class="bx bx-edit"></i>
                                            </a>

                                            <a class="float-start btn btn-danger text-white  mx-sm-2" href="http://localhost/mega_php/owner/supervisor.php?deactivate_id=<?php echo $row['supervisor_id']; ?>">
                                                <i class='bx bx-power-off'></i>
                                            </a>
                                        </td>
                                    </tr>

                            <?php $count--;
                                    // exit();
                                }
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