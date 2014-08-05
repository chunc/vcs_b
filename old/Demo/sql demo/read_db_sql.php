<?php
// Script reads entry from database and returns it as a json
$host = 'vergil.u.washington.edu';
$username = 'root';
$password = 'overhillway';
$dbname = "vcs";
$port = 1284;

$db_vcs = new MySQLi($host,$username,$password,$dbname,$port) or die("Cannot Connect");

//declare the SQL statement that will query the database
$query1 = "SELECT * FROM buttons";
$query2 = "UPDATE switches SET correct = 5";

//execute the SQL query and return records;

$result = mysqli_query($db_vcs, $query1);
$row =mysqli_fetch_assoc($result);
// print $row['redo'];  //For specific column
echo json_encode($row);

mysqli_close($db_vcs);
?> 

<?php
/*
Java Script Sample
function correct_button(){
    $.ajaxSetup ({  
        cache: false  
    });
	$.get('test.php',dirk,'json');
}

function dirk (data) {
	alert("foo");
	alert(data.redo);
	// var num = 5 + data;
	// alert("The number is: "+num);
}


correct_button();

 */
 ?>