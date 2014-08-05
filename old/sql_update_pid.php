<?php
	$pid = $_GET["pid"];
	$id = $_GET["id"];

	$err_lvl = $_GET["err_lvl"];

	$mysqli_connection = new MySQLi('vergil.u.washington.edu', 'root', 'overhillway', 'vcs', 1284) or die("Cannot Connect");
	$query= "UPDATE switches SET pid='$pid' WHERE id='$id'  ";

	$result = mysqli_query($mysqli_connection, $query);
	
	mysqli_close($mysqli_connection);
?>