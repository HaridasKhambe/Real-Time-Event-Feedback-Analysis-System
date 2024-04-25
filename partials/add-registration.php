<?php

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $uusername = $_POST['username'];
    $upassword = $_POST['password'];
    $uuserType = $_POST['userType'];

    $ufenable = 1;   //feedback enable by defualt



    // Validate username
    if (!filter_var($uusername, FILTER_VALIDATE_EMAIL)) {
         $_SESSION['error'] = "Invalid email address";
        // echo '<script>alert("Invalid email address");</script>';
        // echo '<script>window.location.href="register.php";</script>';
         header("Location: register.php");
        exit();
    }

     // Database connection
    require 'dbconn.php';

    // Check if username already exists
    $sql = "SELECT * FROM credentials WHERE userId= ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uusername);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num = mysqli_num_rows($result);

    if ($result->num_rows >=1) {
         $_SESSION['error'] = "Username already exists";
        // echo '<script>alert("Username already exists");</script>';
        echo '<script>window.location.href="register.php";</script>';
        exit();
    }


    // echo "passowrd : ".$upassword."lenth : ".strlen($upassword);

    // Validate password
    if (strlen($upassword) < 8 ) {
         $_SESSION['error'] = "Password must be at least 8 characters long!";
        // echo '<script>alert("Password must be alphanumeric and at least 8 characters long");</script>';
         echo '<script>window.location.href="register.php";</script>';
        exit();
    }

   

    // Insert new user into the database
    // $hashedPassword = password_hash($upassword, PASSWORD_DEFAULT); // Hash the password
    $insertQuery = "INSERT INTO credentials (userId, password, usertype, fenable) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sssi", $uusername, $upassword, $uuserType,  $ufenable);

    if ($stmt->execute()) {
         $_SESSION['success'] = "Registration successful";
        // echo '<script>alert("Registration successful");</script>';
        // echo '<script>window.location.href="../index.php";</script>';
        echo '<script>window.location.href="register.php";</script>';
    } else {
         $_SESSION['error'] = "Error registering user";
        // echo '<script>alert("Error while registering user");</script>';
         echo '<script>window.location.href="register.php";</script>';
    }

    $stmt->close();
    $conn->close();
}
?>
