<?php
    ob_start();
    session_start();
    include_once "../includes/dbconnection.php";
    
    $emailErr = $passwordErr = "";
    if(isset($_POST["submit"])){

        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);

        if(empty($email) || empty($password)){
            $emailErr = "Empty";
            $passwordErr = "Empty";
        }else{
            $sql = "SELECT * FROM administrator WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $result_check = mysqli_num_rows($result);
            if($result_check < 1){
                $emailErr = "Error";
                $passwordErr = "Error";
            }else{
                if($row = mysqli_fetch_assoc($result)){
                    if(!($password == $row["password"])){
                        $emailErr = "Error";
                        $passwordErr = "Error";
                    }elseif($password == $row["password"]){
                        // Log in the user here
                        $_SESSION["s_firstname"] = $row["firstname"];
                        $_SESSION["s_lastname"] = $row["lastname"];
                        $_SESSION["s_email"] = $row["email"];
                        $_SESSION["s_level"] = $row["level"];

                        header("Location: users.php");
                    }
                }
            }
        }
    } else{
        
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
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
		
		<div class="container">
			<div class="row">
				<div class="col-sm-3 .visible-xs, hidden-xs"></div>
				<div class="col-sm-6 jumbotron">
					<div class="header text-center">
					  <h4>Login</h4>
					</div>
					<div class="container">
					  <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="form-group">
						  <label for="email">Username</label><span class="text-danger"> *<?php echo $emailErr;?></span>
						  <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" style="border-radius:12px;" required>
							
						  <label for="password">Password</label><span class="text-danger"> *<?php echo $passwordErr;?></span>
						  <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" style="border-radius:12px;" required>
						  <br>
						
						  <button type="submit" name="submit" class="btn btn-success btn-block" style="border-radius:12px;"><span class="glyphicon glyphicon-off"></span> Login</button>
						</div>
					  </form>
					</div>	
				</div>	
			</div>
		</div>
		
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/jquery-3.1.1.min.js"></script>
	</body>
</html>
<?php ob_end_flush(); ?>