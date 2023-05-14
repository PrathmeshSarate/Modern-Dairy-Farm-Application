<?php
include('../connection.php');
// Assuming you have a database connection already established

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the messageId parameter is set
    if (isset($_POST['messageId'])) {
        $messageId = $_POST['messageId'];

        // Update the is_read field in the message table
        $sql = "UPDATE message SET is_read = 1 WHERE message_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $messageId);
        mysqli_stmt_execute($stmt);

        // Check if the update was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Return a success response
            echo json_encode(['status' => 'success', 'message' => 'is_read field updated successfully']);
        } else {
            // Return an error response
            echo json_encode(['status' => 'error', 'message' => 'Failed to update is_read field']);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Return an error response if messageId parameter is missing
        echo json_encode(['status' => 'error', 'message' => 'Message ID not provided']);
    }
} else {
    // Return an error response for invalid request method
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

?>
