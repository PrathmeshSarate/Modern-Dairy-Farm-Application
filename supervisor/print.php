<?php


    include('../connection.php');
    require '../vendor/autoload.php';
    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    session_start();
    $supervisor_id = $_SESSION['username'];
    // $member_id = '1234';
    // $date = $_POST['startDate'];
    // $endDate = $_GET['startDate'];

    if(isset($_POST['dayBtn']))
    {
      $selectedDate = $_POST['selectedDate'];
      // $endDate = $_POST['endDate'];
      $sql = "SELECT * FROM `milk_collection` WHERE created_date LIKE '$selectedDate%'";

      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result); 
      // echo '<pre>';
      // print_r($sql);
      // exit();

      if($count>0)
        {
            
            
            $grand_total=array();
            // exit();
            
            
            $html='
            <style>
            th{
              border: 1px solid black;
            }
            td{
              border: 1px solid black;
              padding:7px;
            }
            tr{
              text-align: center;
            }
          </style>
          
            <div style="border: 2px solid black; padding: 20px;">
                <div style="margin-bottom: 20px;">
                    <h2 style="text-align: center; font-weight: bold;">Invoice Details</h2>
                </div>
                <div style="margin-bottom: 20px;">
                    <div style="display: inline-block; width: 49%;">
                        <p><strong>Supervisor ID:</strong> '.$supervisor_id.'</p>
                    </div>
                    <div style="display: inline-block; width: 49%; text-align: right;">
                        <p><strong>Invoice Date:</strong> '.$selectedDate.'</p>
                    </div>
                </div>
                <div style="margin-bottom: 20px;">
                    <table style="width: 100%; border-collapse: collapse; border: 2px solid black;">
                        <thead style="background-color: lightgray;">
                            <tr>
                                <th style="border: 2px solid black; padding: 10px;">Bill ID</th>
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
                                <td >'.$row['bil_id'].'</td>
                                <td >'.ucwords($row['time_slot']).'</td>
                                <td >'.ucwords($row['animal_category']).'</td>
                                <td >'.$row['liter'].'</td>
                                <td >'.$row['fat'].'</td>
                                <td >'.$row['snf'].'</td>
                                <td >'.$row['clr'].'</td>
                                <td >'.$row['rate'].'</td>
                                <td >'.$row['total'].'</td>
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
                            <td colspan="8" class="text-end">Total:</td>
                            <td  style="border: 2px solid black; padding: 10px; text-align: right;"> '.$gt.'</td>
                          </tr>
                        </tfoot>
                    </table>
                    
                </div>
            </div>
            <p class="text-end" style="text-align: right; "><em>This is a computer-generated receipt, No signature is required</em></p>
            
            ';


            
            // instantiate and use the dompdf class
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'potraite');
            
                // Render the HTML as PDF
                $dompdf->render();
            
                // Output the generated PDF to Browser
                $dompdf->stream('invoice.pdf',['Attachment'=>0]);
        }
      else if($count==0)
      {
          echo "<script>alert('No data found.'); 
          // var myurl = 'http://localhost/mega_php/supervisor/receipt.php';
          var myurl = 'http://localhost/mega_php/supervisor/receipt.php';
          window.location.href = myurl;</script>";
      }

    }
    else if(isset($_POST['monthBtn']))
    {
      $startDate = $_POST['startDate'];
      $endDate = $_POST['endDate'];

      $today_date = date("D d/m/Y");

      $sql = "SELECT * FROM `milk_collection` WHERE created_date BETWEEN '$startDate  00:00:00' AND '$endDate 23:59:59'";

      $result = mysqli_query($conn,$sql);
      $count = mysqli_num_rows($result); 
      // echo '<pre>';
      // print_r($count);
      // exit();
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
        }
        td{
          border: 1px solid black;
          padding-left:20px;
          padding-right:20px;
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
              <h2 style="text-align: center; font-weight: bold;">Invoice Details</h2>
              <div style="margin-bottom: 20px;">
                  <div style="display: inline-block; width: 49%;">
                      <h3>Invoice Details :</h3>
                      <p><b>From :</b> '.$startDate.' <b> &nbsp; To :</b> '.$endDate.'</p>
                  </div>
                  <div style="display: inline-block; width: 49%; text-align: right;">
                      <p><b>Date: </b><span id="invoiceDate">'.$today_date.'</span></p>
                  </div>
              </div>
              <!-- <hr> -->
              <table  class="table table-bordered" style="border: 2px solid black; " >
                <thead class="table-light" style="background-color:lightblue;">
                  <tr>
                    <th>Bil ID</th>
                    <th>Member ID</th>
                    <th>Member Name</th>
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
                    <td>'.$rows["bil_id"].'</td>
                    <td>'.$rows["member_id"].'</td>
                    <td>'.$rows["member_name"].'</td>
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
                    <td colspan="9" class="text-end" style="text-align:right"><b>Total:</b></td>
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
    exit;
      $startDate = $_GET['startDate'];
      $endDate = $_GET['endDate'];
      $today_date = date("D d/m/Y");
    $sql = "SELECT * FROM `milk_collection` WHERE created_date BETWEEN '$startDate  00:00:00' AND '$endDate 23:59:59'";

    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result); 
    // echo '<pre>';
    // print_r($count);
    // exit();
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
      }
      td{
        border: 1px solid black;
        padding-left:20px;
        padding-right:20px;
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
            <h2 style="text-align: center; font-weight: bold;">Invoice Details</h2>
            <div style="margin-bottom: 20px;">
                <div style="display: inline-block; width: 49%;">
                    <h3>Invoice Details :</h3>
                    <p><b>From :</b> '.$startDate.' <b> &nbsp; To :</b> '.$endDate.'</p>
                </div>
                <div style="display: inline-block; width: 49%; text-align: right;">
                    <p><b>Date: </b><span id="invoiceDate">'.$today_date.'</span></p>
                </div>
            </div>
            <!-- <hr> -->
            <table  class="table table-bordered" style="border: 2px solid black; " >
              <thead class="table-light" style="background-color:lightblue;">
                <tr>
                  <th>Bil ID</th>
                  <th>Member ID</th>
                  <th>Member Name</th>
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
                  <td>'.$rows["bil_id"].'</td>
                  <td>'.$rows["member_id"].'</td>
                  <td>'.$rows["member_name"].'</td>
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
                  <td colspan="9" class="text-end" style="text-align:right"><b>Total:</b></td>
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
