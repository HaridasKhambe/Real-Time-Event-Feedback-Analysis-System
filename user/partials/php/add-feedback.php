<?php

session_start();

require '../../../partials/dbconn.php';

if (isset($_POST['submit'])) {
	// code...
	$CeventId = $_POST['IF-eventId'];

	echo $CeventId;
	//get current userId
	$CuserId = $_SESSION['username'];

	//data Time
	date_default_timezone_set('Asia/Kolkata');
	$currentDateTime = date("Y-m-d H:i:s");

	$Crelevance = $_POST['relevance'];
	$Cclarity = $_POST['clarity'];
	$CEngagement = $_POST['Engagement'];
	$Cinteraction = $_POST['interaction'];
	$CTechnical = $_POST['Technical'];
	$CSatisfaction = $_POST['Satisfaction'];

	$Ccomment = $_POST['ad-comment'];
	

// 	// Prepare INSERT statement
$insert = "INSERT INTO efeedback (eventId, userId, dataTime,relevance,clarity ,engagement,interaction,tech_quality,overall_satisfaction,comment ) VALUES (?, ?, ?, ?, ?,?,?,?,?,?)";


	//prepare & bind paramters
	$stmt = $conn->prepare($insert);
	$stmt->bind_param("issiiiiiis", $CeventId,$CuserId,$currentDateTime,$Crelevance,$Cclarity,$CEngagement,$Cinteraction,$CTechnical,$CSatisfaction,$Ccomment);

	// Execute statement
if ($stmt->execute()) {
    echo "<script>alert('Your Feedback Has Been Recorded');</script>";
} else {
    echo "<script>alert('Error While Recording Feedback!');</script>";
}



	// Close statement
$stmt->close();

// Close connection
$conn->close();

echo '<script>window.location.href = "../../events.php";</script>';  //to avoid auto submit on refreshs
exit();
	


}


?>