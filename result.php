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
			$correct_option1 = explode(',', $row['correct_option1']);
			$correct_option2 = explode(',', $row['correct_option2']);
			$correct_option3 = explode(',', $row['correct_option3']);
			$correct_option4 = explode(',', $row['correct_option4']);
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
		
		<style>
			body {
				background:url('assets/img/background.jpg') no-repeat;
				background-size: cover;
				padding:10px;
			}	
		</style>	
	</head>
	<body>	
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header"><center><img class="img-rounded" src="assets/img/avatar_2x.png" width="100px" height="100px" alt="Card image cap"></center></div>
					<div class="card-body">
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item">
								<b id="juser"> <?php echo $_SESSION["s_fullname"];?></b>
							</li>
							<li class="list-group-item">
								<b class="regid"> <?php echo $_SESSION["s_registration_no"];?></b>
							</li>
							<li class="list-group-item">
								<b id="jexam"> Examination: JAMB MOCK 2019/2020</b>
							</li>
						</ul>
						
						<div class="col-md-12"> 
							<div class="table-responsive">
								<table class="table table-striped table-hover" id="sub">
									<thead>
										<tr>
											<th>#</th>
											<th>Code</th>
											<th>Title</th>
											<th>Scores</th>
										</tr>
									</thead>
									<tbody>
									<?php 
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
										$scoreArray = [round(($subject_1_score*100)/60), round(($subject_2_score*100)/50), round(($subject_3_score*100)/50), round(($subject_4_score*100)/50)];
										$total = 0;
										
										$sql = "SELECT * FROM `courses` WHERE `id` = ".$_SESSION['s_course1_id']." OR `id` = ".$_SESSION['s_course2_id']." OR `id` = ".$_SESSION['s_course3_id']." OR `id` = ".$_SESSION['s_course4_id'];
										$result = mysqli_query($conn, $sql);
										$count = 1;
										while($course = mysqli_fetch_assoc($result)){
											echo '<tr>';
											echo '<td>'.$count.'</td>';
											echo '<td>'.$course['course_code'].'</td>';
											echo '<td>'.$course['course_name'].'</td>';
											echo '<td>'.$scoreArray[$count-1].'</td>';
											echo '</tr>';
											$total = $total + $scoreArray[$count-1];
											$count ++;
										}
									?>
									<tr><!--The last row for total-->
										<td></td>
										<td></td>
										<td><b>Total</b></td>
										<td><b><?php echo $total;?></b></td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-12"><button type="button" class="btn btn-danger float-right" onclick="window.location.replace('logout.php');">Close</button></div>
					</div>	
				</div>
			</div>
			
			
		</div>
	</div>
	
	</body>
	</html>
<?php ob_end_flush(); ?>