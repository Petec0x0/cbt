<?php
    ob_start();
    session_start();
    include_once "includes/dbconnection.php";
	if(!(isset($_SESSION["s_fullname"]))){
		header("location: index.php");
        die("Access denied");
    }
	
?>	

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>JAMB mock e-Testing</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon"  href="assets/img/logo.png">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap.css">
		<link rel="stylesheet" href="assets/css/bootstrap-grid.css">
		<link rel="stylesheet" href="assets/css/bootstrap-grid.min.css">
		<link rel="stylesheet" href="assets/css/bootstrap-reboot.css">
		<link rel="stylesheet" href="assets/css/bootstrap-reboot.min.css">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/main.css">
		<style>
		body {
			background:url('assets/img/background.jpg') no-repeat;
			background-size: cover;
			padding:50px;
		}
		img {
            border-radius: 50%;
        }		
		</style>
	</head>
	<body>
		<div class="container-fluid">
           <div class="row">
			<div class="container">
				<div class="card">
					<div class="card-header alert alert-success text-success text-center">WELCOME TO JAMB MOCK e-TESTING</div>
					<div class="card-body">
						
						<div class="row">
							<div class="col-md-8"> <span><i class="fa fa-user"></i> Logged in with <b><?php echo $_SESSION["s_registration_no"];?></b></span>
								<h3>Available Examinations</h3>
								<div class="table-responsive">
									<table class="table table-striped table-hover" id="sub">
										<thead>
											<tr>
												<th>#</th>
												<th>Code</th>
												<th>Title</th>
											</tr>
										</thead>
										<tbody>
										<?php 
											$sql = "SELECT * FROM `courses` WHERE `id` = ".$_SESSION['s_course1_id']." OR `id` = ".$_SESSION['s_course2_id']." OR `id` = ".$_SESSION['s_course3_id']." OR `id` = ".$_SESSION['s_course4_id'];
											$result = mysqli_query($conn, $sql);
											$count = 1;
											while($course = mysqli_fetch_assoc($result)){
												echo '<tr>';
												echo '<td>'.$count.'</td>';
												echo '<td>'.$course['course_code'].'</td>';
												echo '<td>'.$course['course_name'].'</td>';
												echo '</tr>';
												$count ++;
											}
										?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card">
									<div class="card-header"><center><img class="img-rounded" src="assets/img/avatar_2x.png" width="100px" height="100px" alt="Card image cap"></center></div>
									<div class="card-body">
										<ul class="list-group list-group-flush">
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
									</div>	
									<div class="card-footer">
										<span><a href="exams.php" class="btn btn-success">Start Exam</a></span>
									</div>
								</div>
							</div>
						</div>
						
						
                    </div>
				</div>
			</div>
		   </div>
        </div>

		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery-3.1.1.min.js"></script>
	</body>
</html>
<?php ob_end_flush(); ?>