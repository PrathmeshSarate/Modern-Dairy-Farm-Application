<?php include('check.php');define("TITLE", "Animal Health info"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- My CSS -->
    <link rel="stylesheet" href="style.css">

    <title>Supervisor | <?php if (TITLE !== "") {
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
                    <h1><?php if (TITLE !== "") {
                            echo TITLE;
                        } ?></h1>
                </div>
                <ul class="breadcrumb d-flex justify-content-center">
                    <a href="#">Supervisor</a>
                    <span class="text-primary ps-2 pe-2">></span>
                    <a class="active" href="#"><?php if (TITLE !== "") {
                                                    echo TITLE;
                                                } ?></a>
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
    $d_title  = $_POST['d_title'];
    $d_description  = $_POST['d_description'];
    $t_title  = $_POST['t_title']; 
    $t_description  = $_POST['t_description'];
    $created_time  = $_POST['created_time'];

                $sql = "INSERT INTO `animal_health_info`(`d_title`, `d_description`, `t_title`, `t_description`, `created_at`) VALUES
                ('$d_title','$d_description','$t_title','$t_description','$created_time')";
                $result = mysqli_query($conn, $sql);
                // echo '<pre>';
                // print_r($sql);
                // exit();

                if($result == 1) {
                        echo "<script>alert('Saved successfully'); 
                        var myurl = 'http://localhost/mega_php/supervisor/animal_health_info.php';
                        window.location.href = myurl+'?refresh_page=true';</script>";
                    
                } else {
                    echo "<script>alert('Sorry try again later')</script>";
                }
}


            // START CODE FOR DEACTIVATE MEMBER ID 

            if (isset($_GET['delete_id']) && $_GET['delete_id']) {
                $id = $_GET['delete_id'];
                $sql = "UPDATE `animal_health_info` SET `deleted_at`='$current_timestamp',`is_active`='0' WHERE `id`='$id'";
                $result = mysqli_query($conn, $sql);

                if ($result == 1) {
                    echo "<script>alert('Deleted.'); 
                            var myurl = 'http://localhost/mega_php/supervisor/animal_health_info.php';
                            window.location.href = myurl+'?refresh_page=true';</script>";
                } else {
                    echo "<script>alert('Sorry try again later.'); 
                            var myurl = 'http://localhost/mega_php/supervisor/animal_health_info.php';
                            window.location.href = myurl+'?refresh_page=true';</script>";
                }
            }
            // END CODE FOR DEACTIVATE MEMBER ID 


?>
            <div style="width: 100%;" class="table-data">
                <div class="container-fluid">
                    <form action="" method="post">
                    <input type="hidden" name="created_time" value="<?php echo $current_timestamp; ?>">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 bg-danger rounded p-3">
                            <div class="mb-3"><label for="exampleFormControlInput1" class="form-label text-white">Disease title</label><input type="text" class="form-control" id="d_title" name="d_title" placeholder="Lumpy Skin Disease in Cattle"></div>

                            <div class="mb-3"><label for="exampleFormControlTextarea1" class="form-label text-white">Description</label><textarea class="form-control" id="d_description" name="d_description" rows="3" placeholder="Lumpy skin disease is a viral infection of cattle. Originally found in Africa, it has also spread to countries in the Middle East, Asia, and eastern Europe.Clinical signs include fever..."></textarea></div>
                        </div>
                        <div class="col-md-6 col-sm-12 bg-success p-3 rounded ">
                            <div class="mb-3"><label for="exampleFormControlInput1" class="form-label text-white">Disease Treatment and Prevention</label><input type="text" class="form-control" id="t_title" name="t_title" placeholder="Attenuated virus vaccines may help control spread"></div>
                            <div class="mb-3"><label for="exampleFormControlTextarea1" class="form-label text-white">Description</label><textarea class="form-control" id="t_description"  name="t_description" rows="3" placeholder="The spread of lumpy skin disease in recent years beyond its ancestral home of Africa is alarming. Quarantine restrictions have proved to be of limited use."></textarea></div>
                        </div>
                        <div class="pt-3 "><button type="submit " name="save_data" class="btn btn-dark">Insert (Fill)</button></div>
                    </div>
                    </form>
                </div>
            </div>

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>List</h3>
                    </div>
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr.no</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $load_data = true; // VARIBLE FOR LOAD DATA AUTO AT START
                             $count=1;

                             // START CODE FOR TABLE OF THE MEMEBER 
                             if ((isset($_GET["refresh_page"]) && $_GET["refresh_page"] == "true") || $load_data = "true") {
                                 $sql = "SELECT * FROM `animal_health_info`  WHERE `is_active` = '1' ORDER BY  created_at DESC";
                                 $result = mysqli_query($conn, $sql);
                                 while ($row = mysqli_fetch_assoc($result)) {
                                     // echo '<pre>';
                                     // print_r();
                                     // exit();
                             ?>
                            <tr>
                                <td>
                                    <?php echo $count; ?>
                                </td>
                                <td>
                                    <p><?php echo $row['d_title']; ?></p>
                                </td>
                                <td style="display: flex;place-content: center;"><a class="float-start btn btn-primary text-white" href="http://localhost/mega_php/supervisor/animal_health_info.php?delete_id=<?php echo $row['id']; ?>"><i class='bx bx-trash'></i></a></td>
                            </tr>
                            <?php $count++;
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