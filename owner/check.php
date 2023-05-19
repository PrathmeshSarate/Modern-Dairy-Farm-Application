<?php
session_start(); 
include("../connection.php");
if(!isset($_SESSION['name']))
{
    // echo '<script> alert("WARNING : Please Login !!!"); window.location.href="../login.php"</script>';
    header("Location:../login.php");
    echo "<script>alert('error')</script>";

}
function formatMarathiDate($dateString)
{
    // Create a DateTime object with the provided date string
    $date = new DateTime($dateString);

    // Define arrays for Marathi date components
    $daysOfWeek = array(
        'रवि',
        'सोम',
        'मंगळ',
        'बुध',
        'गुरु',
        'शुक्र',
        'शनि'
    );
    $months = array(
        'जानेवारी',
        'फेब्रुवारी',
        'मार्च',
        'एप्रिल',
        'मे',
        'जून',
        'जुलै',
        'ऑगस्ट',
        'सप्टेंबर',
        'ऑक्टोबर',
        'नोव्हेंबर',
        'डिसेंबर'
    );
    $numbers = array(
        '०',
        '१',
        '२',
        '३',
        '४',
        '५',
        '६',
        '७',
        '८',
        '९'
    );

    // Get the day of the week and month in Marathi
    $dayOfWeek = $daysOfWeek[$date->format('w')];
    $marathiDay = '';
    foreach (str_split($date->format('d')) as $digit) {
        $marathiDay .= $numbers[$digit];
    }
    $month = $months[$date->format('n') - 1];

    // Convert the year to Marathi
    $marathiYear = '';
    foreach (str_split($date->format('Y')) as $digit) {
        $marathiYear .= $numbers[$digit];
    }

    // Format the date in Marathi
    $formattedDate = $dayOfWeek . ' ' . $marathiDay . '-' . $month . '-' . $marathiYear;

    // Return the formatted date
    return $formattedDate;
}    

function formatMarathiTime($timeString)
{
    // Create a DateTime object with the provided time string
    $time = new DateTime($timeString);

    // Define arrays for Marathi time components
    $numbers = array(
        '०',
        '१',
        '२',
        '३',
        '४',
        '५',
        '६',
        '७',
        '८',
        '९'
    );
    $periodTranslations = array(
        'AM' => 'सकाळ',
        'PM' => 'संध्याकाळ'
    );

    // Get the hours, minutes, and AM/PM indicator
    $hours = $time->format('h');
    $minutes = $time->format('i');
    $amPm = $time->format('A');

    // Convert the hours and minutes to Marathi
    $marathiHours = '';
    foreach (str_split($hours) as $digit) {
        $marathiHours .= $numbers[$digit];
    }
    $marathiMinutes = '';
    foreach (str_split($minutes) as $digit) {
        $marathiMinutes .= $numbers[$digit];
    }

    // Get the Marathi translation for the period
    $marathiPeriod = isset($periodTranslations[$amPm]) ? $periodTranslations[$amPm] : '';

    // Format the time in Marathi
    $formattedTime = $marathiHours . ':' . $marathiMinutes . ' ' . $marathiPeriod;

    // Return the formatted time
    return $formattedTime;
}



function convertToMarathiNumber($number)
{
    $englishNumbers = array('0','1','2','3','4','5','6','7','8','9');
    $marathiNumbers = array('०','१','२','३','४','५','६','७','८','९');

    // Convert each English number to its corresponding Marathi number
    $marathiNumber = str_replace($englishNumbers, $marathiNumbers, $number);

    // Return the Marathi number
    return $marathiNumber;
}
?>
