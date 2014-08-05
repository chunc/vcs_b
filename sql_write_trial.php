<?php
	$json_file = $_POST["json_file"];
	$file_name = $_POST["file_name"];

	$handle = fopen($file_name,"w");
	fwrite($handle,$json_file);
	fclose($handle);
?>