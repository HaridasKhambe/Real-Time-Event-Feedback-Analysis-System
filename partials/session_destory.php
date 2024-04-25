
<script type="text/javascript">
	
if (confirm("Are You Sure to Logout?")) {

	// Redirect to logout script using PHP header redirection
    window.location.href = "logout.php";
	
}else
{

// Redirect the user back one page
window.history.back();

}

</script>


<!-- <?php





// session_start();

// // Unset all session variables
// $_SESSION = [];

// // Destroy the session
// session_destroy();

// header("Location: ../index.php");
// exit();

?> -->