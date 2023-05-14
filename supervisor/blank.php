
<?php

// THIS IS DEV BRANCH
require '../vendor/autoload.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;
$html='
?>
<div>
<div>
    <div>
        <h4>Bill Receipt</h4>
    </div>
    <div>
        <div>
            <p><strong>Bill ID:</strong> bil_id</p>
            <p><strong>Member ID:</strong> member_id</p>
        </div>
        <div>
            <p><strong>Date:</strong> Thursday, May 5th, 2023</p>
            <p><strong>Time Slot:</strong> time_slot</p>
        </div>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Animal Category</th>
                    <th>Liter</th>
                    <th>Fat</th>
                    <th>SNF</th>
                    <th>CLR</th>
                    <th>Rate</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>animal_category</td>
                    <td>liter</td>
                    <td>fat</td>
                    <td>snf</td>
                    <td>clr</td>
                    <td>rate</td>
                    <td>total</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <p><strong>Total:</strong> total</p>
    </div>
</div>
</div>

    <?php
    ';
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream('invoice.pdf',['Attachment'=>0]);
    ?>
