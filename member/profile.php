<?php include('check.php');define("TITLE", "Profile"); ?>
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

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

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
<?php 
    
	$sql = "SELECT * FROM `member` WHERE `member_id`= '$member_id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    // echo "<pre>";
    // print_r($row);
    // exit;

    if(isset($_POST['update_data'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $sql_update = "UPDATE `member` SET `name`='$name',`email`='$email',`phone`='$phone',`address`='$address'  WHERE `member_id` ='$member_id'";
        $result_update = mysqli_query($conn, $sql_update);
        // echo '<pre>';
        // print_r($sql_update);
        // exit();
        if ($result_update == 1) {
            echo "<script>alert('Updated.'); window.location.href= 'http://localhost/mega_php/member/profile.php';</script>";
        } else {
            echo "<script>alert('Sorry try again later.'); 
            window.location.href = 'http://localhost/mega_php/member/profile.php';</script>";
        }
    }
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center ">
                        <form class="col-md-5 mt-5" method="post" action="#">
                            <h4 class="display-6 mb-4">Update Details</h4>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputName4">Name</label>
                                    <input type="text" name="name" value="<?php if(isset($row['name'])){ echo $row['name'];}?>" class="form-control" id="inputName4" placeholder="Abc Xyz">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputphone4">Phone No.</label>
                                    <input type="tel" name="phone" value="<?php if(isset($row['phone'])){ echo $row['phone'];}?>" class="form-control" id="inputphone4" placeholder="12345 67890">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="email" name="email" value="<?php if(isset($row['email'])){ echo $row['email'];}?>" class="form-control" id="inputEmail" placeholder="abc@gmail.com">
                            </div>
                            <div class="form-group">
                            <label for="inputAddress">Address</label>
                                    <textarea class="form-control" id="address" rows="3" name="address" placeholder="Near Chitranagari,Kangalgav,Kolhapur" value="<?php if(isset($row['address'])){ echo $row['address'];}?>"><?php if(isset($row['address'])){ echo $row['address'];}?></textarea>
                            </div>
                            <button type="submit" name="update_data" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>



</body>

</html>