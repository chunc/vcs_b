<?php 
	$json_file = $_POST["control_file"];
	$json_data = json_decode(file_get_contents($json_file), true);
	echo json_encode($json_data);
?>