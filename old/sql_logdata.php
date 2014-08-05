<?php
	// POST variables
	$PID = $_POST["pid"];
	$err_lvl = $_POST["err_lvl"];
	$timestamp = explode(" ", $_POST["timestamp"]);
	$id = $_POST["id"];
	$logdata_location = $_POST['logdata'];

	// SQL Connection
	$host = 'vergil.u.washington.edu';
	$username = 'root';
	$password = 'overhillway';
	$dbname = "vcs";
	$port = 1284;

	$db_vcs = new MySQLi($host,$username,$password,$dbname,$port) or die("Cannot Connect");

	$query1 = "UPDATE switches SET date='$timestamp[0]', time='$timestamp[1]' WHERE id='$id' ";
	$result1 =  mysqli_query($db_vcs, $query1);

	$query = "SELECT * FROM switches WHERE id='$id'   ";
	$result = mysqli_query($db_vcs, $query);
		    
	$row =mysqli_fetch_assoc($result);

	$my_file = "datalog/PID" . $PID ."_".$err_lvl."_Error_".$timestamp[0].".csv";
	$handle = fopen($my_file, "a");
	
	if (file_exists($my_file)) {
		do{
			fputcsv($handle, $row,',','"');
		}	while($row = mysqli_fetch_assoc($result));
	} else {
		$heads = array_keys($row);	
		fputcsv($handle, $heads, ',','"');
	}
	// $heads = array_keys($row);
	// fputcsv($handle, $heads);	
	fclose($handle); 

	// Enter data into SQL table
	$query2 = "INSERT INTO $logdata_location SELECT * FROM switches WHERE id='$id' ";
	$result2 = mysqli_query($db_vcs, $query2);


?>