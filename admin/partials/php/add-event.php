<?php


require '../../../partials/dbconn.php';

if (isset($_POST['submit'])) {
	// code...
	$title = $_POST['etitle'];
	$datatime = $_POST['edate-time'];
	$desc = $_POST['edesc'];
	$location = $_POST['eloc'];

	//initally status 0
	$status = 0;

	// Prepare INSERT statement
$insert = "INSERT INTO events (title, dataTime, description, location, status) VALUES (?, ?, ?, ?, ?)";


	//prepare & bind paramters
	$stmt = $conn->prepare($insert);
	$stmt->bind_param("ssssi", $title, $datatime, $desc, $location, $status);

	// Execute statement
if ($stmt->execute()) {
    echo "<script>alert('Event added successfully');</script>";
} else {
    echo "<script>alert('Error adding event');</script>";
}



	$title = "";
	$datatime = "";
	$desc = "";
	$location ="";

	// Close statement
$stmt->close();

// Close connection
$conn->close();

echo '<script>window.location.href = "../../create-event.php";</script>';  //to avoid auto submit on refreshs
exit();
	


}


if (isset($_POST['up-event'])) {
	// code...
	$eventId = $_POST['eid'];

	$title = $_POST['etitle'];
	$datatime = $_POST['edate-time'];
	$desc = $_POST['edesc'];
	$location = $_POST['eloc'];

	//current status 
	$status = $_POST['status'];

	// Prepare INSERT statement
$update = "UPDATE events SET title=?, dataTime=?, description=?, location=?, status=? WHERE eventId=?";


	//prepare & bind paramters
	$stmt = $conn->prepare($update);
	$stmt->bind_param("ssssii", $title, $datatime, $desc, $location, $status,$eventId);

	// Execute statement
if ($stmt->execute()) {
    echo "<script>alert('Event Updated successfully');</script>";
} else {
    echo "<script>alert('Error While Updating Event');</script>";
}

	// Close statement
$stmt->close();

// Close connection
$conn->close();

echo '<script>window.location.href = "../../create-event.php";</script>';  //to avoid auto submit on refreshs
exit();
	


}










?>