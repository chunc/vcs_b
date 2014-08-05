var http = require("http");
var pendingResponse;
var chunks = "";

var count = 0;
http.createServer(function(request, response) {
	// if we have data, send it
	send_udp();
	count++;
	console.log("count: "+count);
	if (chunks.length) {
		response.writeHead(200, { "Content-Type": "text/plain" });
		response.end(chunks);
		chunks = "";

	// no data sitting around, store the response for later
	} else {
		pendingResponse = response;
	}
}).listen(8000);

process.openStdin().addListener("data", function(chunk) {
	// if we have a pending request, send the data
	if (pendingResponse) {
		send_udp();
		console.log("Sent from backlog");
		pendingResponse.writeHead(200, { "Content-Type": "text/plain" });
		pendingResponse.end(chunk);
		pendingResponse = null;

	// no pending request, store the chunk from stdin for later
	} else {
		chunks += chunk;
	}
});


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