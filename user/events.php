<?php

require '../partials/session_check.php';

// session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<?php require 'partials/u-navbar.php' ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap4.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


	<script type="text/javascript">

			$('.editevent').click(function(e) {
				e.preventDefault();
				var eventId = this.value;


				$.ajax({
					type: "GET",
					url: "actions.php",
					data: {
						action: 'edit',
						eventId: eventId
					},

					success: function(response) {
						var jsonData = JSON.parse(response);

						$.each(jsonData, function(key, value) {

							$('#eid').val(value['eventId']);
							$('#etitle').val(value['title']);
							$('#edate-time').val(value['dataTime']);
							$('#edesc').val(value['description']);
							$('#eloc').val(value['location']);
							$('#status').val(value['status']);
							//$('#title').val(value['']);
						});

						$(' #updateevent').modal('show');

					}
				});

			});


	</script>

<script type="text/javascript">
$(document).ready(function() {
    $('.giveFeedback').click(function() {
        var eventId = this.value;
        // alert(eventId);
        // console.log(eventId);
        $('#IF-eventId').val(eventId);
    });
});

$(document).ready(function()
{
    $('.Estatistics').click(function()
    {
        var eventId=this.value;
        var url = 'feedback.php?id=' + encodeURIComponent(eventId);
        window.location.href=url;
    });
});

</script>
<style type="text/css">
:root
    {
       --bgcolor-1:#34495e ;
       --bgcolor-2:#2f3640;
       --ahover:#3498db;
    }

#gfeedback
{
	z-index:100000;	
}

.btn{
    margin-right:10px;
}

@media (max-width:909px)
{
    .btn{
        font-size: 14px;
        padding:3px 6px;
    }
}

</style>
</head>

<body>


	<div class="container">
		<h1>Events</h1>
		<hr>
		<div class="card" style="margin-top: 80px;">
			<div class="card-header bg-success text-white">
				Live Events
			</div>

			<div class="card-body">
				<?php
				require '../partials/dbconn.php';

				$query = "SELECT * FROM events WHERE status = 1 ORDER BY dataTime DESC";
				$events = mysqli_query($conn, $query);

				foreach ($events as $event) {
					echo '<div class="card mb-2">';

					echo '<div class="card-body">';

					echo '<input type="hidden" name="eventId" id="eventId" value="' . $event['eventId'] . '" >';

					echo '<h3 class="card-title" style="border-bottom:1px solid red" >' . $event['title'] . '</h3>';

					echo '<h6 class="card-title">' . $event['dataTime'] . '</h6>';

					echo '<p class="card-text">' . $event['description'] . '</p>';

					echo '	<p class="card-footer">Location: ' . $event['location'] . '</p>';

					echo '<div class="card-footer d-flex justify-content-end">';
					echo '<div class="btn-group" role="group" aria-label="Event Actions">';
					// button for feedback form
					echo '<button type="button" value="' . $event['eventId'] . '" class="btn btn-primary giveFeedback" data-toggle="modal" data-target="#gfeedback" style="border-radius: 4px;">Give Feedback</button>';
                    echo '<button type="button" value="' . $event['eventId'] . '" class="btn btn-success Estatistics"  id="giveFeedback" style="border-radius: 4px;">View Statistics</button>';

					echo '</div>';
					echo '</div>';
					echo '</div>';
					echo '</div>';
				}
				mysqli_close($conn); //close conn	
				?>
			</div>
		</div>
	</div>



<div class="modal fade" id="gfeedback" role="dialog">
 		<div class="modal-dialog">
 			<div class="modal-content">
 				
 				<div class="modal-header">
 					<h5 class="modal-title">Please Give Us Feedback</h5>
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 				</div>

 				<form name="adF-form" action="partials/php/add-feedback.php" method="POST">

 					<div class="modal-body">

		<!--  --><input type="hidden" name="IF-eventId" id="IF-eventId" value="">
 						<div class="form-group">
									<label>How relevant is the session content to the topic?</label><br>
    <div>
        <input type="radio" name="relevance" value="5" id="relevance_5" required>
        <label for="relevance_5">5 - Extremely relevant</label><br>
    </div>
    <div>
        <input type="radio" name="relevance" value="4" id="relevance_4" required>
        <label for="relevance_4">4 - Very relevant</label><br>
    </div>
    <div>
        <input type="radio" name="relevance" value="3" id="relevance_3" required>
        <label for="relevance_3">3 - Moderately relevant</label><br>
    </div>
    <div>
        <input type="radio" name="relevance" value="2" id="relevance_2" required>
        <label for="relevance_2">2 - Slightly relevant</label><br>
    </div>
    <div>
        <input type="radio" name="relevance" value="1" id="relevance_1" required>
        <label for="relevance_1">1 - Not relevant at all</label><br>
    </div>
								</div>

								<div class="form-group">
    <label>How clear are the explanations and examples provided during the session?</label><br>
    
    <div>
        <input type="radio" name="clarity" value="5" required>
        <label>5 - Very clear</label><br>
    </div>
    
    <div>
        <input type="radio" name="clarity" value="4" required>
        <label>4 - Clear</label><br>
    </div>
    
    <div>
        <input type="radio" name="clarity" value="3" required>
        <label>3 - Moderately clear</label><br>
    </div>
    
    <div>
        <input type="radio" name="clarity" value="2" required>
        <label>2 - Somewhat clear</label><br>
    </div>
    
    <div>
        <input type="radio" name="clarity" value="1" required>
        <label>1 - Unclear</label><br>
    </div>
</div>

					<div class="form-group">
    <label>How engaging is the session in capturing your interest and attention?</label><br>
    
    <div>
        <input type="radio" name="Engagement" value="5" required>
        <label>5 - Highly engaging</label><br>
    </div>
    
    <div>
        <input type="radio" name="Engagement" value="4" required>
        <label>4 - Engaging</label><br>
    </div>
    
    <div>
        <input type="radio" name="Engagement" value="3" required>
        <label>3 - Moderately engaging</label><br>
    </div>
    
    <div>
        <input type="radio" name="Engagement" value="2" required>
        <label>2 - Slightly engaging</label><br>
    </div>
    
    <div>
        <input type="radio" name="Engagement" value="1" required>
        <label>1 - Not engaging at all</label><br>
    </div>
</div>

								<div class="form-group">
    <label>How effectively does the presenter encourage interaction and participation?</label><br>
    
    <div>
        <input type="radio" name="interaction" value="5" required>
        <label>5 - Very effectively</label><br>
    </div>
    
    <div>
        <input type="radio" name="interaction" value="4" required>
        <label>4 - Effectively</label><br>
    </div>
    
    <div>
        <input type="radio" name="interaction" value="3" required>
        <label>3 - Moderately effectively</label><br>
    </div>
    
    <div>
        <input type="radio" name="interaction" value="2" required>
        <label>2 - Somewhat effectively</label><br>
    </div>
    
    <div>
        <input type="radio" name="interaction" value="1" required>
        <label>1 - Not effectively at all</label><br>
    </div>
</div>

<div class="form-group">
    <label>How do you rate the overall technical quality of this session?</label><br>
    
    <div>
        <input type="radio" name="Technical" value="5" required>
        <label>5 - Excellent</label><br>
    </div>
    
    <div>
        <input type="radio" name="Technical" value="4" required>
        <label>4 - Very good</label><br>
    </div>
    
    <div>
        <input type="radio" name="Technical" value="3" required>
        <label>3 - Good</label><br>
    </div>
    
    <div>
        <input type="radio" name="Technical" value="2" required>
        <label>2 - Fair</label><br>
    </div>
    
    <div>
        <input type="radio" name="Technical" value="1" required>
        <label>1 - Poor</label><br>
    </div>
</div>

<div class="form-group">
    <label>How satisfied are you overall with this session?</label><br>
    
    <div>
        <input type="radio" name="Satisfaction" value="5" required>
        <label>5 - Very satisfied</label><br>
    </div>
    
    <div>
        <input type="radio" name="Satisfaction" value="4" required>
        <label>4 - Satisfied</label><br>
    </div>
    
    <div>
        <input type="radio" name="Satisfaction" value="3" required>
        <label>3 - Neutral</label><br>
    </div>
    
    <div>
        <input type="radio" name="Satisfaction" value="2" required>
        <label>2 - Dissatisfied</label><br>
    </div>
    
    <div>
        <input type="radio" name="Satisfaction" value="1" required>
        <label>1 - Very dissatisfied</label><br>
    </div>
</div>

<div class="form-group">
    <label>Provide Any Additional comment?</label><br>
    
    <div>

    <?php
    	require '../partials/dbconn.php';

    	$CuserId = $_SESSION['username'];
    	// Check the status of the user
		$query = "SELECT fenable FROM credentials WHERE userId = ?"; // Replace userId with the actual field name
		$stmt = $conn->prepare($query);
		$stmt->bind_param("s", $CuserId); // Assuming $userId is the id of the logged-in user
		$stmt->execute();
		$stmt->bind_result($status);
		$stmt->fetch();
		$stmt->close();

		// echo ''.$CuserId.'';
		// echo 'console.log('.$status.')';

		if ($status==1) {
			 $disabled = ""; // If status is 1, textarea will be enabled
			  $placeholder = "Write your comment here...";
		}else
		{
			 $disabled = "disabled"; // If status is not 1, textarea will be disabled
			 $placeholder = "Comments are disabled.";

		}

    ?>
       <textarea name="ad-comment" class="form-control" placeholder="<?php echo $placeholder; ?>" <?php echo $disabled;?>></textarea>
        
    </div>
</div>

 					   <div class="modal-footer">
 						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
 						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
 					</div>

 				</form>
 			</div>
 		</div>
 </div>


</body>

</html>