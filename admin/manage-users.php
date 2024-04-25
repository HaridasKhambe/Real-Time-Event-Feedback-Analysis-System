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

<style type="text/css">
	:root
	{
	   --bgcolor-1:#34495e ;
	   --bgcolor-2:#2f3640;
	   --ahover:#3498db;
	}

*{
	padding: 0;
	margin: 0;
}
.title
{
	
	margin:80px 0 10px 20px;
	z-index:100;
	padding:2px;
	font-size:20px;
	font-weight:bold;
	color:var(--bgcolor-2);
	border-bottom:2px solid var(--bgcolor-1);
}



</style>

<script>
$(document).ready(function() {
    $('.enable-btn').click(function(e) {
        var CuserId = this.value;
        e.preventDefault();

var confirmed = confirm('Are you sure you want to Enable This User?');

        if (confirmed) {
            $.ajax({
            type: "POST",
            url: "partials/php/enable_comment.php", // Specify the URL of the PHP script to handle the update
            data: { userId: CuserId },
            success: function(response) {
                 var data = JSON.parse(response);
                if (data.status === 'success') {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            }
            
             });
        }

       });
});

</script>

</head>
<body>
<?php

 require '../partials/dbconn.php';

// Fetch data from the credentials table where fenable is 0
$sql = "SELECT userId FROM credentials WHERE fenable = 0";
$result = mysqli_query($conn, $sql);

?>

<div class="box1">

		<label class="title">Control Your Comment Permissions</label>

		
 	</div>
	
<div class="container" >
 	<div class="table-responsive">
 		<table id="mytable" class="table table-striped table-bordered text-nowrap" style="width: 100%;">
 			<thead>
 				<tr>
 					<th>#</th>
 					<th>User Id</th>
 					<th>Action</th>
 				
 				</tr>

 			</thead>

 			<tbody>

 				 <?php
                if (mysqli_num_rows($result) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $count++ . "</td>";
                        echo "<td>" . $row['userId'] . "</td>";
                        echo '<td><button type="button" class="btn btn-success enable-btn" value="'.$row['userId'].'">Enable</button></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>All users have enabled comment permissions.</td></tr>";
                }
                ?>
 				
 			</tbody>

 			<tfoot>
 				<tr>
 					<th>#</th>
 					<th>User Id</th>
 					<th>Action</th>
 				</tr>
 			</tfoot>


 			
 		</table>
 	</div>
 </div>


<!-- for table -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>

<script type="text/javascript">
	new DataTable('#mytable');
</script>
</body>
</html>