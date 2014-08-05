<?php
	// Load variables from javascript control file
	$show_correct = $_GET["show_correct"];
	$show_sys_error = $_GET["show_sys_error"];
	$location_id = $_GET["location_id"];

	// Connect to SQL Database
	$mysqli_connection = new MySQLi('vergil.u.washington.edu', 'root', 'overhillway', 'vcs', 1284) or die("Cannot Connect");
	

	//Make SQL Query
	$query= "UPDATE switches SET show_correct='$show_correct', show_sys_error='$show_sys_error' WHERE location_id='$location_id' ";

	

	//Execute the SQL query and return records
	$result = mysqli_query($mysqli_connection, $query);
	
	mysqli_close($mysqli_connection);
?> 