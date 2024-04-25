<?php


		$servername = "localhost";
		$username = "root";
		$password = "harry";
		$dbname = "rtefa";

		$conn = mysqli_connect($servername, $username, $password, $dbname);

		if (!$conn) {
			// code...
			//die("connection failed...!".mysqli_connect_error());

			echo '<script>alert("Error while connectnig database!"); </script>';
		}








?>