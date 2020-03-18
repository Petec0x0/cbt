<?php
include_once "includes/dbconnection.php";

$response = array();

// Update time on database every min if a post request of min and reg. no. is sent
if(isset($_POST["mins"]) && isset($_POST["registration_no"])){
	$mins = $_POST["mins"];
	$registration_no = $_POST["registration_no"];
	$sql = "UPDATE candidates SET time_available='$mins' WHERE candidates_registration_no = '$registration_no'";
	if(mysqli_query($conn, $sql)){
        $response['error'] = false;
        $response['message'] = "Time Updated Successfully";
    }else{
        $response['error'] = true;
        $response['message'] = "Time Update Failed";
    }
	echo json_encode($response);
}

// Update answered options for course 1
if(isset($_POST["options"]) && isset($_POST["registration_no"]) && isset($_POST["course1"])){
	$options = $_POST["options"];
	$registration_no = $_POST["registration_no"];
	$sql = "UPDATE candidates SET course1_score='$options' WHERE candidates_registration_no = '$registration_no'";
	if(mysqli_query($conn, $sql)){
        $response['error'] = false;
        $response['message'] = "Scores Updated Successfully";
    }else{
        $response['error'] = true;
        $response['message'] = "Scores Update Failed";
    }
	echo json_encode($response);
}

// Update answered options for course 2
if(isset($_POST["options"]) && isset($_POST["registration_no"]) && isset($_POST["course2"])){
	$options = $_POST["options"];
	$registration_no = $_POST["registration_no"];
	$sql = "UPDATE candidates SET course2_score='$options' WHERE candidates_registration_no = '$registration_no'";
	if(mysqli_query($conn, $sql)){
        $response['error'] = false;
        $response['message'] = "Scores Updated Successfully";
    }else{
        $response['error'] = true;
        $response['message'] = "Scores Update Failed";
    }
	echo json_encode($response);
}

// Update answered options for course 3
if(isset($_POST["options"]) && isset($_POST["registration_no"]) && isset($_POST["course3"])){
	$options = $_POST["options"];
	$registration_no = $_POST["registration_no"];
	$sql = "UPDATE candidates SET course3_score='$options' WHERE candidates_registration_no = '$registration_no'";
	if(mysqli_query($conn, $sql)){
        $response['error'] = false;
        $response['message'] = "Scores Updated Successfully";
    }else{
        $response['error'] = true;
        $response['message'] = "Scores Update Failed";
    }
	echo json_encode($response);
}

// Update answered options for course 4
if(isset($_POST["options"]) && isset($_POST["registration_no"]) && isset($_POST["course4"])){
	$options = $_POST["options"];
	$registration_no = $_POST["registration_no"];
	$sql = "UPDATE candidates SET course4_score='$options' WHERE candidates_registration_no = '$registration_no'";
	if(mysqli_query($conn, $sql)){
        $response['error'] = false;
        $response['message'] = "Scores Updated Successfully";
    }else{
        $response['error'] = true;
        $response['message'] = "Scores Update Failed";
    }
	echo json_encode($response);
}

?>