<?php include('check.php');define("TITLE", "Receipt"); 


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
<script>
    function select_day(){
    //    var btn = document.getElementById('getReceipt');
       document.getElementById('getReceipt').attr('disabled',false);
 
       
    }
    </script>
</>

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
                    <div class="container-fluid pb-5">
                        <div class="d-flex justify-content-center">
                            <div class="col-md-4">
                                <form action="blank.php" method="post">
                                <h4 class="py-4 text-center">Selcet date for Recipt <span class="badge bg-dark ms-2 text-white">DAY</span> </h4>
                                
                                <div class="row">
                                    <div class="col-auto " style="display: inherit;">
                                        <input id="startDate" name="startDate" onclick="select_day()" class="form-control" type="date">
                                    </div>
                                    <div class="col-auto " style="display: inherit;">
                                        <input type="submit" id="getReceipt" class="btn btn-dark" name="getReceipt" value="Get Receipt" >
                                     </div>
                                </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <hr class="border-2 border-dark">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-center">
                            <form class=" text-center justify-content-center ">
                                <div class="row g-3 justify-content-center">
                                    <h4 class="py-4 ">Selcet date for Recipt <span class="badge text-white bg-primary ms-2">Month</span></h4>
                                </div>  
                                <div class="row">
                                    <div class="col-auto " style="display: inherit;"><label for="staticEmail2" class="d-inline px-4 align-self-center">From :</label><input id="startDate" class="form-control" type="date"></div>
                                    <div class="col-auto " style="display: inherit;"><label for="staticEmail2" class="d-inline px-4 align-self-center">To :</label><input id="startDate" class="form-control" type="date"></div>
                                </div>
                            </form>
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


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>



</body>

</html>