<?php
	//Name of json switch_board file
	$json_file = $_GET["control_file"];  
		
	//Common Variables
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
	// $c_event = $_GET["c_event"];
	// $c_time = $_GET["c_time"];
	// $c_err_event = $_GET["c_err_event"];
	// $c_err_time = $_GET["c_err_time"];
	$c_contact = $_GET["c_contact"];
	$c_location = $_GET["c_location"];
	$c_day = $_GET["c_day"];
	$c_time = $_GET["c_time"];
	$c_err_contact = $_GET["c_err_contact"];
	$c_err_location = $_GET["c_err_location"];
	$c_err_day = $_GET["c_err_day"];
	$c_err_time = $_GET["c_err_time"];


	//N-Back Variables
	$zero_back = $_GET["zero_back"];

	//Write on to JSON file
	$json_data = json_decode(file_get_contents($json_file), true);
	$json_data['task'] = $task;
	$json_data['trial'] = $trial;
	$json_data['delay'] = $delay;

	$json_data['audio_prompt'] = $audio_prompt;
	$json_data['audio_confirm'] = $audio_confirm;
	$json_data['audio_error'] = $audio_error;

	$json_data['r_station'] = $r_station;
	$json_data['r_freq'] = $r_freq;
	$json_data['r_err_station'] = $r_err_station;
	$json_data['r_err_freq'] = $r_err_freq;

	$json_data['n_street'] = $n_street;
	$json_data['n_num'] = $n_num;
	$json_data['n_rtype'] = $n_rtype;
	$json_data['n_err_street'] = $n_err_street;
	$json_data['n_err_num'] = $n_err_num;
	$json_data['n_err_rtype'] = $n_err_rtype;

	// $json_data['c_event'] = $c_event;
	// $json_data['c_time'] = $c_time;
	// $json_data['c_err_event'] = $c_err_event;
	// $json_data['c_err_time'] = $c_err_time;
	$json_data['c_contact'] = $c_contact;
	$json_data['c_location'] = $c_location;
	$json_data['c_day'] = $c_day;
	$json_data['c_time'] = $c_time;
	$json_data['c_err_contact'] = $c_err_contact;
	$json_data['c_err_location'] = $c_err_location;
	$json_data['c_err_day'] = $c_err_day;
	$json_data['c_err_time'] = $c_err_time;

	$json_data['zero_back'] = $zero_back;


	

	file_put_contents($json_file, json_encode($json_data));	
	// echo $json_file;

?>