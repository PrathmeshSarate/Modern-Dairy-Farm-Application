<?php
session_start();
// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $senderId = $_SESSION['username'];
    $receiverId = $_POST["member_id"];
    $subject = $_POST["subject"];
    $content = $_POST["content1"];

    // Perform validation on the form data
    // ...

    // Process the message sending logic
    if (sendMessage($senderId, $receiverId, $subject, $content)) {
        // Message sent successfully
        echo "<script>alert('Message sent successfully!');window.location.href='http://localhost/mega_php/supervisor/message.php'</script>";
    } else {
        // Error sending the message
        echo "Error sending the message.";
    }
}

// Function to send the message
function sendMessage($senderId, $receiverId, $subject, $content) {
    include("../connection.php");
    $sql = "INSERT INTO message (sender_id, receiver_id, subject, content, timestamp, is_read, is_deleted) 
            VALUES ('$senderId', '$receiverId', '$subject', '$content', NOW(), 0, 0)";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        return true; // Message sent successfully
    } else {
        return false; // Error sending message
    }
    return true; // Replace this with your actual implementation
}

?>