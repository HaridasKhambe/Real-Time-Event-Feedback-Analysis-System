<?php

session_start();


if (!isset($_SESSION['username']) || !isset($_SESSION['usertype'])) {
	
	header("Location: ../index.php");
	exit();
}else
{
// echo '<script> alert(" set");</script>';
}


?>