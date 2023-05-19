<?php include('check.php');define("TITLE", "Message"); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Member | <?php if (TITLE !== "") {
                        echo TITLE;
                    } ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/jquery-ui.css">
    
    
    <!-- <script src="../assets/js/jquery.min.js"></script> -->
    
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery-ui.js"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php require 'include/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php 
                require 'include/topbar.php'; 
                ?>
            
            <script>
                $(document).ready(function() {
                    $("#supervisor_id_input").autocomplete({
                        source: function(request, response) {
                            $.ajax({
                                url: "get_supervisor_ids.php",
                                method: "GET",
                                data: {
                                    searchTerm: request.term
                                },
                                success: function(data) {
                                    response(data);
                                    // response(data.name);
                                    console.log(data);
                                    // let selectedID = $('#supervisor_name_input').val;
                                    // for (let key in data.name)
                                    // console.log(data.name[selectedID]);
                                    // $('#supervisor_name_input').val = data.name[selectedID];
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error(errorThrown);
                                }
                            });
                        },
                        minLength: 1,
                        select: function(event, ui) {
                            $("#supervisor_id_input").val(ui.item.value);
                            $("#supervisor_name_input").val(ui.item.name);
                            return false;
                        }
                    });


                });
            </script>

            <script>
                $(document).ready(function() {
                    // Listen for modal show event
                    
                    $('.btn_msg_close').on("click", function () {

                        window.location.reload();

                    } );
                    $('.modal').on('show.bs.modal', function(event) {
                        var button = $(event.relatedTarget);
                        var messageId = button.data('message-id');
                        // console.log(messageId);
                        // Send AJAX request to update is_read field
                        $.ajax({
                            url: '../supervisor/update_message.php',
                            type: 'POST',
                            data: { messageId: messageId },
                            success: function(response) {
                                console.log(response);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error updating is_read field:', error);
                            }
                        });
                    });
                });
            </script>

            <?php
                // Function to fetch messages from the database
                function getReadMessages() {
                    include("../connection.php");
                    $member_id = $_SESSION['username'];

                    // Query to fetch messages with sender and receiver information
                    $query = "SELECT m.message_id, m.subject, m.content, m.timestamp, 
                    s.name AS sender_name
                    FROM message AS m                    
                    INNER JOIN supervisor AS s ON m.sender_id = s.supervisor_id                    
                    WHERE m.is_read=1 and m.receiver_id = '$member_id'
                    ORDER BY m.timestamp DESC";
                    // echo '<pre>';
                    // print_r($query);
                    // exit();

                    // Execute the query
                    $result = mysqli_query($conn, $query);

                    // Fetch all rows as an associative array
                    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    // Free result set
                    mysqli_free_result($result);

                    // Close the connection
                    mysqli_close($conn);

                    return $messages;
                }
                // Function to fetch messages from the database
                function getMessages() {
                    include("../connection.php");
                    $member_id = $_SESSION['username'];

                    // Query to fetch messages with sender and receiver information
                    $query = "SELECT m.message_id, m.subject, m.content, m.timestamp, 
                    s.name AS sender_name
                    FROM message AS m                    
                    INNER JOIN supervisor AS s ON m.sender_id = s.supervisor_id                    
                    WHERE m.is_read=0 and m.receiver_id = '$member_id'
                    ORDER BY m.timestamp DESC
                    ";
                    // echo '<pre>';
                    // print_r($query);
                    // exit();

                    // Execute the query
                    $result = mysqli_query($conn, $query);

                    // Fetch all rows as an associative array
                    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    // Free result set
                    mysqli_free_result($result);

                    // Close the connection
                    mysqli_close($conn);

                    return $messages;
                }

                // Retrieve messages from the database
                $messages = getMessages();
                $readmessages = getReadMessages();
            ?>

                <!-- Begin Page Content -->
                <div style="width: 100%; text-align:left" class="table-data">
                <div class="container-fluid">
                    <div class="row"><br>
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="tab" href="#inbox" aria-selected="true" role="tab">Inbox <?php if(count($messages)>0){?> <span class="badge bg-danger"><?php echo count($messages) ?></span><?php }?></a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link " data-bs-toggle="tab" href="#compose" aria-selected="false" role="tab" tabindex="-1">Create message</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#read" aria-selected="false" role="tab" tabindex="-1">Read messages</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="inbox" class="container-fluid tab-pane active show" role="tabpanel"><br>
                            
                                <table class="table table-striped">
                                    <!-- <thead>
                                        <tr>
                                            <th>Sender</th>
                                            <th>Subject</th>
                                            <th>Timestamp</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> -->
                                    <tbody>
                                        <?php
                                        if(empty($messages))
                                        {
                                            ?>No new messages<?php
                                            
                                        }else{
                                        foreach ($messages as $message): 
                                            $date = new DateTime($message['timestamp']);
                                            $formatted_date = $date->format('D d-M-Y h:i:s A');?>
                                            <tr>
                                                <td><span class="text-black">From : </span><?php echo $message['sender_name']; ?></td>
                                                <td><?php echo $formatted_date; ?></td>
                                                <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messageModal-<?php echo $message['message_id']; ?>" data-message-id="<?php echo $message['message_id']; ?>">Open</button></td>
                                            </tr>
                                             <!-- Modal for each message -->
                                                <div class="modal fade" id="messageModal-<?php echo $message['message_id']; ?>" tabindex="-1" aria-labelledby="messageModalLabel-<?php echo $message['message_id']; ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="messageModalLabel-<?php echo $message['message_id']; ?>">Subject : <span class="text-primary"><?php echo $message['subject']; ?></span></h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?php echo $message['content']; ?></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn_msg_close" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php endforeach; }?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="compose" class="container-fluid tab-pane fade" role="tabpanel"><br>
                                <ul class="pt-5" style="list-style-type: none;">
                                    <div class="py-2">
                                        <form action="send_message.php" method="POST">
                                            <h3>Send new message to Supervisor</h3>

                                            <div class="row g-3 mb-2 mt-4 d-flex justify-content-center">
                                                <div class="col-auto" style="display: inline-flex;"><label for="inputPassword2" class="me-3 align-self-center ">Member ID. :</label>
                                                    <div class="col-sm">
                                                        <input type="tel" class="form-control" name="supervisor_id_input" id="supervisor_id_input" placeholder="4" autocomplete="off">


                                                    </div>
                                                </div>
                                                <div class="col-auto" style="display: inline-flex;">
                                                <!-- <label for="inputPassword2" class="me-3 align-self-center">Name :</label> -->
                                                    <div class="col-sm">
                                                        <!-- <input type="tel" class="form-control text-primary" name="center_code" disabled > -->
                                                        <input type="text" class="form-control" name="member_namet" id="supervisor_name_input" placeholder="Name will displayed here" readonly>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="mb-3">
                                                <!-- <label for="supervisorId">Supervisor ID:</label> -->
                                                <input type="hidden" class="form-control" id="supervisorId" name="supervisorId" required>
                                            </div>

                                            <div class="mb-3">
                                                <!-- <label for="memberId">Member ID:</label> -->
                                                <input type="hidden" class="form-control" id="memberId" name="memberId" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="subject">Subject:</label>
                                                <input type="text" class="form-control" id="subject" name="subject" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="content">Description:</label>
                                                <textarea class="form-control" id="content1" name="content1" rows="5" required></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Send Message</button>
                                        </form>
                                    </div>
                                </ul>
                            </div>
                            <!-- <div id="inbox" class="container-fluid tab-pane fade" role="tabpanel"><br>
                                <ul class="pt-5" style="list-style-type: none;">
                                    <div class="py-2">
                                        <li class="bg-primary text-white ps-4" style="padding: 30px 0px; border-radius: 20px;">
                                            <h5>From : Admin</h5><small>&nbsp;Reguarding your query</small><a href=""><span class="float-end me-5 text-black btn btn-light">Open</span></a>
                                        </li>
                                    </div>
                                    <div class="py-2">
                                        <li class="bg-success text-white ps-4 " style="padding: 30px 0px; border-radius: 20px;">
                                            <h5>From : Supervisor</h5><small>&nbsp;Reguarding milk query</small><a href=""><span class="float-end me-5 text-black btn btn-light">Open</span></a>
                                        </li>
                                    </div>
                                </ul>
                            </div> -->
                            <div id="read" class="container-fluid tab-pane fade" role="tabpanel"><br>
                                <table class="table table-striped">
                                        <!-- <thead>
                                            <tr>
                                                <th>Sender</th>
                                                <th>Subject</th>
                                                <th>Timestamp</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead> -->
                                        <tbody>
                                            <?php
                                            if(empty($readmessages))
                                            {
                                                ?>No new messages<?php
                                                
                                            }else{
                                            foreach ($readmessages as $message): 
                                                $date = new DateTime($message['timestamp']);
                                                $formatted_date = $date->format('D d-M-Y h:i:s A');?>
                                                <tr>
                                                    <td><span class="text-black">From : </span><?php echo $message['sender_name']; ?></td>
                                                    <td><?php echo $formatted_date; ?></td>
                                                    <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#readModal-<?php echo $message['message_id']; ?>" >Open</button></td>
                                                </tr>
                                                <!-- Modal for each message -->
                                                    <div class="modal fade" id="readModal-<?php echo $message['message_id']; ?>" tabindex="-1" aria-labelledby="messageModalLabel-<?php echo $message['message_id']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="messageModalLabel-<?php echo $message['message_id']; ?>">Subject : <span class="text-primary"><?php echo $message['subject']; ?></span></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><?php echo $message['content']; ?></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php endforeach; }?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
    <!-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>



</body>

</html>