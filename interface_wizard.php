<!DOCTYPE html>
<html>
	<head>
		<title>VCS Wizard V4 (SQL based)</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8" />
		<!-- Bootstrap -->
		<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
		<script src="howler/howler.min.js"></script>
		<!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
		
		<script src="control_wizard.js"></script>
		
		<style type="text/css">
			#base {
				border: 2px solid black;
				background-color: gray; 
				border-radius: 1.5em 1.5em 1.5em 1.5em;
			}
			#display {
				border: 2px solid black;
				background-color: white;
				border-radius: 1.8em 1.8em 1.8em 1.8em;
				height: 17em;
			}
			#wiz_buttons {
				margin-top: 3em;
				margin-bottom: 3em;	 
			}
			button {
				height: 5em;
				width: 10em;
			}
			#c1 {color: lightseagreen;}
			#c2 {color: red;}
			/*#wiz_instruction {color: white;}*/
			#sys_error_warning {
				text-align: center;
				font-size: 2em;
				background-color: orange;
				color: white;
			}
			.w-form, .w-label{
				/*color: black;*/
				font-size: 1.75em;
				margin-top: .5em;
			}
			#timer{
				color: white;
				font-size: 1.7em;
			}
			
		</style>
	</head>

	<body onload="">
		
		<!-- <h1 class="text-center">Wizard Mode</h1> -->
		
		<div id="base" class="col-sm-12">
			
			<!-- Display Elements -->
			<!-- <div class="row">
				<div id="wiz_instruction" class="col-sm-8 col-sm-offset-2"><h3>Correct Response:</h3></div>
			</div> -->
			
			<!-- Dropdown Select Menu -->
			<div class="row">
				<div id="file_load" class="col-sm-6 col-sm-offset-3">
					<select class="form-control" onchange="switch_json(this.value)">
				  		<option value="zz_vcs_run1.json">Main Run 1</option>
				  		<option value="zz_vcs_run2.json">Main Run 2</option>
				  		<!-- <option value="zz_vcs_nav_wi.json">Nav Wisconsin</option> -->
				  		<option value=""></option>
				  		<option value="zz_vcs_radio.json">Practice: Radio</option>
					  	<option value="zz_vcs_cal.json">Practice: Calendar</option>
					  	<option value="zz_vcs_nav.json">Practice: Navigation</option>
					  	<option value="zz_vcs_nback.json">Practice: N-Back</option>
					  	<option value=""></option>
					  	<!-- 1st Digit: Delay, 2nd Digit: Error Level -->
					  	<option value="zz_vcs00.json">Test: No Delay - No Error</option>
					  	<option value="zz_vcs01.json">Test: No Delay - High Error</option>
					  	<option value="zz_vcs10.json">Test: Long Delay - No Error</option>
					  	<option value="zz_vcs11.json">Test: Long Delay - High Error</option>
					</select>
				</div>	
			</div>
			
			<div class="row" id="display">
				<!-- <div id="display" class="col-sm-8 col-sm-offset-2"><h2 id="wiz_message" class="text-center"></h2></div> -->
				
				<div class="row">
					<div class='col-sm-2 w-label text-right' id='label-1'>Label 1</div>
					<div class='col-sm-4 w-form' id='form-1'>1,2,3,4,5,6,7,8,9,1</div>
					<div class='col-sm-2 w-label text-right' id='label-2'>Label 2</div>
					<div class='col-sm-4 w-form' id='form-2'>Content bla bla</div>
				</div>
				<div class="row">
					<div class='col-sm-2 w-label text-right' id='label-3'>Label 3</div>
					<div class='col-sm-4 w-form' id='form-3'>Content bla bla</div>
					<div class='col-sm-2 w-label text-right' id='label-4'>Label 4</div>
					<div class='col-sm-4 w-form' id='form-4'>Content bla bla</div>
				</div>
				<div class="row">
					<div class='col-sm-2 w-label text-right' id='label-5'>Label 5</div>
					<div class='col-sm-4 w-form' id='form-5'>Content bla bla</div>
					<div class='col-sm-2 w-label text-right' id='label-6'>Label 6</div>
					<div class='col-sm-4 w-form' id='form-6'>Content bla bla</div>
				</div>
				<div class="row">
					<div class='col-sm-2 w-label text-right' id='label-7'>Label 7</div>
					<div class='col-sm-4 w-form' id='form-7'>Content bla bla</div>
					<div class='col-sm-2 w-label text-right' id='label-8'>Label 8</div>
					<div class='col-sm-4 w-form' id='form-8'>Content bla bla</div>
				</div>
			</div>

			<div id='sys_error_warning'></div>
			<div id='timer' class="col-sm-12">Timer:</div>
			
			<!-- Buttons -->
			<div id="start-reset">
				<button class="btn btn-warning btn-xs " onclick="btn_start()">Start</button>
				<button class="btn btn-warning btn-xs " onclick="btn_next_task()">Next Task (Debug)</button>
				<button class="btn btn-warning btn-xs pull-right" onclick="btn_reset()">Clear Display</button>
			</div>
			
			<div id="wiz_buttons">
				<div id="norm-btn">
					<div id="btn_command_group">
						<p class="text-center">
							<button class="btn btn-lg btn-success" onclick="btn_command_correct()">Command Correct</button>
							<button class="btn btn-lg btn-danger" onclick="btn_command_incorrect()">Command Incorrect</button>
							<button class="btn btn-lg btn-info" onclick="btn_command_repeat()">Command Repeat</button>
						</p>
					</div>

					<div id="btn_confirm_group">
						<p class="text-center">
							<button class="btn btn-lg btn-success"  onclick="btn_confirm_correct()">Confirm Correct</button>
							<button class="btn btn-lg btn-danger" onclick="btn_confirm_incorrect()">Confirm Incorrect</button>
							<button class="btn btn-lg btn-info" onclick="btn_confirm_repeat()">Confirm Repeat</button>
						</p>
					</div>
				</div>
				
				<div id="nback-btn">
					<p class="text-center">	
						<button class="btn btn-success btn-lg" onclick="nback_correct()" id="nback_right">N-Back Correct</button>
					</p>
					<p class="text-center">
						<button class="btn btn-default btn-lg nb-btn" onclick="nback_start()" id='nb-start'>Start N-Back</button>
						<!-- <button class="btn btn-default btn-lg nb-btn" onclick="nback_reset()">Reset N-Back</button>	 -->
					</p>
					<p class="text-center">
						<button class="btn btn-default btn-lg" onclick="btn_nback_next()"><strong>Next Task</strong></button>						
					</p>	
				</div>
				
				<h3 id='correct_counter'></h3>
								
			</div>

		</div>
		
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<!--
		<script src="bootstrap/js/bootstrap.min.js"></script>
		-->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	</body>
</html>
