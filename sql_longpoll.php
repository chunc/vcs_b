<?php
	$location_id = $_POST['location_id'];
	$time = time();

	$host = 'vergil.u.washington.edu';
	$username = 'root';
	$password = 'overhillway';
	$dbname = "vcs";
	$port = 1284;

	$db_vcs = new MySQLi($host,$username,$password,$dbname,$port) or die("Cannot Connect");
	
	while((time() - $time) < 30) {	//Infinite loop
	    $query1 = "SELECT * FROM switches WHERE location_id='$location_id' ";
	    $result = mysqli_query($db_vcs, $query1);
		// if we have new data return it
	    if(!empty($result)) {
	        $row =mysqli_fetch_assoc($result);
	        echo json_encode($row);
	        break;
	    }


		// if(!empty($answer)) {
		// 	echo mysql_result($answer,0);
		// 	break;	
		// }
	    // sleep(300);
	}

?>