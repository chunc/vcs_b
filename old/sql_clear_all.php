<?php
	$id = $_GET['id'];
	$mysqli_connection = new MySQLi('vergil.u.washington.edu', 'root', 'overhillway', 'vcs', 1284) or die("Cannot Connect");
	
	//Make SQL Query
	$query = "UPDATE switches SET 
		task='',
		audio_prompt='',
		audio_confirm='',
		audio_error='',
		error_level='',
		trial='',
		delay='',

		r_station='',
		r_freq='',
		r_err_station='',
		r_err_freq='',

		n_street='',
		n_num='',
		n_rtype='',
		n_err_street='',
		n_err_num='',
		n_err_rtype='',

		c_contact='',
		c_location='',
		c_day='',
		c_time='',
		c_err_contact='',
		c_err_location='',
		c_err_day='',
		c_err_time='',

		zero_back='',
		nb_num_stream='',
		nb_correct_stream='',
		nb_correct_total=''
		
		WHERE id='$id'
		";

	

	//Execute the SQL query and return records
	$result = mysqli_query($mysqli_connection, $query);
	
	mysqli_close($mysqli_connection);

?>