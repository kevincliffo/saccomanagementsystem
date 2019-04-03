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
	if(isset($input['memberNo']) && isset($input['amount']) && isset($input['fullName'])){
 		$memberNo = $input['memberNo'];
		$amount = $input['amount'];
		$fullName = $input['fullName'];
		$deductionDate = $input['deductionDate'];	
		$corrected = 0;
		
		$insertQuery  = "INSERT INTO errorneousdeductions(MemberNo, FullName, Amount, DeductionDate, Corrected) VALUES (?,?,?,?,?)";
		if($stmt = $con->prepare($insertQuery)){
			$stmt->bind_param("ssdsi",$memberNo,$fullName,$amount,$deductionDate,$corrected);
			$stmt->execute();
			$response["status"] = 0;
			$response["message"] = "Request Sucessful";
			$stmt->close();
		}

	}
	else{
		$response["status"] = 2;
		$response["message"] = "Missing mandatory parameters";
	}
	echo json_encode($response);
?>
