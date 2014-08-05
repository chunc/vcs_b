<?php
	// Load variables from javascript control file
	$correct = $_GET["correct"];
	$sys_error = $_GET["sys_error"];
	$redo = $_GET["redo"];
	$repeat = $_GET["repeat"];
	$next1 = $_GET["next1"];
	$next2 = $_GET["next2"];

	// Connect to SQL Database
	$mysqli_connection = new MySQLi('vergil.u.washington.edu', 'root', 'overhillway', 'vcs', 1284);
	if($mysqli_connection->connect_error){
	   echo "Not connected, error: ".$mysqli_connection->connect_error;
	}
	else{
	   echo "Connected.";
	}

	//Make SQL Query
	$query= "UPDATE buttons SET correct='$correct', sys_error='$sys_error', redo='$redo', repeat_btn='$repeat', next1='$next1', next2='$next2' "; 
	

	//Execute the SQL query and return records
	$result = mysqli_query($mysqli_connection, $query);
	
	mysqli_close($mysqli_connection);
?> 