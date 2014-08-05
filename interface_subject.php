<!DOCTYPE html>
<html>
	<head>
		<title>VCS Subject View V2 (SQL based)</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8" />
		<!-- Bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		
		<!--
		<script src="http://code.jquery.com/jquery.js"></script>
		-->
		<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
		<script src="control_subject.js"></script>		
	</head>

	<style type="text/css">
		body {
			border: .8em solid #3D3D3D;
			background-color: black;
			border-radius: .71em;
		}
		#base {
			/*Resolution of Touchscreen is 800X600*/
			/*height: 550px;
			width: 750px;*/

/*			height: 525px;*/
			height: 670px;
            width: 750px;
/*            width: 725px;*/
		}
		.gray_bar {
/*			color: white;*/
/*			border: .3em solid #3D3D3D ;*/
			border-radius: 2em;
			height: 3em;
			margin-top: 1em;
			margin-bottom: 1em;
			font-size: 1.15em;
			display: none;
		}
		#stations div {
		border: .07em solid #FFE540;
			color: white;
			background-color: #4F4FD9;	
/*			margin-top: .5em;*/
            margin-top: 1em;
			margin-bottom: .5em;
            font-size: 1.8em;
			border-radius: .3em;
			padding:.1em 0 .1em .5em;
		}
		.blue_frame {
			border-radius: .71em;
			border: .2em solid #4F4FD9;
			background-color: #00001C;
			color: white;
			margin-bottom: 1em;
			height: 40em;
		}
        #display_subject {
            width: 55em;
        }
        
		.blue_frame h1 {
			font-size: 4em;
		}
		#r_display {
			height: 12em;
		}
		.form {
			width: 450px;
			height: 100px;
/*            height: 60px;*/
			background-color: rgba(79, 79, 217, .2);
			border-radius: 10px;
		}
		#myTab {
			font-size: 2.5em;
		}
		#n-back_form, #tdt_form {
			height: 250px;
			font-size: 12em;
			background-color: rgba(79, 79, 217, .2);
			border-radius: 10px;

		}
		#n-back_form {
			font-size: 3em;
			padding-top: 50px;
		}	
	</style>

	<body onload="">
		<!-- Top Tab Nav -->
		<div class="col-sm-12 container">
			<ul class="nav nav-tabs" id="myTab">
			  	<li><a href="#radio" data-toggle="tab">Radio</a></li>
			  	<li><a href="#nav" data-toggle="tab">Navigation</a></li>
			  	<li><a href="#calendar"data-toggle="tab">Calendar</a></li>
			  	<li><a href="#n-back"data-toggle="tab">N-Back</a></li>
			  	<li><a href="#tdt"data-toggle="tab">TDT</a></li>
			</ul>
		</div>
		

		<!-- Tab Contents -->
		<!-- <div class="tab-content" id="myTab"> -->
		<div class="tab-content">
		  	<!-- Radio -->
		  	<div class="tab-pane active" id="radio">
                <div id="base" class="col-sm-12 container"> 
					<br>
					<!-- Gray Instruction Bar -->
				  	<div class="row">
						<div class="col-sm-12 gray_bar"></div>
					</div>
					<!-- Main Display -->
					<div class="row">
						<div id="r_display" class="col-sm-12 blue_frame">
							<p class="text-center text-info lead" id="now_listening"></p>
							<h1 class="text-center" id="s_station"></h1>
						</div>
					</div>
					<!-- Radio Stations -->
					<div class="row text-center" id="stations">
						<div class="col-sm-3 ">Hip-Hop Hits</div>
						<div class="col-sm-2">101.3</div>
						<div class="col-sm-3 col-sm-offset-2">ESPN Xtreme</div>
						<div class="col-sm-2">103.5</div>
						<div class="col-sm-3 ">Country Hits</div>
						<div class="col-sm-2">94.5</div>
						<div class="col-sm-3 col-sm-offset-2">Radio Disney</div>
						<div class="col-sm-2">100.3</div>
						<div class="col-sm-3 ">NPR News</div>
						<div class="col-sm-2">92.3</div>
						<div class="col-sm-3 col-sm-offset-2">80's Pop</div>
						<div class="col-sm-2">102.7</div>
						<div class="col-sm-3 ">Light Jazz</div>
						<div class="col-sm-2">98.4</div>
						<div class="col-sm-3 col-sm-offset-2">Classic Rock</div>
						<div class="col-sm-2">99.1</div>
					</div>			
				</div>	
		  	</div>

		  	<!-- Navigation -->
		  	<div class="tab-pane" id="nav">
		  		<div id="base" class="col-sm-12 container">
					<br>
					<!-- Gray Instruction Bar -->
					<div class="row">
						<div class="col-sm-12 gray_bar"></div>
					</div>
					<!-- Blue Outer Frame -->
					<div class="row">
						<div id="display_subject" class="col-sm-12 blue_frame">
							<!-- Map Icon -->
							<div class="row">	
								<div id="icon" class="col-sm-2">
									<img src="img/map2.png" width="80px" height="80px" class="pull-left">
								</div>
							</div>
							<br>
							<!-- Entry Form -->
							<div class="row">
								<div class="col-sm-3"><h2>Address: </h2></div>
								<div class="col-sm-9 form"><h2 id="s_address"></h2></div>
								<div class="col-sm-9 col-sm-offset-3 form"><h2 id="s_state"></h2></div>
							</div>
						</div>
					</div>
				</div>	
		  	</div> <!-- Close Nav Tab -->
		  	
		  	<!-- Calendar -->
		  	<div class="tab-pane" id="calendar">
		  		<div id="base" class="col-sm-12 container">
					<br>
					<!-- Gray Instruction Bar -->
					<div class="row">
						<div class="col-sm-12 gray_bar"></div>
					</div>

					<!-- Blue Outer Frame -->
					<div class="row">
						<div id="display_subject" class="col-sm-12 blue_frame">
							<!-- Icon and Calendar Title -->
							<div class="row">	
								<div id="icon" class="col-sm-2">
									<img src="img/schedule.png" width="80px" height="80px" class="pull-left">
								</div>
								<div class="col-sm-10"><h2 id="send">Calendar Appointments</h2></div>
							</div>
							<hr>
							<!-- Form Content -->
							<div class="row">
								<div class="row">
									<div class="col-sm-3 col-sm-offset-1 text-right"><h2>Contact: </h2></div>
									<div class="col-sm-8 form" ><h2 id="s_contact"></h2></div>	
								</div>
								<div class="row">
									<div class="col-sm-3 col-sm-offset-1 text-right"><h2>Location: </h2></div>
									<div class="col-sm-8 form" ><h2 id="s_location"></h2></div>		
								</div>
								<div class="row">
									<div class="col-sm-3 col-sm-offset-1 text-right"><h2>Time: </h2></div>
									<div class="col-sm-8 form" ><h2 id="s_time"></h2></div>		
								</div>
							</div>
						</div>
					</div>
				</div>
		  	</div>	<!-- Calendar Close Bracket -->

		  	<!-- N-Back -->
		  	<div class="tab-pane" id="n-back">
		  		<div id="base" class="col-sm-12 container">
					<br>
					<!-- Gray Instruction Bar -->
					<div class="row">
						<div class="col-sm-12 gray_bar"></div>
					</div>
					<!-- Blue Outer Frame -->
					<div class="row">
						<div id="display_subject" class="col-sm-12 blue_frame">
							<!-- Map Icon -->
							<div class="row">	
								<!-- <div id="icon" class="col-sm-2">
									<img src="img/map2.png" width="80px" height="80px" class="pull-left">
								</div> -->
								<div class="col-sm-10"><h2 id="send">N-Back Task</h2></div>
							</div>
							<hr>
							<br>
							<!-- Entry Form -->
							<div class="col-sm-8 col-sm-offset-2 text-center" id="n-back_form">
								Test
							</div>
							<div class="row">

								<!-- <div class="col-sm-3"><h2>Address: </h2></div>
								<div class="col-sm-9 form"><h2 id="s_address"></h2></div>
								<div class="col-sm-9 form"><h2 id="s_state"></h2></div> -->
							</div>
						</div>
					</div>
				</div>	
		  	</div> <!-- Close N-Back Tab -->

		  	<!-- TDT -->
		  	<div class="tab-pane" id="tdt">
		  		<div id="base" class="col-sm-12 container">
					<br>
					<!-- Gray Instruction Bar -->
					<div class="row">
						<div class="col-sm-12 gray_bar"></div>
					</div>
					<!-- Blue Outer Frame -->
					<div class="row">
						<div id="display_subject" class="col-sm-12 blue_frame">
							<!-- Map Icon -->
							<div class="row">	
								<!-- <div id="icon" class="col-sm-2">
									<img src="img/map2.png" width="80px" height="80px" class="pull-left">
								</div> -->
								<div class="col-sm-10"><h2 id="send">Tactile Detection Task</h2></div>
							</div>
							<hr>
							<br>
							<!-- Entry Form -->
							<div class="col-sm-8 col-sm-offset-2 text-center" id="tdt_form">
								TDT
							</div>
							<div class="row">

								<!-- <div class="col-sm-3"><h2>Address: </h2></div>
								<div class="col-sm-9 form"><h2 id="s_address"></h2></div>
								<div class="col-sm-9 form"><h2 id="s_state"></h2></div> -->
							</div>
						</div>
					</div>
				</div>	
		  	</div> <!-- Close TDT Tab -->
		  	
		</div>	<!-- Tab Content Close Bracket -->

		


		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script>
			$(function () {
		    	$('#myTab a:radio').tab('show')
			})
		</script>
	</body>
</html>
