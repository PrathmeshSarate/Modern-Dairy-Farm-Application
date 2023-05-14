<?php include('check.php');define("TITLE", "Message"); 
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

                <?php 
                require 'include/topbar.php'; 
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#inbox">Inbox <span class="badge bg-danger">2</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#sent">Sent messages</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="inbox" class="container tab-pane active"><br>
                            <h3>New Messages</h3>
                            <ul class="pt-5" style="list-style-type: none; ">

                                <div class="p-2">
                                    <li class="bg-primary text-white ps-4" style="padding: 30px 0px 30px 0px;">
                                        <h5>From : Admin</h5>
                                        <small class="text-dark">&nbsp;Reguarding your query</small>
                                        <a href=""><span class="float-end me-5 text-black btn btn-light">Open</span></a>
                                    </li>
                                </div>

                                <div class="p-2">
                                    <li class="bg-success text-white ps-4" style="padding: 30px 0px 30px 0px;">
                                        <h5>From : Supervisor</h5>
                                        <small class="text-dark">&nbsp;Reguarding milk query</small>
                                        <a href=""><span class="float-end me-5 text-black btn btn-light">Open</span></a>
                                    </li>
                                </div>


                            </ul>

                        </div>
                        <div id="sent" class="container tab-pane fade"><br>
                            <ul class="pt-5" style="list-style-type: none; ">

                                <li class="bg-primary text-white ps-4" style="padding: 30px 0px 30px 0px;">
                                    <h5>Me</h5>
                                    <span>&nbsp;Query about milk collection</span>
                                    <a href=""><span class="float-end me-5 text-black btn btn-light">Open</span></a>
                                </li>

                                <li class="bg-success text-white ps-4" style="padding: 30px 0px 30px 0px;">
                                    <h5>Me</h5>
                                    <span>&nbsp;Query about fat</span>
                                    <a href=""><span class="float-end me-5 text-black btn btn-light">Open</span></a>
                                </li>

                                <li class="bg-primary text-white ps-4" style="padding: 30px 0px 30px 0px;">
                                    <h5>Me</h5>
                                    <span>&nbsp;Query about milk animal health</span>
                                    <a href=""><span class="float-end me-5 text-black btn btn-light">Open</span></a>
                                </li>

                            </ul>

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