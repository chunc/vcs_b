<?php

// $.get variable
$zero_back = $_GET["zero_back"];
$num_stream = $_GET['num_stream'];
$correct_stream = $_GET['correct_stream'];
$correct_total = $_GET['correct_total'];
$location_id = $_GET['location_id'];

// Script reads entry from database and returns it as a json
$host = 'vergil.u.washington.edu';
$username = 'root';
$password = 'overhillway';
$dbname = "vcs";
$port = 1284;

$db_vcs = new MySQLi($host,$username,$password,$dbname,$port) or die("Cannot Connect");

//declare the SQL statement that will query the database
$query = "UPDATE switches SET zero_back = '$zero_back', nb_num_stream = '$num_stream', nb_correct_stream = '$correct_stream', nb_correct_total = '$correct_total' WHERE location_id='$location_id' ";

//execute the SQL query and return records;
$result = mysqli_query($db_vcs, $query);
$row =mysqli_fetch_assoc($result);


// mysqli_close($db_vcs);
?>