<?php


    include('../connection.php');
    require '../vendor/autoload.php';
    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    session_start();
    $member_id = $_SESSION['username'];
    // $member_id = '1234';
    $date = $_POST['startDate'];

    if(isset($_POST['monthBtn']))
    {
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $sql = "SELECT * FROM `milk_collection` WHERE created_date BETWEEN '$startDate%' AND '$endDate%'";

    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result); 

	if($count>0)
    {
        
        
        $grand_total=array();
        // exit();
        
        
        $html='
        
        <div style="border: 2px solid black; padding: 20px;">
            <div style="margin-bottom: 20px;">
                <h2 style="text-align: center; font-weight: bold;">Bill Receipt</h2>
            </div>
            <div style="margin-bottom: 20px;">
                <div style="display: inline-block; width: 49%;">
                    <p><strong>Member ID:</strong> '.$member_id.'</p>
                </div>
                <div style="display: inline-block; width: 49%; text-align: right;">
                    <p><strong>Date:</strong> '.$date.'</p>
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
                            <td style="border: 2px solid black; padding: 10px;">'.$row['bil_id'].'</td>
                            <td style="border: 2px solid black; padding: 10px;">'.$row['time_slot'].'</td>
                            <td style="border: 2px solid black; padding: 10px;">'.$row['animal_category'].'</td>
                            <td style="border: 2px solid black; padding: 10px; text-align: right;">'.$row['liter'].'</td>
                            <td style="border: 2px solid black; padding: 10px; text-align: right;">'.$row['fat'].'</td>
                            <td style="border: 2px solid black; padding: 10px; text-align: right;">'.$row['snf'].'</td>
                            <td style="border: 2px solid black; padding: 10px; text-align: right;">'.$row['clr'].'</td>
                            <td style="border: 2px solid black; padding: 10px; text-align: right;">'.$row['rate'].'</td>
                            <td style="border: 2px solid black; padding: 10px; text-align: right;">'.$row['total'].'</td>
                        </tr>
                        ';
                        $count++;
                       
                    }
                    $gt = array_sum($grand_total);
                    // exit;
                       $html.= '
                    </tbody>
                </table>
            </div>
            <div>
                <p><strong>Total:</strong>'.$gt.' </p>
            </div>
        </div>
        
        
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
        // var myurl = 'http://localhost/mega_php/member/receipt.php';
        var myurl = 'http://localhost/mega_php/member/receipt.php';
        window.location.href = myurl;</script>";
    }

    }else if(isset($_POST['dayBtn']))
    {

    }
    $sql = "SELECT * FROM `milk_collection` WHERE created_date BETWEEN '2023-05-05 00:00:00' AND '2023-05-15 23:59:59' ";

    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result); 
    
 $html_month='


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Receipt</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="text-center">
          <p class="lead"><span >श्री. दत्त सह. दूध व्याव. व कृषिपूरक सेवा संस्था,</span><br>मर्या. , वाकरे, ता. करवीर, जि. कोल्हापूर</p>
        </div>
        <hr>
        <!-- <div class="row">
          <div class="col-md-6">
            <h5>Billed To:</h5>
            <p>Customer Name</p>
            <p>Customer Address</p>
          </div>
          <div class="col-md-6">
            <h5>Invoice Details:</h5>
            <p>Date: <span id="invoiceDate">May 14, 2023</span></p>
            <p>Invoice #: <span id="invoiceNumber">123456</span></p>
          </div>
        </div> -->
        <!-- <hr> -->
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>Bil ID</th>
              <th>Member ID</th>
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
              <td>'.$rows["created_date"].'</td>
              <td>'.$rows["time_slot"].'</td>
              <td>'.$rows["animal_category"].'</td>
              <td>'.$rows["liter"].'</td>
              <td>'.$rows["fat"].'</td>
              <td>'.$rows["rate"].'</td>
              <td>&#8377;'.$rows["total"].'</td>
            </tr>';
            $count++;
}
$gt = array_sum($grand_total);
            $html_month.='
          </tbody>
          <tfoot>
            <tr>
              <td colspan="8" class="text-end">Total:</td>
              <td> &#8377;'.$gt.'</td>
            </tr>
          </tfoot>
        </table>
        <p class="text-end"><em>This is a computer-generated receipt</em></p>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html> ';
echo $html_month;
?>