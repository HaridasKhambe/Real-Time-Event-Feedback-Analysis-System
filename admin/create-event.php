<?php

require '../partials/session_check.php';

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

	<?php require 'partials/a-navbar.php'?>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" >
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap4.css">

	<!-- modal show function -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>



<style type="text/css">
root:{
	 --bgcolor-1:#34495e ;
	   --bgcolor-2:#2f3640;
	   --ahover:#3498db;
}
*{
	padding:0;
	margin:0;
}

#ce-btn{
	margin:90px auto;
	background:var(--bgcolor-2);
	color:white;
	padding:5px 25px;
	position:absolute;
	right:20px;
}

#cevent
{
	z-index:100000;	
}

#updateevent
{
	z-index:100000;	
}

@media (max-width:909px)
{
	.btn{
		font-size: 10px;
		padding:3px 6px;
	}
}

</style>

<script type="text/javascript">
$(document).ready(function()
{
	$('.startevent').click(function (e)
	{
		//e.preventDefault();
		var eventId = this.value;
		//console.log(eventId);
		//alert(eventId);

		$.ajax({
            type: "GET",
            url: "actions.php",
            data: { action: 'start', eventId: eventId },

            success: function(response) {
                // // Parse the JSON response
                // var data = JSON.parse(response);
                // // Check the status of the response
                // if (data.status === 'success') {
                //     // Update successful, show success message
                //     alert(data.message);
                //      window.location.reload();
                // } else {
                //     // Update failed, show error message
                //     alert(data.message);
                // }
                handleResponse(response);
            }

		});


    });

   $('.pauseevent').click(function(e) {
        e.preventDefault();
        var eventId = this.value;

        // Display confirmation dialog
        var confirmed = confirm('Are you sure you want to PAUSE this event?');

        if (confirmed) {
            $.ajax({
                type: "GET",
                url: "actions.php",
                data: { action: 'pause', eventId: eventId },
                success: function(response) {
                    handleResponse(response);
                }

            });
        }
    });

   $('.endevent ').click(function(e) {
        e.preventDefault();
        var eventId = this.value;

        // Display confirmation dialog
        var confirmed = confirm('Are you sure you want to END this event?');

        if (confirmed) {
            $.ajax({
                type: "GET",
                url: "actions.php",
                data: { action: 'end', eventId: eventId },
                success: function(response) {
                    handleResponse(response);
                }

            });
        }
    });


   $('.deleteevent').click(function(e) {
        e.preventDefault();
        var eventId = this.value;

        // Display confirmation dialog
        var confirmed = confirm('Are you sure you want to DELETE this event?');

        if (confirmed) {
            $.ajax({
                type: "GET",
                url: "actions.php",
                data: { action: 'delete', eventId: eventId },
                success: function(response) {
                    handleResponse(response);
                   
                }

            });
        }
    });


  $('.editevent').click(function(e)
  {
  		e.preventDefault();
  		var eventId = this.value;

  		
  		$.ajax({
  			type: "GET",
  			url :"actions.php",
  			data :{action: 'edit', eventId: eventId},

  			success: function(response)
  			{
  				var jsonData = JSON.parse(response);

  				$.each(jsonData, function(key, value){

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

   //funciton for handling all things
   function handleResponse(response) {
        var data = JSON.parse(response);
        if (data.status === 'success') {
            alert(data.message);
            window.location.reload();
        } else {
            alert(data.message);
        }
    }


	});


$(document).ready(function()
{
	$('.feedback').click(function()
	{
		var eventId=this.value;
		var url = 'feedbacks.php?id=' + encodeURIComponent(eventId);
		window.location.href=url;
	});
});
</script>
</head>
<body>
	<div class="box1">

		<button type="button" class="btn btn-primary" data-toggle="modal" id="ce-btn" data-target="#cevent">Create Event</button>
		
 	</div>

 	<div class="modal fade" id="cevent" role="dialog">
 		<div class="modal-dialog">
 			<div class="modal-content">
 				
 				<div class="modal-header">
 					<h5 class="modal-title">Create New Event</h5>
 					<button type="button" class="close" data-dismiss="modal">&times;</button>
 				</div>

 				<form name="ce-form" action="partials/php/add-event.php" method="POST">

 					<div class="modal-body">

 						<div class="form-group">
 							<label>Event Title</label>
 							<input type="text" name="etitle" class="form-control" placeholder="enter some event title" required>
 						</div>

 						<div class="form-group">
 							<label>Event Date and Time</label>
 							<input type="datetime-local" name="edate-time" class="form-control" placeholder="enter event data & time" required>
 						</div>

 						<div class="form-group">
 							<label>Event Description</label>
 							<textarea name="edesc" class="form-control" placeholder="enter some event description" required></textarea>
 						</div>

 						<div class="form-group">
 							<label>Event Location</label>
 							<textarea name="eloc" class="form-control" placeholder="enter event venue" required></textarea>
 						</div>

 					</div>

 					<div class="modal-footer">
 						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
 						<button type="submit" name="submit" class="btn btn-primary">Create Event</button>
 					</div>

 				</form>
 			</div>
 		</div>
 	</div>


 <!-- modal for update event -->
 <div class="modal fade" id="updateevent" role="dialog" data-backdrop="false">
 		<div class="modal-dialog">
 			<div class="modal-content">
 				
 				<div class="modal-header">
 					<h5 class="modal-title">Edit Your Event</h5>
 					<button type="button" class="close" onclick="$('#updateevent').modal('hide');" data-dismiss="modal">&times;</button>
 				</div>

 				<form name="ce-form" action="partials/php/add-event.php" method="POST">

 					<div class="modal-body">

 						<input type="hidden" name="eid" id="eid">

 						<div class="form-group">
 							<label>Event Title</label>
 							<input type="text" name="etitle" id="etitle" class="form-control" placeholder="enter some event title" required>
 						</div>

 						<div class="form-group">
 							<label>Event Date and Time</label>
 							<input type="datetime-local" name="edate-time" id="edate-time" class="form-control" placeholder="enter event data & time" required>
 						</div>

 						<div class="form-group">
 							<label>Event Description</label>
 							<textarea name="edesc" id="edesc" class="form-control" placeholder="enter some event description" required></textarea>
 						</div>

 						<div class="form-group">
 							<label>Event Location</label>
 							<textarea name="eloc" id="eloc" class="form-control" placeholder="enter event venue" required></textarea>
 						</div>

 						<input type="hidden" name="status" id="status">

 					</div>

 					<div class="modal-footer">
 						<button type="button" class="btn btn-primary" onclick="$('#updateevent').modal('hide');" data-dismiss="modal">Close</button>
 						<button type="submit" name="up-event" class="btn btn-primary">Update Event</button>
 					</div>

 				</form>
 			</div>
 		</div>
 	</div>


<div class="container">
	<h1>Events</h1>
	<hr>

	<!-- diplay cuurent events -->
	<div class="card " style="margin-top:80px;">
		<div class="card-header bg-success text-white">
			Current Events	
		</div>

		<div class="card-body">

				<?php
						require '../partials/dbconn.php';

						$query = "SELECT * FROM events WHERE status!=2 ORDER BY dataTime DESC";
						$events = mysqli_query($conn, $query);

						foreach ($events as $event) {
							echo '<div class="card mb-2">';

							echo '<div class="card-body">';

							echo '<h3 class="card-title" style="border-bottom:1px solid red" >'.$event['title'].'</h3>';

							echo '<h6 class="card-title">'.date('M j, Y h:i A', strtotime($event['dataTime'])).'</h6>';

							echo '<p class="card-text">'.$event['description'].'</p>';

							echo '	<p class="card-footer">Location: '.$event['location'].'</p>';

							echo '<div class="card-footer d-flex justify-content-end">';
    						echo '<div class="btn-group" role="group" aria-label="Event Actions">';

							// Enable or disable buttons based on event status
    						if ($event['status'] == 0) {
        					// Event not started, enable Start button, disable Stop button
       							 echo '<button type="button" value="'.$event['eventId'].'" class="btn btn-primary startevent mr-2 " style="border-radius: 4px;">Start</button>';
        						echo '<button type="button" class="btn btn-warning mr-2" style="border-radius: 4px;" disabled>Pause</button>';
        						echo '<button type="button" class="btn btn-danger mr-2" style="border-radius: 4px;" disabled>End</button>';
    						} else {
        							// Event started, disable Start button, enable Stop button
       							echo '<button type="button" class="btn btn-primary mr-2" style="border-radius: 4px;" disabled>Start</button>';
        						echo '<button type="button" value="'.$event['eventId'].'" class="btn btn-warning mr-2 pauseevent" style="border-radius: 4px;">Pause</button>';
        						echo '<button type="button" value="'.$event['eventId'].'" class="btn btn-danger endevent mr-2" style="border-radius: 4px;" >End</button>';
    							}

    						// Other buttons
    						echo '<button type="button" value="'.$event['eventId'].'" class="btn btn-info editevent mr-2" style="border-radius: 4px;">Edit</button>';
    						echo '<button type="button" value="'.$event['eventId'].'" class="btn btn-danger deleteevent mr-2" style="border-radius: 4px;">Delete</button>';
    						echo '<button type="button" value="'.$event['eventId'].'" class="btn btn-success feedback" style="border-radius: 4px;">Feedbacks</button>';

							
    						 echo '</div>';
   							 echo '</div>';
							 echo '</div>';
   							 echo '</div>';

						}

						mysqli_close($conn);//close conn

					?>
				</div>	
		<div class="card-header bg-secondary text-white">
			Passed Events	
		</div>

		<div class="card-body">

				<?php
						require '../partials/dbconn.php';

						$query = "SELECT * FROM events WHERE status=2 ORDER BY dataTime DESC";
						$events = mysqli_query($conn, $query);

						foreach ($events as $event) {
							echo '<div class="card mb-2">';

							echo '<div class="card-body">';

							echo '<h3 class="card-title" style="border-bottom:1px solid red" >'.$event['title'].'</h3>';

							echo '<h6 class="card-title">'.date('M j, Y h:i A', strtotime($event['dataTime'])).'</h6>';

							echo '<p class="card-text">'.$event['description'].'</p>';

							echo '	<p class="card-footer">Location: '.$event['location'].'</p>';

							echo '<div class="card-footer d-flex justify-content-end">';
    						echo '<div class="btn-group" role="group" aria-label="Event Actions">';

    						//disabled buttons
							echo '<button type="button" class="btn btn-primary mr-2" style="border-radius: 4px;" disabled>Start</button>';
        					echo '<button type="button" value="'.$event['eventId'].'" class="btn btn-warning mr-2 pauseevent" style="border-radius: 4px;" disabled>Pause</button>';
        					echo '<button type="button" value="'.$event['eventId'].'" class="btn btn-danger endevent mr-2" style="border-radius: 4px;" disabled>End</button>';
        					echo '<button type="button" value="'.$event['eventId'].'" class="btn btn-info editevent mr-2" style="border-radius: 4px;" disabled>Edit</button>';

    						// enabled buttons
    					
    						echo '<button type="button" value="'.$event['eventId'].'" class="btn btn-danger deleteevent mr-2" style="border-radius: 4px;">Delete</button>';

    						echo '<button type="button" value="'.$event['eventId'].'" class="btn btn-success feedback" style="border-radius: 4px;">Feedbacks</button>';

							
    						 echo '</div>';
   							 echo '</div>';
							 echo '</div>';
   							 echo '</div>';

						}

						mysqli_close($conn);//close conn

					?>
				</div>	


			</div>

		</div>
	</div>


</div>



</body>
</html>