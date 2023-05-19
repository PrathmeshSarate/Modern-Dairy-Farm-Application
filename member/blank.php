<?php
    include('../connection.php');
    require '../vendor/autoload.php';
    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    session_start();
    $member_id = $_SESSION['username'];
    // $member_id = '1234';
    // $date = $_POST['startDate'];
    $date = $_GET['startDate'];

    $sql = "SELECT * FROM `milk_collection` WHERE `member_id` ='$member_id' AND `created_date` LIKE '$date%'";

    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result); 

    $path = '../assets/img/header2.jpg';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
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
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        </head>
        
        <body style=" padding: 20px;background-color:#D6E2E4">
        <div style="border: 2px solid black; padding: 20px;">
            <div style="margin-bottom: 20px;">
                <img src="'.$base64.'" width="100%" height="170px">
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
                            <td style="border: 2px solid black; padding: 10px; text-align: right;"><i class="fa-solid fa-indian-rupee-sign fa-xs"></i> '.$row['total'].'</td>
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
            <div class="text-end">
                <p><strong>Total: <i class="fa-solid fa-indian-rupee-sign fa-xs"></i> </strong>'.$gt.' </p>
            </div>
        </div>
        
 
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>   ';
echo $html;exit;
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potraite');
        
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

?>
