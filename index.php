<!DOCTYPE html>
<html>
	<head>
		<title>VCS V4 Part B Setup</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
		<!-- Bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
		<script src="control_index.js"></script>
		<!--<script src="howler/howler.min.js"></script>-->
		<link rel="icon" href="img/car.ico"type="image/ico">

		<style type="text/css" title="currentStyle" media="screen">
				body {
					margin-left: 5em;
					margin-right: 5em;
					font-family: helvetica;
					/*border: 5px solid red;*/
				}
				#warn {
					color: red;
				}
		</style>
		<script type="text/javascript">
			//"sea" = Seattle, "mad"= Madison, 
			//In addition [test, test1, test2, test3] can all be used
    		var location_id = "sea"; 
    		var db_json_file;
    		var log_id;

			if(location_id === "sea") {
				db_json_file = 'zz_vcs_db_sea.json';
				log_id ="logdata_sea";
			} else if(location_id === "mad") {
				db_json_file = 'zz_vcs_db_mad.json';
				log_id ="logdata_mad";
			} else {
				db_json_file = 'zz_vcs_db_sea.json';
				log_id ="logdata_test";
			}
			console.log("DB used: "+db_json_file);

		</script>
	</head>

	

	<body>
    	<h2 id="main-title">***VCS Part B***</h2>
		<!-- <button class="btn btn-primary" onclick="play_audio()">Test</button> -->
		<ol>
			<li>Enter Participant ID (PID) and select a recognition error level.  It will generate a datalog file with the parameters entered.</li>
			<li>Run voice task - Click on Wizard link and run the voice task.</li>
			<li>The "Datalog Folder" link will contain the datalog from the voice task.</li>
			<li><h3 id="warn">Note to Chun!!!  Remember to change location with id variable!!!  Look for Javascript in the index.php!!!</h3></li>
		</ol>

    	<form method="post">
		    <fieldset>
			    <legend>1.  Enter Participant Info</legend>
			    <label>PID:</label>
			    <input type="text" placeholder="" name="pid_input">
			    
			   	<dl class="dl-horizontal">
					<dt>Run Type:</dt>
					<dd>
						<label class="radio-inline">
  							<input type="radio" name="run-type" id="radioRun1" value="Practice" checked> Practice Run
						</label>
						<label class="radio-inline">
	  						<input type="radio" name="run-type" id="radioRun2" value="Main Experiment"> Main Experiment
						</label>	
					</dd>

					<dt>Error Level:</dt>
					<dd>
						<label class="radio-inline">
  							<input type="radio" name="error" id="radioError1" value="Low" checked> Low Recognition Error
						</label>
						<label class="radio-inline">
	  						<input type="radio" name="error" id="radioError2" value="High"> High Recognition Error
						</label>	
					</dd>
		
					<dt>Scenario:</dt>
					<dd>
						<label class="radio-inline">
  							<input type="radio" name="scenario" id="radioScenario1" value="1" checked> 1
						</label>
						<label class="radio-inline">
	  						<input type="radio" name="scenario" id="radioScenario2" value="2"> 2
						</label>	
					</dd>
				</dl>
				
			    <button type="submit" class="btn" onclick="">Submit</button>
			    <?php
			    	if(empty($_POST["pid_input"]))
			    		{$PID_err = "***Participant ID Required***";}
			    ?>
			    <p><h4>You have entered the following:</h4></p>
			    <dl class="dl-horizontal">
  					<dt>PID:</dt>
  					<dd><span class="error"><?php echo $PID_err;?></span><?php echo $_POST["pid_input"]; ?></dd>
  					<dt>Run Type:</dt>
  					<dd><?php echo $_POST["run-type"]; ?></dd>
  					<dt>Error Level:</dt>
  					<dd><?php echo $_POST["error"]; ?></dd>
  					<dt>Scenario:</dt>
  					<dd><?php echo $_POST["scenario"]; ?></dd>
				</dl>
		    </fieldset>
    	</form>

    	<p><h4>Randomizing Experimental Runs</h4></p>
    	<p>
    	   Every participant will experience the same exact Radio, Navigation, and Calendar tasks.
           However, each participant will experience the tasks in different order.  Button below will
           randomize the tasks.  The long and short blocks will be randomize as well as the tasks themselves.
           The links VCS RUN1 and VCS RUN2 represent combination A and C (or vice versa) in Fig 1.  
    	</p>
		<ul>
			<li>If task don't appear to be randomize, please click on refresh.</li>
			<li><a href="zz_vcs_run1.json">VCS RUN1</a></li>
			<li><a href="zz_vcs_run2.json">VCS RUN2</a></li>
		</ul>
		
		<button class="btn btn-primary" onclick="btn_randomize_trial(db_json_file)">Randomize Trial Runs</button>
		<button class="btn btn-primary" onclick="btn_convert_high_error()">Convert To High Error</button>
		
		<p></p>
		
		<div class="row">
  			<figure class="thumbnail col-sm-5 col-sm-offset-1">
            	<img src="img/plan2.png" alt="Scenario Design">
                <figcaption>Figure 1:  Scenario Design</figcaption>
            </figure>
            <figure class="thumbnail col-sm-5 col-sm-offset-1">
            	<img src="img/plan1.png" alt="Task Layout">
                <figcaption>Figure 2:  Task Layout</figcaption>
            </figure>
		</div>

		
    	<hr>

		<h3>2.  VCS Interface</h3>
		<ul>
			<li><a href="interface_wizard.php">Wizard</a></li>
			<li><a href="interface_subject.php">Subject</a></li>
		</ul>
		<h3>3.  Data Files</h3>
		
		<ul>
			
			<hr>
			<button class="btn btn-primary" onclick="export_data()">Export All Data</button>
			<hr>
			
			
			<li><a href="datalog">Datalog Folder</a></li>
			<li><a href="zz_vcs_radio.json">Radio JSON</a></li>
			<li><a href="zz_vcs_nav.json">Navigation JSON</a></li>
			<li><a href="zz_vcs_cal.json">Calendar JSON</a></li>
			<li><a href="http://www.jsoneditoronline.org/">Online JSON Editor</a></li>
		</ul>

		<h3>Datalog Guide</h3>
		<p>
			The Datalog creates a timestamp of each button press on the Wizard.  Any column with the prefix "btn" corresponds to a button on the wizard.  
			When a button is pressed or activated, it is denoted by the number "1".  Inactive buttons are denoted by the number "0".
			Finally the Datalog file is a tab seperated text file.  It should be easy to parse in R, but I havent tested that yet.  
		</p>
		<h4>Variables</h4>
		<dl class="dl-horizontal">
			<dt>delay</dt>
			<dd>Amount of time between the verbal response of the participant and the verbal response of the VCS.  Factor contains 2-Levels (Short, Long)</dd>
			<dt>task</dt>
			<dd>Voice task (Radio Channel Selection, Navigation, Calendar Scheduling, and 1-Back)</dd>
			<dt>trial</dt>
			<dd>Participants perform each voice task multiple times.  Trial number helps keep track of experiment progress.</dd>
			<dt>btn_correct</dt>
			<dd>Corresponds to pressing the "Correct" button on the Wizard</dd>
			<dt>btn_sys_error</dt>
			<dd>Corresponds to pressing the "System Error" button on the Wizard</dd>
			<dt>btn_redo</dt>
			<dd>Corresponds to pressing the "Redo" button on the Wizard</dd>
			<dt>btn_repeat</dt>
			<dd>Corresponds to pressing the "Repeat" button on the Wizard</dd>
			<dt>btn_next1</dt>
			<dd>Corresponds to pressing the "Yes Correct: Next Task" button on the Wizard</dd>
			<dt>btn_next2</dt>
			<dd>Corresponds to pressing the "Yes Incorrect: Next Task" button on the Wizard</dd>
		</dl>
		</dl>

		
		
		<script type="text/javascript">

    		//Create a File Name for datalogging
    		var pid_input = '<?php echo $_POST["pid_input"]; ?>';
    		var err_level = '<?php echo $_POST["error"]; ?>';
    		var run_type = '<?php echo $_POST["run-type"]; ?>';
    		var scenario = '<?php echo $_POST["scenario"]; ?>';
    		
    		var switch_board = 'profile_data.json';
    		
    		console.log("PID: "+pid_input);
    		$.get("json_update_pid.php", { 
    			control_file: switch_board, 
    			location_id: location_id,
    			pid: pid_input,
    			run_type: run_type,
    			err_level: err_level,
    			scenario: scenario
    		});
    		
    		$.get("sql_update_profile.php",{
    			location_id: location_id,
    			pid: pid_input,
    			run_type: run_type,
    			err_level: err_level,
    			scenario: scenario   
    		});
			
			function export_data() {
				$.get("sql_export.php", {log: log_id},export_confirm,"html");
			}

			function export_confirm(stuff) {
				alert("Datalog Updated.  Please check logdata_all.csv in the datalog folder.");
			}

			/*
			function play_audio() {
				var sound = new Howl({
					urls:['audio/c_confirm_ 03.mp3'],
					buffer: true,
					onload: function() {
						console.log('sound loaded');
						sound.play();
					}
				});
			}
			*/
			
			//Renames the title of the Page ased on Location ID
			if(location_id === "sea") {
    			$("#main-title").html("VCS Part B Setup (Seattle)");
    		} else if(location_id === "mad") {
    			$("#main-title").html("VCS Part B Setup (Madison)");
    		} else {
    			$("#main-title").html("VCS Part B Setup (Testing)");
    		}

		</script>
		

		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
