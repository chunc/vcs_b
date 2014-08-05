//	The overall goal of the script is to send a UDP message to the TDT.
//	It accomplishes by first creating a server that listens for AJAX requests.
//  When program receives AJAX request, it will fire a UDP message.

//	Note:  Needs to run on Node.js


//------------------------------------------------------------
//Create a server on http://localhost:8000 
//------------------------------------------------------------
var http = require("http");
var requests = [];
http.createServer(function(request, response) {
	// store the response so we can respond later
	requests.push(response);
}).listen(8000);
console.log('Server Running');

//When server receives Ajax request on locaslhost:8000, then fire a UDP message
setInterval(function() {
	// respond to each request
	while (requests.length) {
		response = requests.shift();
		// response.writeHead(200, { "Content-Type": "text/plain" });	
		// response.end("Baz, World!");  //Confirm on http://localhost:8000 that server has been created
		console.log('Received UDP Request');
		// query_udp();
		//Need to create function to send UDP message
		send_udp();
	}
}, 1000);

//--------------------------
// Function to send UDP
//--------------------------
var dgram = require('dgram');
var PORT = 9004;
var HOST = '127.0.0.1';

function send_udp() {
	var client = dgram.createSocket('udp4');
	var message = new Buffer('a');
	client.bind( 33334, HOST );
	client.send(message, 0, message.length, PORT, HOST, function(err, bytes) {
	    if (err) throw err;
	    console.log('UDP message "' + message + '" is sent to ' + HOST +':'+ PORT);
	    client.close();
	    // console.log(timeStamp());
	});
}

/*
function timeStamp() {
	var now = new Date();
	var stamp = [now.getFullYear(), now.getMonth()+1,now.getDate(),now.getHours(), now.getMinutes(), now.getSeconds(), now.getMilliseconds()];
	
	for(i = 0; i < stamp.length; i++) {
		stamp[i] = stamp[i].toString();	
	}

	for(j = 1; j < stamp.length - 1; j++) {
		if(stamp[j].length < 2) {
			stamp[j] = "0" + stamp[j];
		}
	}

	if(stamp[6].length == 1) {
		stamp[6] = "00"+stamp[6];
	} else if(stamp[6].length == 2) {
		stamp[6] = "0" + stamp[6];
	}
	
	var bla = stamp[0]+stamp[1]+stamp[2]+stamp[3]+stamp[4]+stamp[5]+stamp[6];
	// console.log(bla);
	return bla;
}
*/


//===================
//	NOTE TO SELF
//
//	I problably wont be needing any MYSQL functions
//====================


/*
//Establish connection to MYSQL database
var mysql      = require('mysql');
var connection = mysql.createConnection({
  host     : 'vergil.u.washington.edu',
  port	   :  1284,
  user     : 'root',
  password : 'overhillway',
  database : 'vcs'
});

//Check for successful SQL database connection
connection.connect(function(err){
    if(err != null) {
        console.log('Error connecting to mysql:' + err+'\n');
    }
    console.log("Successfully Connected to MYSQL");
});

//Function makes query to SQL database
function query_udp() {
	connection.query('SELECT sea FROM udp', function(err, rows, fields) {
		if (err) throw err;
		if(rows[0].sea === 1) {
			console.log("Result: "+rows[0].sea);
			console.log("Run Send UDP message");
		}
	});	
}

*/

