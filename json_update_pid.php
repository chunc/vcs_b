<?php
	$switch_board_file = $_GET["control_file"];
	

	$location_id = $_GET["location_id"];
	$pid = $_GET["pid"];
	$run_type = $_GET["run_type"];
	$err_level = $_GET["err_level"];
	$scenario = $_GET["scenario"];
	

	// $json_data = json_decode(file_get_contents('switches.txt'), true);
	$json_data = json_decode(file_get_contents($switch_board_file), true);
	$json_data['location_id'] = $location_id;
	$json_data['pid'] = $pid;
	$json_data['run_type'] = $run_type;
	$json_data['error_block'] = $err_level;
	$json_data['scenario'] = $scenario;
	
	file_put_contents($switch_board_file, json_encode($json_data));	
?>