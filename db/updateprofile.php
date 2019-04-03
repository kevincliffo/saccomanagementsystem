<?php
	$response = array();
	include 'db_connect.php';
	include 'functions.php';

	//Get the input request parameters

	$inputJSON = file_get_contents('php://input');
	if(get_magic_quotes_gpc()){
		$param = stripslashes($inputJSON);
	}
	else{
		$param = $inputJSON;
	}
	$input = json_decode($param, TRUE); //convert JSON into array

	//Check for Mandatory parameters
	if(isset($input['memberNo']) && isset($input['birthDate']) && isset($input['email'])){
		$birthDate = $input['birthDate'];
		$mobileNo = $input['mobileNo'];
		$email = $input['email'];
		$address = $input['address'];
        $memberNo = $input['memberNo'];
		
		$updateQuery  = " UPDATE members SET Email='$email', "
							  . " BirthDate='$birthDate', MobileNo='$mobileNo', Email='$email', "
							  . " Address='$address' WHERE MemberNo='$memberNo'";
															  
		if (mysqli_query($con, $updateQuery))
		{
			$response["status"] = 0;
			$response["message"] = "Record updated successfully";				
		} 
		else 
		{
			$response["status"] = 0;
			$response["message"] = "Update Failed ". mysqli_error($con);
		}

	}
	else{
		$response["status"] = 2;
		$response["message"] = "Missing mandatory parameters";
	}
	echo json_encode($response);
?>
