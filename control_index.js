
var jsonData;

function btn_randomize_trial(file) {
	$.ajaxSetup ({cache: false});
	// $.get(db_json_file, createRUN, 'json');
	$.get(file, createRUN, 'json');
}


function createRUN(db) {
    console.log(db);
    
    var task = ["radio", "nav","calendar"];
    var delay = ["short","long"];
    
    var trial = {};  //Declare a json object
    trial.run=[];   //Add a child to json object
    
    var trial2 = {};
    trial2.run=[]
    
    task = shuffle(task);
    delay = shuffle(delay);
    
    // console.log(eval("db.low_error."+task[0]));  //Evaluates String as a variable
    var rand0 = shuffle(eval("db.low_error."+task[0]));
    var rand1 = shuffle(eval("db.low_error."+task[1]));
    var rand2 = shuffle(eval("db.low_error."+task[2]));

    var rand10 = rand0.slice(0,rand0.length/2);
    var rand11 = rand1.slice(0,rand1.length/2);
    var rand12 = rand2.slice(0,rand2.length/2);

    var rand20 = rand0.slice(rand0.length/2, rand0.length);
    var rand21 = rand1.slice(rand1.length/2, rand1.length);
    var rand22 = rand2.slice(rand2.length/2, rand2.length);
    
    //------------------------------------
    // Create JSON FILE for 1st Run 
    //------------------------------------

    trial.run.push(db.low_error.misc_task[0]);  //Start
    
    randomizeTask(rand10, 1, trial);
    trial.run.push(db.low_error.misc_task[1]);  //TDT
    randomizeTask(rand11, 1, trial);
    trial.run.push(db.low_error.misc_task[1]);  //TDT
    randomizeTask(rand12, 1, trial);
    trial.run.push(db.low_error.misc_task[1]);  //TDT
    
    trial.run.push(db.low_error.misc_task[2]);  //Nback
    
    randomizeTask(rand10, 2, trial);
    trial.run.push(db.low_error.misc_task[1]);  //TDT
    randomizeTask(rand11, 2, trial);
    trial.run.push(db.low_error.misc_task[1]);  //TDT
    randomizeTask(rand12, 2, trial);
    trial.run.push(db.low_error.misc_task[1]);  //TDT

    trial.run.push(db.low_error.misc_task[3]);  //END
   
    //Make 1st half of task X delay
    $.each(trial.run, function(index,value) {
        if(index < trial.run.length/2 && trial.run[index].task !== "tdt") {
            trial.run[index].delay = delay[0];  //Voice Task 1
        } else {
            // return false;
        }
    });    
    
    //&& trial.run[index].task !== "tdt"

    //Make 2nd half of task X delay
    $.each(trial.run, function(index,value) {
        
        if(index >= trial.run.length/2 && trial.run[index].task !== "tdt") {
            // console.log(trial.run[index].task);
            trial.run[index].delay = delay[1];  //Voice Task 1
        } 
    }); 
    
    var trial_num = 0;
    $.each(trial.run, function(index,value) {
        if(trial.run[index].task !== 'tdt') {
            trial.run[index].trial = trial_num;
            trial_num++;
        }
    });
           
    var jsonstring = JSON.stringify(trial,null,2);
//    console.log(jsonstring);
  	
    // Write JSON to a File
    $.ajaxSetup ({cache: false});
    $.post("sql_write_trial.php", {json_file: jsonstring, file_name: "zz_vcs_run1.json"},test123,"json");

    //------------------------------------
    // Create JSON FILE for 2nd Run 
    //------------------------------------
    var randtask2 = ["rand20","rand21","rand22"];
    var delay2 = ["short","long"];
    randtask2 = shuffle(randtask2);
    delay2 = shuffle(delay2);
    
    trial2.run.push(db.low_error.misc_task[0]);  //Start
    
    randomizeTask(eval(randtask2[0]), 1, trial2);
    trial2.run.push(db.low_error.misc_task[1]);  //TDT
    randomizeTask(eval(randtask2[1]), 1, trial2);
    trial2.run.push(db.low_error.misc_task[1]);  //TDT
    randomizeTask(eval(randtask2[2]), 1, trial2);
    trial2.run.push(db.low_error.misc_task[1]);  //TDT
    
    trial2.run.push(db.low_error.misc_task[2]);  //Nback
    
    randomizeTask(eval(randtask2[0]), 2, trial2);
    trial2.run.push(db.low_error.misc_task[1]);  //TDT
    randomizeTask(eval(randtask2[1]), 2, trial2);
    trial2.run.push(db.low_error.misc_task[1]);  //TDT
    randomizeTask(eval(randtask2[2]), 2, trial2);
    trial2.run.push(db.low_error.misc_task[1]);  //TDT

    trial2.run.push(db.low_error.misc_task[3]);  //END
   
    //Make 1st half of task X delay
    $.each(trial2.run, function(index,value) {
        if(index < trial2.run.length/2 && trial2.run[index].task !== "tdt") {
            trial2.run[index].delay = delay2[0];  //Voice Task 1
        } else {
            // return false;
        }
    });    

    //Make 2nd half of task X delay
    $.each(trial2.run, function(index,value) {
        if(index >= trial2.run.length/2 && trial2.run[index].task !== "tdt") {
            // console.log(trial.run[index].task);
            trial2.run[index].delay = delay2[1];  //Voice Task 1
        } 
    });    
    
    var trial_num2 = 26;
    $.each(trial2.run, function(index,value) {
        if(trial2.run[index].task !== 'tdt') {
            trial2.run[index].trial = trial_num2;
            trial_num2++;
        }
    });
    
    var jsonstring2 = JSON.stringify(trial2,null,2);
//    console.log(jsonstring2);
    
    // Write JSON to a File
    $.ajaxSetup ({cache: false});
    $.post("sql_write_trial.php", {json_file: jsonstring2, file_name: "zz_vcs_run2.json"},test123,"json");
    

   
}

function randomizeTask(task,part, json_run) {
    if(part === 1) {
        $.each(task, function(index,value) {
            if(index < task.length/2) {
                json_run.run.push(value);  //Voice Task 1
            } 
        });  
    } else if (part === 2) {
        $.each(task, function(index,value) {
            if(index >= task.length/2) {
                json_run.run.push(value);  //Voice Task 5
            } 
        });
    }    
}


// Simple shuffle entries inside an array
function shuffle(o){ //v1.0
    for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
};

function test123() {
    //For debugging purposes
}


function btn_convert_high_error() {
	// console.log("fizzzz");
	// var file1 = 'zz_vcs_run1.json';
	// var file2 = 'zz_vcs_run2.json';	
	convert_high_error('zz_vcs_run1.json');
	convert_high_error('zz_vcs_run2.json');
	
}

function convert_high_error(jsonfile) {
	$.getJSON(jsonfile, function(run1) {
		
		db1 = run1;
		var c_radio = 0;
		var c_nav = 0;
		var c_cal = 0;

		$.each(db1.run, function(index,value) {
	    	
	    	if(db1.run[index].task === "radio" && c_radio < 4) {
	    		db1.run[index].err_rate = "high";
	    		c_radio++;
	    	} else if(db1.run[index].task === "radio" && c_radio >= 4 && c_radio < 6) {
	    		db1.run[index].err_rate = "low";
	    		c_radio++;
	    	} else {
	    		c_radio = 0;
	    	}

	    	if(db1.run[index].task === "nav" && c_nav < 2) {
	    		db1.run[index].err_rate = "high";
	    		c_nav++;
	    	} else {
	    		c_nav = 0;
	    	}	

	    	if(db1.run[index].task === "calendar" && c_cal < 2) {
	    		db1.run[index].err_rate = "high";
	    		c_cal++;
	    	} else {
	    		c_cal = 0;
	    	}	
	    });
		
		var jsonstring3 = JSON.stringify(db1,null,2);
	    console.log(jsonstring3);
	    
	    // Write JSON to a File
	    $.ajaxSetup ({cache: false});
	    $.post("sql_write_trial.php", {json_file: jsonstring3, file_name: jsonfile},test123,"json"); 
	    
	});

}
