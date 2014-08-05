<?php
	// Currently doesnt need to be used.  Combined with sql_log_btn.php.

	$location_id = $_GET['location_id'];
	$mysqli_connection = new MySQLi('vergil.u.washington.edu', 'root', 'overhillway', 'vcs', 1284) or die("Cannot Connect");
	
	//Make SQL Query
	$query = "UPDATE switches SET 
		
		start='0',
		reset='0',
		next_task='0',

		command_correct='0',
		command_incorrect='0',
		command_repeat='0',

		confirm_correct='0',
		confirm_incorrect='0',
		confirm_repeat='0',

		fail_command_repeat='0',
		fail_confirm_repeat='0',
		catch_sys_error='0'
		
		WHERE location_id='$location_id'
		";

	//Execute the SQL query and return records
	$result = mysqli_query($mysqli_connection, $query);
	
	mysqli_close($mysqli_connection);

		

?>