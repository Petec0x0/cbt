<?php
    ob_start();
    session_start();
    include_once "includes/dbconnection.php";
	if(!(isset($_SESSION["s_fullname"]))){
		header("location: index.php");
        die("Access denied");
    }
	
	$sql = "SELECT * FROM candidates WHERE candidates_registration_no = '".$_SESSION["s_registration_no"]."'";
    $result = mysqli_query($conn, $sql);
    $result_check = mysqli_num_rows($result);
    if($result_check < 1){
        $registration_noErr = "Invalid Registration no.";
    }else{
		if($row = mysqli_fetch_assoc($result)){
			// Log in the user here
			$fullname = $row["candidates_fullname"];
			$registration_no = $row["candidates_registration_no"];
			$course1_id = $row["course1_id"];
			$course2_id = $row["course2_id"];
			$course3_id = $row["course3_id"];
			$course4_id = $row["course4_id"];
			$time_available = $row["time_available"];
			$course1_score = explode(',', $row["course1_score"]);// students and options for course1
			$course2_score = explode(',', $row["course2_score"]);// students and options for course2
			$course3_score = explode(',', $row["course3_score"]);// students and options for course3
			$course4_score = explode(',', $row["course4_score"]);// students and options for course4
		}
    }
	
?>	

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>JAMB mock e-Testing</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon"  href="assets/img/logo.png">
		<!--EXTERNAL CSS FILES-->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.css">
		<link rel="stylesheet" href="assets/css/bootstrap-grid.css">
		<link rel="stylesheet" href="assets/css/bootstrap-grid.min.css">
		<link rel="stylesheet" href="assets/css/bootstrap-reboot.css">
		<link rel="stylesheet" href="assets/css/bootstrap-reboot.min.css">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/main.css">
		<!--/EXTERNAL CSS FILES-->
		
		<!--EXTERNAL JS FILES-->
		<script src="assets/js/jquery-3.2.1.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<!--/EXTERNAL JS FILES-->
		
		<style>
			body {
				background:url('assets/img/background.png') no-repeat;
				background-size: cover;
				padding:10px;
			}	
			
			/*
			Calculator CSS starts
			*/
			.cal_container {
				position: fixed;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				background: #fff;
				box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.2);
				border-radius: 14px;
				padding-bottom: 20px;
				width: 320px;
				
			}
			.cal_display {
				width: 100%;
				height: 60px;
				padding: 0;
				margin:2px;
				background: #00cc44;
				border-top-left-radius: 14px;
				border-top-right-radius: 14px;
			}
			.cal_buttons {
				padding: 20px 20px 0 20px;
			}
			.cal_row {
				width: 280px;
				float: left;
			}
			input[type=button] {
				width: 60px;
				height: 60px;
				float: left;
				padding: 0;
				margin: 5px;
				box-sizing: border-box;
				background: #ecedef;
				border: none;
				font-size: 30px;
				line-height: 30px;
				border-radius: 50%;
				font-weight: 700;
				color: #5E5858;
				cursor: pointer;
				
			}
			input[type=text] {
				width: 270px;
				height: 60px;
				padding: 0;
				box-sizing: border-box;
				border: none;
				background: none;
				color: #ffffff;
				text-align: right;
				font-weight: 700;
				font-size: 60px;
				line-height: 60px;
				margin: 1px;
				
			}
			.cal_green {
				background: #00cc44 !important;
				color: #ffffff !important;
				
			}
			/*
			Calculator CSS ends
			*/
			
			/*Increase the size of the radio buttons in the page*/
			input[type=radio] {
				-ms-transform: scale(1.5); /* IE 9 */
				-webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
				transform: scale(1
			}
				
			/* The Modal (background) */
			.modal {
			  display: none; /* Hidden by default */
			  position: fixed; /* Stay in place */
			  z-index: 1; /* Sit on top */
			  padding-top: 100px; /* Location of the box */
			  left: 0;
			  top: 0;
			  width: 100%; /* Full width */
			  height: 100%; /* Full height */
			  overflow: auto; /* Enable scroll if needed */
			  background-color: rgb(0,0,0); /* Fallback color */
			  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
			}

			/* Modal Content */
			.modal-content {
			  background-color: #fefefe;
			  margin: auto;
			  padding: 20px;
			  border: 1px solid #888;
			  width: 80%;
			}
		</style>
	</head>
	<body>
		<div class="container-fluid">
           <div class="row">
			<div class="container-fluid">
				<div class="card">
					<div class="card-header alert alert-success text-success text-center">JAMB MOCK e-TESTING</div>
					<div class="card-body">
						<div class="row jumbotron" style="margin:10px; padding-top:10px; padding-bottom:10px;">
							<div class="col-md-4">
								<label><i class="fa fa-edit"></i> Examination: &nbsp;<b>JAMB MOCK 2019/2020</b></label>
								<label><i class="fa fa-user"></i> Candidate: &nbsp;<b id="regid"> <?php echo $_SESSION["s_registration_no"];?></b>:<b id="juser"> <?php echo $_SESSION["s_fullname"];?></b></label>
								<input id="registration_no" type="hidden" value="<?php echo $_SESSION["s_registration_no"];?>">
							</div>
							
							<div class="col-md-6">
								<h4 style="margin-left:4em"> Remaining Time</h4>
								<div style="margin-left:8em">
                                    <div>
										<h1 id="timer" class="text-success">00:00</h1>
									</div>
                                </div>
                                <div class="btn-group" style="margin-left:4em">
                                    <button type="button" class="btn btn-success"><i class="fa fa-book"></i> Instruction</button>
									<div class="dropdown">
										<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calculator"></i> Calculator</button>
										<div class="dropdown-menu">
											<div id="target-div"></div>
										</div>
									</div>	
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submitModal"><i class="fa fa-file"></i> Submit</button>
                                </div>
							</div>
							
							<div class="col-md-2">
								<img class="img-rounded" src="assets/img/avatar_2x.png" width="120" height="120" alt="Card image cap">
							</div>
						</div>
						
						<div class="row container-fluid" style="margin:10px;">
							<div class="col-8">
								<div class="tab">
									<?php 
										$courses_name_array = array(); // an array to store the name of selected courses
										$courses_code_array = array(); // an array to store the course code of the selected courses
										$courses_file_array = array(); // an array to store the file names of the selected courses
									
										$sql = "SELECT * FROM `courses` WHERE `id` = ".$_SESSION['s_course1_id']." OR `id` = ".$_SESSION['s_course2_id']." OR `id` = ".$_SESSION['s_course3_id']." OR `id` = ".$_SESSION['s_course4_id'];
										$result = mysqli_query($conn, $sql);
										$activeCourseCount = 1;
										while($course = mysqli_fetch_assoc($result)){
											echo '<button class="tablinks" onclick="openSubject(event, \''.$course['course_code'].'\', '.$activeCourseCount.')">'.$course['course_name'].'</button>'; // for the tab buttons
											array_push($courses_name_array,$course['course_name']); // adding the course names to the already created arrays
											array_push($courses_code_array,$course['course_code']); // adding the course codes to the already created array
											array_push($courses_file_array,$course['filename']); // adding the course file names to the already created array
											$activeCourseCount++; //Increment the active count variable
										}
										
										// preparing the course 1 questions, options and answers
										$course_file_1 = fopen('files/'.$courses_file_array[0], "r") or die("Unable to open file!");
										$course_1_questions = array(); // an array to store all the questions from course 1
										$course_1_options = array(); // an array to store all the options from course 1
										$course_1_answers = array(); // an array to store all the answers from course 1
										// loop through the file line by line until end-of-file
										while(!feof($course_file_1)) {
											$a_line = fgets($course_file_1); // read only 1 line from the file
											$a_line_array = explode("|",$a_line); // split the line if | is identified
											array_push($course_1_questions,$a_line_array[0]); // add the each question to the array
											@$options = rtrim(ltrim($a_line_array[1],"{'"),"'}") ; // remove the {" at the begining of the options and remove the "} at the end of the options 
											array_push($course_1_options,$options); // add the options to the array
											@$answers = rtrim(ltrim($a_line_array[2][1],'{'),'}') ; // remove the { at the begining of the answer and remove the } at the end of the answer 
											array_push($course_1_answers,$answers); // add the answer to the array
										}
										$correct_option1 = implode(",",$course_1_answers);
										$sql = "UPDATE candidates SET correct_option1='$correct_option1' WHERE candidates_registration_no = '$registration_no'";
										if(!mysqli_query($conn, $sql)){
											die("Unable to store correct options");
										}
										fclose($course_file_1);
										
										// preparing the course 2 questions, options and answers
										$course_file_2 = fopen('files/'.$courses_file_array[1], "r") or die("Unable to open file!");
										$course_2_questions = array(); // an array to store all the questions from course 2
										$course_2_options = array(); // an array to store all the options from course 2
										$course_2_answers = array(); // an array to store all the answers from course 2
										// loop through the file line by line until end-of-file
										while(!feof($course_file_2)) {
											$a_line = fgets($course_file_2); // read only 1 line from the file
											$a_line_array = explode("|",$a_line); // split the line if | is identified
											array_push($course_2_questions,$a_line_array[0]); // add the each question to the array
											@$options = rtrim(ltrim($a_line_array[1],"{'"),"'}") ; // remove the {" at the begining of the options and remove the "} at the end of the options 
											array_push($course_2_options,$options); // add the options to the array
											@$answers = rtrim(ltrim($a_line_array[2][1],'{'),'}') ; // remove the { at the begining of the answer and remove the } at the end of the answer 
											array_push($course_2_answers,$answers); // add the answer to the array
										}
										$correct_option2 = implode(",",$course_2_answers);
										$sql = "UPDATE candidates SET correct_option2='$correct_option2' WHERE candidates_registration_no = '$registration_no'";
										if(!mysqli_query($conn, $sql)){
											die("Unable to store correct options");
										}
										fclose($course_file_2);
										
										// preparing the course 3 questions, options and answers
										$course_file_3 = fopen('files/'.$courses_file_array[2], "r") or die("Unable to open file!");
										$course_3_questions = array(); // an array to store all the questions from course 3
										$course_3_options = array(); // an array to store all the options from course 3
										$course_3_answers = array(); // an array to store all the answers from course 3
										// loop through the file line by line until end-of-file
										while(!feof($course_file_3)) {
											$a_line = fgets($course_file_3); // read only 1 line from the file
											$a_line_array = explode("|",$a_line); // split the line if | is identified
											array_push($course_3_questions,$a_line_array[0]); // add the each question to the array
											@$options = rtrim(ltrim($a_line_array[1],"{'"),"'}") ; // remove the {" at the begining of the options and remove the "} at the end of the options 
											array_push($course_3_options,$options); // add the options to the array
											@$answers = rtrim(ltrim($a_line_array[2][1],'{'),'}') ; // remove the { at the begining of the answer and remove the } at the end of the answer 
											array_push($course_3_answers,$answers); // add the answer to the array
										}
										$correct_option3 = implode(",",$course_3_answers);
										$sql = "UPDATE candidates SET correct_option3='$correct_option3' WHERE candidates_registration_no = '$registration_no'";
										if(!mysqli_query($conn, $sql)){
											die("Unable to store correct options");
										}
										fclose($course_file_3);
										
										// preparing the course 4 questions, options and answers
										$course_file_4 = fopen('files/'.$courses_file_array[3], "r") or die("Unable to open file!");
										$course_4_questions = array(); // an array to store all the questions from course 4
										$course_4_options = array(); // an array to store all the options from course 4
										$course_4_answers = array(); // an array to store all the answers from course 4
										// loop through the file line by line until end-of-file
										while(!feof($course_file_4)) {
											$a_line = fgets($course_file_4); // read only 1 line from the file
											$a_line_array = explode("|",$a_line); // split the line if | is identified
											array_push($course_4_questions,$a_line_array[0]); // add the each question to the array
											@$options = rtrim(ltrim($a_line_array[1],"{'"),"'}") ; // remove the {" at the begining of the options and remove the "} at the end of the options 
											array_push($course_4_options,$options); // add the options to the array
											@$answers = rtrim(ltrim($a_line_array[2][1],'{'),'}') ; // remove the { at the begining of the answer and remove the } at the end of the answer 
											array_push($course_4_answers,$answers); // add the answer to the array
										}
										$correct_option4 = implode(",",$course_4_answers);
										$sql = "UPDATE candidates SET correct_option4='$correct_option4' WHERE candidates_registration_no = '$registration_no'";
										if(!mysqli_query($conn, $sql)){
											die("Unable to store correct options");
										}
										fclose($course_file_4);
									?>
								</div>
								
								<div id="<?php echo $courses_code_array[0];?>" class="tabcontent col-md-12">
									<p id="course1QuestioId"><?php echo $course_1_questions[0];?></p>
									<form id="options_form1">
										<?php
											$explode_options1 = explode("'_'",$course_1_options[0]);
											$abcdeArray_option1 = ["A", "B", "C", "D"];
											for ($x = 0; $x <= 3; $x++) {
												if($course1_score[0] == $abcdeArray_option1[$x]){
													echo $abcdeArray_option1[$x].' <input type="radio" name="option1" value="'.$abcdeArray_option1[$x].'" checked><b id="option1'.$abcdeArray_option1[$x].'"> '. $explode_options1[$x] .'</b><br>';
												}else{
													echo $abcdeArray_option1[$x].' <input type="radio" name="option1" value="'.$abcdeArray_option1[$x].'"><b id="option1'.$abcdeArray_option1[$x].'"> '. $explode_options1[$x] .'</b><br>';
												}
												
											}
										?>	
									</form>
									<br>
									<div class="row">
										<div class="col-6"><button id="course1Prev" type="button" class="btn btn-success" onclick="course1Prev()">Prev</button></div>
										<div class="col-6"><button id="course1Next" type="button" class="btn btn-success float-right" onclick="course1Next()">Next</button></div>
										<hr class="col-10">
										<div id="course1Map" class="col-12"></div>
									</div>
								</div>

								<div id="<?php echo $courses_code_array[1];?>" class="tabcontent col-md-12">
									<p id="course2QuestioId"><?php echo $course_2_questions[0];?></p> 
									<form id="options_form2">
										<?php
											$explode_options2 = explode("'_'",$course_2_options[0]);
											$abcdeArray_option2 = ["A", "B", "C", "D"];
											for ($x = 0; $x <= 3; $x++) {
												if($course2_score[0] == $abcdeArray_option2[$x]){
													echo $abcdeArray_option2[$x].' <input type="radio" name="option2" value="'.$abcdeArray_option2[$x].'" checked><b id="option2'.$abcdeArray_option2[$x].'"> '. $explode_options2[$x] .'</b><br>';
												}else{
													echo $abcdeArray_option2[$x].' <input type="radio" name="option2" value="'.$abcdeArray_option2[$x].'"><b id="option2'.$abcdeArray_option2[$x].'"> '. $explode_options2[$x] .'</b><br>';
												}
											}
										?>	
									</form>
									<br>
									<div class="row">
										<div class="col-6"><button id="course2Prev" type="button" class="btn btn-success" onclick="course2Prev()">Prev</button></div>
										<div class="col-6"><button id="course2Next" type="button" class="btn btn-success float-right" onclick="course2Next()">Next</button></div>
										<hr class="col-10">
										<div id="course2Map" class="col-12"></div>
									</div>
								</div>

								<div id="<?php echo $courses_code_array[2];?>" class="tabcontent col-md-12">
									<p id="course3QuestioId"><?php echo $course_3_questions[0];?></p>
									<form id="options_form3">
										<?php
											$explode_options3 = explode("'_'",$course_3_options[0]);
											$abcdeArray_option3 = ["A", "B", "C", "D"];
											for ($x = 0; $x <= 3; $x++) {
												if($course3_score[0] == $abcdeArray_option3[$x]){
													echo $abcdeArray_option3[$x].' <input type="radio" name="option3" value="'.$abcdeArray_option3[$x].'" checked><b id="option3'.$abcdeArray_option3[$x].'"> '. $explode_options3[$x] .'</b><br>';
												}else{
													echo $abcdeArray_option3[$x].' <input type="radio" name="option3" value="'.$abcdeArray_option3[$x].'"><b id="option3'.$abcdeArray_option3[$x].'"> '. $explode_options3[$x] .'</b><br>';
												}
											}
										?>	
									</form>
									<br>
									<div class="row">
										<div class="col-6"><button id="course3Prev" type="button" class="btn btn-success" onclick="course3Prev()">Prev</button></div>
										<div class="col-6"><button id="course3Next" type="button" class="btn btn-success float-right" onclick="course3Next()">Next</button></div>
										<hr class="col-10">
										<div id="course3Map" class="col-12"></div>
									</div>
								</div>
								
								<div id="<?php echo $courses_code_array[3];?>" class="tabcontent col-md-12">
									<p id="course4QuestioId"><?php echo $course_4_questions[0];?></p>
									<form id="options_form4">
										<?php
											$explode_options4 = explode("'_'",$course_4_options[0]);
											$abcdeArray_option4 = ["A", "B", "C", "D"];
											for ($x = 0; $x <= 3; $x++) {
												if($course4_score[0] == $abcdeArray_option4[$x]){
													echo $abcdeArray_option4[$x].' <input type="radio" name="option4" value="'.$abcdeArray_option4[$x].'" checked><b id="option4'.$abcdeArray_option4[$x].'"> '. $explode_options4[$x] .'</b><br>';
												}else{
													echo $abcdeArray_option4[$x].' <input type="radio" name="option4" value="'.$abcdeArray_option4[$x].'"><b id="option4'.$abcdeArray_option4[$x].'"> '. $explode_options4[$x] .'</b><br>';
												}
											}
										?>	
									</form>
									<br>
									<div class="row">
										<div class="col-6"><button id="course4Prev" type="button" class="btn btn-success" onclick="course4Prev()">Prev</button></div>
										<div class="col-6"><button id="course4Next" type="button" class="btn btn-success float-right" onclick="course4Next()">Next</button></div>
										<hr class="col-10">
										<div id="course4Map" class="col-12"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		   </div>
        </div>

		
		<!-- The timeUp Modal -->
		<div id="timeUpModal" class="modal row">
		  <!-- timeUp Modal content -->
		  <div class="modal-content col-12 text-center">
			<h3 class="text-danger">Your time is up!!!<br>Proceed to finish</>
			<div class="row">
				<div class="col-12"><button type="button" class="btn btn-success justify-content-center" onclick="endTest()">End</button></div>
			</div>
		  </div>
		</div><!--/timeUpModal-->

		  <!-- The Submit Modal -->
		  <div class="modal" id="submitModal">
			<div class="modal-dialog">
			  <div class="modal-content">
				
				<!-- Modal body -->
				<div class="modal-body">
				  <div class="modal-content col-12">
					<h3>Are you sure you want to submit ?</h3>
					<div class="row">
						<div class="col-6"><button type="button" class="btn btn-success" onclick="endTest()">Continue</button></div>
						<div class="col-6"><button type="button" class="btn btn-danger float-right" data-dismiss="modal">Cancel</button></div>
					</div>
				  </div>
				</div>
				
			  </div>
			</div>
		  </div><!--/submitModal-->

			
		
		
		<script>
			var activeCourseCount;
			document.getElementsByClassName("tablinks")[0].click();	//make the first subject/course active
		
			//Block for timer counter start
			var secs = 60;
			var mins = <?php echo $time_available;?>;
			if(mins == 0){
				document.getElementById("timer").innerHTML = "<span class='text-danger'>TIME UP!!!</span>";
				document.getElementById('timeUpModal').style.display = 'block'
			}
			var registration_no = document.getElementById("registration_no").value;
			var course1_score = <?php echo '["' . implode('", "', $course1_score) . '"]'?>;
			var course2_score = <?php echo '["' . implode('", "', $course2_score) . '"]'?>;
			var course3_score = <?php echo '["' . implode('", "', $course3_score) . '"]'?>;
			var course4_score = <?php echo '["' . implode('", "', $course4_score) . '"]'?>;

			var x = setInterval(timerFunc, 1000);
			function timerFunc() { 
			  secs -= 1;
			  document.getElementById("timer").innerHTML = mins + ": " + secs ;
			  if (secs == 0) {
				if(mins == 0){
					document.getElementById("timer").innerHTML = "<span class='text-danger'>TIME UP!!!</span>";
					document.getElementById('timeUpModal').style.display = 'block'
					clearInterval(x);
				}else{
					secs = 60;
					mins -= 1;
					secs -= 1;
					var xhttpTimer = new XMLHttpRequest();
					xhttpTimer.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							// do something!!!
						}
					};
					xhttpTimer.open("POST", "asynchronously.php", true);
					xhttpTimer.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttpTimer.send("mins="+mins+"&registration_no="+registration_no);
				}
			  }
			  
			}
			
			//function for opening each subject tab
			function openSubject(evt, courseCode, activeCourseCount) {
			  var i, tabcontent, tablinks;
			  tabcontent = document.getElementsByClassName("tabcontent");
			  for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			  }
			  tablinks = document.getElementsByClassName("tablinks");
			  for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			  }
			  document.getElementById(courseCode).style.display = "block";
			  evt.currentTarget.className += " active";
			  window.activeCourseCount = activeCourseCount;
			}
			
			btnMapFunction(course1_score, 'course1Map', 1);// calling the btnMapFunction() to create button map for course1
			btnMapFunction(course2_score, 'course2Map', 2);// calling the btnMapFunction() to create button map for course2
			btnMapFunction(course3_score, 'course3Map', 3);// calling the btnMapFunction() to create button map for course3
			btnMapFunction(course4_score, 'course4Map', 4);// calling the btnMapFunction() to create button map for course4
			
			function btnMapFunction(array, divId, courseId) {
				for (i = 0; i < array.length; i++) {
					var btn = document.createElement("BUTTON");
					btn.innerHTML = i+1;
					var id_att = document.createAttribute("id");// Create an "id" attribute
					id_att.value = divId+(i+1);// give each button a unique Id
					btn.setAttributeNode(id_att);// Add the Id attribute to <BUTTON> 
					var class_att = document.createAttribute("class");// Create a "class" attribute
					if(array[i] == 0){
						class_att.value = "btn btn-danger";// change button to red if question is not answered yet
					}else{
						class_att.value = "btn btn-success";// change button to green if question have been answered
					}
					btn.setAttributeNode(class_att);// Add the class attribute to <BUTTON> 
					var onclick_att = document.createAttribute("onclick");// Create an "onclick" attribute
					onclick_att.value = "mapTo("+(i+1)+","+courseId+")";//give each button an onclick listener
					btn.setAttributeNode(onclick_att);// Add the onclick attribute to <BUTTON>
					document.getElementById(divId).appendChild(btn);
				}
			}
			
			var course_1_questions = <?php echo '["' . implode('", "', $course_1_questions) . '"]'?>;
			var course_1_options = <?php echo '["' . implode('", "', $course_1_options) . '"]'?>;
			var course1_count = 0;
			function course1Prev() { 
				var text = "";
				if (course1_count == 0) {
					//Do Nothing
				}else {
					var form = document.getElementById("options_form1");
					if(form.elements["option1"].value == ""){
						// do Nothing!!!
					}else{
						course1_score[course1_count] = form.elements["option1"].value;
						var arrayToString = course1_score.toString();
						
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								// do something!!!
							}
						};
						xhttp.open("POST", "asynchronously.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("options="+arrayToString+"&registration_no="+registration_no+"&course1=course1_score");
						document.getElementById("course1Map"+(course1_count+1)).setAttribute("class", "btn btn-success"); // change the map button to green
					}
					
					course1_count--;
					document.getElementById("course1QuestioId").innerHTML = course_1_questions[course1_count];
					
					var arr = course_1_options[course1_count].split("'_'");
					var abcdeArray_option1 = ["A", "B", "C", "D"];
					for (i = 0; i <= 3; i++) {
						if(course1_score[course1_count] == abcdeArray_option1[i]){
							text += abcdeArray_option1[i]+' <input type="radio" name="option1" value="'+abcdeArray_option1[i]+'" checked><b id="option1'+abcdeArray_option1[i]+'"> '+ arr[i] +'</b><br>';
						}else{
							text += abcdeArray_option1[i]+' <input type="radio" name="option1" value="'+abcdeArray_option1[i]+'"><b id="option1'+abcdeArray_option1[i]+'"> '+ arr[i] +'</b><br>';
						}
					}
					document.getElementById("options_form1").innerHTML = text;
				}
			}
			
			function course1Next() {
				var text = "";
				if (course1_count == 59) {
					//Do Nothing
				}else {
					var form = document.getElementById("options_form1");
					if(form.elements["option1"].value == ""){
						// do Nothing!!!
					}else{
						course1_score[course1_count] = form.elements["option1"].value;
						var arrayToString = course1_score.toString();
						
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								// do something!!!
							}
						};
						xhttp.open("POST", "asynchronously.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("options="+arrayToString+"&registration_no="+registration_no+"&course1=course1_score");
						document.getElementById("course1Map"+(course1_count+1)).setAttribute("class", "btn btn-success"); // change the map button to green
					}
					
					course1_count++;
					document.getElementById("course1QuestioId").innerHTML = course_1_questions[course1_count];
					
					var arr = course_1_options[course1_count].split("'_'");
					var abcdeArray_option1 = ["A", "B", "C", "D"];
					for (i = 0; i <= 3; i++) {
						if(course1_score[course1_count] == abcdeArray_option1[i]){
							text += abcdeArray_option1[i]+' <input type="radio" name="option1" value="'+abcdeArray_option1[i]+'" checked><b id="option1'+abcdeArray_option1[i]+'"> '+ arr[i] +'</b><br>';
						}else{
							text += abcdeArray_option1[i]+' <input type="radio" name="option1" value="'+abcdeArray_option1[i]+'"><b id="option1'+abcdeArray_option1[i]+'"> '+ arr[i] +'</b><br>';
						}
					}
					document.getElementById("options_form1").innerHTML = text;
				}
			}
			
			var course_2_questions = <?php echo '["' . implode('", "', $course_2_questions) . '"]'?>;
			var course_2_options = <?php echo '["' . implode('", "', $course_2_options) . '"]'?>;
			var course2_count = 0;
			function course2Prev() {
				var text = "";
				if (course2_count == 0) {
					//Do Nothing
				}else {
					var form = document.getElementById("options_form2");
					if(form.elements["option2"].value == ""){
						// do Nothing!!!
					}else{
						course2_score[course2_count] = form.elements["option2"].value;
						var arrayToString = course2_score.toString();
						
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								// do something!!!
							}
						};
						xhttp.open("POST", "asynchronously.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("options="+arrayToString+"&registration_no="+registration_no+"&course2=course2_score");
						document.getElementById("course2Map"+(course2_count+1)).setAttribute("class", "btn btn-success"); // change the map button to green
					}
					
					course2_count--;
					document.getElementById("course2QuestioId").innerHTML = course_2_questions[course2_count];
					
					var arr = course_2_options[course2_count].split("'_'");
					var abcdeArray_option2 = ["A", "B", "C", "D"];
					for (i = 0; i <= 3; i++) {
						if(course2_score[course2_count] == abcdeArray_option2[i]){
							text += abcdeArray_option2[i]+' <input type="radio" name="option2" value="'+abcdeArray_option2[i]+'" checked><b id="option2'+abcdeArray_option2[i]+'"> '+ arr[i] +'</b><br>';
						}else{
							text += abcdeArray_option2[i]+' <input type="radio" name="option2" value="'+abcdeArray_option2[i]+'"><b id="option2'+abcdeArray_option2[i]+'"> '+ arr[i] +'</b><br>';
						}
					}
					document.getElementById("options_form2").innerHTML = text;
				}
			}
			
			function course2Next() {
				var text = "";
				if (course2_count == 49) {
					//Do Nothing
				}else {
					var form = document.getElementById("options_form2");
					if(form.elements["option2"].value == ""){
						// do Nothing!!!
					}else{
						course2_score[course2_count] = form.elements["option2"].value;
						var arrayToString = course2_score.toString();
						
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								// do something!!!
							}
						};
						xhttp.open("POST", "asynchronously.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("options="+arrayToString+"&registration_no="+registration_no+"&course2=course2_score");
						document.getElementById("course2Map"+(course2_count+1)).setAttribute("class", "btn btn-success"); // change the map button to green
					}
					
					course2_count++;
					document.getElementById("course2QuestioId").innerHTML = course_2_questions[course2_count];
					
					var arr = course_2_options[course2_count].split("'_'");
					var abcdeArray_option2 = ["A", "B", "C", "D"];
					for (i = 0; i <= 3; i++) {
						if(course2_score[course2_count] == abcdeArray_option2[i]){
							text += abcdeArray_option2[i]+' <input type="radio" name="option2" value="'+abcdeArray_option2[i]+'" checked><b id="option2'+abcdeArray_option2[i]+'"> '+ arr[i] +'</b><br>';
						}else{
							text += abcdeArray_option2[i]+' <input type="radio" name="option2" value="'+abcdeArray_option2[i]+'"><b id="option2'+abcdeArray_option2[i]+'"> '+ arr[i] +'</b><br>';
						}
					}
					document.getElementById("options_form2").innerHTML = text;
				}
			}
			
			var course_3_questions = <?php echo '["' . implode('", "', $course_3_questions) . '"]'?>;
			var course_3_options = <?php echo '["' . implode('", "', $course_3_options) . '"]'?>;
			var course3_count = 0;
			function course3Prev() {
				var text = "";
				if (course3_count == 0) {
					//Do Nothing
				}else {
					var form = document.getElementById("options_form3");
					if(form.elements["option3"].value == ""){
						// do Nothing!!!
					}else{
						course3_score[course3_count] = form.elements["option3"].value;
						var arrayToString = course3_score.toString();
						
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								// do something!!!
							}
						};
						xhttp.open("POST", "asynchronously.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("options="+arrayToString+"&registration_no="+registration_no+"&course3=course3_score");
						document.getElementById("course3Map"+(course3_count+1)).setAttribute("class", "btn btn-success"); // change the map button to green
					}
					
					course3_count--;
					document.getElementById("course3QuestioId").innerHTML = course_3_questions[course3_count];
					
					var arr = course_3_options[course3_count].split("'_'");
					var abcdeArray_option3 = ["A", "B", "C", "D"];
					for (i = 0; i <= 3; i++) {
						if(course3_score[course3_count] == abcdeArray_option3[i]){
							text += abcdeArray_option3[i]+' <input type="radio" name="option3" value="'+abcdeArray_option3[i]+'" checked><b id="option3'+abcdeArray_option3[i]+'"> '+ arr[i] +'</b><br>';
						}else{
							text += abcdeArray_option3[i]+' <input type="radio" name="option3" value="'+abcdeArray_option3[i]+'"><b id="option3'+abcdeArray_option3[i]+'"> '+ arr[i] +'</b><br>';
						}
					}
					document.getElementById("options_form3").innerHTML = text;
				}
			}
			
			function course3Next() {
				var text = "";
				if (course3_count == 49) {
					//Do Nothing
				}else {
					var form = document.getElementById("options_form3");
					if(form.elements["option3"].value == ""){
						// do Nothing!!!
					}else{
						course3_score[course3_count] = form.elements["option3"].value;
						var arrayToString = course3_score.toString();
						
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								// do something!!!
							}
						};
						xhttp.open("POST", "asynchronously.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("options="+arrayToString+"&registration_no="+registration_no+"&course3=course3_score");
						document.getElementById("course3Map"+(course3_count+1)).setAttribute("class", "btn btn-success"); // change the map button to green
					}
					
					course3_count++;
					document.getElementById("course3QuestioId").innerHTML = course_3_questions[course3_count];
					
					var arr = course_3_options[course3_count].split("'_'");
					var abcdeArray_option3 = ["A", "B", "C", "D"];
					for (i = 0; i <= 3; i++) {
						if(course3_score[course3_count] == abcdeArray_option3[i]){
							text += abcdeArray_option3[i]+' <input type="radio" name="option3" value="'+abcdeArray_option3[i]+'" checked><b id="option3'+abcdeArray_option3[i]+'"> '+ arr[i] +'</b><br>';
						}else{
							text += abcdeArray_option3[i]+' <input type="radio" name="option3" value="'+abcdeArray_option3[i]+'"><b id="option3'+abcdeArray_option3[i]+'"> '+ arr[i] +'</b><br>';
						}
					}
					document.getElementById("options_form3").innerHTML = text;
				}
			}
			
			var course_4_questions = <?php echo '["' . implode('", "', $course_4_questions) . '"]'?>;
			var course_4_options = <?php echo '["' . implode('", "', $course_4_options) . '"]'?>;
			var course4_count = 0;
			function course4Prev() {
				var text = "";
				if (course4_count == 0) {
					//Do Nothing
				}else {
					var form = document.getElementById("options_form4");
					if(form.elements["option4"].value == ""){
						// do Nothing!!!
					}else{
						course4_score[course4_count] = form.elements["option4"].value;
						var arrayToString = course4_score.toString();
						
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								// do something!!!
							}
						};
						xhttp.open("POST", "asynchronously.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("options="+arrayToString+"&registration_no="+registration_no+"&course4=course4_score");
						document.getElementById("course4Map"+(course4_count+1)).setAttribute("class", "btn btn-success"); // change the map button to green
					}
					
					course4_count--;
					document.getElementById("course4QuestioId").innerHTML = course_4_questions[course4_count];
					
					var arr = course_4_options[course4_count].split("'_'");
					var abcdeArray_option4 = ["A", "B", "C", "D"];
					for (i = 0; i <= 3; i++) {
						if(course4_score[course4_count] == abcdeArray_option4[i]){
							text += abcdeArray_option4[i]+' <input type="radio" name="option4" value="'+abcdeArray_option4[i]+'" checked><b id="option4'+abcdeArray_option4[i]+'"> '+ arr[i] +'</b><br>';
						}else{
							text += abcdeArray_option4[i]+' <input type="radio" name="option4" value="'+abcdeArray_option4[i]+'"><b id="option4'+abcdeArray_option4[i]+'"> '+ arr[i] +'</b><br>';
						}
					}
					document.getElementById("options_form4").innerHTML = text;
				}
			}
			
			function course4Next() {
				var text = "";
				if (course4_count == 49) {
					//Do Nothing
				}else {
					var form = document.getElementById("options_form4");
					if(form.elements["option4"].value == ""){
						// do Nothing!!!
					}else{
						course4_score[course4_count] = form.elements["option4"].value;
						var arrayToString = course4_score.toString();
						
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								// do something!!!
							}
						};
						xhttp.open("POST", "asynchronously.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("options="+arrayToString+"&registration_no="+registration_no+"&course4=course4_score");
						document.getElementById("course4Map"+(course4_count+1)).setAttribute("class", "btn btn-success"); // change the map button to green
					}
					
					course4_count++;
					document.getElementById("course4QuestioId").innerHTML = course_4_questions[course4_count];
					
					var arr = course_4_options[course4_count].split("'_'");
					var abcdeArray_option4 = ["A", "B", "C", "D"];
					for (i = 0; i <= 3; i++) {
						if(course4_score[course4_count] == abcdeArray_option4[i]){
							text += abcdeArray_option4[i]+' <input type="radio" name="option4" value="'+abcdeArray_option4[i]+'" checked><b id="option4'+abcdeArray_option4[i]+'"> '+ arr[i] +'</b><br>';
						}else{
							text += abcdeArray_option4[i]+' <input type="radio" name="option4" value="'+abcdeArray_option4[i]+'"><b id="option4'+abcdeArray_option4[i]+'"> '+ arr[i] +'</b><br>';
						}
					}
					document.getElementById("options_form4").innerHTML = text;
				}
			}
			
			function mapTo(questionNo, courseId){// function included to each mapping button to navigate to the question number
				var text = "";
				if(courseId == 1){ // check if the clicked button is for course 1 
					var form = document.getElementById("options_form1");
					if(form.elements["option1"].value == ""){
						// do Nothing!!!
					}else{
						course1_score[course1_count] = form.elements["option1"].value;
						var arrayToString = course1_score.toString();
						
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								// do something!!!
							}
						};
						xhttp.open("POST", "asynchronously.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("options="+arrayToString+"&registration_no="+registration_no+"&course1=course1_score");
						document.getElementById("course1Map"+(course1_count+1)).setAttribute("class", "btn btn-success"); // change the map button to green
					}
					
					course1_count = questionNo - 1;
					document.getElementById("course1QuestioId").innerHTML = course_1_questions[course1_count];
					
					var arr = course_1_options[course1_count].split("'_'");
					var abcdeArray_option1 = ["A", "B", "C", "D"];
					for (i = 0; i <= 3; i++) {
						if(course1_score[course1_count] == abcdeArray_option1[i]){
							text += abcdeArray_option1[i]+' <input type="radio" name="option1" value="'+abcdeArray_option1[i]+'" checked><b id="option1'+abcdeArray_option1[i]+'"> '+ arr[i] +'</b><br>';
						}else{
							text += abcdeArray_option1[i]+' <input type="radio" name="option1" value="'+abcdeArray_option1[i]+'"><b id="option1'+abcdeArray_option1[i]+'"> '+ arr[i] +'</b><br>';
						}
					}
					document.getElementById("options_form1").innerHTML = text;
				}else if(courseId == 2){ // check if the clicked button is for course 2 
					var form = document.getElementById("options_form2");
					if(form.elements["option2"].value == ""){
						// do Nothing!!!
					}else{
						course2_score[course2_count] = form.elements["option2"].value;
						var arrayToString = course2_score.toString();
						
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								// do something!!!
							}
						};
						xhttp.open("POST", "asynchronously.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("options="+arrayToString+"&registration_no="+registration_no+"&course2=course2_score");
						document.getElementById("course2Map"+(course2_count+1)).setAttribute("class", "btn btn-success"); // change the map button to green
					}
					
					course2_count = questionNo - 1;
					document.getElementById("course2QuestioId").innerHTML = course_2_questions[course2_count];
					
					var arr = course_2_options[course2_count].split("'_'");
					var abcdeArray_option2 = ["A", "B", "C", "D"];
					for (i = 0; i <= 3; i++) {
						if(course2_score[course2_count] == abcdeArray_option2[i]){
							text += abcdeArray_option2[i]+' <input type="radio" name="option2" value="'+abcdeArray_option2[i]+'" checked><b id="option2'+abcdeArray_option2[i]+'"> '+ arr[i] +'</b><br>';
						}else{
							text += abcdeArray_option2[i]+' <input type="radio" name="option2" value="'+abcdeArray_option2[i]+'"><b id="option2'+abcdeArray_option2[i]+'"> '+ arr[i] +'</b><br>';
						}
					}
					document.getElementById("options_form2").innerHTML = text;
				}else if(courseId == 3){ // check if the clicked button is for course 3
					var form = document.getElementById("options_form3");
					if(form.elements["option3"].value == ""){
						// do Nothing!!!
					}else{
						course3_score[course3_count] = form.elements["option3"].value;
						var arrayToString = course3_score.toString();
						
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								// do something!!!
							}
						};
						xhttp.open("POST", "asynchronously.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("options="+arrayToString+"&registration_no="+registration_no+"&course3=course3_score");
						document.getElementById("course3Map"+(course3_count+1)).setAttribute("class", "btn btn-success"); // change the map button to green
					}
					
					course3_count = questionNo - 1;
					document.getElementById("course3QuestioId").innerHTML = course_3_questions[course3_count];
					
					var arr = course_3_options[course3_count].split("'_'");
					var abcdeArray_option3 = ["A", "B", "C", "D"];
					for (i = 0; i <= 3; i++) {
						if(course3_score[course3_count] == abcdeArray_option3[i]){
							text += abcdeArray_option3[i]+' <input type="radio" name="option3" value="'+abcdeArray_option3[i]+'" checked><b id="option3'+abcdeArray_option3[i]+'"> '+ arr[i] +'</b><br>';
						}else{
							text += abcdeArray_option3[i]+' <input type="radio" name="option3" value="'+abcdeArray_option3[i]+'"><b id="option3'+abcdeArray_option3[i]+'"> '+ arr[i] +'</b><br>';
						}
					}
					document.getElementById("options_form3").innerHTML = text;
				}else if(courseId == 4){ // check if the clicked button is for course 4
					var form = document.getElementById("options_form4");
					if(form.elements["option4"].value == ""){
						// do Nothing!!!
					}else{
						course4_score[course4_count] = form.elements["option4"].value;
						var arrayToString = course4_score.toString();
						
						var xhttp = new XMLHttpRequest();
						xhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								// do something!!!
							}
						};
						xhttp.open("POST", "asynchronously.php", true);
						xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhttp.send("options="+arrayToString+"&registration_no="+registration_no+"&course4=course4_score");
						document.getElementById("course4Map"+(course4_count+1)).setAttribute("class", "btn btn-success"); // change the map button to green
					}
					
					course4_count = questionNo - 1;
					document.getElementById("course4QuestioId").innerHTML = course_4_questions[course4_count];
					
					var arr = course_4_options[course4_count].split("'_'");
					var abcdeArray_option4 = ["A", "B", "C", "D"];
					for (i = 0; i <= 3; i++) {
						if(course4_score[course4_count] == abcdeArray_option4[i]){
							text += abcdeArray_option4[i]+' <input type="radio" name="option4" value="'+abcdeArray_option4[i]+'" checked><b id="option4'+abcdeArray_option4[i]+'"> '+ arr[i] +'</b><br>';
						}else{
							text += abcdeArray_option4[i]+' <input type="radio" name="option4" value="'+abcdeArray_option4[i]+'"><b id="option4'+abcdeArray_option4[i]+'"> '+ arr[i] +'</b><br>';
						}
					}
					document.getElementById("options_form4").innerHTML = text;
				}
			}
			
			//Load the calculator
			$('#target-div').load('cal.html #content');
			//Calculator function
			function calcNumbers(result){
				form.displayResult.value=form.displayResult.value+result;
			}
			
			//add event listeners for keyboard user
			window.addEventListener('keydown', (event) => {
				if(event.keyCode === 78){
					//Press N for Next Button
					if(activeCourseCount === 1){
						course1Next();						
					}else if(activeCourseCount === 2){
						course2Next();
					}else if(activeCourseCount === 3){
						course3Next();
					}else if(activeCourseCount === 4){
						course4Next();
					}
				}else if(event.keyCode === 80){
					//Press P for Prev Button
					if(activeCourseCount === 1){
						course1Prev();
					}else if(activeCourseCount === 2){
						course2Prev();
					}else if(activeCourseCount === 3){
						course3Prev();
					}else if(activeCourseCount === 4){
						course4Prev();
					}
				}else if(event.keyCode === 65){
					//Press A for A Button
					if(activeCourseCount === 1){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[0].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[0].checked = true;
					}else if(activeCourseCount === 2){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[1].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[0].checked = true;
					}else if(activeCourseCount === 3){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[2].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[0].checked = true;
					}else if(activeCourseCount === 4){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[3].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[0].checked = true;
					}
				}else if(event.keyCode === 66){
					//Press B for B Button
					if(activeCourseCount === 1){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[0].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[1].checked = true;
					}else if(activeCourseCount === 2){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[1].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[1].checked = true;
					}else if(activeCourseCount === 3){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[2].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[1].checked = true;
					}else if(activeCourseCount === 4){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[3].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[1].checked = true;
					}
				}else if(event.keyCode === 67){
					//Press C for C Button
					if(activeCourseCount === 1){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[0].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[2].checked = true;
					}else if(activeCourseCount === 2){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[1].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[2].checked = true;
					}else if(activeCourseCount === 3){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[2].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[2].checked = true;
					}else if(activeCourseCount === 4){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[3].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[2].checked = true;
					}
				}else if(event.keyCode === 68){
					//Press C for C Button
					if(activeCourseCount === 1){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[0].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[3].checked = true;
					}else if(activeCourseCount === 2){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[1].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[3].checked = true;
					}else if(activeCourseCount === 3){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[2].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[3].checked = true;
					}else if(activeCourseCount === 4){
						var x = document.getElementsByClassName("tabcontent");	
						var y = x[3].childNodes[3];
						var z = y.getElementsByTagName('input');
						z[3].checked = true;
					}
				}
			})
			
			function endTest(){
				document.getElementById("course1Prev").click()
				document.getElementById("course1Next").click()
				document.getElementById("course2Prev").click()
				document.getElementById("course2Next").click()
				document.getElementById("course3Prev").click()
				document.getElementById("course3Next").click()
				document.getElementById("course4Prev").click()
				document.getElementById("course4Next").click()
				$("#submitModal").modal("hide")
				window.location.replace("result.php");
			}	
			
		</script>
	</body>
</html>
<?php ob_end_flush(); ?>