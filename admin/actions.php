<?php
    
    require '../partials/dbconn.php';



// Check if eventId is set in the request
if(isset($_GET['action']) && isset($_GET['eventId'])) {
    $action = $_GET['action'];
    $eventId = $_GET['eventId'];

    //for edit event
    $arrayresult = [];
    $flag = 0;

   if ($action === 'start') {
       // code...
      $sql = "UPDATE events SET status = 1 WHERE eventId = '$eventId'";
   }elseif ($action === 'pause') {
       // code...
    $sql = "UPDATE events SET status = 0 WHERE eventId = '$eventId'";

   }elseif ($action === 'end') {
                //end & insert stat in passed event table
     $sql = "UPDATE events SET status = 2 WHERE eventId = '$eventId'";

   }elseif ($action === 'delete') {
       // code...

        $preDelete = "DELETE FROM efeedback WHERE eventId = '$eventId'";

        if(mysqli_query($conn, $preDelete)) {
        // records deleted from efeedback table
         $sql = "DELETE FROM events WHERE eventId = '$eventId'";
        }

   }else if($action ==='edit'){

        $flag =1; //perform edit event seperatly

   }else {
        // Invalid action
        $response = array('status' => 'error', 'message' => 'Invalid action');
        echo json_encode($response);
        exit(); // Terminate script execution
    }
   
  
    // Execute the query
if ($flag==1) {
    
    $sql = "SELECT * FROM events WHERE eventId='$eventId'";
    $fetch_q = mysqli_query($conn, $sql);

    if ($fetch_q && mysqli_num_rows($fetch_q) > 0) {
        // code...
        $row = mysqli_fetch_assoc($fetch_q);
        array_push($arrayresult, $row);

        echo json_encode($arrayresult);
    }
    
}else
{
    if(mysqli_query($conn, $sql)) {
        // Update successful

        $response = array('status' => 'success', 'message' => ucfirst($action) . ' Operation Successful');
    } else {
        // Update failed
        $response = array('status' => 'error', 'message' => ucfirst($action). 'Operation Failed');
    }
     // Send the response back to the AJAX call
   // header('Content-Type: application/json');
    echo json_encode($response);
}
} else {
    // eventId is not set in the request
    $response = array('status' => 'error', 'message' => 'Action or Event ID not provided');
    echo json_encode($response);
}

?>
