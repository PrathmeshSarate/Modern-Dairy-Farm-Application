<?php
include('../connection.php');

if(isset($_GET["searchTerm"])){
// Get search term from GET parameter
$searchTerm = $_GET["searchTerm"];

// Prepare SQL statement
$stmt = $conn->prepare("SELECT member_id, name, phone  FROM member WHERE member_id LIKE ? AND is_active=1");

// Bind parameter and execute statement
$searchTerm = "%" . $searchTerm . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();


// Get results and create array of member IDs
$result = $stmt->get_result();
$memberData = array();
while ($row = $result->fetch_assoc()) {
  $memberData[] = array(
    "value" => $row["member_id"],
    "name" => $row["name"],
    "phone" => $row["phone"]
  );
}
// echo '<pre>';
// print_r($memberData);
// exit();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($memberData);
}



if(isset($_GET["searchRate"])){


$searchRate = $_GET["searchRate"];

if ($searchRate >= floor($searchRate) + 0.6) {
  $roundedRate = ceil($searchRate);
} elseif ($searchRate >= floor($searchRate) + 0.1) {
  $roundedRate = floor($searchRate) + 0.5;
} else {
  $roundedRate = floor($searchRate);
}


// Prepare SQL statement
$stmt = $conn->prepare("SELECT rate FROM rate WHERE fat LIKE ?");

// Bind parameter and execute statement
$roundedRate = "%" . $roundedRate . "%";
$stmt->bind_param("s", $roundedRate);
$stmt->execute();


// Get results and create array of member IDs
$result = $stmt->get_result();
$rateData ;
$row = $result->fetch_assoc();
if(empty($row['rate']))
  {
    $rateData=null;
  }else
  {
    $rateData = $row["rate"];
  }

header('Content-Type: application/json');
echo json_encode($rateData);
}

?>