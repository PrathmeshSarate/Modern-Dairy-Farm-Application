<?php
    include('../connection.php');
    require '../vendor/autoload.php';
    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    session_start();
    $member_id = $_SESSION['username'];
    $member_name = $_SESSION['name'];
    $today_date = date("D d/m/Y");
    // $member_id = '1234';

    // CODE TO EMBEED THE IMG IN PDF
    $path = '../assets/img/header2.jpg';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    // CODE TO EMBEED THE IMG IN PDF

    if(isset($_POST['dayBtn'])){
    
        $date = $_POST['startDate'];
        // $date = $_GET['startDate'];

        $sql = "SELECT * FROM `milk_collection` WHERE `member_id` ='$member_id' AND `created_date` LIKE '$date%'";

        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result); 


        if($count>0){
            
            
            $grand_total=array();
            // exit();
            
            
            $html='
            <!DOCTYPE html>
            <html lang="en">
            
            <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Receipt</title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">

            <style>
            th{
                font-size:15px
            }
            td{font-size:15px}
            </style>

            </head>
            
            <body style=" margin: 10px;" >
            
            <div style="border: 2px solid black; padding:20px ;">
                <div style="margin-bottom: 40px;">
                    <img src="'.$base64.'" width="100%" height="170px">
                </div>
                <div style="margin-bottom: 20px;">
                    <div style="display: inline-block; width: 49%;">
                        <p><strong>Member ID:</strong> '.$member_id.'</p>
                        <p><strong>Invoice Date:</strong> '.$date.'</p>
                    </div>
                    <div style="display: inline-block; width: 49%; text-align: right;">
                        <p><strong>Name :</strong> '.$member_name.'</p>
                        <p><strong>Date:</strong> '.$today_date.'</p>
                    </div>
                </div>
                <div style="margin-bottom: 20px;">
                    <table style="width: 100%; border-collapse: collapse; border: 2px solid black; margin-bottom:40px">
                        <thead  style="background-color:lightblue;">
                            <tr>
                                <th style="border: 2px solid black; padding: 10px; width:10px">Bill ID</th>
                                <th style="border: 2px solid black; padding: 10px;">Time Slot</th>
                                <th style="border: 2px solid black; padding: 10px;">Animal Category</th>
                                <th style="border: 2px solid black; padding: 10px;">Liter</th>
                                <th style="border: 2px solid black; padding: 10px;">Fat</th>
                                <th style="border: 2px solid black; padding: 10px;">SNF</th>
                                <th style="border: 2px solid black; padding: 10px;">CLR</th>
                                <th style="border: 2px solid black; padding: 10px;">Rate</th>
                                <th style="border: 2px solid black; padding: 10px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            ';
                            $count = 0;
                            while($row = mysqli_fetch_assoc($result)){
                                $grand_total[$count]=$row['total'];
            // echo '<pre>';
            // print_r($row);
            
            // exit();
                            $html.=
                            '<tr>
                                <td style="border: 2px solid black; font-size:10px; padding: 10px;">'.$row['bil_id'].'</td>
                                <td style="border: 2px solid black; padding: 10px;">'.ucwords($row['time_slot']).'</td>
                                <td style="border: 2px solid black; padding: 10px;">'.ucwords($row['animal_category']).'</td>
                                <td style="border: 2px solid black; padding: 10px; text-align: right;">'.$row['liter'].'</td>
                                <td style="border: 2px solid black; padding: 10px; text-align: right;">'.$row['fat'].'</td>
                                <td style="border: 2px solid black; padding: 10px; text-align: right;">'.$row['snf'].'</td>
                                <td style="border: 2px solid black; padding: 10px; text-align: right;">'.$row['clr'].'</td>
                                <td style="border: 2px solid black; padding: 10px; text-align: right;">'.$row['rate'].'</td>
                                <td style="border: 2px solid black; padding: 10px; text-align: right;">Rs. '.$row['total'].'</td>
                            </tr>
                            ';
                            $count++;
                        
                        }
                        $gt = array_sum($grand_total);
                        // exit;
                        $html.= '
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8" class="text-end" style="text-align:right"><b>Total:</b></td>
                                <td style="border: 2px solid black; padding: 10px; text-align: right;"> Rs.'.$gt.'</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <p class="text-end" style="text-align: right; "><em>This is a computer-generated receipt, No signature is required</em></p>
            
    
            <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
            </body>

            </html>   ';
            // echo $html;exit;
            // instantiate and use the dompdf class
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');
            
                // Render the HTML as PDF
                $dompdf->render();
            
                // Output the generated PDF to Browser
                $dompdf->stream('invoice.pdf',['Attachment'=>0]);
        }else if($count==0){
            echo "<script>alert('No data found.'); 
            // var myurl = 'http://localhost/mega_php/member/receipt.php';
            var myurl = 'http://localhost/mega_php/member/receipt.php';
            window.location.href = myurl;</script>";
        }
    }else if(isset($_POST['monthBtn']))
    {
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        

        $sql = "SELECT * FROM `milk_collection` WHERE created_date BETWEEN '$startDate  00:00:00' AND '$endDate 23:59:59' AND `member_id` = '$member_id'";
        //   echo '<pre>';
        //   print_r($sql);
        //   exit();

        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result); 
        if($count>0){
            $html_month='
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Receipt</title>
                <!-- Bootstrap CSS -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">

                
            <style>
                th{
                border: 1px solid black;
                padding-left:13px;
                padding-right:13px;
                padding-top:5px;
                padding-bottom:5px;
                }
                td{
                border: 1px solid black;
                padding-left:33px;
                padding-right:33px;
                padding-top:5px;
                padding-bottom:5px;
                }
                tr{
                text-align: center;
                }
            </style>

            </head>

            <body>
                <div class="container-fluid  mt-5" style="border: 2px solid black; padding:20px">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                    <div style="margin-bottom: 20px;">
                        <img src="'.$base64.'" width="100%" height="170px">
                    </div>
                    <h2 style="text-align: center; font-weight: bold;">Invoice Details (Month)</h2>
                    <div style="margin-bottom: 20px;">
                        <div style="display: inline-block; width: 49%;">
                            <h3>Member ID : '.$member_id.'</h3>
                            <p><b>From :</b> '.$startDate.' <b> &nbsp; To :</b> '.$endDate.'</p>
                        </div>
                        <div style="display: inline-block; width: 49%; text-align: right;">
                                <h3>Name : '.$member_name.'</h3> 
                                <p><b>Date: </b><span id="invoiceDate">'.$today_date.'</span></p>
                        </div>
                    </div>
                    <!-- <hr> -->
                    <table  class="table table-bordered" style="border: 2px solid black;  margin-bottom:40px" >
                        <thead class="table-light" style="background-color:lightblue;">
                        <tr>
                            <th>Bil ID</th>
                            <th>Date</th>
                            <th>Time Slot</th>
                            <th>Animal Type</th>
                            <th>Liter</th>
                            <th>Fat</th>
                            <th>Rate</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        ';
            //           while ($rows = mysqli_fetch_assoc($result)) {
            // echo '<pre>';
            // print_r($rows);
            //           }
            // exit();
            $count = 0;

            while ($rows = mysqli_fetch_assoc($result)) {
                $grand_total[$count]=$rows['total'];

                        $html_month.=
                        '<tr>
                            <td style="font-size:13px">'.$rows["bil_id"].'</td>
                            <td>'.date("d/M/y", strtotime($rows["created_date"])).'</td>
                            <td>'.ucwords($rows["time_slot"]).'</td>
                            <td>'.ucwords($rows["animal_category"]).'</td>
                            <td>'.$rows["liter"].'</td>
                            <td>'.$rows["fat"].'</td>
                            <td>'.$rows["rate"].'</td>
                            <td> Rs.'.$rows["total"].'</td>
                        </tr>';
                        $count++;
            }
            $gt = array_sum($grand_total);
                        $html_month.='
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="7" class="text-end" style="text-align:right"><b>Total:</b></td>
                            <td> Rs.'.$gt.'</td>
                        </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
                </div>
                <p class="text-end" style="text-align: right; "><em>This is a computer-generated receipt, No signature is required</em></p>

                <!-- Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
            </body>

            </html> ';
            
            // echo $html_month;exit;

            // instantiate and use the dompdf class
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html_month);
            
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');
            
                // Render the HTML as PDF
                $dompdf->render();
            
                // Output the generated PDF to Browser
                $dompdf->stream('invoice.pdf',['Attachment'=>0]);
        }
        else if($count==0)
        {
                echo "<script>alert('No data found.'); 
                // var myurl = 'http://localhost/mega_php/member/receipt.php';
                var myurl = 'http://localhost/mega_php/member/receipt.php';
                window.location.href = myurl;</script>";
        }

    }

?>
