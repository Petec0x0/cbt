<?php
    ob_start();
    session_start();
    include_once "includes/dbconnection.php";
	
	function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }	
	
    $registration_noErr = "";
    if(isset($_POST["submit"])){

        $registration_no = test_input($_POST["registration_no"]);
        
        if(empty($registration_no)){
            $registration_noErr = "Empty Field";
        }else{
            $sql = "SELECT * FROM candidates WHERE candidates_registration_no = '$registration_no'";
            $result = mysqli_query($conn, $sql);
            $result_check = mysqli_num_rows($result);
            if($result_check < 1){
                $registration_noErr = "Invalid Registration no.";
            }else{
				if($row = mysqli_fetch_assoc($result)){
					// Log in the user here
					$_SESSION["s_fullname"] = $row["candidates_fullname"];
					$_SESSION["s_registration_no"] = $row["candidates_registration_no"];
					$_SESSION["s_course1_id"] = $row["course1_id"];
					$_SESSION["s_course2_id"] = $row["course2_id"];
					$_SESSION["s_course3_id"] = $row["course3_id"];
					$_SESSION["s_course4_id"] = $row["course4_id"];
					$_SESSION["s_time_available"] = $row["time_available"];

					header("Location: dashboard.php");
				}
            }
        }
    } else{
        
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
		</style>
	</head>
	<body>
		<div class="container-fluid">
           <div class="row">
			<div class="container">
				<div class="card">
					<div class="card-header alert alert-success text-success text-center">WELCOME TO JAMB MOCK e-TESTING</div>
					<div class="card-body">
						<form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<div class="row">
								<div class="col-md-4">
									<img src="assets/img/logo.png" />
								</div>
								<div class="col-md-4">
									<b>Enter Your JAMB Registration No.</b><span class="text-danger"> *<?php echo $registration_noErr;?></span> <br />
									<input type="text" id="registration_no" name="registration_no" class="form-control" placeholder="Registration No"/>
								</div>
								<div class="col-md-4">
								   <br />
									<button type="submit" name="submit" class="btn btn-success"> Login</button>
								</div>
							</div>
						</form>
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