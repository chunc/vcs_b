<?php
	$switch_board_file = $_GET["control_file"];
	$correct = $_GET["correct"];
	$sys_error = $_GET["sys_error"];
	$redo = $_GET["redo"];
	$repeat = $_GET["repeat"];
	$next1 = $_GET["next1"];
	$next2 = $_GET["next2"];

	// $json_data = json_decode(file_get_contents('switches.txt'), true);
	$json_data = json_decode(file_get_contents($switch_board_file), true);
	$json_data['correct'] = $correct;
	$json_data['sys_error'] = $sys_error;
	$json_data['redo'] = $redo;
	$json_data['repeat'] = $repeat;
	$json_data['next1'] = $next1;
	$json_data['next2'] = $next2;
	file_put_contents($switch_board_file, json_encode($json_data));	
	// file_put_contents('switches.txt', json_encode($json_data));	
	// echo $json_data['correct'];

?>