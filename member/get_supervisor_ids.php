<?php
include('../connection.php');

if(isset($_GET["searchTerm"])){
    // Get search term from GET parameter
    $searchTerm = $_GET["searchTerm"];
    
    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT supervisor_id,name FROM `supervisor` WHERE supervisor_id LIKE  ?");
    
    // Bind parameter and execute statement
    $searchTerm = "%" . $searchTerm . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    
    
    // Get results and create array of member IDs
    $result = $stmt->get_result();
    $supervisorData = array();
    while ($row = $result->fetch_assoc()) {
      $supervisorData[] = array(
        "value" => $row["supervisor_id"],
        "name" => $row["name"],
      );
    }
    // echo '<pre>';
    // print_r($memberData);
    // exit();
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($supervisorData);
    }

?>