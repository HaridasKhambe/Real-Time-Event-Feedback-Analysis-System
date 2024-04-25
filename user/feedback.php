<?php

require '../partials/session_check.php';

require '../partials/dbconn.php';

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

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" >
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap4.css">

	<!-- for google charts -->
	<link rel="stylesheet" href="chart.css">
 	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<?php require 'partials/u-navbar.php'?>


	<?php

// 	$eventId=NULL;

// 	if (isset($_GET['id'])) {

// 		$eventId=$_GET['id'];
// // echo "<script>alert('id : '+$eventId)</script>";
// 	}
function Statistic($eventId, $con){

if($con)
{

//for piechart
$sql1="Select count(relevance) as tcount,relevance from efeedback where eventId='$eventId' group by relevance";
$stmt1=$con->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();
$arr1 = $result1->fetch_all(MYSQLI_ASSOC);


$sql2="Select count(interaction) as tcount,interaction from efeedback where eventId='$eventId' group by interaction";
$stmt2=$con->prepare($sql2);
$stmt2->execute();
$result2 = $stmt2->get_result();
$arr2 = $result2->fetch_all(MYSQLI_ASSOC);

$sql3="Select count(engagement) as tcount,engagement from efeedback where eventId='$eventId' group by engagement";
$stmt3=$con->prepare($sql3);
$stmt3->execute();
$result3 = $stmt3->get_result();
$arr3 = $result3->fetch_all(MYSQLI_ASSOC);

$sql4="Select count(tech_quality) as tcount,tech_quality from efeedback where eventId='$eventId' group by tech_quality";
$stmt4=$con->prepare($sql4);
$stmt4->execute();
$result4 = $stmt4->get_result();
$arr4 = $result4->fetch_all(MYSQLI_ASSOC);

$sql5="Select count(overall_satisfaction) as tcount,overall_satisfaction from efeedback where eventId='$eventId' group by overall_satisfaction";
$stmt5=$con->prepare($sql5);
$stmt5->execute();
$result5 = $stmt5->get_result();
$arr5 = $result5->fetch_all(MYSQLI_ASSOC);

$sql6="Select count(clarity) as tcount,clarity from efeedback where eventId='$eventId' group by clarity";
$stmt6=$con->prepare($sql6);
$stmt6->execute();
$result6 = $stmt6->get_result();
$arr6 = $result6->fetch_all(MYSQLI_ASSOC);

}

// for bar chart

$sq1="SELECT 
        SUM(CASE WHEN interaction = 1 THEN 1 ELSE 0 END) +
        SUM(CASE WHEN clarity = 1 THEN 1 ELSE 0 END) +
        SUM(CASE WHEN engagement = 1 THEN 1 ELSE 0 END) +
        SUM(CASE WHEN tech_quality = 1 THEN 1 ELSE 0 END) +
        SUM(CASE WHEN overall_satisfaction = 1 THEN 1 ELSE 0 END) +
        SUM(CASE WHEN relevance = 1 THEN 1 ELSE 0 END) AS total_count
    FROM efeedback where eventId='$eventId'";
    $stm1=$con->prepare($sq1);
    $stm1->execute();
    $res1 = $stm1->get_result();
    $t1 = $res1->fetch_all(MYSQLI_ASSOC);
    $totalCount1 = $t1[0]['total_count'];


    $sq2="SELECT 
       SUM(CASE WHEN interaction = 2 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN clarity = 2 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN engagement = 2 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN tech_quality = 2 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN overall_satisfaction = 2 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN relevance = 2 THEN 1 ELSE 0 END) AS total_cou
    FROM efeedback where eventId='$eventId'";
    $stm2=$con->prepare($sq2);
    $stm2->execute();
    $res2 = $stm2->get_result();
    $t2 = $res2->fetch_all(MYSQLI_ASSOC);
    $totalCount2 = $t2[0]['total_cou'];


    $sq3="SELECT 
       SUM(CASE WHEN interaction = 3 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN clarity = 3 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN engagement = 3 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN tech_quality = 3 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN overall_satisfaction = 3 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN relevance = 3 THEN 1 ELSE 0 END) AS total
    FROM efeedback where eventId='$eventId'";
    $stm3=$con->prepare($sq3);
    $stm3->execute();
    $res3 = $stm3->get_result();
    $t3 = $res3->fetch_all(MYSQLI_ASSOC);
    $totalCount3 = $t3[0]['total'];


    $sq4="SELECT 
       SUM(CASE WHEN interaction = 4 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN clarity = 4 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN engagement = 4 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN tech_quality = 4 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN overall_satisfaction = 4 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN relevance = 4 THEN 1 ELSE 0 END) AS m
    FROM efeedback where eventId='$eventId'";
    $stm4=$con->prepare($sq4);
    $stm4->execute();
    $res4 = $stm4->get_result();
    $t4 = $res4->fetch_all(MYSQLI_ASSOC);
    $totalCount4 = $t4[0]['m'];

  
    $sq5="SELECT 
       SUM(CASE WHEN interaction = 5 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN clarity = 5 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN engagement = 5 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN tech_quality = 5 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN overall_satisfaction = 5 THEN 1 ELSE 0 END) +
       SUM(CASE WHEN relevance = 5 THEN 1 ELSE 0 END) AS t
    FROM efeedback where eventId='$eventId'";
    $stm5=$con->prepare($sq5);
    $stm5->execute();
    $res5 = $stm5->get_result();
    $t5 = $res5->fetch_all(MYSQLI_ASSOC);
    $totalCount5 = $t5[0]['t'];


function mapRelevance($num) {
    switch ($num) {
        case 1:
            return 'Not At All';
        case 2:
            return 'Slightly';
        case 3:
            return 'Moderately';
        case 4:
            return 'Very';
        case 5:
            return 'Extremely';
        default:
            return 'Unknown';
    }
}

function mapClarity($num) {
    switch ($num) {
        case 1:
            return 'Unclear';
        case 2:
            return 'SomeWhat';
        case 3:
            return 'Moderately';
        case 4:
            return 'Clear';
        case 5:
            return 'Very Clear';
        default:
            return 'Unknown';
    }
}


function mapEngagement($num) {
    switch ($num) {
        case 1:
            return 'Not At All';
        case 2:
            return 'Slightly';
        case 3:
            return 'Moderately';
        case 4:
            return 'Very';
        case 5:
            return 'Extremely';
        default:
            return 'Unknown';
    }
}

function mapInteraction($num) {
    switch ($num) {
        case 1:
            return 'Not At All';
        case 2:
            return 'SomeWhat';
        case 3:
            return 'Moderately';
        case 4:
            return 'Effective';
        case 5:
            return 'Very Effective';
        default:
            return 'Unknown';
    }
}

function mapTechQ($num) {
    switch ($num) {
        case 1:
            return 'Poor';
        case 2:
            return 'Fair';
        case 3:
            return 'Good';
        case 4:
            return 'Very Good';
        case 5:
            return 'Excellent';
        default:
            return 'Unknown';
    }
}

function mapOverall($num) {
    switch ($num) {
        case 1:
            return 'Very Negative';
        case 2:
            return 'Negative';
        case 3:
            return 'Neutral';
        case 4:
            return 'Positive';
        case 5:
            return 'Very Positive';
        default:
            return 'Unknown';
    }
}

	?>

	<script type="text/javascript">
      google.charts.load("current", {packages:["corechart", "bar"]});
      google.charts.setOnLoadCallback(drawChart);


       function drawChart() {
            drawChart1();
            drawChart2();
            drawChart3();
            drawChart4();
            drawChart5();
            drawChart6();
            //bar
            drawBarChart();

        }



      function drawChart1() {
        var data = google.visualization.arrayToDataTable
        ([
          ['relevance', 'count'],
           <?php foreach($arr1 as $key=>$val)
           {?>
            ['<?php echo mapRelevance($val['relevance']); ?>',<?php echo $val['tcount']?>],
            <?php }?>
          
        ]);

        var options = {
          title: 'Relevance',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_1'));
        chart.draw(data, options);
      }
  
  //function 2
      function drawChart2() {
        var data = google.visualization.arrayToDataTable
        ([
          ['interaction', 'count'],
           <?php foreach($arr2 as $key=>$val)
           {?>
            ['<?php echo mapInteraction($val['interaction']);?>',<?php echo $val['tcount']?>],
            <?php }?>
          
        ]);

        var options = {
          title: 'Interaction',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_2'));
        chart.draw(data, options);
      }

        //f3
       function drawChart3() {
        var data = google.visualization.arrayToDataTable
        ([
          ['engagement', 'count'],
           <?php foreach($arr3 as $key=>$val)
           {?>
            ['<?php echo mapEngagement($val['engagement']); ?>',<?php echo $val['tcount']?>],
            <?php }?>
          
        ]);

        var options = {
          title: 'Engagement',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_3'));
        chart.draw(data, options);
      }

      function drawChart4() {
        var data = google.visualization.arrayToDataTable
        ([
          ['tech_quality', 'count'],
           <?php foreach($arr4 as $key=>$val)
           {?>
            ['<?php echo mapTechQ($val['tech_quality']);?>',<?php echo $val['tcount']?>],
            <?php }?>
          
        ]);

        var options = {
          title: 'Techcinal Quality',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_4'));
        chart.draw(data, options);
      }

       function drawChart5() {
        var data = google.visualization.arrayToDataTable
        ([
          ['overall_satisfaction', 'tcount'],
           <?php foreach($arr5 as $key=>$val)
           {?>
            ['<?php echo mapOverall($val['overall_satisfaction']);?>',<?php echo $val['tcount']?>],
            <?php }?>
          
        ]);

        var options = {
          title: 'Overall Satisfaction',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_5'));
        chart.draw(data, options);
      }


       function drawChart6() {
        var data = google.visualization.arrayToDataTable
        ([
          ['clarity', 'count'],
           <?php foreach($arr6 as $key=>$val)
           {?>
            ['<?php echo mapClarity($val['clarity']);?>',<?php echo $val['tcount']?>],
            <?php }?>
          
        ]);

        var options = {
          title: 'Clarity',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_6'));
        chart.draw(data, options);
      }

      function drawBarChart() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Poor', 'Fair', 'Good','Very Good','Excellent'],
          ['Ratings', <?php  echo $totalCount1; ?>, <?php  echo $totalCount2; ?>, <?php  echo $totalCount3; ?>, <?php  echo $totalCount4; ?>, <?php  echo $totalCount5; ?>],
          
        ]);

        var options = {
          chart: {
            title: 'Overall Feedback',
            // is3D: true,
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }




    </script>


<?php
}
?>


 <style type="text/css">
    root:{
        --bgcolor-1:#34495e ;
       --bgcolor-2:#2f3640;
       --ahover:#3498db;
}

	.container
	{

	}

	.chart
	{
		width: 450px;
        height: 250px;
        display: inline-block;
        border:1px solid var(--bgcolor-2);
      
	}
    .section
  {
    /*    display:flex;*/
    /* white-space: nowrap;*/
    display: flex;
    margin-top:20px;
    justify-content: center;
  }



#barchart_material
{
    width:550px;
    height:350px;
}
  @media (max-width:909px){
    
    .chart
    {
        width: 250px;
        height: 250px;
/*        display: inline-block;*/
       border:1px solid var(--bgcolor-1);
      
    }

    #barchart_material
{
    width: 250px;
    height: 250px;
}

    .section
  {
    
     display:block;
     margin-top:0px;


  }
}

.comment {
    display: flex;
    align-items: flex-start; /* Align items at the start (top) of the container */
    margin-bottom: 10px;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 5px;
    border-bottom:2px solid var(--ahover);
}

.comment-content {
    flex: 1; /* Grow to fill remaining space */
    margin-right: 10px; /* Add some space between content and button */
}

.comment-text {
    margin-bottom: 5px;
}

.comment-timestamp {
    font-size: 12px;
    color: #888;
}

.com-disabled {
    align-self: flex-start; /* Align the button at the start (top) of its container */
}
.alert 
{
/*    margin-top:100px;*/
    
    font-size:16px;
    width:85%;
    margin-left:50%;
    transform:translate(-50%, 10%);
    
}
.alert p
{
    text-align: center;
    font-size:18px;
}
</style>
</head>
<body>

    <div class="space" style="height:100px;"></div>

<?php


	$eventId=NULL;

 	if (isset($_GET['id'])) {

		$eventId=$_GET['id'];
 // echo "<script>alert('id : '+$eventId)</script>";

?>


<div class="container" style="width:100%">
	<!-- <h1>Events</h1> -->
	<hr>

	<!-- diplay cuurent events -->
	<div class="card " style="margin-top:80px;">
		<div class="card-header bg-success text-white">
			Current Event
		</div>

		<div class="card-body">

				<?php
						require '../partials/dbconn.php';

						$query = "SELECT * FROM events WHERE eventId='$eventId'";
						$events = mysqli_query($conn, $query);

						foreach ($events as $event) {
							echo '<div class="card mb-2">';

							echo '<div class="card-body">';

							echo '<h3 class="card-title" style="border-bottom:1px solid red" >'.$event['title'].'</h3>';

							echo '<h6 class="card-title">'.date('M j, Y h:i A', strtotime($event['dataTime'])).'</h6>';

							echo '<p class="card-text">'.$event['description'].'</p>';

							echo '	<p class="card-footer">Location: '.$event['location'].'</p>';


							echo '<div class="card-footer d-flex justify-content-end">';

							echo '<div class="container">';    
    						echo '<div class="section">';	
      						echo '<div id="piechart_3d_1" class="chart"></div>';		

        					echo '<div id="piechart_3d_6" class="chart"></div>';	

        					echo '<div id="piechart_3d_3" class="chart"></div>';		
    						echo '</div>';	

    						echo '<div class="section">';	
      						echo '<div id="piechart_3d_2" class="chart"></div>';		

        					echo '<div id="piechart_3d_4" class="chart"></div>';	

        					echo '<div id="piechart_3d_5" class="chart"></div>';		
    						echo '</div>';	
		          							
							

                            echo '<div class="section" id="barChart">';  //  section 3

                            echo ' <div id="barchart_material" class="chart"></div>';    

                            echo '</div>';

							echo '</div>';

                             echo '</div>';

                            //comments

                            
    						

						// mysqli_close($conn);//close conn

					?>
				</div>
                
			<div class="card-body">

				<?php Statistic($eventId, $conn); ?>

			</div>

             <?php
                 echo '<div class="card-header bg-success text-white">';
                 echo 'Comments';
                 echo '</div>';
                 echo '<div class="card-body">';
                  $comQ = "SELECT userId, comment, dataTime FROM efeedback WHERE eventId = '$eventId' AND comment!='' ORDER BY dataTime DESC";
                  $comResult = mysqli_query($conn, $comQ);

                  if (mysqli_num_rows($comResult) > 0) {
                      while ($com = mysqli_fetch_assoc($comResult)) {
                          echo '<div class="comment">';
                            echo '<div class="comment-content">';
                            echo '<p class="comment-text">'.$com['comment'].'</p>';
                            echo '<p class="comment-timestamp">'.date('M j, Y h:i A', strtotime($com['dataTime'])).'</p>';
                            echo '</div>';
                            // echo '<button type="button" value="'.$com['userId'].'" class="btn btn-danger com-disabled" style="border-radius: 4px;" >Disable</button>';
                          echo '</div>';
                      }
                  } else {
                      echo '<p>No comments yet.</p>';
                  }
                  echo '</div>'; // End of card-body
                  echo '</div>'; // End of card

              }
                ?>


		</div>

       


</div>


<?php

 	}else {

        
// Display error message when no event is selected
    echo '
        <div class="error-con">
            <div class="alert alert-danger mt-8" role="alert">
                <p>Please select an event to view its statistics.</p>
            </div>
        </div>
    ';    

}

?>


</body>
</html>