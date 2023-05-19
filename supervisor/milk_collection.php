<?php include('check.php');
define("TITLE", "Milk Collection");
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

    <title>Supervisor | <?php if (TITLE !== "") {
                            echo TITLE;
                        } ?>
    </title>
    <link rel="stylesheet" href="../assets/css/jquery-ui.css">

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery-ui.js"></script>

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
                <ul class="breadcrumb">
                    <a href="#">Supervisor</a>
                    <span class="text-primary ps-2 pe-2">></span>
                    <a class="active" href="#"><?php if (TITLE !== "") {
                                                    echo TITLE;
                                                } ?></a>
                </ul>
            </div>

            <?php
            $current_time_min = date('H:i');
            if ($current_time_min >= "07:00" && $current_time_min <= "11:00") {
                $time_slot = "morning";
            } else if ($current_time_min >= "16:00" && $current_time_min <= "19:00") {
                $time_slot = "evening";
            } else {
                // $time_slot = "-";
                $time_slot = "morning";
            }



        if (isset($_POST['save_data'])){
            if(!empty($_POST['member_id']) && !empty($_POST['animal_type']) && !empty($_POST['liter']) && !empty($_POST['fat']) && !empty($_POST['snf']) && !empty($_POST['clr']) && !empty($_POST['rate']) && !empty($_POST['total']) && !empty($_POST['member_phone_input']) &&  !empty($_POST['time_slot']))
            {

                // echo '<pre>';
                // print_r( $_POST['time_slot']);
                // exit();    
                $phone = $_POST['member_phone_input'];
                $bill_id  = $_POST['bill_id'];
                $time_slot  = $_POST['time_slot'];
                $member_id  = $_POST['member_id'];
                $supervisor_id  = $_SESSION['username'];
                $animal_type  = $_POST['animal_type'];
                $liter  = $_POST['liter'];
                $fat  = $_POST['fat'];
                $snf  = $_POST['snf'];
                $clr  = $_POST['clr'];
                $rate  = $_POST['rate'];
                $total  = $_POST['total'];
                $created_time  = $_POST['created_time'];

                $sql = "INSERT INTO `milk_collection`(`bil_id`, `member_id`, `supervisor_id`, `time_slot`, `animal_category`, `liter`, `fat`, `snf`, `clr`, `rate`, `total`, `created_date`) VALUES ('$bill_id','$member_id','$supervisor_id','$time_slot','$animal_type','$liter','$fat','$snf','$clr','$rate','$total','$created_time')";
                $result = mysqli_query($conn, $sql);
                // echo '<pre>';
                // print_r($result);
                // exit();

                if ($result == 1) {

                    $sms_total = "₹ " . $total;
                    $date = new DateTime($created_time);
                    $sms_date = formatMarathiDate($date->format('D d-M-Y'));;
                    $sms_time = formatMarathiTime($created_time);
                    $liter = convertToMarathiNumber($liter);
                    $fat = convertToMarathiNumber($fat);
                    $rate = convertToMarathiNumber($rate);
                    $sms_total = convertToMarathiNumber($sms_total);
                    // exit;
                    $message = "*आपले दूध संकलन तपशील*\n";
                    $message .= "\nदिनांक :- $sms_date";
                    $message .= "\nवेळ :- $sms_time";
                    $message .= "\nलिटर :- $liter";
                    $message .= "\nफॅट :- $fat";
                    $message .= "\nदर :- $rate";
                    $message .= "\nएकूण (रुपये) :- $sms_total";
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

                    // do something with response
                    if ($result['status'] == 200) {
                        echo "<script>alert('SMS sent successfully');</script>";
                    }
                    echo "<script>alert('Data saved successfully');</script>";
                } else {
                    echo "<script>alert('Sorry try again later')</script>";
                }
            }else{
                echo "<script>alert('Enter all required fields')</script>";
            }
        }


            ?>

            <script>
                function calculateTotal() {
                    // Get input values
                    const input1 = Number(document.getElementById("liter").value);
                    const input2 = Number(document.getElementById("fat").value);
                    const input3 = Number(document.getElementById("rate").value);

                  
                    if(input1!="" && input2!="" && input3!=""){

                        // Calculate total
                        const total = (input1 * input2 * input3).toFixed(2);;
                        
                        // Update total input value
                        document.getElementById("total").value = total;
                    }
                }

                function get_rate(){
                    const input2 = Number(document.getElementById("fat").value);
                    if(input2!=""){
                        $.ajax({
                                url: "get_member_ids.php",
                                method: "GET",
                                data: {
                                    searchRate: input2
                                },
                                success: function(data) {
                                    // response(data);
                                    // response(data.name);
                                    console.log(data);
                                    // let selectedID = $('#member_name_input').val;
                                    // for (let key in data.name)
                                    // console.log(data.name[selectedID]);
                                    $('#rate').val(data);
                                    calculateTotal();
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error(errorThrown);
                                }
                            });
                           

                    }else{

                    
                           
                        }

                }

                $(document).ready(function() {
                    $("#member_id_input").autocomplete({
                        source: function(request, response) {
                            $.ajax({
                                url: "get_member_ids.php",
                                method: "GET",
                                data: {
                                    searchTerm: request.term
                                },
                                success: function(data) {
                                    response(data);
                                    // response(data.name);
                                    console.log(data);
                                    // let selectedID = $('#member_name_input').val;
                                    // for (let key in data.name)
                                    // console.log(data.name[selectedID]);
                                    // $('#member_name_input').val = data.name[selectedID];
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error(errorThrown);
                                }
                            });
                        },
                        minLength: 1,
                        select: function(event, ui) {
                            $("#member_id_input").val(ui.item.value);
                            $("#member_name_input").val(ui.item.name);
                            $("#member_phone_input").val(ui.item.phone);
                            return false;
                        }
                    });

                    

                });

                document.addEventListener("DOMContentLoaded", function() {
                    let time_slot = '<?php echo $time_slot; ?>';

                    // console.log(time_slot)

                    var msg = document.getElementById("msg");
                    var container_milk_collection = document.getElementById("container_milk_collection");
                    var msgDiv = document.getElementById('msg_div');

                    msgDiv.style.display="none";
                    if (time_slot == '-') {

                        msg.innerHTML = "The Form is starts from 07:00 AM to 11:00 AM <br> 04:00 PM to 07:00 PM";
                        var className = "bg-danger";
                        msg.classList.add("text-white", "p-4", className,"rounded-5");

                        msgDiv.style.display="block";
                        container_milk_collection.style.display="none";


                        // var form = document.getElementById("milk_collection_form");
                        
                        // if (form) {
                        //     for (var i = 0; i < form.elements.length; i++) {
                        //         form.elements[i].disabled = true; 
                        //     }
                        // }
                    }
                });
            </script>

            <div class="table-data">
                <div class="container-fluid" id="msg_div">
                    <div id="msg" ></div>
                </div>
                <div class="container-fluid" id="container_milk_collection">
                    <div class="row mb-3 mt-4 d-flex justify-content-evenly">
                        <form action="#" method="post" id="milk_collection_form">
                            <input type="hidden" id="member_phone_input" name="member_phone_input">
                            <input type="hidden" name="bill_id" value="<?php echo $genrate_bill_id; ?>">
                            <input type="hidden" name="created_time" value="<?php echo $current_timestamp; ?>">
                            <input type="hidden" name="time_slot" value="<?php echo $time_slot;  ?>">

                            <div class="col-auto">
                                <div class="mb-3">
                                    <h5 for="exampleFormControlInput1" class="form-label text-primary">Date : <time datetime="1683195805662" class="text-dark"><?php echo date('l') . date(' d/M/Y') ?></time></h5>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="">
                                    <h5 for="exampleFormControlInput1" class="form-label text-primary">Time Slot : <span class="text-dark"><?php echo $time_slot; ?></span></h5>
                                </div>
                            </div>
                            
                    </div>
                    <div class="row g-3 mb-4 d-flex justify-content-between">
                        <div class="col-auto" style="display: inline-flex;"><label for="inputPassword2" class="me-3 align-self-center text-primary">Member ID. :</label>
                            <div class="col-sm">
                                <input type="tel" class="form-control" name="member_id" id="member_id_input" placeholder="4" autocomplete="off" required>


                            </div>
                        </div>
                        <div class="col-auto" style="display: inline-flex;">
                            <!-- <label for="inputPassword2" class="me-3 align-self-center text-primary">Name :</label> -->
                            <div class="col-sm">
                                <!-- <input type="tel" class="form-control text-primary" name="center_code" disabled > -->
                                <input type="text" class="form-control" name="member_name_input" id="member_name_input" placeholder="Name will displayed here" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="row g-3 mb-4 d-flex justify-content-end">
                        <div class="col-auto" style="display: inline-flex;"><label for="inputPassword2" class="me-3 align-self-center text-primary">Animal category :</label>
                            <div class="col-sm"><select class="custom-select form-control" name="animal_type" required>
                                    <option value=""> Select </option>
                                    <option value="cow">Cow</option>
                                    <option value="buffalo">buffalo</option>
                                </select></div>
                        </div>
                        <div class="col-auto" style="display: inline-flex;"><label for="inputPassword2" class="me-3 align-self-center text-primary">Liter</label>
                            <div class="col-sm"><input type="tel" class="form-control" onkeyup="calculateTotal()" name="liter" id="liter" placeholder="4" required></div>
                        </div>
                        <div class="col-auto" style="display: inline-flex;"><label for="inputPassword2" class="me-3 align-self-center text-primary">Fat</label>
                            <div class="col-sm"><input type="tel" class="form-control" name="fat" id="fat" placeholder="6.7" onkeyup="get_rate()"  required></div>
                        </div>
                        <div class="col-auto" style="display: inline-flex;"><label for="inputPassword2" class="me-3 align-self-center text-primary">SNF</label>
                            <div class="col-sm"><input type="tel" class="form-control" name="snf" placeholder="16" required></div>
                        </div>
                    </div>
                    <div class="row g-3 mb-5 d-flex justify-content-end">
                        <div class="col-auto" style="display: inline-flex;"><label for="inputPassword2" class="me-3 align-self-center text-primary">CLR</label>
                            <div class="col-sm"><input type="tel" class="form-control" name="clr" placeholder="4" required></div>
                        </div>
                        <div class="col-auto" style="display: inline-flex;"><label for="inputPassword2" class="me-3 align-self-center text-primary">Rate</label>
                            <div class="col-sm"><input type="tel" id="rate" class="form-control" name="rate"  readonly></div>
                        </div>
                        <div class="col-auto" style="display: inline-flex;"><label for="inputPassword2" class="me-3 align-self-center text-primary">Total</label>
                            <div class="col-sm"><input type="text" id="total" class="form-control" name="total" placeholder="0" value="" readonly></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-auto" style="display: inline-flex;"><button type="submit " class="btn btn-success" name="save_data">Save</button></div>
                        <div class="col-auto" style="display: inline-flex;"><button type="submit " class="btn btn-primary" name="">Print</button></div>
                        <!-- <div class="col-auto" style="display: inline-flex;"><button type="submit " class="btn btn-warning" name="">Clear</button></div> -->
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