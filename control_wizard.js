//=====================
// Global Variables
//=====================
// var timer = 0;   //Used on Wizard interface timer notifier
var json;       //Stores sequence of task
var profile_data;   //Stores participant ID, location, and experiment type entered in the index page
var runTimer;   //Related to Wizard interface timer notifier
var timer;	//Related to Wizard interface timer
var long_delay_lag = 8000;  //8 second delay for slow response block condition

// New Interface variables
var repeat_inc_command = 0;

var repeat_command = 0;
var repeat_confirm_err = 0;
var repeat_confirm_corr = 0;
var inc_confirm_count = 0;
var run_index;  //Index for json task number
var command_stage;  //Helps determine if task is in command stage of conform stage. See check_stage()
var bool_complete_once; //Used in "High Error Events"

//Location and ID Variables
var location_code;
var log_id;
var city;


// N-Back Variables
var one_back = null;
var zero_back = null;
var stream = [];
var stream_length = 20; //Define how many digits used for N-back task
var stream2string;
var nb_count = 0;
var nb_num_correct = 0;
var nb_correct_stream = [];
var nb_correct_trigger;
var nb_num_string;
var interval = 3000; //Define time in between new numbers.  Units in milli-seconds.
var audio_num = ["nb-0.mp3","nb-1.mp3","nb-2.mp3","nb-3.mp3","nb-4.mp3","nb-5.mp3","nb-6.mp3","nb-7.mp3","nb-8.mp3","nb-9.mp3"];

// ================================
// Default File Directory
// ================================
var db_file = 'zz_vcs_run1.json';  //Default file that is loaded



// ====================
// Load Files
// ====================

//Default Load 'zz_vcs_run1.json' or Main Run 1
$.getJSON(db_file, function(jsonData) {
        json = jsonData;
        console.log('Loaded JSON file: '+db_file);
});



//Loads file from dropdown menu on wizard interface 
function switch_json(file) {
    $.getJSON(file, function(jsonData) {
        json = jsonData;
        clear_small();
        
        $.ajaxSetup ({  
            cache: false  
        });
        $.get("sql_clear_all_task.php" ,{location_id: location_code});
        display_on_subject('none');
       
        console.log('Loaded JSON file: '+file);
    });
}


$.getJSON("profile_data.json", function(jsonData) {
    profile_data = jsonData;  //Variable used in datalogging function
    location_code = profile_data.location_id;
    if(location_code === "sea") {
        city = "Seattle WA";
        log_id = "logdata_sea";
    } else if(location_code === "mad") {
        city = "Madison WI";
        log_id = "logdata_mad";
    } else {
        city = "Seattle WA";
        log_id = "logdata_test";
    }
});     




// ================================
// Longpolling Functions
// ================================

var lpStart = function() {
    $.post('sql_longpoll.php', {location_id: location_code}, lpOnComplete, 'json');
    // $('button').prop('disabled', true);
};

var lpOnComplete = function(response) {
    // do more processing
    // console.log("Active Task: "+response.task);
    
    function check_confirm_high() 
    {
        if(response.error_level === "high" && bool_complete_once === false) 
        {
            $('#sys_error_warning').html("System Error Event");
            $('#form-7').css({"color":"green", "font-size":"3em"});
            $('#label-7').html('Expected Confirm:');
            $('#form-7').html('No');
        } 
        else if(response.error_level === "high" && bool_complete_once === true) 
        {
            $("#sys_error_warning").html("");
            $('#label-7').html('');
            $('#form-7').html('');
        } else {
        	$('#sys_error_warning').html("");
        	$('#label-7').html('');
            $('#form-7').html('');
        }
    }

    if(response.task === "radio") {
        $('#label-1').html('Task:');
        $('#form-1').html('Radio');
        $('#label-2').html('');
        $('#form-2').html('');
        $('#label-3').html('Correct:');
        $('#form-3').html(response.r_station+" or "+response.r_freq);
        $('#label-4').html('');
        $('#form-4').html('');

        $('#label-5').html('');
        $('#form-5').html('');
        $('#label-6').html('Delay:');
        $('#form-6').html(response.delay);
        check_confirm_high();
        // $('#label-7').html('');
        // $('#form-7').html('');
        $('#label-8').html('Error:');
        $('#form-8').html(response.error_level);
        
        $('#norm-btn').css("display","");
        $('#nback-btn').css("display","none"); 
    
    } else if(response.task === "nav") {
        $('#label-1').html('Task:');
        $('#form-1').html('Navigation');
        $('#label-2').html('');
        $('#form-2').html('');
        $('#label-3').html('Correct:');
        $('#form-3').html(response.n_num+" "+response.n_street+" "+response.n_rtype);
        $('#label-4').html('');
        $('#form-4').html('');

        $('#label-5').html('');
        $('#form-5').html(city);
        $('#label-6').html('Delay:');
        $('#form-6').html(response.delay);
        check_confirm_high();
        // $('#label-7').html('');
        // $('#form-7').html('');
        $('#label-8').html('Error:');
        $('#form-8').html(response.error_level);
        
        $('#norm-btn').css("display","");
        $('#nback-btn').css("display","none");
   
    } else if(response.task === "calendar") {
        $('#label-1').html('Task:');
        $('#form-1').html('Calendar');
        $('#label-2').html('Location:');
        $('#form-2').html(response.c_location);
        $('#label-3').html('Contact:');
        $('#form-3').html(response.c_contact);
        $('#label-4').html('Time:');
        $('#form-4').html(response.c_time);

        $('#label-5').html('Day:');
        $('#form-5').html(response.c_day);
        $('#label-6').html('Delay:');
        $('#form-6').html(response.delay);
        check_confirm_high();
        // $('#label-7').html('');
        // $('#form-7').html('');
        $('#label-8').html('Error:');
        $('#form-8').html(response.error_level);
        
        $('#norm-btn').css("display","");
        $('#nback-btn').css("display","none");
              
    } else if(response.task === "n-back") {
        $('#label-1').html('Task:');
        $('#form-1').html('N-Back');
        $('#label-2').html('');
        $('#form-2').html('');
        $('#label-3').html('Stream:');
        $('#form-3').html(stream2string);
        $('#label-4').html('');
        $('#form-4').html('');

        $('#label-5').html();
        $('#form-5').html();
        $('#label-6').html('');
        $('#form-6').html('');
        $('#label-7').html('1-Back:');
        $('#form-7').html(one_back);
        $('#label-8').html('Correct:');
        $('#form-8').html(nb_num_correct+ ' out of '+stream_length);
        
        $('#norm-btn').css("display","none");
        $('#nback-btn').css("display","");
    } 
    else {
        $('#label-1').html('Task:');
        $('#form-1').html(response.task);
        $('#label-2').html('');
        $('#form-2').html('');
        $('#label-3').html('');
        $('#form-3').html('');
        $('#label-4').html('');
        $('#form-4').html('');

        $('#label-5').html('');
        $('#form-5').html('');
        $('#label-6').html('');
        $('#form-6').html('');
        $('#label-7').html('');
        $('#form-7').html('');
        $('#label-8').html('');
        $('#form-8').html('');
        
        $('#norm-btn').css("display","");
        $('#nback-btn').css("display","none");
    }
    lpStart();
};




// ====================
// Wizard Buttons
// ====================
function btn_reset() 
{
    clear_small();
    $.ajaxSetup ({  
        cache: false  
    });
    $.get("sql_clear_all_task.php" ,{location_id: location_code});
    display_on_subject('none');
    record_button_input('reset');
}

function btn_start() 
{
    
    clear_small();
    run_index = 1;
    
    setTimeout(function(){
    	load_task(run_index);
    },1000);
    record_button_input('start');   
}

function btn_next_task() 
{
    // clear_small();
    display_on_subject("none");
    run_index++;
    load_task(run_index);
}



function btn_command_correct() 
{
    record_button_input('command_correct');
    // console.log('correct button pressed');

    $('button').prop('disabled', true);
    command_stage = false;

    clearTimer();
    
    $.ajaxSetup ({  
        cache: false  
    });
    
    if(json.run[run_index].err_rate === "high" && json.run[run_index].delay === "short")
    {
        if(bool_complete_once === false)
        {
            display_on_subject("error");
            play_confirm_audio("error",run_index);
        } else 
        {
            display_on_subject("correct");
            play_confirm_audio("confirm",run_index);    
        }
    }

    if(json.run[run_index].err_rate === "high" && json.run[run_index].delay === "long")
    {
        if(bool_complete_once === false)
        {
            setTimeout(function(){display_on_subject("error");play_confirm_audio("error",run_index)},long_delay_lag);
        } else 
        {
            setTimeout(function(){display_on_subject("correct"); play_confirm_audio("confirm",run_index)},long_delay_lag);  
        }
    }

    if(json.run[run_index].err_rate === "low" && json.run[run_index].delay === "short")
    {
        display_on_subject("correct");
        play_confirm_audio("confirm",run_index);
    }

    if(json.run[run_index].err_rate === "low" && json.run[run_index].delay === "long")
    {
        setTimeout(function(){display_on_subject("correct");play_confirm_audio("confirm",run_index)},long_delay_lag);
    }
    
    
}

//delay_next_task Global variable
var task_delay = 0;

function btn_command_incorrect() 
{
    record_button_input('command_incorrect');
    if(repeat_inc_command + repeat_command < 2) {
        replay_prompt(run_index);
        display_on_subject("none");
        repeat_inc_command++;
        console.log('(DEBUG) cmd_inc: '+repeat_inc_command+' cmd_rpt: '+repeat_command);   
    } else {
        repeat_inc_command++;
        console.log('(DEBUG) cmd_inc: '+repeat_inc_command+' cmd_rpt: '+repeat_command);
        setTimeout(function(){
        	record_button_input('fail_command_repeat');	
        },500);	//Was 100

        display_on_subject("none");
        repeat_inc_command = 0;
		
		delay_next_task(task_delay);	//Was 200
		
        // run_index++;
        // load_task(run_index);
    }
       
}

function btn_command_repeat() 
{
    record_button_input('command_repeat');
    repeat_command++;
    console.log('(DEBUG) cmd_inc: '+repeat_inc_command+' cmd_rpt: '+repeat_command);
    if(repeat_command + repeat_inc_command < 3) {
    	replay_prompt(run_index);
        display_on_subject("none"); 
    } else {
        
        setTimeout(function(){
        	record_button_input('fail_command_repeat');
        },500);


        display_on_subject("none");
        repeat_command = 0;
        
        delay_next_task(task_delay);	//Was 200
        // run_index++;
        // load_task(run_index);    
    }       
}

function btn_confirm_correct() 
{
    record_button_input('confirm_correct');
    if(json.run[run_index].err_rate === "high" && bool_complete_once === true) 
    {
        display_on_subject("none");
        delay_next_task(task_delay);	//Was 100
        // run_index++;
        // load_task(run_index);
        
    } else if(json.run[run_index].err_rate === "high" && bool_complete_once === false) 
    {
        setTimeout(function() {
        	record_button_input('catch_sys_error','yes_clear_btn');
        },500);	//Was 100
        replay_prompt(run_index);
        command_stage = true;
        bool_complete_once = true;
        display_on_subject("none");
        
    } else 
    {
        display_on_subject("none");
        delay_next_task(task_delay);	//Was 200
        // run_index++;
        // load_task(run_index);
    }
}

function btn_confirm_incorrect() 
{
    record_button_input('confirm_incorrect');
    inc_confirm_count++;
    console.log('(DEBUG) cmf_inc: '+inc_confirm_count+' cmf_rpt: '+repeat_confirm_corr);
    if(json.run[run_index].err_rate === "high" && bool_complete_once === false) {
    	// run_index++;
    	// load_task(run_index);
    	inc_confirm_count = 0;
    	delay_next_task(task_delay);	//Was 100
    } else {
    	// console.log("count: "+inc_confirm_count);
    	if(inc_confirm_count+repeat_confirm_corr >= 3) {
    		setTimeout(function(){
    			record_button_input("fail_confirm_repeat","yes_clear_btn");
    		},500);		//Was 100
    		    		
    		inc_confirm_count = 0;
    		delay_next_task(task_delay);	//Was 250
    		// run_index++;
    		// load_task(run_index);
    	} else if(inc_confirm_count+repeat_confirm_corr < 3) {
    		replay_prompt(run_index);
    		display_on_subject("none");
    		command_stage = true;
    	}
    }
    // run_index++;
    // load_task(run_index);    
}

function btn_confirm_repeat()
{
    record_button_input('confirm_repeat');
    $('button').prop('disabled', true);
    clearTimer();
    if(json.run[run_index].err_rate === "low" || json.run[run_index].err_rate === "high" && bool_complete_once === true)
    {
        repeat_confirm_corr++;
        console.log('(DEBUG) cmf_inc: '+inc_confirm_count+' cmf_rpt: '+repeat_confirm_corr);
        if(inc_confirm_count+repeat_confirm_corr < 3)
        {
            display_on_subject("correct");
            play_confirm_audio("confirm",run_index);
        }
        else
        {
            // btn_next_task();
            setTimeout(function(){
            	record_button_input('fail_confirm_repeat');
            },500);
            
            // run_index++;
            // load_task(run_index);
            delay_next_task(task_delay);	//was 200
            repeat_confirm_corr = 0;
        }
    }
    else if(json.run[run_index].err_rate === "high" && bool_complete_once === false)
    {
        repeat_confirm_err++;
        if(repeat_confirm_err < 3)
        {
            display_on_subject("error");
            play_confirm_audio("error",run_index);
        }
        else
        {
            setTimeout(function(){
            	record_button_input('fail_confirm_repeat'); 
            },500);
            
            repeat_confirm_err = 0;
            delay_next_task(task_delay);
            // run_index++;
            // load_task(run_index);
        }
    }
            
}

// =================
// Misc Functions
// =================

function load_task(count) {
    clearTimer();
    command_stage = true;
    display_on_subject('none');
    clear_small();
    repeat_confirm_err = 0;
    repeat_confirm_corr = 0;
    repeat_inc_command = 0;
    repeat_command = 0;
    inc_confirm_count = 0;


    $('#wiz_buttons button').prop('disabled', true);     //disable button
    if(count > json.run.length -1) {
        count = 0;
    }

    // Common Variables
    var task_name = json.run[count].task;
    var a_prompt = json.run[count].audio_prompt;
    var a_confirm = json.run[count].audio_confirm;
    var a_err = json.run[count].audio_err;
    var delay = json.run[count].delay;
    var err_rate = json.run[count].err_rate;
    var trial = json.run[count].trial;

    //Radio Variables
    var station = json.run[count].r_station;
    var freq = json.run[count].r_freq;
    var err_station = json.run[count].r_err_station;
    var err_freq = json.run[count].r_err_freq;

    //Navigation Variables
    var street = json.run[count].n_street;
    var num  = json.run[count].n_num;
    var rtype = json.run[count].n_rtype;
    var err_street = json.run[count].n_err_street;
    var err_num = json.run[count].n_err_num;
    var err_rtype = json.run[count].n_err_rtype;

    //Calendar Appointment Variables  
    var cal_contact = json.run[count].c_contact;
    var cal_location = json.run[count].c_location;
    var cal_day = json.run[count].c_day;
    var cal_time    = json.run[count].c_time;
    var cal_err_contact = json.run[count].c_err_contact;
    var cal_err_location = json.run[count].c_err_location;
    var cal_err_day = json.run[count].c_err_day;
    var cal_err_time    = json.run[count].c_err_time;

    //Insert database json files in switch board
    $.ajaxSetup ({  
        cache: false  
    });
    $.get("sql_update_wiz_display.php", { 
        location_id: location_code,
        task: task_name,
        trial: trial,

        r_station: station,
        r_freq: freq,
        r_err_station: err_station,
        r_err_freq: err_freq,

        n_street: street,
        n_num: num,
        n_rtype: rtype,
        n_err_street: err_street,
        n_err_num: err_num,
        n_err_rtype: err_rtype,

        c_contact: cal_contact,
        c_location: cal_location,
        c_day: cal_day,
        c_time: cal_time,
        c_err_contact: cal_err_contact,
        c_err_location: cal_err_location,
        c_err_day: cal_err_day,
        c_err_time: cal_err_time,
        
        audio_prompt: a_prompt,
        audio_confirm: a_confirm,
        audio_error: a_err,
        delay: delay,
        err_rate: err_rate
    },complete_task_load);

    /*
    var task_type = json.run[count].task;
    if(task_type == 'tdt') {
    	var audio_file = 'audio/tdt_prompt.mp3';
    } else {
    	var audio_file = "audio/"+json.run[count].audio_prompt;
    }
    
  	play_command_audio(task_type,audio_file);
    bool_complete_once = false;
    record_button_input('next_task');
    */ 
}

function complete_task_load() {
	var task_type = json.run[run_index].task;
    if(task_type == 'tdt') {
    	var audio_file = 'audio/tdt_prompt.mp3';
    } else {
    	var audio_file = "audio/"+json.run[run_index].audio_prompt;
    }
    
  	play_command_audio(task_type,audio_file);
    bool_complete_once = false;
    record_button_input('next_task'); 
}

function delay_next_task(lag) {
	setTimeout(function(){
		run_index++;
		load_task(run_index);
	},lag);
}

function clear_small() {
    $("#sys_error_warning").html("");
    $("#label-7").html('');
    $("#form-7").html('');

    clearTimer();
    $('#form-3').css('color','black');	//Reset color for Nback numbers
    stream.splice(0, stream.length);    //Empty the Stream array
    nb_correct_stream.splice(0,nb_correct_stream.length);   //Clear or empty array
    nb_count = 0;                       //Clear N-back index on 'Next' button press 
    nb_num_correct = 0;
    zero_back = null;
    one_back = null;
    stream2string = null;
}

function display_on_subject(show) {
    var filename = "sql_update_subject_display.php";
    if(show == 'correct') {
        $.get(filename, { location_id: location_code, show_correct: 1, show_sys_error: 0}); 
    }
    else if(show == 'error'){
        $.get(filename, { location_id: location_code, show_correct: 0, show_sys_error: 1});   
    } 
    else if(show == 'none'){
        $.get(filename, { location_id: location_code, show_correct: 0, show_sys_error: 0});
    } else{
        $.get(filename, { location_id: location_code, show_correct: 0, show_sys_error: 0});
    }
}

function record_button_input(input) {
    
    var r_pid = profile_data.pid;
    var r_location = location_code;
    var r_run_type = profile_data.run_type;
    var r_error_block = profile_data.error_block;
    var r_scenario = profile_data.scenario; 
    
    var r_date = timestamp_new('date');
    var r_time = timestamp_new('time');
    var r_task = json.run[run_index].task;
    
    var r_trial = json.run[run_index].trial;    //Currently Unused
    
    var r_delay = json.run[run_index].delay;
    var r_error_task = json.run[run_index].err_rate;
    var r_btn_input = input;

    var r_radio_prompt = json.run[run_index].r_station;
    var r_nav_prompt = json.run[run_index].n_num+' '+json.run[run_index].n_street+' '+json.run[run_index].n_rtype;
    var r_cal_prompt = json.run[run_index].c_contact+' '+json.run[run_index].c_location+' '+json.run[run_index].c_day+' '+json.run[run_index].c_time;
    
//    var r_nb_num = stream2string;
    var r_nb_num = '{'+nb_num_string+'}';
    var r_nb_correct = nb_num_correct;

    if(json.run[run_index].trial === undefined) {r_trial ='NA'}

    if(json.run[run_index].r_station === undefined)  {r_radio_prompt = 'NA';} 
    if(json.run[run_index].n_street === undefined) {r_nav_prompt = 'NA';}
    if(json.run[run_index].c_contact === undefined) {r_cal_prompt = 'NA';}

    if(r_delay === undefined) {r_delay = 'NA';}
    if(r_error_task === undefined) {r_error_task = 'NA';}
    
    if(stream2string === null) {r_nb_num = 'NA';}




    var r_log = r_pid +','+
    			r_location+','+
    			r_run_type+','+
    			r_error_block+','+
    			r_scenario+','+

    			r_date+','+
    			r_time+','+
    			r_task+','+
    			
                r_trial+','+  
        
                r_delay+','+
    			r_error_task+','+
    			r_btn_input+','+

    			r_radio_prompt+','+
    			r_nav_prompt+','+
    			r_cal_prompt+','+
                
                r_nb_num+','+
                r_nb_correct+',';

    console.log(r_log);
    logdata_new(r_log);
}

function play_audio(file) {
    var sound_file = file;
    // var audio = new Audio(sound_file);
    // audio.play();

    var audio = new Howl({
    	urls: [sound_file],
    	autoplay: true,
    	buffer: true
    });
}

function replay_prompt(index) {
    clearTimer();
    $('button').prop('disabled', true);
    $.ajaxSetup ({  
        cache: false  
    });
    
    //Play Audio File
    var task_type = json.run[index].task;
    var audio_file = "audio/"+json.run[index].audio_prompt;
    var beep_sound = "audio/chime.mp3";
    play_command_audio(task_type,audio_file); 
}

function play_confirm_audio(type, index) {
    if(type === "confirm") {
        var audio_file = "audio/"+json.run[index].audio_confirm;    
    } else {
        var audio_file = "audio/"+json.run[index].audio_err;
    }
    // startTimer("norm");
    setTimeout(function(){play_audio(audio_file);check_stage();$('#wiz_buttons button').prop('disabled', true);}, 1000);
    setTimeout(function(){startTimer("norm");$('#btn_confirm_group button').prop('disabled', false);},5000);
}

function play_command_audio(task, file){
    // console.log('task: '+task+' dir: '+file);
    var beep_sound = "audio/chime.mp3";
    
    if(task !== 'n-back') {
        play_audio(file);   
    }

    if(task === 'radio') {
        setTimeout(function() {
            play_audio(beep_sound);
            // $('button').prop('disabled', false);
            check_stage();
            startTimer("norm");
        },3500);
    } else if (task === 'nav') {
        setTimeout(function() {
            play_audio('audio/n_where.mp3');
            setTimeout(function(){play_audio(beep_sound);},2000);
            setTimeout(function(){$('button').prop('disabled', false); check_stage()},2000);
            startTimer("norm");
        },8000);    
    } else if (task === 'calendar') {
        setTimeout(function() {
            play_audio('audio/c_schedule.mp3');
            setTimeout(function(){play_audio(beep_sound);},2000);
            setTimeout(function(){$('button').prop('disabled', false); check_stage();},2000);
            startTimer("norm");
        },6000);
    } else if (task === 'n-back') {
        play_audio('audio/nb_prompt.mp3');
        setTimeout(function(){$('button').prop('disabled', false);},2000);
    } else if (task === 'tdt') {
        // play_audio('audio/tdt_prompt.mp3');
        setTimeout(function(){startTimer("tdt");},4000);
        // startTimer("tdt");
        setTimeout(function(){$('#wiz_buttons button').prop('disabled', true);},2000);
    } else {
        $('button').prop('disabled', false);
    }
}

// Checks stage to determine which group of buttons to disable
function check_stage() {
    $('#start-reset button').prop('disabled',false);
    if(command_stage) {
        $('#btn_confirm_group button').prop('disabled',true);
        $('#btn_command_group button').prop('disabled',false);
    } else {
        $('#btn_confirm_group button').prop('disabled',false);
        $('#btn_command_group button').prop('disabled',true);
    }
}

function startTimer(task) {
    timer = 0;
    countdown = 60;
    runTimer = setInterval(function() { 
        update_nback_display(countdown);    //Updates Subject's screen
        $('#timer').html('Timer: '+ timer +' sec');
        timer++;
        
        if(task == 'tdt') {
        	countdown = countdown - 1;	
        }
        
        // console.log(countdown);
        if(timer > 11 && task !== "tdt") {
            $('#timer').html('Timer: '+ timer+ '     --Over 10 seconds.  You should repeat instructions');
        }
        if(task === "tdt" && timer >60) {
            $('#timer').html('Timer: '+ timer+ '     --Over 60 seconds.  Move to next task');
            run_index++;
            load_task(run_index);
            countdown = 60;
        }
    }, 1000);
}

function clearTimer() {
    clearInterval(runTimer);
    $('#timer').html('Timer:');
    timer = 0;
}



// =====================
// N-Back Functions
// =====================
function nback_start() {
    $('#nb-start').prop('disabled', true);
    nb_num_string ="";
    var streamNUM = setInterval(function() {
        var stream_count = next_num();
        if (stream_count > stream_length) {
                console.log('[N-back] '+timestamp_new('time')+' All N-back numbers shown');
                $('#form-3').css('color','blue');
                // clear_small();
                clearInterval(streamNUM);
                $('#nb-start').prop('disabled', false);
            }
    }, interval);
}

function next_num() {
    // console.log("correct trigger: "+nb_correct_trigger);
    
    var randomnumber=Math.floor(Math.random()*10);
    one_back = zero_back;
    zero_back = randomnumber;
    
    //Makes sure that numbers dont get repeated
    if(one_back === randomnumber) {
        var temp;
        do {
            temp = Math.floor(Math.random()*10);
        } while(temp === one_back);
        zero_back = temp;
    }
    
    stream[nb_count] = zero_back;
    stream2string = stream.toString();
    
    nb_num_string = nb_num_string+' '+zero_back;
    
    if(nb_correct_trigger === true) {
        nb_correct_stream[nb_count] = 1;
    } else {
        nb_correct_stream[nb_count] = 0;
    }
    
        
    // console.log('[N-Back] '+timestamp_new('time')+' numList: {'+stream.toString()+'}');
    record_button_input('nb_num');
    update_nback_display(zero_back);
    
    // console.log(stream[nb_count]);
    // var play_num = new Audio("audio/"+audio_num[zero_back]);
    // play_num.play();
    var play_num = new Howl({
    	urls: ['audio/'+audio_num[zero_back]],
    	autoplay: true,
    	buffer: true
    });

    if(nb_count > 0) {
        var chime = new Audio("audio/chime4.wav");
        // setTimeout(function(){chime.play();},1000);
    }
    
    nb_count = nb_count+1;
    nb_correct_trigger = false;
    nb_correct_stream[nb_count] = 0;
    return nb_count;
}

function nback_correct() {
    if(nb_num_correct < stream_length) {
        nb_num_correct++;   
        nb_correct_trigger = true;
    }
    // console.log('[N-Back] '+timestamp_new('time')+' correct: '+nb_num_correct);
    record_button_input('nb_correct');
}

function nback_reset() {
    location.reload();
}

function update_nback_display(num) {
    // console.log();
    var task_name = 'n-back';
    var nb_correct_string = nb_correct_stream.toString();
    $.ajaxSetup ({  
        cache: false  
    });
    $.get('sql_update_nback.php', { 
        location_id: location_code,
        task: task_name,
        zero_back: num,
        num_stream: stream2string,
        // correct_stream: nb_correct_string,
        correct_total: nb_num_correct
    },setTimeout(function(){/* Some function here  */},100));
}



function btn_nback_next() {    
    run_index++;
    load_task(run_index);
}

// =====================
// Data Logging Function
// =====================


function timestamp_new(choice) {
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

    if(stamp[6].length === 1) {
        stamp[6] = "00"+stamp[6];
    } else if(stamp[6].length === 2) {
        stamp[6] = "0" + stamp[6];
    }
    
    // Sample Date Format:
    // 2013-11-22 14:36:20:156
    var date_time = stamp[0]+"-"+stamp[1]+"-"+stamp[2]+" "+stamp[3]+":"+stamp[4]+":"+stamp[5]+":"+stamp[6];
    // return blurb;
    
    if(choice.toLowerCase() == 'date') {
    	return stamp[0]+"-"+stamp[1]+"-"+stamp[2];
    } else if(choice.toLowerCase() == 'time') {
    	return stamp[3]+":"+stamp[4]+":"+stamp[5]+":"+stamp[6];
    } else {
    	return date_time;
    }
}

function logdata_new(log) {
	$.ajaxSetup ({cache: false});
    var time = timestamp_new('date');
     $.post('sql_log_simple.php',{
        location_id: location_code, 
        logdata: log_id, 
        pid: profile_data.pid,
        run_type: profile_data.run_type,
        scenario: profile_data.scenario,
        err_lvl: profile_data.error_block, 
        timestamp: time,
        log: log
    });
}

setTimeout(function(){$(document).ready(lpStart);},1000);
// $(document).ready(lpStart);


