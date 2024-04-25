<?php


session_start();

require 'dbconn.php';

function validateUser($username, $password, $userType, $conn) {
    
    if ($conn) {
    	// Prepare and execute a query to check user credentials
    $query = "SELECT * FROM credentials WHERE userId = ? AND password = ? AND usertype = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $password, $userType);
    $stmt->execute();
    $result = $stmt->get_result();



		// echo $result->num_rows;
    	if($result->num_rows > 0)
   		 {
 		// User credentials are valid
        	return true;
    	}else
    	{
    	// User credentials are invalid
       	 return false;
    	 
    	}

    $conn->close();
    }else
    {
 	// Connection failed, handle the error
    echo 'alert("Failed to connect to the database.");';
    }
      
}


if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['usertype'])) {
	// Get the submitted username, password, and user type
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['usertype'];

    // echo '<br>'.$username;
    //  echo $password;
    //   echo $userType;

    if (validateUser($username, $password, $userType, $conn)) {
    	// Authentication successful, set session variables
    	$_SESSION['username']=$username;
    	$_SESSION['usertype']=$userType;

    	if ($userType==='user') {
    		header("Location: ../user/events.php");
    		exit();
    	}elseif($userType==='admin')
    	{
			header("Location: ../admin/create-event.php");
    		exit();

    	}
    }else
    {
    	 		$_SESSION['error'] = "Invalid username or password";
				echo '<script>';
        		echo 'alert("Invalid Credentials ! Please Login Again..!");';
        		echo '</script>';

        		 $_POST['username']= "";
                 $_POST['password']= "";
                 $_POST['usertype']= "";

        		//exit();
        		// header("Location: /../GCD/index.php");
        		echo '<script>window.location.href = "../index.php";</script>'; 
    }

}

// Close the database connection
mysqli_close($conn);

?>