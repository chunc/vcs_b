<?php
	//Name of json switch_board file
	// $json_file = $_GET["control_file"];  
		
	//Common Variables
	$location_id = $_GET["location_id"];
	$task = $_GET["task"];
	$audio_prompt = $_GET["audio_prompt"];
	$audio_confirm = $_GET["audio_confirm"];
	$audio_error = $_GET["audio_error"];
	$delay = $_GET["delay"];
	$err_rate = $_GET["err_rate"];
	$trial = $_GET["trial"];

	//Radio Variables
	$r_station = $_GET["r_station"];
	$r_freq = $_GET["r_freq"];
	$r_err_station = $_GET["r_err_station"];
	$r_err_freq = $_GET["r_err_freq"];

	// Navigation Variables
	$n_street = $_GET["n_street"];
	$n_num = $_GET["n_num"];
	$n_rtype = $_GET["n_rtype"];
	$n_err_street = $_GET["n_err_street"];
	$n_err_num = $_GET["n_err_num"];
	$n_err_rtype = $_GET["n_err_rtype"];

	//Calendar Variables
	$c_contact = $_GET["c_contact"];
	$c_location = $_GET["c_location"];
	$c_day = $_GET["c_day"];
	$c_time = $_GET["c_time"];
	$c_err_contact = $_GET["c_err_contact"];
	$c_err_location = $_GET["c_err_location"];
	$c_err_day = $_GET["c_err_day"];
	$c_err_time = $_GET["c_err_time"];

	// N-Back Variables
	// $zero_back = $_GET["zero_back"];


	
	// Connect to DB
	$host = 'vergil.u.washington.edu';
	$username = 'root';
	$password = 'overhillway';
	$dbname = "vcs";
	$port = 1284;

	$db_vcs = new MySQLi($host,$username,$password,$dbname,$port) or die("Cannot Connect");

	// Make query update
	$query = "UPDATE switches SET 
		task='$task',
		audio_prompt='$audio_prompt',
		audio_confirm='$audio_confirm',
		audio_error='$audio_error',
		error_level='$err_rate',
		trial='$trial',
		delay='$delay',

		r_station='$r_station',
		r_freq='$r_freq',
		r_err_station='$r_err_station',
		r_err_freq='$r_err_freq',

		n_street='$n_street',
		n_num='$n_num',
		n_rtype='$n_rtype',
		n_err_street='$n_err_street',
		n_err_num='$n_err_num',
		n_err_rtype='$n_err_rtype',

		c_contact='$c_contact',
		c_location='$c_location',
		c_day='$c_day',
		c_time='$c_time',
		c_err_contact='$c_err_contact',
		c_err_location='$c_err_location',
		c_err_day='$c_err_day',
		c_err_time='$c_err_time',

		zero_back = '',
		nb_num_stream= '',
		nb_correct_stream= '',
		nb_correct_total= ''
		
		WHERE location_id='$location_id'
		";

	$result = mysqli_query($db_vcs, $query);
?>