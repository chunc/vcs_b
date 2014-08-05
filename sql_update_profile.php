<?php
	$location_id = $_GET["location_id"];
	$pid = $_GET["pid"];
	$run_type = $_GET["run_type"];
	$err_lvl = $_GET["err_level"];
	$scenario = $_GET["scenario"];

	$mysqli_connection = new MySQLi('vergil.u.washington.edu', 'root', 'overhillway', 'vcs', 1284) or die("Cannot Connect");
	$query= "UPDATE switches SET pid='$pid', run_type='$run_type', error_block='$err_lvl', scenario='$scenario' WHERE location_id='$location_id'  ";

	$result = mysqli_query($mysqli_connection, $query);
	
	mysqli_close($mysqli_connection);
?>