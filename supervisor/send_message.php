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
            VALUES ($senderId, $receiverId, '$subject', '$content', NOW(), 0, 0)";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        return true; // Message sent successfully
    } else {
        return false; // Error sending message
    }
    return true; // Replace this with your actual implementation
}





// exit();



// Function to send a message from a member to a supervisor
function sendMessageFromMemberToSupervisor($senderId, $receiverId, $subject, $content) {
    // Assuming you have a database connection established

    // SQL query to insert the message into the database
    $sql = "INSERT INTO message (sender_id, receiver_id, subject, content, timestamp, is_read, is_deleted) 
            VALUES ($senderId, $receiverId, '$subject', '$content', NOW(), 0, 0)";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        return true; // Message sent successfully
    } else {
        return false; // Error sending message
    }
}

// Function to send a message from a supervisor to a member
function sendMessageFromSupervisorToMember($senderId, $receiverId, $subject, $content) {
    // Assuming you have a database connection established

    // SQL query to insert the message into the database
    $sql = "INSERT INTO message (sender_id, receiver_id, subject, content, timestamp, is_read, is_deleted) 
            VALUES ($senderId, $receiverId, '$subject', '$content', NOW(), 0, 0)";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        return true; // Message sent successfully
    } else {
        return false; // Error sending message
    }
}

// Usage example:

// Sending a message from a member to a supervisor
$senderId = 123; // Member ID
$receiverId = 456; // Supervisor ID
$subject = "Important Message";
$content = "Hello Supervisor, I have an important matter to discuss.";
$result = sendMessageFromMemberToSupervisor($senderId, $receiverId, $subject, $content);
if ($result) {
    echo "Message sent successfully from member to supervisor.";
} else {
    echo "Error sending message from member to supervisor.";
}

// Sending a message from a supervisor to a member
$senderId = 456; // Supervisor ID
$receiverId = 123; // Member ID
$subject = "Reply to Your Message";
$content = "Hello Member, thank you for reaching out. Here is my reply.";
$result = sendMessageFromSupervisorToMember($senderId, $receiverId, $subject, $content);
if ($result) {
    echo "Message sent successfully from supervisor to member.";
} else {
    echo "Error sending message from supervisor to member.";
}
?>


