<?php

	$time = time();
	$json_file = $_POST["control_file"];
	while((time() - $time) < 30) {	//Infinite loop
	    $json_data = json_decode(file_get_contents($json_file), true);
		// if we have new data return it
	    if(!empty($json_data)) {
	        echo json_encode($json_data);
	        break;
	    }


		// if(!empty($answer)) {
		// 	echo mysql_result($answer,0);
		// 	break;	
		// }
	    // sleep(300);
	}

?>