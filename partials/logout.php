<?PHP
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect the user to the login page or wherever appropriate
header("Location: ../index.php");
exit();

?>