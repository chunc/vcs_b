<?php 
	$PID = $_POST["pid"];
	$err_lvl = $_POST["err_lvl"];
	$task = $_POST["task"];
	// $time = $_POST["timestamp"];
	$timestamp = explode(" ", $_POST["timestamp"]);
	$trial = $_POST["trial"];
	$delay = $_POST["delay"];

	$correct = $_POST["btn_correct"];
	$sys_error = $_POST["btn_sys_error"];
	$redo = $_POST["btn_redo"];
	$repeat = $_POST["btn_repeat"];
	$next1 = $_POST["btn_next1"];
	$next2 = $_POST["btn_next2"];

	
	// $my_file = "datalog/PID" . $PID ."_".$timestamp[0]."_".$err_lvl."_Error"."_Datalog.txt";
	$my_file = "datalog/PID" . $PID ."_".$err_lvl."_Error_".$timestamp[0].".txt";
	// $my_file = "datalog/data_log.txt";
	
	if (file_exists($my_file)) {
		// $data = $PID."\t".$time."\t".$task."\t".$correct."\t".$sys_error."\t".$redo."\t".$repeat."\t".$next1."\t".$next2."\n";
		$data = $PID."\t".$timestamp[0]."\t".$timestamp[1]."\t".$delay."\t".$task."\t".$trial."\t".$correct."\t".$sys_error."\t".$redo."\t".$repeat."\t".$next1."\t".$next2."\n";
	} else {
		// $data = "PID \t timestamp \t task \t btn_correct \t btn_sys_error \t btn_redo \t btn_repeat \t btn_next1 \t btn_next2 \n";
		$data = "PID \t Date \t Time \t delay \t task \t trial\t btn_correct \t btn_sys_error \t btn_redo \t btn_repeat \t btn_next1 \t btn_next2 \n";
	}

	$handle = fopen($my_file, "a"); 
	fwrite($handle, $data); // write it 
	fclose($handle);  
?>