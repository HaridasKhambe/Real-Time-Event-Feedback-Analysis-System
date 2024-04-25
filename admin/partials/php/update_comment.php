<?php

   require '../../../partials/dbconn.php';



// Check if eventId is set in the request
if(isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    $sql = "UPDATE credentials SET fenable = 0 WHERE userId = '$userId'";


  	if(mysqli_query($conn, $sql)) {
        // Update successful

        $response = array('status' => 'success', 'message' => ' Comment Permission disabled successfully');
    } else {
        // Update failed
        $response = array('status' => 'error', 'message' => 'Error While Disabling Comment Permission!');
    }

     echo json_encode($response);
  }







?>