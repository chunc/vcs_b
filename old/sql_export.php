<?php
	// Currently Not Fixed for MYSQL logdata parameter
	$host = 'vergil.u.washington.edu';
	$username = 'root';
	$password = 'overhillway';
	$dbname = "vcs";
	$port = 1284;

	$logdata_location = $_GET['log'];

	$db_vcs = new MySQLi($host,$username,$password,$dbname,$port) or die("Cannot Connect");

	$query1 = "SELECT * FROM $logdata_location ";
	$result = mysqli_query($db_vcs, $query1);
	$row = mysqli_fetch_assoc($result);
	
	
	
	$field = mysqli_num_fields($result);
	$headers = array_keys($row);
	// $fp = fopen('php://output', 'w');  
	$fp = fopen('datalog/logdata_all.csv', 'w');

	if ($fp && $result) {
	    // header('Content-Type: text/csv');
	    // header('Content-Disposition: attachment; filename="export.csv"');
	    // header('Pragma: no-cache');
	    // header('Expires: 0');
	    fputcsv($fp, $headers);
	    while ($row = $result->fetch_array(MYSQLI_NUM)) {
	        fputcsv($fp, array_values($row));
	    }
	    // die;
	    fclose($fp);
	}
	
	
	
	


?>

