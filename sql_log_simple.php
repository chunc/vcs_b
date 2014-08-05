<?php
	// POST variables
	$PID = $_POST["pid"];
	$err_lvl = $_POST["err_lvl"];
	$timestamp = explode(" ", $_POST["timestamp"]);
	$location_id = $_POST["location_id"];
	$logdata_location = $_POST['logdata'];
	$run_type = $_POST['run_type'];
	$scenario = $_POST['scenario'];

	$log = $_POST['log'];

	// SQL Connection
	$host = 'vergil.u.washington.edu';
	$username = 'root';
	$password = 'overhillway';
	$dbname = "vcs";
	$port = 1284;

	$db_vcs = new MySQLi($host,$username,$password,$dbname,$port) or die("Cannot Connect");

	$my_file = "datalog/PID" . $PID ."_".$err_lvl."_Error_".$timestamp[0]."_newfile.csv";
	$handle = fopen($my_file, "a");
	
	
	$table_header ="pid,location,run_type,error_block,scenario,date,time,task,delay,error_task,btn_input,radio_prompt,nav_prompt,cal_prompt,nb_num,nb_correct_count \n";

	if(file_exists($my_file))
	{
		file_put_contents($my_file, $log."\n", FILE_APPEND | LOCK_EX);	
	} else {
		
	}

	$master_file = "datalog/logdata_all.csv";
	file_put_contents($master_file, $log."\n", FILE_APPEND | LOCK_EX);

	fclose($handle); 

	// Enter data into SQL table
	//	Should create columns to insert everything
	$myArray = explode(',', $log);
	
	//$query2 = "INSERT INTO $logdata_location SET log = '$log' ";
	//$result2 = mysqli_query($db_vcs, $query2);

	$query2 = "INSERT INTO $logdata_location SET
		pid = '$myArray[0]',
		location = '$myArray[1]',
		run_type = '$myArray[2]',
		error_block = '$myArray[3]',

		scenario = '$myArray[4]',
		date = '$myArray[5]',
		time = '$myArray[6]',
		
		task = '$myArray[7]',
		trial = '$myArray[8]',
		delay = '$myArray[9]',
		error_task = '$myArray[10]',
		btn_input = '$myArray[11]',

		radio_prompt = '$myArray[12]',
		nav_prompt = '$myArray[13]',
		cal_prompt = '$myArray[14]',
		nb_num = '$myArray[15]',
		nb_correct = '$myArray[16]'
	";

	$result2 = mysqli_query($db_vcs, $query2);
	

?>