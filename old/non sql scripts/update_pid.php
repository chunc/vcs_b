<?php
	$switch_board_file = $_GET["control_file"];
	$pid = $_GET["pid"];
	$err_lvl = $_GET["err_lvl"];
	

	// $json_data = json_decode(file_get_contents('switches.txt'), true);
	$json_data = json_decode(file_get_contents($switch_board_file), true);
	$json_data['pid'] = $pid;
	$json_data['error'] = $err_lvl;
	
	file_put_contents($switch_board_file, json_encode($json_data));	
?>