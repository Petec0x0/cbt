<?php
    ob_start();
    session_start();
    include_once "../includes/dbconnection.php";
	if(!(isset($_SESSION["s_firstname"]))){
        die("Access denied");
    }
	
	function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
	$fullname = $registration_no = $phone_no = $email = $course1_id = $course2_id = $course3_id = $course4_id = "";
	$fullnameErr = $registration_noErr = $phone_noErr = $emailErr = $coursesErr = "";
	$fullname_validated = $registration_no_validated = $phone_no_validated = $email_validated = $course1_id_validated = $course2_id_validated = $course3_id_validated = $course4_id_validated = "";
	
	if (isset($_POST["submit"])) {
		
		if(empty($_POST["fullname"])){
			$fullnameErr = "Full Name is required";
		}else{
			$fullname = test_input($_POST["fullname"]);
			// check if name only contains letters and whitespace
			if (!preg_match("/^[a-zA-Z ]*$/",$fullname)) {
			$fullnameErr = "Only letters and white space allowed"; 
			}
			else{
				$fullname_validated = true;
			}
		}
		
		if(empty($_POST["registration_no"])){
			$registration_noErr = "Reg no. is required";
		}else{
			$registration_no = test_input($_POST["registration_no"]);
			// check if reg no. only contains letters and numbers
			if (!preg_match("/^[a-zA-Z0-9]*$/",$registration_no)) {
			$registration_noErr = "Only letters and numbers allowed"; 
			}
			else{
				//check if registration_no already exist
				$sql = "SELECT * FROM candidates WHERE candidates_registration_no = '$registration_no'";
				$result = mysqli_query($conn, $sql);
				$result_check = mysqli_num_rows($result);
				if($result_check > 0){
					$registration_noErr = "Registration no. already Exist";
				}else{
					$registration_no_validated = true;
				}
			}
		}
		
		if(empty($_POST["phone_no"])){
			$phone_noErr = "Reg no. is required";
		}else{
			$phone_no = test_input($_POST["phone_no"]);
			// check if  only contains numbers
			if (!preg_match("/^[0-9]*$/",$phone_no)) {
			$phone_noErr = "Only numbers allowed"; 
			}
			else{
				$phone_no_validated = true;
			}
		}
		
		if(empty($_POST["email"])){
			$emailErr = "Email is required";
		}else{
			$email = test_input($_POST["email"]);
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  $emailErr = "Invalid email format"; 
			}else{
				$email_validated = true;
			}
		 } 
		  
		if(empty($_POST["course1_id"])){
			$coursesErr = "Invalid course 1 Selected ";
		}else{
			$course1_id = test_input($_POST["course1_id"]);
			if($course1_id == "Select"){
				$coursesErr = "Invalid course 1 Selected ";
			}else{
				$course1_id_validated = true;
			}
		}
		
		if(empty($_POST["course2_id"])){
			$coursesErr = "Invalid course 2 Selected ";
		}else{
			$course2_id = test_input($_POST["course2_id"]);
			if($course2_id == "Select course 2"){
				$coursesErr = "Invalid course 2 Selected ";
			}else{
				$course2_id_validated = true;
			}
		}
		
		if(empty($_POST["course3_id"])){
			$coursesErr = "Invalid course 3 Selected ";
		}else{
			$course3_id = test_input($_POST["course3_id"]);
			if($course3_id == "Select course 3"){
				$coursesErr = "Invalid course 3 Selected ";
			}else{
				$course3_id_validated = true;
			}
		}
		
		if(empty($_POST["course4_id"])){
			$coursesErr = "Invalid course 4 Selected ";
		}else{
			$course4_id = test_input($_POST["course4_id"]);
			if($course4_id == "Select course 4"){
				$coursesErr = "Invalid course 4 Selected ";
			}else{
				$course4_id_validated = true;
			}
		}
		
		if($fullname_validated && $registration_no_validated && $phone_no_validated && $email_validated && $course1_id_validated && $course2_id_validated && $course3_id_validated && $course4_id_validated){
			$sql = "INSERT INTO candidates (candidates_fullname, candidates_registration_no, candidates_phone_no, candidates_email, course1_id, course2_id, course3_id, course4_id) VALUES ('$fullname', '$registration_no', '$phone_no', '$email', '$course1_id', '$course2_id', '$course3_id', '$course4_id')";
			if(mysqli_query($conn, $sql)){
				echo '<div class="alert alert-success alert-dismissable text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><strong>Success!</strong> User created successfully.</div>';
				//header("Location: login.php");
			}else{
				echo '<div class="alert alert-danger text-center"><strong>Error!</strong>.</div>';
			}
		}
  
	}	
   
   
?>   

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>JAMB mock e-Testing</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon"  href="../assets/img/logo.png">
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-grid.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-grid.min.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-reboot.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-reboot.min.css">
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/css/main.css">
		<style>
		</style>
	</head>
	<body>
		
		<nav class="navbar navbar-expand-md bg-dark navbar-dark">
		  <a class="navbar-brand" href="#">Ule Admin</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav">
			  <li class="nav-item">
				<a class="nav-link" href="users.php">Candidates</a>
			  </li>    
			</ul>
		  </div>  
		</nav>
		
		<div class="container">
			
			<div class="container">
				<div class="row">
					<div class="col-sm-2 .visible-xs, hidden-xs"></div>
					<div class="col-sm-8 jumbotron">
						<div class="header text-center">
						  <h4>New User Registration</h4>
						</div>
						<div class="container">
						  <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label for="fullname">Full name</label><span class="text-danger"> *<?php echo $fullnameErr;?></span>
										<input type="text" name="fullname" class="form-control" id="fullname" placeholder="Enter Full name" style="border-radius:12px;" required>
									</div>	
									<div class="col-sm-6">
										<label for="registration_no">Registration no.</label><span class="text-danger"> *<?php echo $registration_noErr;?></span>
										<input type="text" name="registration_no" class="form-control" id="registration_no" placeholder="Enter Registration no." style="border-radius:12px;" required>
									</div>
									<div class="col-sm-6">
										<label for="phone_no">Phone no.</label><span class="text-danger"> *<?php echo $phone_noErr;?></span>
										<input type="tel" name="phone_no" class="form-control" id="phone_no" placeholder="Enter Phone no." style="border-radius:12px;" required>
									</div>
									<div class="col-sm-6">
										<label for="email">Email</label><span class="text-danger"> *<?php echo $emailErr;?></span>
										<input type="email" name="email" class="form-control" id="email" placeholder="Enter email" style="border-radius:12px;" required>
									</div>
									<div class="col-sm-6">
										<label for="courses">Courses</label><span class="text-danger"> *<?php echo $coursesErr;?></span>
										<select name="course1_id" class="form-control" style="border-radius:12px;" required>
											<option value="1" selected>Use of English</option>
										</select>
									</div>
									<div class="col-sm-6">
										<br>
										<select name="course2_id" class="form-control" style="border-radius:12px;" required>
											<option value="default"disabled selected>Select course 2</option>
											<?php 
												$sql = "SELECT * FROM `courses` WHERE 1";
												$result = mysqli_query($conn, $sql);
												while($course = mysqli_fetch_assoc($result)){
													echo '<option value="'.$course['id'].'">'.$course['course_name'].'</option>';													
												}
											?>
										</select>
									</div>
									<div class="col-sm-6">
										<select name="course3_id" class="form-control" style="border-radius:12px;" required>
											<option value="default"disabled selected>Select course 3</option>
											<?php 
												$sql = "SELECT * FROM `courses` WHERE 1";
												$result = mysqli_query($conn, $sql);
												while($course = mysqli_fetch_assoc($result)){
													echo '<option value="'.$course['id'].'">'.$course['course_name'].'</option>';													
												}
											?>
										</select>
									</div>
									<div class="col-sm-6">
										<select name="course4_id" class="form-control" style="border-radius:12px;" required>
											<option value="default"disabled selected>Select course 4</option>
											<?php 
												$sql = "SELECT * FROM `courses` WHERE 1";
												$result = mysqli_query($conn, $sql);
												while($course = mysqli_fetch_assoc($result)){
													echo '<option value="'.$course['id'].'">'.$course['course_name'].'</option>';													
												}
											?>
										</select>
									</div>
									<br><br>
									<button type="submit" name="submit" class="btn btn-success btn-block" style="border-radius:12px;"><span class="glyphicon glyphicon-off"></span> Login</button>
								</div>
							</div>
						  </form>
						</div>	
					</div>	
					<div class="col-sm-2 .visible-xs, hidden-xs"></div>
				</div>
			</div>
			
			<!---->
			
			<div class="container-fluid">
                <table class="table table-striped">
                    <thead class="thead-dark">
                      <tr>
                        <th>ID</th>  
                        <th>Full name</th>
                        <th>Reg no.</th>
                        <th>Phone no.</th>
                        <th>Email</th>
						<th>Courses</th>
						<th>Scores</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM `candidates` WHERE 1";
                    	    $result = mysqli_query($conn, $sql);
                    	    while($candidate = mysqli_fetch_assoc($result)){								
                    	        echo '<tr>';
                    	        echo '<td>'.$candidate['candidates_id'].'</td>';
                    	        echo '<td>'.$candidate['candidates_fullname'].'</td>';
                    	        echo '<td>'.$candidate['candidates_registration_no'].'</td>';
                    	        echo '<td>'.$candidate['candidates_phone_no'].'</td>';
                    	        echo '<td>'.$candidate['candidates_email'].'</td>';
								//Courses
								echo '<td>';
								$courses_sql = "SELECT * FROM `courses` WHERE `id` = ".$candidate['course1_id']." OR `id` = ".$candidate['course2_id']." OR `id` = ".$candidate['course3_id']." OR `id` = ".$candidate['course4_id'];
								$courses_result = mysqli_query($conn, $courses_sql);
								while($course = mysqli_fetch_assoc($courses_result)){
									echo '<i>'.$course['course_name'].'</i><br>';									
								}
								echo '</td>';
								//Scores 
								echo '<td>';
								$course1_score = explode(',', $candidate['course1_score']);
								$course2_score = explode(',', $candidate['course2_score']);
								$course3_score = explode(',', $candidate['course3_score']);
								$course4_score = explode(',', $candidate['course4_score']);
								$correct_option1 = explode(',', $candidate['correct_option1']);
								$correct_option2 = explode(',', $candidate['correct_option2']);
								$correct_option3 = explode(',', $candidate['correct_option3']);
								$correct_option4 = explode(',', $candidate['correct_option4']);
								
								$subject_1_score = 0;
								for($i = 0; $i < count($course1_score); $i++) {
									if(strtoupper($course1_score[$i]) === strtoupper($correct_option1[$i])){
										$subject_1_score++;
									}									
								}
								
								$subject_2_score = 0;
								for($i = 0; $i < count($course2_score); $i++) {
									if(strtoupper($course2_score[$i]) === strtoupper($correct_option2[$i])){
										$subject_2_score++;
									}									
								}
								
								$subject_3_score = 0;
								for($i = 0; $i < count($course3_score); $i++) {
									if(strtoupper($course3_score[$i]) === strtoupper($correct_option3[$i])){
										$subject_3_score++;
									}									
								}
								
								$subject_4_score = 0;
								for($i = 0; $i < count($course4_score); $i++) {
									if(strtoupper($course4_score[$i]) === strtoupper($correct_option4[$i])){
										$subject_4_score++;
									}									
								}
								echo '<i>'.round(($subject_1_score*100)/60).'</i><br>';
								echo '<i>'.round(($subject_2_score*100)/50).'</i><br>';
								echo '<i>'.round(($subject_3_score*100)/50).'</i><br>';
								echo '<i>'.round(($subject_4_score*100)/50).'</i><br>';								
								echo '</td>';								
								
                    	        echo '</tr>';
                    	    }
                    	?>
                     </tbody>
                </table>  
			</div>
		</div>
		
		
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/jquery-3.1.1.min.js"></script>
	</body>
</html>
<?php ob_end_flush(); ?>