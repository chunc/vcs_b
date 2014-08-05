var location_code;
var city;

$.getJSON("profile_data.json", function(jsonData) {
    profile_data = jsonData;  //Variable used in datalogging function
    location_code = profile_data.location_id;
    if(location_code === "sea") {
        city = "Seattle WA";
    } else if(location_code === "mad") {
        city = "Madison WI";
    } else {
        city = "Seattle WA";
    }
}); 

// =======================================
// Subject or Participant View Functions
// =======================================
var lp2OnComplete = function(response) {
    // alert(response);
    
	if(response.task == "radio") {
        $('#myTab a[href="#radio"]').tab('show');   //Show Radio Tab 
        if(response.show_correct == 1) {                  //Check button presses
            $('#s_station').html(response.r_station);
            $('#now_listening').html('You are now listening to:');
        } else if (response.show_sys_error == 1) {
            $('#s_station').html(response.r_err_station);
            $('#now_listening').html('You are now listening to:');
        } else {
            $('#s_station').html("");
            $('#now_listening').html("");
        }
    } else if(response.task == "nav") {
        var address = response.n_num +" "+response.n_street+" "+response.n_rtype;
        var err_address = response.n_err_num+" "+response.n_err_street+" "+response.n_err_rtype;
        $('#myTab a[href="#nav"]').tab('show');
        if(response.show_correct ==1) {            
            $('#s_address').html(address);
            $('#s_state').html(city);
        } else if (response.show_sys_error == 1) {
            $('#s_address').html(err_address);
            $('#s_state').html(city);
        } else {
            $('#s_address').html("");
            $('#s_state').html("");
        }      
    } else if(response.task == "calendar") {
        $('#myTab a[href="#calendar"]').tab('show');
        if(response.show_correct ==1) {            
        	$('#s_contact').html(response.c_contact);
            $('#s_location').html(response.c_location);
            $('#s_time').html(response.c_day+" "+response.c_time);   
        } else if (response.show_sys_error == 1) {
            $('#s_contact').html(response.c_err_contact);
            $('#s_location').html(response.c_err_location);
            $('#s_time').html(response.c_err_day+" "+response.c_err_time);
        } else {
            $('#s_contact').html("");
            $('#s_location').html("");
            $('#s_time').html("");
        }    
    } else if(response.task == "n-back") {
        $('#myTab a[href="#n-back"]').tab('show');
        // $('#n-back_form').html(response.zero_back);
        $('#n-back_form').html("Please say outloud the previous number");   
    } else if(response.task == "tdt") {
        $('#myTab a[href="#tdt"]').tab('show');
        $('#tdt_form').html(response.zero_back); 
    } else {
            $('#s_station').html("");
            $('#now_listening').html("");
            $('#s_address').html("");
            $('#s_state').html("");
            // $('#s_event').html("");
            $('#s_contact').html("");
            $('#s_location').html("");
            $('#s_time').html("");
    }
	
	lp2Start(); 	    
}

var lp2Start = function() {
    $.post('sql_longpoll.php', {location_id: location_code}, lp2OnComplete, 'json');
}

setTimeout(function(){$(document).ready(lp2Start);}, 1000);
// $(document).ready(lp2Start);